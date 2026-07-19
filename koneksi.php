<?php
// Mengambil kredensial secara dinamis dari Environment Variables Railway
$host = getenv('MYSQLHOST') ?: 'mysql.railway.internal'; 
$user = getenv('MYSQLUSER') ?: 'root';            
$pass = getenv('MYSQLPASSWORD') ?: 'lXsjsxIWppjDsElqfoTkyRqfeqfovjfb';   
$db   = getenv('MYSQL_DATABASE') ?: 'railway';   
$port = getenv('MYSQLPORT') ?: '3306'; 

try {
    // String koneksi (DSN) sekarang fully dynamic
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    
    $koneksi = new PDO($dsn, $user, $pass);
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Jangan lupa hapus echo ini kalau sudah sukses di production
    // echo "Koneksi sukses!"; 
} catch (PDOException $e) {
    // Di tahap produksi, jangan tampilkan getMessage() ke user umum karena berbahaya
    echo "Koneksi database gagal: " . $e->getMessage();
    die();
}
?>
