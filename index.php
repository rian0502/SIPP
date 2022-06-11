<?php
    require_once "config.php";
    $con = new Connection();
    $stmt = $con->getKoneksi()->prepare("SELECT * FROM siswa");
    $stmt->execute();
    $listbook = $con->getKoneksi()->prepare("SELECT id_buku, judul FROM buku");
    $listbook->execute();
?>0-
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <a href="#" class="logo">Sistem Perpustakaan</a>
        <div class="group">
            <ul class="navigation">
                <li><a href="#">Home</a></li>
                <li><a href="daftarPeminjam.php">Daftar Peminjam</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </header>
    <form action="pinjaman.php" method="post">
        <div class="banner">
            <div class="bg">
                <img src="assets/image/bg5.jpg" class="cover" alt="">
                <div class="content">
                    <h2>Sistem Perpustakaan</h2>
                    <a href="daftarBuku.html" class="btn">Daftar Buku</a>
                </div>
                <div class="searchBox">
                    <div class="inputBx">
                        <p>Peminjam</p>
                        <select name="siswa">
                            <?php while($data = $stmt->fetch(PDO::FETCH_ASSOC)){?>
                                <option value="<?php echo $data['id_siswa'] ?>"> <?php echo $data['nisn']." - ".$data['nama'] ?></option>
                            <?php } $stmt->closeCursor();?>
                        </select>
                    </div>
                    <div class="inputBx">
                        <p>Buku</p>
                        <select name="buku">
                            <?php while($row = $listbook->fetch(PDO::FETCH_ASSOC)){?>
                                <option value="<?php echo $row['id_buku'] ?>"> <?php echo $row['judul'] ?></option>
                            <?php } $listbook->closeCursor(); $con->destroyConnection(); ?>
                        </select>
                    </div>
                    <div class="inputBx">
                        <p>Peminjaman</p>
                        <input type="date" name="tgl_pjm" required>
                    </div>
                    <div class="inputBx">
                        <p>Pengembalian</p>
                        <input type="date" name="tgl_bck" required>
                    </div>
                    <div class="inputBx">
                        <p class="white">_</p>
                        <input type="submit" value="Entry" name="send">
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>