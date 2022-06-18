<?php
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
$data = array();
while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $buku[] = $row['jenis_buku'];
    $data[] = $row["jumlah"];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/styleGrafik.css">
    <script type="text/javascript" src="assets/script/Chart.js"></script>
</head>
<body>
    <table>
        <tr>
            <td><div class="grafik-pinjam">
                    <h3>Grafik Peminjaman Buku</h3>
                    <canvas id="peminjaman_buku"></canvas>
                </div>
            </td>
            <td><div class="grafik-buku">
                    <h3>Grafik Jenis Buku</h3>
                    <canvas id="daftar_buku"></canvas>
                </div>
            </td>
        </tr>
    </table>
<script>
    var ctx = document.getElementById("peminjaman_buku").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($month) ?>,
            datasets: [{
                data: <?php echo json_encode($data)?>,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
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
    var buku = document.getElementById("daftar_buku").getContext('2d');
    var bookChart = new Chart(buku, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($buku) ?>,
            datasets: [{
                data: <?php echo json_encode($data)?>,
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 1,
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
</script>
</body>
</html>
