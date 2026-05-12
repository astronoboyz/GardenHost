<?php session_start(); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - GardenHost</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-md p-8">
    <div class="text-center mb-10">
      <div class="inline-flex items-center justify-center w-16 h-16 bg-green-700 rounded-xl mb-4 shadow-lg shadow-green-200">
        <i class="fas fa-server text-white text-2xl"></i>
      </div>
      <h1 class="text-2xl font-bold text-slate-800">GardenHost</h1>
      <p class="text-slate-500">Kelola infrastruktur cloud Anda</p>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-xl shadow-slate-200 border border-slate-100">
      <?php if(!empty($_SESSION['flash_error'])): ?>
        <div class="message error"><?=htmlspecialchars($_SESSION['flash_error'])?></div>
        <?php unset($_SESSION['flash_error']); endif; ?>
      <?php if(!empty($_SESSION['flash_success'])): ?>
        <div class="message success"><?=htmlspecialchars($_SESSION['flash_success'])?></div>
        <?php unset($_SESSION['flash_success']); endif; ?>

      <form action="/api/login.php" method="post" class="space-y-6">
        <div>
          <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400"><i class="far fa-envelope"></i></span>
            <input id="email" name="email" type="email" required class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-lg" placeholder="nama@email.com">
          </div>
        </div>
        <div>
          <label for="password" class="text-sm font-semibold text-slate-700 mb-2">Kata Sandi</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400"><i class="fas fa-lock"></i></span>
            <input id="password" name="password" type="password" required class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-lg" placeholder="••••••••">
          </div>
        </div>
        <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white font-bold py-3 rounded-lg">Masuk ke Dashboard</button>
      </form>

      <div class="mt-8 pt-6 border-t border-slate-100 text-center">
        <p class="text-sm text-slate-600">Belum punya akun? <a href="/register.php" class="font-bold text-green-700 hover:underline">Daftar Sekarang</a></p>
      </div>
    </div>

    <div class="mt-8 text-center text-xs text-slate-400">&copy; 2026 GardenHost.</div>
  </div>
</body>
</html>
