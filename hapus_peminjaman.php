<?php
session_start();
if (!isset($_SESSION['login'])){
    header("Location: login.html");
}else{
    require_once "config.php";
    require_once "check_data.php";
    $before = Check::checkData();
    if (isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $con = new Connection();
        $stmt = $con->getKoneksi()->prepare("DELETE FROM `peminjaman` WHERE id_pinjam = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $stmt->closeCursor();
        $after = Check::checkData();
        echo '<script type="text/javascript"> alert("Data berhasil dihapus");window.location.href="daftarPeminjam.php"; </script>';
    }else{
        header("Location: daftarPeminjam.php");
    }
}



