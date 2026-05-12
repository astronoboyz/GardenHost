<?php session_start(); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Daftar - SkyHost</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-md p-8">
    <div class="text-center mb-8"><h1 class="text-2xl font-bold">Daftar SkyHost</h1><p class="text-slate-500">Buat akun untuk mengelola layanan cloud Anda</p></div>
    <div class="bg-white p-8 rounded-2xl shadow-xl">
      <?php if(!empty($_SESSION['flash_error'])): ?>
        <div class="message error"><?=htmlspecialchars($_SESSION['flash_error'])?></div>
        <?php unset($_SESSION['flash_error']); endif; ?>
      <form action="/api/register.php" method="post" class="space-y-4">
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
          <input name="email" type="email" required class="w-full px-3 py-2 border rounded" placeholder="email@contoh.com">
        </div>
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-2">Kata Sandi</label>
          <input name="password" type="password" required class="w-full px-3 py-2 border rounded" placeholder="Minimal 6 karakter">
        </div>
        <div class="mt-2"><button class="w-full bg-blue-600 text-white py-2 rounded">Daftar</button></div>
      </form>
      <div class="mt-4 text-center text-sm text-slate-600">Sudah punya akun? <a href="/index.php" class="text-blue-600">Masuk</a></div>
    </div>
  </div>
</body>
</html>
