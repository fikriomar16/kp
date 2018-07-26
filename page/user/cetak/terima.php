<?php

include '../../../config/db.php';

$sup = $_POST['sup'];
$bulan = $_POST['bulan'];

$sql = "SELECT brgmasuk.tglmasuk, barang.namabrg, brgmasuk.jumlah, satuan.namasatuan, supplier.namasup, supplier.alamat FROM brgmasuk INNER JOIN barang ON brgmasuk.kodebrg = barang.kodebrg INNER JOIN satuan ON barang.kodesatuan = satuan.kodesatuan INNER JOIN supplier ON barang.kodesup = supplier.kodesup WHERE supplier.kodesup='$sup' AND month(brgmasuk.tglmasuk)='$bulan'";
$query = mysqli_query($con,$sql);
$result = mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan Penerimaan</title>
	<link rel="icon" href="../../../assets/images/puskesmas.png">
	<link rel="stylesheet" href="../../../assets/css/bootstrap.css">
	<script type="text/javascript">
		window.print();
	</script>
</head>
<body>
	<div class="container mb-auto">
		<center>
			<img src="../../../assets/images/kop.jpg" style="width: 670px;">
			<h3 class="mt-5 mb-5">Laporan Penerimaan Barang</h3>
			<hr>
		</center>
		<p class="float-right">Tanggal : <?php echo date("d/m/Y"); ?></p>
		<p>Nama Supplier : <?php echo $result['namasup'];?></p>
		<p>Alamat : <?php echo $result['alamat'];?></p>
		<p>Menyatakan bahwa telah diterima barang-barang di bawah ini :</p>
		<div class="table-responsive">
			<table class="table table-bordered table-sm">
				<thead class="thead-light">
					<tr>
						<th>No</th>
						<th>Tgl Masuk</th>
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>Satuan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$terima = $data->terima($_POST['sup'],$_POST['bulan']);
					foreach ($terima as $key => $value):
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $value['tglmasuk']; ?></td>
						<td><?php echo $value['namabrg']; ?></td>
						<td><?php echo $value['jumlah']; ?></td>
						<td><?php echo $value['namasatuan']; ?></td>
					</tr>
					<?php
					$i++;
					endforeach;
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="fixed-bottom">
	<center>
		<div class="row mt-5">
			<div class="col">
				<div class="form-group">
					<h5>Supplier</h5>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<h5>Petugas</h5>
				</div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col">
				<div class="form-group">
					<h5>(...................................)</h5>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<h5>(...................................)</h5>
				</div>
			</div>
		</div>
	</center>
	</div>
	<script type="text/javascript">
		window.close();
	</script>
	<script src="../../../assets/js/popper.min.js"></script>
	<script src="../../../assets/js/jquery.min.js"></script>
	<script src="../../../assets/js/bootstrap.min.js"></script>
</body>
</html>