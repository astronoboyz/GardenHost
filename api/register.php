<?php
// api/register.php
require_once __DIR__ . '/../config.php';
session_start();
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(405);
    exit;
}
$email = trim($_POST['email'] ?? '');
$pass  = $_POST['password'] ?? '';
if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($pass) < 6){
    $_SESSION['flash_error'] = 'Email tidak valid atau password kurang dari 6 karakter';
    header('Location: /register.php'); exit;
}
try{
    $pdo = getPDO();
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO users (email,password) VALUES (?, ?)');
    $stmt->execute([$email, $hash]);
    $_SESSION['flash_success'] = 'Akun berhasil dibuat. Silakan masuk.';
    header('Location: /index.php'); exit;
}catch(PDOException $e){
    if(stripos($e->getMessage(), 'duplicate') !== false || strpos($e->getMessage(),'1062') !== false){
        $_SESSION['flash_error'] = 'Email sudah terdaftar';
        header('Location: /register.php'); exit;
    }
    error_log($e->getMessage());
    $_SESSION['flash_error'] = 'Terjadi kesalahan server';
    header('Location: /register.php'); exit;
}
