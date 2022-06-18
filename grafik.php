<?php
session_start();
if (!isset($_SESSION['login'])){
    header("Location: login.html");
}else{
    require_once "config.php";
    $conn = new Connection();
    $stmt = $conn->getKoneksi()->prepare("select date_format(borrow_book, '%M') as bulan,COUNT(borrow_book) as 
                                                    jumlah from peminjaman group by date_format(borrow_book, '%M')");
    $stmt->execute();
    $month = array();
    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $month[] = $row['bulan'];
        $data[] = $row['jumlah'];
    }
    $stmt2 = $conn->getKoneksi()->prepare("SELECT jenis_buku, COUNT(jenis_buku) AS jumlah FROM buku GROUP BY jenis_buku;");
    $stmt2->execute();
    $buku = array();
    $jumlah = array();
    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $buku[] = $row['jenis_buku'];
        $jumlah[] = $row["jumlah"];
    }
    $stmt3 = $conn->getKoneksi()->prepare("SELECT b.judul, COUNT(b.judul) as total
                                                FROM peminjaman as p, buku as b
                                                WHERE p.id_buku = b.id_buku
                                                GROUP BY b.judul ORDER BY total DESC;");
    $stmt3->execute();
    $judul = array();
    $total = array();
    while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
        $judul[] = $row['judul'];
        $total[] = $row["total"];
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafik Perpustkaan</title>
    <link rel="stylesheet" href="assets/css/styleGrafik.css">
    <link rel="icon" type="image/jpg" href="assets/image/logo.jpg">
    <script type="text/javascript" src="assets/script/Chart.js"></script>
</head>
<body>
    <table>
        <tr>
            <td><div class="grafik">
                    <h3>Grafik Peminjaman Buku</h3>
                    <canvas id="peminjaman_buku"></canvas>
                </div>
            </td>
            <td><div class="grafik">
                    <h3>Grafik Jenis Buku</h3>
                    <canvas id="daftar_buku"></canvas>
                </div>
            </td>
        </tr>
        <tr>
            <td><div class="grafik">
                    <h3>Grafik Buku Terfavorit</h3>
                    <canvas id="buku_fav"></canvas>
                </div>
            </td>
        </tr>
    </table>
<script>
    const ctx = document.getElementById("peminjaman_buku").getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($month) ?>,
            datasets: [{
                data: <?php echo json_encode($data)?>,
                backgroundColor: [
                    'rgb(64, 223, 239)',
                    'rgb(185, 248, 211)',
                    'rgb(231, 142, 169)',
                    'rgb(229, 203, 159)',
                    'rgb(89, 6, 150)',
                    'rgb(199, 10, 128)',
                    'rgb(251, 203, 10)'

                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            title: {
                display: false
            }
        }
    });
    const buku = document.getElementById("daftar_buku").getContext('2d');
    const bookChart = new Chart(buku, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($buku) ?>,
            datasets: [{
                data: <?php echo json_encode($jumlah)?>,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }],
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            title: {
                display: false
            }
        }
    });
    const bookFav = document.getElementById("buku_fav").getContext('2d');
    const favChart = new Chart(bookFav, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($judul) ?>,
            datasets: [{
                data: <?php echo json_encode($total)?>,
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                    'rgb(255, 205, 86)',
                    'rgb(62, 199, 11)',
                    'rgb(59, 68, 246)',
                    'rgb(117, 52, 34)',
                    'rgb(161, 73, 250)',
                ],
                borderWidth: 1,
                hoverOffset: 4
            }]
        }
    });
</script>
</body>
</html>
