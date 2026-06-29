<?php
include 'koneksi.php';

if(isset($_GET['username']) && isset($_GET['password'])){
    $username = $_GET['username'];
    $password = $_GET['password'];

    $query = $koneksi->prepare("SELECT * FROM user WHERE username = :user AND password = :pass");
    $query->execute(['user' => $username, 'pass' => $password]);
    $data = $query->fetch();

    if($data){
        echo "berhasil";
    } else {
        echo "gagal";
    }
}
?>