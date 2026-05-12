<?php
session_start();
if(empty($_SESSION['user_id'])){ header('Location: /index.php'); exit; }
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard - GardenHost</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="min-h-screen bg-slate-50">
  <header class="bg-white shadow p-4 flex justify-between items-center">
    <div class="flex items-center gap-3">
      <div class="logo-mark bg-green-700 text-white p-3 rounded"><i class="fas fa-cloud"></i></div>
      <h1 class="text-lg font-bold">GardenHost Dashboard</h1>
    </div>
    <div><a href="/api/logout.php" class="px-3 py-1 bg-red-500 text-white rounded">Logout</a></div>
  </header>
  <main class="p-8">
    <div id="profileArea">
      <h2 class="text-2xl font-semibold">Selamat datang, <?=htmlspecialchars($_SESSION['user_email'])?></h2>
      <p class="text-slate-600 mt-2">Akun aktif.</p>
    </div>
  </main>
</body>
</html>
