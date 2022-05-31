<!doctype html>
<html lang="en">
  <head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
						<a href="TambahJurnal.php" class="btn btn-md btn-success" style="margin-bottom: 10px">TAMBAH DATA</a>
						<table class="table table-bordered" id="myTable">
							<thead>
								<tr>
									<th scope="col">NO.</th>
									<th scope="col">Nama Peminjaml</th>
									<th scope="col">Nama Buku</th>
									<th scope="col">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo 1 ?></td>
									<td><?php echo "Teknologi Informasi"?></td>
									<td><?php echo "Sejarah Komputer" ?></td>
									<td class="text-center">
										<a href="EditJurnal.php?id=<?php echo 1 ?>" class="btn btn-sm btn-primary">EDIT</a>
										<a href="HapusJurnal.php?id=<?php echo 1 ?>" class="btn btn-sm btn-danger">HAPUS</a>
									</td>
								</tr>
							</tbody>
						  </table>
					</div>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>
