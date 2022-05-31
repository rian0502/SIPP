<?php
    require_once "config.php";
    $sql = "SELECT * FROM siswa";
    $execute = mysqli_query(Connection::getConnection(), $sql);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPP</title>
    <link rel="stylesheet" href="style.css">
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
    <div class="banner">
        <div class="bg">
            <img src="bg5.jpg" class="cover">
            <div class="content">
                <h2>Sistem Perpustakaan</h2>
                <a href="daftarBuku.html" class="btn">Daftar Buku</a>
            </div>
            <div class="searchBox">
                <div class="inputBx">
                    <p>Peminjam</p>
                    <select name="nama">
                        <?php while($data = mysqli_fetch_assoc($execute)){?>
                            <option value="<?php echo $data['id_siswa'] ?>"> <?php echo $data['nisn']." - ".$data['nama'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="inputBx">
                    <p>Buku</p>
                    <input type="text">
                </div>
                <div class="inputBx">
                    <p>Peminjaman</p>
                    <input type="date">
                </div>
                <div class="inputBx">
                    <p>Pengembalian</p>
                    <input type="date">
                </div>
                <div class="inputBx">
                    <p class="white">_</p>
                    <input type="submit" value="Entry">
                </div>
            </div>
        </div>
    </div>
</body>
</html>