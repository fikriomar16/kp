<?php
$sql = 'SELECT * FROM satuan;';
$query = mysqli_query($con, $sql);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($con));
}
?>
<script type="text/javascript">
	function showmodalsat() {
		$('#modalsat').modal('show');
	}
	function showmodaledt(kodesatuan,namasatuan) {
		$('#edtkodesatuan').val(kodesatuan);
		$('#edtkodesatuan2').val(kodesatuan);
		$('#edtnamasatuan').val(namasatuan);
		$('#modaledt').modal('show');
	}
	function showmodaldel(kodesatuan,namasatuan) {
		$('#delkodesatuan').val(kodesatuan);
		$('#delkodesatuan2').val(kodesatuan);
		$('#delnamasatuan').val(namasatuan);
		$('#delnamasatuan2').val(namasatuan);
		$('#modaldel').modal('show');
	}
	function sukses_add() {
		swal(
			'Berhasil',
			'Data Berhasil Ditambahkan',
			'success'
			)
	}
	function sukses_edt() {
		swal(
			'Berhasil',
			'Data Berhasil Diubah',
			'success'
			)
	}
	function sukses_del() {
		swal(
			'Berhasil',
			'Data Berhasil Dihapus',
			'success'
			)
	}
</script>
<center>
	<h4>Form Satuan Barang</h4>
</center>
<div class="container-fluid mb-auto">
	<button type="button" class="btn btn-info btn-sm mb-2 float-right" onclick="showmodalsat();" data-toggle="tooltip" data-placement="left" title="Tambah Data">
		<i class="fa fa-plus"></i>&nbsp;Tambah
	</button>
	<?php
	if (isset($_POST['add_sat'])) {
		$data->add_sat($_POST['kodesatuan'],$_POST['namasatuan']);
		echo "<script>location='index.php?page=satuan';</script>";
	}
	if (isset($_POST['edt_sat'])) {
		$data->edt_sat($_POST['edtkodesatuan'],$_POST['edtnamasatuan']);
		echo "<script>location='index.php?page=satuan';</script>";
	}
	if (isset($_POST['del_sat'])) {
		$data->del_sat($_POST['delkodesatuan']);
		echo "<script>location='index.php?page=satuan';</script>";
	}
	?>
	<div class="table-responsive">
		<table class="table table-hover" id="tabsat">
			<thead class="thead-dark">
				<tr align="center">
					<th>No</th>
					<th>Kode Satuan</th>
					<th>Nama Satuan</th>
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
						<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Satuan" onclick="showmodaledt('<?php echo $value[0]; ?>','<?php echo $value[1]; ?>');">
							<i class="fa fa-edit"></i>
						</button>
						<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Satuan" onclick="showmodaldel('<?php echo $value[0]; ?>','<?php echo $value[1]; ?>');">
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
<div class="modal fade" id="modalsat" tabindex="-1" role="dialog" aria-labelledby="DialogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Input Data Satuan</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-sat" method="POST">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="kodesatuan" id="kodesatuan" class="form-control text-center" placeholder="Kode Satuan" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="namasatuan" id="namasatuan" class="form-control text-center" placeholder="Nama Satuan" required>
							</div>
						</div>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-success" type="submit" name="add_sat" id="add_sat">
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
				<h5 class="modal-title">Update Data Satuan</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-edt" method="POST">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="edtkodesatuan2" id="edtkodesatuan2" class="form-control text-center" placeholder="Kode Satuan" disabled>
								<input type="hidden" name="edtkodesatuan" id="edtkodesatuan" class="form-control text-center" placeholder="Kode Satuan">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="edtnamasatuan" id="edtnamasatuan" class="form-control text-center" placeholder="Nama Satuan" required>
							</div>
						</div>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-primary" type="submit" name="edt_sat" id="edt_sat">
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
				<h5 class="modal-title">Hapus Data Satuan</h5>
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
								<input type="text" name="delkodesatuan2" id="delkodesatuan2" class="form-control text-center" disabled>
								<input type="hidden" name="delkodesatuan" id="delkodesatuan" class="form-control text-center">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="delnamasatuan2" id="delnamasatuan2" class="form-control text-center" disabled>
								<input type="hidden" name="delnamasatuan" id="delnamasatuan" class="form-control text-center">
							</div>
						</div>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-danger" type="submit" name="del_sat" id="del_sat">
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