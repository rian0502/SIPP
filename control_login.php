<?php
require_once "config.php";
$konek = new Connection();
if (isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $stmt = $konek->getKoneksi()->prepare("SELECT username, password FROM akun WHERE username= ?");
    $stmt->bindParam(1, $user);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($res != null){
        if (password_verify($pass,$res['password'])){
            session_start();
            $_SESSION["login"] = $res['username'];
            header("Location: index.php");
        }else{
            echo '<script type="text/javascript"> alert("Username & password tidak cocok");window.location.href="login.html"; </script>';
        }
    }else{
        echo '<script type="text/javascript"> alert("Username tidak ditemukan");window.location.href="login.html"; </script>';
    }
}else{
    header("Location: login.html");
}