<?php
$sql = 'SELECT * FROM user;';
$query = mysqli_query($con, $sql);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($con));
}
?>
<script type="text/javascript">
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
	function showmodaladmin() {
		$('#modaluser').modal('show');
	}
	function showmodaledt(username,pass) {
		$('#edtusername').val(username);
		$('#edtusername2').val(username);
		$('#edtpass').val(pass);
		$('#modaledt').modal('show');
	}
	function showmodaldel(username,pass) {
		$('#delusername').val(username);
		$('#delusername2').val(username);
		$('#delpass2').val(pass);
		$('#delpass2').val(pass);
		$('#modaldel').modal('show');
	}
</script>
<center>
	<h4>Pengelolaan Data Admin</h4>
</center>
<div class="container-fluid mb-auto">
	<button type="button" class="btn btn-info btn-sm mb-2 float-right" onclick="showmodaladmin();" data-toggle="tooltip" data-placement="left" title="Tambah Admin/User">
		<i class="fa fa-plus"></i>&nbsp;Tambah
	</button>
	<?php
	if (isset($_POST['add_user'])) {
		$data->add_user($_POST['username'],$_POST['pass'],$_POST['hakakses']);
		echo '<script>swal("Input Data Berhasil")</script>';
		echo "<script>location='index.php?page=admin';</script>";
	}
	if (isset($_POST['edt_user'])) {
		$data->edt_user($_POST['edtusername2'],$_POST['edtusername'],$_POST['edtpass'],$_POST['edthakakses']);
		echo '<script>swal("Data Berhasil Diubah")</script>';
		echo "<script>location='index.php?page=admin';</script>";
	}
	if (isset($_POST['del_user'])) {
		$data->del_user($_POST['delusername']);
		echo '<script>swal("Data Berhasil Dihapus")</script>';
		echo "<script>location='index.php?page=admin';</script>";
	}
	?>
	<div class="table-responsive">
		<table id="admintab" class="table table-hover table-striped">
			<thead class="thead-light">
				<tr align="center">
					<th>No</th>
					<th>Username</th>
					<th>Password</th>
					<th>Hak Akses</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				while ($value = mysqli_fetch_row($query)) {
				?>
				<tr align="center">
					<td><?php echo $i ?></td>
					<td><?php echo $value[0] ?></td>
					<td><?php echo $value[1] ?></td>
					<td><?php echo $value[2] ?></td>
					<td>
						<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Edit Data" onclick="showmodaledt('<?php echo $value[0] ?>','<?php echo $value[1] ?>');">
							<i class="fa fa-edit"></i>
						</button>
						<button type="button" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus Data" onclick="showmodaldel('<?php echo $value[0] ?>','<?php echo $value[1] ?>');">
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
<div class="modal fade" id="modaluser" tabindex="-1" role="dialog" aria-labelledby="DialogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Input Data User</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-user" method="POST">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="username" id="username" class="form-control text-center" placeholder="Username" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="password" name="pass" id="pass" class="form-control text-center" placeholder="Password" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<select class="form-control text-center" name="hakakses" id="hakakses" required>
									<option value="" disabled selected>- Hak Akses -</option>
									<option value="admin">Admin</option>
									<option value="user">User</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-success" type="submit" name="add_user" id="add_user">
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
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Update Data User</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-edt" method="POST">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="edtusername2" id="edtusername2" class="form-control text-center" placeholder="Username" required>
								<input type="hidden" name="edtusername" id="edtusername" class="form-control text-center" placeholder="Username">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="password" name="edtpass" id="edtpass" class="form-control text-center" placeholder="Password" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<select class="form-control text-center" name="edthakakses" id="edthakakses" required>
									<option value="" disabled selected>- Hak Akses -</option>
									<option value="admin">Admin</option>
									<option value="user">User</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-primary" type="submit" name="edt_user" id="edt_user">
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
				<h5 class="modal-title">Hapus Data User</h5>
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
								<input type="text" name="delusername2" id="delusername2" class="form-control text-center" disabled>
								<input type="hidden" name="delusername" id="delusername" class="form-control text-center">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="delpass2" id="delpass2" class="form-control text-center" disabled>
								<input type="hidden" name="delpass" id="delpass" class="form-control text-center">
							</div>
						</div>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-danger" type="submit" name="del_user" id="del_user">
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