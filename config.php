<?php
// config.php - konfigurasi koneksi MySQL (sesuaikan jika perlu)
return (object)[
    'db_host' => '127.0.0.1',
    'db_port' => 3306,
    'db_name' => 'gardenhost',
    'db_user' => 'root',
    'db_pass' => ''
];

function getPDO(){
    $c = include __DIR__ . '/config.php';
    $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4', $c->db_host, $c->db_port, $c->db_name);
    $opts = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];
    return new PDO($dsn, $c->db_user, $c->db_pass, $opts);
}
