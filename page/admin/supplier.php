<?php
$sql = 'SELECT * FROM supplier;';
$query = mysqli_query($con, $sql);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($con));
}
?>
<script type="text/javascript">
	function showmodalsup() {
		$('#kodesup').val();
		$('#namasup').val();
		$('#alamat').val();
		$('#telp').val();
		$('#kontak').val();
		$('#ket').val();
		$('#modalsup').modal('show');
	}
	function showmodaledt(kodesup,namasup,alamat,telp,kontak,ket) {
		$('#edtkodesup').val(kodesup);
		$('#edtkodesup2').val(kodesup);
		$('#edtnamasup').val(namasup);
		$('#edtalamat').val(alamat);
		$('#edttelp').val(telp);
		$('#edtkontak').val(kontak);
		$('#edtket').val(ket);
		$('#modaledt').modal('show');
	}
	function showmodaldet(kodesup,namasup,alamat,telp,kontak,ket) {
		$('#detkodesup').text(kodesup);
		$('#detnamasup').text(namasup);
		$('#detalamat').text(alamat);
		$('#dettelp').text(telp);
		$('#detkontak').text(kontak);
		$('#detket').text(ket);
		$('#modaldet').modal('show');
	}
	function showmodaldel(kodesup,namasup){
		$('#delkodesup').val(kodesup);
		$('#delnamasup').val(namasup);
		$('#delkodesup2').val(kodesup);
		$('#delnamasup2').val(namasup);
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
	<h4>Daftar Supplier</h4>
</center>
<div class="container-fluid mb-auto">
	<button type="button" class="btn btn-info btn-sm mb-2 float-right" onclick="showmodalsup();" data-toggle="tooltip" data-placement="left" title="Tambah Data">
		<i class="fa fa-plus"></i>&nbsp;Tambah
	</button>
	<?php
	if (isset($_POST['add_sup'])) {
		$data->add_sup($_POST['kodesup'],$_POST['namasup'],$_POST['alamat'],$_POST['telp'],$_POST['kontak'],$_POST['ket']);
		echo '<script>sukses_add()</script>';
		echo "<script>location='index.php?page=supplier';</script>";
	}
	if (isset($_POST['edt_sup'])) {
		$data->edt_sup($_POST['edtkodesup'],$_POST['edtnamasup'],$_POST['edtalamat'],$_POST['edttelp'],$_POST['edtkontak'],$_POST['edtket']);
		echo '<script>sukses_edt()</script>';
		echo "<script>location='index.php?page=supplier';</script>";
	}
	if (isset($_POST['del_sup'])) {
		$data->del_sup($_POST['delkodesup']);
		echo '<script>sukses_del();</script>';
		echo "<script>location='index.php?page=supplier';</script>";
	}
	?>
	<div class="table-responsive">
		<table class="table table-hover" id="tabsup">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Supplier</th>
					<th>Alamat</th>
					<th>Telp</th>
					<th>Kontak</th>
					<!--<th>Keterangan</th>-->
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
					<!--<td><?php echo $value[5] ?></td>-->
					<td>
						<button type="button" class="btn btn-primary btn-sm" onclick="showmodaldet('<?php echo $value[0]; ?>','<?php echo $value[1]; ?>','<?php echo $value[2]; ?>',<?php echo $value[3]; ?>,'<?php echo $value[4]; ?>','<?php echo $value[5]; ?>');" data-toggle="tooltip" data-placement="top" title="Detail Supplier">
							<i class="fa fa-eye"></i>
						</button>
						<button type="button" class="btn btn-secondary btn-sm" onclick="showmodaledt('<?php echo $value[0]; ?>','<?php echo $value[1]; ?>','<?php echo $value[2]; ?>',<?php echo $value[3]; ?>,'<?php echo $value[4]; ?>','<?php echo $value[5]; ?>');" data-toggle="tooltip" data-placement="top" title="Edit Data Supplier">
							<i class="fa fa-edit"></i>
						</button>
						<button type="button" class="btn btn-danger btn-sm" onclick="showmodaldel('<?php echo $value[0]; ?>','<?php echo $value[1]; ?>');" data-toggle="tooltip" data-placement="top" title="Hapus Data Supplier">
							<i class="fa fa-trash"></i>
						</button>
					</td>
				</tr>
				<?php
				$i++;
				}
				mysqli_free_result($query);
				mysqli_close($con);
				?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modalsup" tabindex="-1" role="dialog" aria-labelledby="DialogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-success text-white">
				<h5 class="modal-title text-center" id="modaltitlesup">Input Data Supplier</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-sup" method="POST">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="kodesup" class="form-control text-center text-success" id="kodesup" placeholder="Kode Supplier" maxlength="10" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="namasup" class="form-control text-center" id="namasup" placeholder="Supplier" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="text" name="alamat" class="form-control text-center" id="alamat" placeholder="Alamat" required>
					</div>
					<div class="row">
						<div class="col-5">
							<div class="form-group">
								<input type="number" name="telp" class="form-control text-center" id="telp" placeholder="No Telp" maxlength="13" required>
							</div>
						</div>
						<div class="col-7">
							<div class="form-group">
								<input type="text" name="kontak" class="form-control text-center" id="kontak" placeholder="Kontak" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="text" name="ket" class="form-control text-center" id="ket" placeholder="Keterangan" required>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-success" type="submit" name="add_sup" id="add_sup">
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
			<div class="modal-header" style="background-color: #6C757D; color: #fff;">
				<h5 class="modal-title" id="modaltitlesup">Update Data Supplier</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-edt" method="POST">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="edtkodesup2" class="form-control text-center text-primary" id="edtkodesup2" placeholder="Kode Supplier" required="" disabled="true">
								<input type="hidden" name="edtkodesup" class="form-control text-center" id="edtkodesup" placeholder="Kode Supplier" required="">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="edtnamasup" class="form-control text-center" id="edtnamasup" placeholder="Supplier" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="text" name="edtalamat" class="form-control text-center" id="edtalamat" placeholder="Alamat" required>
					</div>
					<div class="row">
						<div class="col-5">
							<div class="form-group">
								<input type="number" name="edttelp" class="form-control text-center" id="edttelp" placeholder="No Telp" maxlength="13" required>
							</div>
						</div>
						<div class="col-7">
							<div class="form-group">
								<input type="text" name="edtkontak" class="form-control text-center" id="edtkontak" placeholder="Kontak" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="text" name="edtket" class="form-control text-center" id="edtket" placeholder="Keterangan" required>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-primary" type="submit" name="edt_sup" id="edt_sup">
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
<div class="modal fade" id="modaldet" tabindex="-1" role="dialog" aria-labelledby="DialogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #007bff; color: #fff;">
				<h5 class="modal-title" id="modaltitlesup">Detail Data Supplier</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-det" method="POST">
					<div class="row">
						<div class="col-4">
							Kode Supplier :
						</div>
						<div class="col">
							<p id="detkodesup"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							Nama Supplier :
						</div>
						<div class="col">
							<p id="detnamasup"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							Alamat :
						</div>
						<div class="col">
							<p id="detalamat"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							No Telp :
						</div>
						<div class="col">
							<p id="dettelp"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							Nama Kontak :
						</div>
						<div class="col">
							<p id="detkontak"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							Keterangan :
						</div>
						<div class="col">
							<p id="detket"></p>
						</div>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-success" type="submit" data-dismiss="modal">
							<i class="fa fa-check"></i>&nbsp;OK
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
			<div class="modal-header" style="background-color: #dc3545; color: #fff;">
				<h5 class="modal-title" id="modaltitlesup">Hapus Data Supplier</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-del" method="POST">
					<h4 align="center" style="color: red;">Yakin ingin menghapus data ini ?</h4>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="hidden" name="delkodesup" class="form-control text-center" id="delkodesup">
								<input type="text" name="delkodesup2" class="form-control text-center text-danger" id="delkodesup2" disabled>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="hidden" name="delnamasup" class="form-control text-center" id="delnamasup">
								<input type="text" name="delnamasup2" class="form-control text-center" id="delnamasup2" disabled>
							</div>
						</div>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-danger" type="submit" name="del_sup" id="del_sup">
							<i class="fa fa-trash"></i>&nbsp;Hapus
						</button>
						<button class="btn btn-sm btn-outline-primary" data-dismiss="modal">
							<i class="fa fa-close"></i>&nbsp;Batal
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>