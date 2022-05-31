<?php
    require_once "config.php";
    $con = new Connection();
    if (isset($_POST['send'])){
        $stmt = $con->getKoneksi()->prepare("INSERT INTO peminjaman(borrow_book, return_book, id_buku, id_siswa) VALUES (?,?,?,?)");
        $stmt->bindParam(1, $_POST['tgl_pjm']);
        $stmt->bindParam(2, $_POST['tgl_bck']);
        $stmt->bindParam(3, $_POST['buku']);
        $stmt->bindParam(4, $_POST['siswa']);
        $stmt->execute();
    }
