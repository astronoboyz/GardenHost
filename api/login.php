<?php
// api/login.php
require_once __DIR__ . '/../config.php';
session_start();
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(405);
    exit;
}
$email = trim($_POST['email'] ?? '');
$pass  = $_POST['password'] ?? '';
if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $pass === ''){
    $_SESSION['flash_error'] = 'Email atau password tidak boleh kosong';
    header('Location: /index.php'); exit;
}
try{
    $pdo = getPDO();
    $stmt = $pdo->prepare('SELECT id,email,password FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if(!$user || !password_verify($pass, $user['password'])){
        $_SESSION['flash_error'] = 'Kredensial salah';
        header('Location: /index.php'); exit;
    }
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    header('Location: /dashboard.php'); exit;
}catch(PDOException $e){
    error_log($e->getMessage());
    $_SESSION['flash_error'] = 'Terjadi kesalahan server';
    header('Location: /index.php'); exit;
}
