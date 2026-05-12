# GardenHost (SkyHost demo)

Local development:

1. Install dependencies:

```bash
npm install
```

2. Jalankan server:

```bash
npm start
# lalu buka http://localhost:3000
```

Fitur yang ditambahkan:
- Frontend: `css/styles.css`, `js/main.js`, `js/auth.js` (login/register/logout)
- Backend: `server.js` (Express) dengan endpoint `/api/register`, `/api/login`, `/api/logout`, `/api/profile`
- Database: SQLite di `data/database.sqlite` (diinisialisasi otomatis)

Catatan keamanan: ini contoh minimal untuk demo lokal. Untuk produksi, gunakan HTTPS, penyimpanan session yang persisten, validasi input lebih kuat, dan konfigurasi secret dari env.
# GardenHost