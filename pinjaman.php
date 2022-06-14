<?php
require_once "config.php";
require_once "check_data.php";
$con = new Connection();
$before = Check::checkData();
if (isset($_POST['send'])) {
    $tglpjm = $_POST['tgl_pjm'];
    $tglbck = $_POST['tgl_bck'];
    $buku = (int)$_POST['buku'];
    $siswa = (int)$_POST['siswa'];
    $stmt = $con->getKoneksi()->prepare("INSERT INTO peminjaman(borrow_book, return_book, id_buku, id_siswa) VALUES (?,?,?,?)");
    $stmt->bindParam(1, $tglpjm);
    $stmt->bindParam(2, $tglbck);
    $stmt->bindParam(3, $buku);
    $stmt->bindParam(4, $siswa);
    $stmt->execute();
    $stmt->closeCursor();
    $con->destroyConnection();
    $after = Check::checkData();
    if ($after > $before) {
        echo '<script type="text/javascript"> alert("Peminjaman Berhasil");window.location.href="daftarPeminjam.php"; </script>';
    } else {
        echo '<script type="text/javascript"> alert("Peminjaman Gagal");window.location.href="daftarPeminjam.php"; </script>';
    }
}else{
    header("Location: index.php");
}
