<?php
// Hubungkan dengan file koneksi.php bawaan lu
include 'koneksi.php';

// Pastiin parameter username dan password dikirim via GET
if (isset($_GET['username']) && isset($_GET['password'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];
    
    try {
        // 1. Cek terlebih dahulu apakah username sudah terdaftar
        $cek = $koneksi->prepare("SELECT * FROM user WHERE username = :user");
        $cek->execute(['user' => $username]);
        
        if ($cek->rowCount() > 0) {
            // Jika username sudah ada yang pakai
            echo "ada";
        } else {
            // 2. Jika username belum terdaftar, masukkan data baru ke tabel user
            $insert = $koneksi->prepare("INSERT INTO user (username, password) VALUES (:user, :pass)");
            $sukses = $insert->execute(['user' => $username, 'pass' => $password]);
            
            if ($sukses) {
                echo "berhasil";
            } else {
                echo "gagal";
            }
        }
    } catch (PDOException $e) {
        // Tampilkan pesan error jika query gagal dieksekusi
        echo "Error: " . $e->getMessage();
    }
}
?>
