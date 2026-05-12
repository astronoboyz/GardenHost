const express = require('express');
const path = require('path');
const fs = require('fs');
const bcrypt = require('bcryptjs');
const session = require('express-session');
const sqlite3 = require('sqlite3').verbose();

const app = express();
const PORT = process.env.PORT || 3000;

// ensure data dir
const dataDir = path.join(__dirname, 'data');
if(!fs.existsSync(dataDir)) fs.mkdirSync(dataDir, { recursive: true });

const dbPath = path.join(dataDir, 'database.sqlite');
const db = new sqlite3.Database(dbPath);

db.serialize(()=>{
  db.run(`CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
  )`);
});

app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(session({ secret: process.env.SESSION_SECRET || 'change_this_secret', resave:false, saveUninitialized:false }));

app.use(express.static(path.join(__dirname)));

app.post('/api/register', (req,res)=>{
  const { email, password } = req.body || {};
  if(!email || !password) return res.status(400).json({ error: 'Email dan password diperlukan' });
  const hashed = bcrypt.hashSync(password, 10);
  const stmt = db.prepare('INSERT INTO users (email,password) VALUES (?,?)');
  stmt.run(email, hashed, function(err){
    if(err){
      if(err.code === 'SQLITE_CONSTRAINT') return res.status(409).json({ error: 'Email sudah terdaftar' });
      return res.status(500).json({ error: 'Gagal membuat akun' });
    }
    res.json({ ok:true });
  });
});

app.post('/api/login', (req,res)=>{
  const { email, password } = req.body || {};
  if(!email || !password) return res.status(400).json({ error: 'Email dan password diperlukan' });
  db.get('SELECT id,email,password FROM users WHERE email = ?', [email], (err,row)=>{
    if(err) return res.status(500).json({ error: 'Gagal membaca database' });
    if(!row) return res.status(401).json({ error: 'Kredensial salah' });
    const ok = bcrypt.compareSync(password, row.password);
    if(!ok) return res.status(401).json({ error: 'Kredensial salah' });
    req.session.userId = row.id;
    res.json({ ok:true, user: { email: row.email } });
  });
});

app.post('/api/logout', (req,res)=>{
  req.session.destroy(()=>{
    res.json({ ok:true });
  });
});

app.get('/api/profile', (req,res)=>{
  if(!req.session.userId) return res.status(401).json({ error: 'Unauthorized' });
  db.get('SELECT id,email,created_at FROM users WHERE id = ?', [req.session.userId], (err,row)=>{
    if(err || !row) return res.status(500).json({ error: 'User not found' });
    res.json({ ok:true, user: row });
  });
});

app.listen(PORT, ()=>{
  console.log(`Server running on http://localhost:${PORT}`);
});
