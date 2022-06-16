<?php
require_once "config.php";
$conn = new Connection();
$stmt = $conn->getKoneksi()->prepare("SELECT jenis_buku, COUNT(jenis_buku) AS jumlah FROM buku GROUP BY jenis_buku;");
$stmt->execute();
$buku = array();
$data = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $buku[] = $row['jenis_buku'];
    $data[] = $row['jumlah'];
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
    <script type="text/javascript" src="assets/script/Chart.js"></script>
</head>
<body>
<div style="width: 700px;height: 500px">
    <canvas id="jenis_buku"></canvas>
</div>
<script>
    var ctx = document.getElementById("jenis_buku").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($buku) ?>,
            datasets: [{
                label: 'Grafik Jenis Buku',
                data: <?php echo json_encode($data)?>,
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 1,
                tension: 0.1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
</body>
</html>
