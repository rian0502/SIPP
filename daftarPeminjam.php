<?php
require_once "config.php";
$con = new Connection();
$stmt = $con->getKoneksi()->prepare("SELECT id_pinjam, borrow_book, return_book, s.nama, b.judul 
                                               FROM siswa as s, buku as b, peminjaman as p
                                               WHERE p.id_buku = b.id_buku AND s.id_siswa = p.id_siswa");
$stmt->execute();


?>

<!doctype html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Daftar Peminjam Buku</a>
    </div>
</nav>
<div class="container" style="margin-top: 80px">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    DATA PEMINJAM
                </div>
                <div class="card-body">
                    <a href="index.php" class="btn btn-md btn-success" style="margin-bottom: 10px">TAMBAH
                        DATA</a>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th scope="col">NO.</th>
                            <th scope="col">Nama Peminjam</th>
                            <th scope="col">Nama Buku</th>
                            <th scope="col">Tgl. Pinjam</th>
                            <th scope="col">Tgl. Pengembalian</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $index = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $index ?></td>
                                <td><?php echo $row['nama'] ?></td>
                                <td><?php echo $row['judul'] ?></td>
                                <td><?php echo $row['borrow_book'] ?></td>
                                <td><?php echo $row['return_book'] ?></td>
                                <td class="text-center">
                                    <a href="hapus_peminjaman.php?id=<?php echo $row['id_pinjam'] ?>" class="btn btn-sm btn-danger">HAPUS</a>
                                </td>
                            </tr>
                        <?php $index++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
