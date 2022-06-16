<?php
require_once "config.php";
$conn = new Connection();
$stmt = $conn->getKoneksi()->prepare("select date_format(borrow_book, '%M') as bulan,COUNT(borrow_book) as 
                                                    jumlah from peminjaman group by date_format(borrow_book, '%M');");
$stmt->execute();
$month = array();
$data = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $month[] = $row['bulan'];
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
    <canvas id="peminjaman_buku"></canvas>
</div>
<script>
    var ctx = document.getElementById("peminjaman_buku").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($month) ?>,
            datasets: [{
                label: 'Banyaknya Peminjaman',
                data: <?php echo json_encode($data)?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
</body>
</html>
