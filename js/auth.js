// Handles login and register forms
document.addEventListener('DOMContentLoaded', ()=>{
  const loginForm = document.getElementById('loginForm');
  if(loginForm){
    loginForm.addEventListener('submit', async (e)=>{
      e.preventDefault();
      clearMessage('#loginMessage');
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value;
      try{
        const res = await fetch('/api/login', {
          method:'POST', headers:{'Content-Type':'application/json'},
          body: JSON.stringify({ email, password })
        });
        const data = await res.json();
        if(res.ok && data && data.ok){
          showMessage('#loginMessage','Login berhasil! Mengalihkan...','success');
          setTimeout(()=> window.location.href = '/dashboard.html', 700);
        } else {
          showMessage('#loginMessage', data && data.error ? data.error : 'Login gagal','error');
        }
      }catch(err){
        showMessage('#loginMessage', 'Terjadi kesalahan jaringan','error');
      }
    });
  }

  const registerForm = document.getElementById('registerForm');
  if(registerForm){
    registerForm.addEventListener('submit', async (e)=>{
      e.preventDefault();
      clearMessage('#registerMessage');
      const email = document.getElementById('reg_email').value.trim();
      const password = document.getElementById('reg_password').value;
      try{
        const res = await fetch('/api/register', {
          method:'POST', headers:{'Content-Type':'application/json'},
          body: JSON.stringify({ email, password })
        });
        const data = await res.json();
        if(res.ok && data && data.ok){
          showMessage('#registerMessage','Akun dibuat. Silakan masuk.','success');
          setTimeout(()=> window.location.href = '/', 900);
        } else {
          showMessage('#registerMessage', data && data.error ? data.error : 'Pendaftaran gagal','error');
        }
      }catch(err){
        showMessage('#registerMessage', 'Terjadi kesalahan jaringan','error');
      }
    });
  }

  // logout button
  const logoutBtn = document.getElementById('logoutBtn');
  if(logoutBtn){
    logoutBtn.addEventListener('click', async ()=>{
      await fetch('/api/logout', { method:'POST' });
      window.location.href = '/';
    });
  }
});
