<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.html");
} else {
    require_once "config.php";
    if (isset($_POST['update'])) {
        $conn = new Connection();
        $tgl = $_POST['tgl_return'];
        $id = (int)$_POST['id_pinjam'];
        $stmt = $conn->getKoneksi()->prepare("UPDATE `peminjaman` SET `return_book`= ? WHERE id_pinjam = ?");
        $stmt->bindParam(1, $tgl);
        $stmt->bindParam(2, $id);
        $exe = $stmt->execute();
        if ($exe) {
            echo '<script type="text/javascript"> alert("Berhasil merubah data");window.location.href="daftarPeminjam.php"; </script>';
        } else {
            echo '<script type="text/javascript"> alert("Gagal merubah data");window.location.href="daftarPeminjam.php"; </script>';
        }
        $conn->destroyConnection();
    } else {
        header("Location: daftarPeminjaman.php");
    }
}
