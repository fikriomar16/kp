<?php
include '../../../config/db.php';
$bulan = $_POST['bulan'];
$sql = "SELECT barang.kodebrg, brgmasuk.tglmasuk, barang.namabrg, brgmasuk.jumlah, satuan.namasatuan, barang.harga, (barang.harga*brgmasuk.jumlah) AS subtotal, supplier.namasup FROM brgmasuk INNER JOIN barang ON brgmasuk.kodebrg = barang.kodebrg INNER JOIN satuan ON barang.kodesatuan = satuan.kodesatuan INNER JOIN supplier ON barang.kodesup = supplier.kodesup WHERE month(brgmasuk.tglmasuk)='$bulan' ORDER BY barang.kodebrg ASC";
$query = mysqli_query($con,$sql);
$result = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan Barang Masuk</title>
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
			<h3 class="mt-5 mb-5">Laporan Daftar Barang Masuk</h3>
			<hr>
		</center>
		<p class="float-right">Tanggal : <?php echo date("d/m/Y"); ?></p>
		<div class="table-responsive">
			<table class="table table-sm">
				<thead class="thead-light">
					<tr>
						<th>No</th>
						<th>Kode Barang</th>
						<th>Tgl Masuk</th>
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>Satuan</th>
						<th>Harga</th>
						<th>Subtotal</th>
						<th>Supplier</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$masuk = $data->masuk($_POST['bulan']);
					foreach ($masuk as $key => $value):
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $value['kodebrg']; ?></td>
						<td><?php echo $value['tglmasuk']; ?></td>
						<td><?php echo $value['namabrg']; ?></td>
						<td><?php echo $value['jumlah']; ?></td>
						<td><?php echo $value['namasatuan']; ?></td>
						<td><?php echo number_format($value['harga'], 0, ',', '.'); ?></td>
						<td><?php echo number_format($value['subtotal'], 0, ',', '.'); ?></td>
						<td><?php echo $value['namasup']; ?></td>
					</tr>
					<?php
					$i++;
					$total += $value['subtotal'];
					endforeach;
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="7" align="right">Total :</td>
						<td colspan="2"><?php echo "Rp. ".number_format($total, 0, ',', '.'); ?></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<script src="../../../assets/js/popper.min.js"></script>
	<script src="../../../assets/js/jquery.min.js"></script>
	<script src="../../../assets/js/bootstrap.min.js"></script>
</body>
</html>