<?php
$sql = "SELECT brgkeluar.kodekeluar,brgkeluar.tglkeluar,barang.namabrg,brgkeluar.jumlah,satuan.namasatuan,brgkeluar.ket,brgmasuk.kodemasuk FROM brgkeluar INNER JOIN brgmasuk ON brgkeluar.kodemasuk=brgmasuk.kodemasuk INNER JOIN barang ON brgmasuk.kodebrg=barang.kodebrg INNER JOIN satuan ON barang.kodesatuan=satuan.kodesatuan";
$query = mysqli_query($con, $sql);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($con));
}
?>
<script type="text/javascript">
	function showmodalkeluar() {
		$('#modalkeluar').modal('show');
	}
	function showmodaldel(kodekeluar,tglkeluar,namabrg,jumlah,kodemasuk) {
		$('#delkodekeluar').val(kodekeluar);
		$('#delkodekeluar2').val(kodekeluar);
		$('#deltglkeluar').val(tglkeluar);
		$('#deldatamasuk').val(namabrg);
		$('#deljumlah').val(jumlah);
		$('#deljumlah2').val(jumlah);
		$('#kodemasuk').val(kodemasuk);
		$('#modaldel').modal('show');
	}
</script>
<center>
	<h4>Form Pemakaian Barang</h4>
</center>
<div class="container-fluid mb-auto">
	<button type="button" class="btn btn-info btn-sm mb-2 float-right" onclick="showmodalkeluar();" data-toggle="tooltip" data-placement="left" title="Tambah Data">
		<i class="fa fa-plus-circle"></i>&nbsp;Tambah
	</button>
	<?php
	if (isset($_POST['add_brgout'])) {
		$data->add_brgout($_POST['kodekeluar'],$_POST['datamasuk'],$_POST['tglkeluar'],$_POST['jumlah'],$_POST['ket']);
		echo '<script>swal("Berhasil Menginputkan Data")</script>';
		echo "<script>location='index.php?page=pemakaian';</script>";
	}
	if (isset($_POST['del_brgout'])) {
		$data->del_brgout($_POST['delkodekeluar'],$_POST['kodemasuk'],$_POST['deljumlah']);
		echo '<script>swal("Berhasil Menghapus Data")</script>';
		echo "<script>location='index.php?page=pemakaian';</script>";
	}
	?>
	<div class="table-responsive">
		<table class="table table-hover table-striped" id="tabbrgkeluar">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Kode Keluar</th>
					<th>Tgl Keluar</th>
					<th>Nama Barang</th>
					<th>Jumlah</th>
					<th>Satuan</th>
					<th>Keterangan</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				while ($value = mysqli_fetch_row($query)) { 
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value[0] ?></td>
					<td><?php echo $value[1] ?></td>
					<td><?php echo $value[2] ?></td>
					<td><?php echo $value[3] ?></td>
					<td><?php echo $value[4] ?></td>
					<td><?php echo $value[5] ?></td>
					<td>
						<button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data" onclick="showmodaldel('<?php echo $value[0] ?>','<?php echo $value[1] ?>','<?php echo $value[2] ?>',<?php echo $value[3] ?>,'<?php echo $value[6] ?>');">
							<i class="fa fa-trash"></i>
						</button>
					</td>
				</tr>
				<?php
				$i++;
				}
				mysqli_free_result($query);
				?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modalkeluar" tabindex="-1" role="dialog" aria-labelledby="DialogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-success text-white">
				<h5 class="modal-title text-center col-12" id="modaltitlesup">Input Barang Keluar</h5>
			</div>
			<div class="modal-body">
				<form method="POST" id="form-brg">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="kodekeluar" id="kodekeluar" class="form-control text-center text-success" placeholder="Kode Barang Keluar" maxlength="10" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="date" name="tglkeluar" id="tglkeluar" class="form-control" max="<?php echo date("Y-m-d");?>" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<select class="form-control text-center" name="datamasuk" id="datamasuk" required>
									<option value="" disabled selected>Pilih Barang</option>
									<?php
									$brgin = $data->showbrgmasuk();
									foreach ($brgin as $key => $value):
										echo "<option value='".$value['kodemasuk']."'>".$value['tglmasuk']." - ".$value['namabrg']." - ".$value['jumlah']." ".$value['namasatuan']."</option>";
									endforeach;
									?>
								</select>
							</div>
						</div>
						<div class="col-2">
							<div class="form-group">
								<input type="number" name="jumlah" id="jumlah" class="form-control text-center" placeholder="Jumlah" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="text" name="ket" id="ket" class="form-control text-center" placeholder="Keterangan">
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-success" type="submit" name="add_brgout" id="add_brgout">
							<i class="fa fa-save"></i>&nbsp;Simpan
						</button>
						<button class="btn btn-sm btn-outline-danger" type="submit" data-dismiss="modal">
							<i class="fa fa-close"></i>&nbsp;Batal
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modaldel" tabindex="-1" role="dialog" aria-labelledby="DialogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h5 class="modal-title text-center col-12" id="modaltitlesup">Hapus Barang Keluar</h5>
			</div>
			<div class="modal-body">
				<form method="POST" id="form-del">
					<h4 align="center" class="text-danger">Yakin Ingin Menghapus Data Ini ?</h4>
					<input type="hidden" name="kodemasuk" id="kodemasuk" class="form-control text-center">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="delkodekeluar2" id="delkodekeluar2" class="form-control text-center text-danger" disabled>
								<input type="hidden" name="delkodekeluar" id="delkodekeluar" class="form-control text-center text-danger">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="deltglkeluar" id="deltglkeluar" class="form-control text-center" disabled>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="deldatamasuk" id="deldatamasuk" class="form-control text-center" disabled>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="deljumlah2" id="deljumlah2" class="form-control text-center" disabled>
								<input type="hidden" name="deljumlah" id="deljumlah" class="form-control text-center">
							</div>
						</div>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-danger" type="submit" name="del_brgout" id="del_brgout">
							<i class="fa fa-trash"></i>&nbsp;Hapus
						</button>
						<button class="btn btn-sm btn-outline-primary" type="submit" data-dismiss="modal">
							<i class="fa fa-close"></i>&nbsp;Batal
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>