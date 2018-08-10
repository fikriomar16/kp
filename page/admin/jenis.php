<?php
$sql = 'SELECT * FROM jenisbarang;';
$query = mysqli_query($con, $sql);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($con));
}
?>
<script type="text/javascript">
	function showmodaljen() {
		$('#modaljen').modal('show');
	}
	function showmodaledt(kodejen,namajen) {
		$('#edtkodejen').val(kodejen);
		$('#edtkodejen2').val(kodejen);
		$('#edtnamajen').val(namajen);
		$('#modaledt').modal('show');
	}
	function showmodaldel(kodejen,namajen) {
		$('#delkodejen').val(kodejen);
		$('#delkodejen2').val(kodejen);
		$('#delnamajen').val(namajen);
		$('#delnamajen2').val(namajen);
		$('#modaldel').modal('show');
	}
</script>
<center>
	<h4>Form Jenis Barang</h4>
</center>
<div class="container-fluid mb-auto">
	<button type="button" class="btn btn-info btn-sm mb-2 float-right" onclick="showmodaljen();" data-toggle="tooltip" data-placement="left" title="Tambah Data">
		<i class="fa fa-plus"></i>&nbsp;Tambah
	</button>
	<?php
	if (isset($_POST['add_jen'])) {
		$data->add_jen($_POST['kodejen'],$_POST['namajen']);
	}
	if (isset($_POST['edt_jen'])) {
		$data->edt_jen($_POST['edtkodejen'],$_POST['edtnamajen']);
		echo '<script>swal("Data Berhasil Diubah");</script>';
		echo "<script>location='index.php?page=jenis';</script>";
	}
	if (isset($_POST['del_jen'])) {
		$data->del_jen($_POST['delkodejen']);
	}
	?>
	<div class="table-responsive">
		<table class="table table-hover" id="tabjen">
			<thead class="thead-dark">
				<tr align="center">
					<th>No</th>
					<th>Kode Jenis</th>
					<th>Jenis Barang</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				while ($value = mysqli_fetch_row($query)) { 
				?>
				<tr align="center">
					<td><?php echo $i; ?></td>
					<td><?php echo $value[0] ?></td>
					<td><?php echo $value[1] ?></td>
					<td>
						<button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Jenis" onclick="showmodaledt('<?php echo $value[0] ?>','<?php echo $value[1] ?>');">
							<i class="fa fa-edit"></i>
						</button>
						<button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Jenis" onclick="showmodaldel('<?php echo $value[0] ?>','<?php echo $value[1] ?>');">
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
<div class="modal fade" id="modaljen" tabindex="-1" role="dialog" aria-labelledby="DialogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Input Data Jenis</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-jen" method="POST">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="kodejen" id="kodejen" class="form-control text-center text-success" placeholder="Kode Jenis" maxlength="10" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="namajen" id="namajen" class="form-control text-center" placeholder="Nama Jenis" required>
							</div>
						</div>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-success" type="submit" name="add_jen" id="add_jen">
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
<div class="modal fade" id="modaledt" tabindex="-1" role="dialog" aria-labelledby="DialogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Update Data Jenis</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-edt" method="POST">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="edtkodejen2" id="edtkodejen2" class="form-control text-center text-primary" placeholder="Kode Jenis" disabled>
								<input type="hidden" name="edtkodejen" id="edtkodejen" class="form-control text-center" placeholder="Kode Jenis">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="edtnamajen" id="edtnamajen" class="form-control text-center" placeholder="Nama Jenis" required>
							</div>
						</div>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-primary" type="submit" name="edt_jen" id="edt_jen">
							<i class="fa fa-save"></i>&nbsp;Update
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
			<div class="modal-header">
				<h5 class="modal-title">Hapus Data Jenis</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-del" method="POST">
					<h4 align="center" style="color: red;">Yakin ingin menghapus data ini ?</h4>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="delkodejen2" id="delkodejen2" class="form-control text-center text-danger" disabled>
								<input type="hidden" name="delkodejen" id="delkodejen" class="form-control text-center">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="delnamajen2" id="delnamajen2" class="form-control text-center" disabled>
								<input type="hidden" name="delnamajen" id="delnamajen" class="form-control text-center">
							</div>
						</div>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-danger" type="submit" name="del_jen" id="del_jen">
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