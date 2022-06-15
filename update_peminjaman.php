<?php
    require_once "config.php";
    if (isset($_GET['id'])){
        $conn = new Connection();
        $id_pjm = (int) $_GET['id'];
        $stmt = $conn->getKoneksi()->prepare("SELECT id_pinjam, borrow_book, return_book, s.nama, b.judul 
                                               FROM siswa as s, buku as b, peminjaman as p
                                               WHERE p.id_buku = b.id_buku AND s.id_siswa = p.id_siswa AND id_pinjam = ?");
        $stmt->bindParam(1, $id_pjm);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    }else{
        header("Location: daftarPeminjam.php");
    }
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
        <a class="navbar-brand" href="#">EDIT PEMINJAM</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
        </div>
    </div>
</nav>
<div class="container" style="margin-top: 80px">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    EDIT PEMINJAM
                </div>
                <div class="card-body">
                    <form action="update_control.php" method="POST">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" disabled class="form-control" value="<?php echo $data['nama']?>">
                        </div>
                        <div class="form-group">
                            <label>Buku</label>
                            <input type="text" name="buku" disabled class="form-control" value="<?php echo $data['judul']?>">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Peminjaman</label>
                            <input type="date" name="tgl_pinjam" disabled class="form-control" value="<?php echo $data['borrow_book']?>">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pengembalian</label>
                            <input type="date" name="tgl_return" class="form-control" value="<?php echo $data['return_book']?>">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id_pinjam" class="form-control" value="<?php echo $id_pjm ?>">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-success" value="UPDATE" name="update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>