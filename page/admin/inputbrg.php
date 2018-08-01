<?php
$sql = 'SELECT barang.kodebrg, barang.namabrg, jenisbarang.namajen, barang.jumlah, barang.harga, satuan.namasatuan, barang.tglmsk, supplier.namasup, barang.foto from barang INNER JOIN jenisbarang ON barang.kodejen = jenisbarang.kodejen INNER JOIN satuan ON barang.kodesatuan = satuan.kodesatuan INNER JOIN supplier ON barang.kodesup = supplier.kodesup;';
$query = mysqli_query($con, $sql);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($con));
}
?>
<script type="text/javascript">
	function showmodalbrg() {
		$('#modalbrg').modal('show');
	}
	function showmodaledt(kodebrg,namabrg,jumlah,harga) {
		$('#edtkodebrg').val(kodebrg);
		$('#edtkodebrg2').val(kodebrg);
		$('#edtnamabrg').val(namabrg);
		$('#edtjumlah').val(jumlah);
		$('#edtharga').val(harga);
		$('#modaledt').modal('show');
	}
	function showmodaldel(kodebrg,namabrg) {
		$('#delkodebrg').val(kodebrg);
		$('#delkodebrg2').val(kodebrg);
		$('#delnamabrg').val(namabrg);
		$('#delnamabrg2').val(namabrg);
		$('#modaldel').modal('show');
	}
	function showmodaldet(kodebrg,namabrg,kodejen,jumlah,harga,kodesatuan,tglmsk,kodesup,foto) {
		$('#detkodebrg').text(kodebrg);
		$('#detnamabrg').text(namabrg);
		$('#detkodejen').text(kodejen);
		$('#detjumlah').text(jumlah);
		$('#detharga').text(harga);
		$('#detkodesatuan').text(kodesatuan);
		$('#dettglmsk').text(tglmsk);
		$('#detsup').text(kodesup);
		$('#detfoto').text(foto);
		$('#modaldet').modal('show');
		var TextInsideP = document.getElementById("detfoto").innerHTML;
		document.getElementById("image-id").src = "../../assets/images/barang/"+TextInsideP;
	}
	function gambar(nama,gambar){
		swal({
			title : nama,
			html : '<img style="width: auto;height: 270px;" src="../../assets/images/barang/'+gambar+'">',
			showConfirmButton: false
		});
	}
	function getkode(e) {
		document.getElementById('labelfoto').value = e.target.value;
	}
	function edtgetkode(e) {
		document.getElementById('edtlabelfoto').value = e.target.value;
	}
</script>
<center>
	<h4>Form Penginputan Data Barang</h4>
</center>
<div class="container-fluid mb-auto">
	<button type="button" class="btn btn-info btn-sm mb-2 float-right" onclick="showmodalbrg();" data-toggle="tooltip" data-placement="left" title="Tambah Data">
		<i class="fa fa-plus"></i>&nbsp;Tambah
	</button>
	<?php
	if (isset($_POST['add_brg'])) {
		$data->add_brg($_POST['kodebrg'],$_POST['namabrg'],$_POST['jenis'],$_POST['jumlah'],$_POST['harga'],$_POST['satuan'],$_POST['tglmsk'],$_POST['sup'],$_FILES['foto']);
	}
	if (isset($_POST['edt_brg'])) {
		$data->edt_brg($_POST['edtkodebrg'],$_POST['edtnamabrg'],$_POST['edtjenis'],$_POST['edtjumlah'],$_POST['edtharga'],$_POST['edtsatuan'],$_POST['edttglmsk'],$_POST['edtsup'],$_FILES['edtfoto']);
		echo '<script>swal("Data Berhasil Diubah");</script>';
		echo "<script>location='index.php?page=inputbrg';</script>";
	}
	if (isset($_POST['del_brg'])) {
		$data->del_brg($_POST['delkodebrg']);
		echo '<script>swal("Data Berhasil Dihapus");</script>';
		echo "<script>location='index.php?page=inputbrg';</script>";
	}
	?>
	<div class="table-responsive">
		<table class="table table-hover table-striped" id="tabbrg">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>Jenis</th>
					<th>Jml</th>
					<th>Harga</th>
					<th>Satuan</th>
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
					<td><?php echo number_format($value[4], 0, ',', '.'); ?></td>
					<td><?php echo $value[5] ?></td>
					<td>
						<button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Gambar" onclick="gambar('<?php echo $value[1] ?>','<?php echo $value[8] ?>');">
							<i class="fa fa-image"></i>
						</button>
						<button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Barang" onclick="showmodaldet('<?php echo $value[0] ?>','<?php echo $value[1] ?>','<?php echo $value[2] ?>',<?php echo $value[3] ?>,<?php echo $value[4] ?>,'<?php echo $value[5] ?>','<?php echo $value[6] ?>','<?php echo $value[7] ?>','<?php echo $value[8] ?>');">
							<i class="fa fa-eye"></i>
						</button>
						<button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Data Barang" onclick="showmodaledt('<?php echo $value[0] ?>','<?php echo $value[1] ?>',<?php echo $value[3] ?>,<?php echo $value[4] ?>);">
							<i class="fa fa-edit"></i>
						</button>
						<button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data Barang" onclick="showmodaldel('<?php echo $value[0] ?>','<?php echo $value[1] ?>');">
							<i class="fa fa-trash"></i>
						</button>
					</td>
				</tr>
				<?php
				$i++;
				}
				mysqli_free_result($query);
				//mysqli_close($con);
				?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modalbrg" tabindex="-1" role="dialog" aria-labelledby="DialogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-success text-white">
				<h5 class="modal-title" id="modaltitlebrg">Input Data Barang</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-brg" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-5">
							<div class="form-group">
								<input type="text" name="kodebrg" class="form-control text-center" id="kodebrg" placeholder="Kode Barang" maxlength="10" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="namabrg" class="form-control text-center" id="namabrg" placeholder="Nama Barang" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<select class="form-control text-center" name="jenis" id="jenis" required>
							<option value="" disabled selected>- Jenis Barang -</option>
							<?php $jen = $data->showjen()?>
							<?php foreach ($jen as $key => $value): ?>
								<?php echo "<option value='".$value['kodejen']."'>";?><?php echo $value['namajen']."</option>"; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="row">
						<div class="col-4">
							<div class="form-group">
								<input type="number" name="jumlah" class="form-control text-center" id="jumlah" placeholder="Jumlah" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<select class="form-control text-center" name="satuan" id="satuan" required>
									<option value="" disabled selected>- Satuan -</option>
									<?php $sat = $data->showsat()?>
									<?php foreach ($sat as $key => $value): ?>
										<?php echo "<option value='".$value['kodesatuan']."'>";?><?php echo $value['namasatuan']."</option>"; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-2">
							<div class="form-group">
								<input type="text" class="form-control text-center" placeholder="Rp." disabled>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="number" name="harga" class="form-control text-center" id="harga" placeholder="Harga" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="date" name="tglmsk" id="tglmsk" class="form-control" max="<?php echo date("Y-m-d");?>" required>
					</div>
					<div class="form-group">
						<select class="form-control text-center" name="sup" id="sup" required>
							<option value="" disabled selected>- Supplier -</option>
							<?php $sup = $data->showsup()?>
							<?php foreach ($sup as $key => $value): ?>
								<?php echo "<option value='".$value['kodesup']."'>";?><?php echo $value['namasup']."</option>"; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								 <span class="input-group-text"><i class="fa fa-image"></i></span>
							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="foto" name="foto" onchange="getkode(event)">
								<label class="custom-file-label" for="foto" id="label"><i class="fa fa-folder-open"></i>&nbsp;Pilih Gambar</label>
							</div>
						</div>
						<input type="hidden" name="labelfoto" id="labelfoto" readonly class="form-control">
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-success" type="submit" name="add_brg" id="add_brg">
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
				<h5 class="modal-title" id="modaltitlebrg">Update Data Barang</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-edt" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-5">
							<div class="form-group">
								<input type="text" name="edtkodebrg2" class="form-control text-center text-primary" id="edtkodebrg2" placeholder="Kode Barang" disabled>
								<input type="hidden" name="edtkodebrg" class="form-control text-center" id="edtkodebrg" placeholder="Kode Barang">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="edtnamabrg" class="form-control text-center" id="edtnamabrg" placeholder="Nama Barang" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<select class="form-control text-center" name="edtjenis" id="edtjenis" required>
							<option value="" disabled selected>- Jenis Barang -</option>
							<?php $jen = $data->showjen()?>
							<?php foreach ($jen as $key => $value): ?>
								<?php echo "<option value='".$value['kodejen']."'>";?><?php echo $value['namajen']."</option>"; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="row">
						<div class="col-3">
							<div class="form-group">
								<input type="number" name="edtjumlah" class="form-control text-center" id="edtjumlah" placeholder="Jumlah" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<select class="form-control text-center" name="edtsatuan" id="edtsatuan" required>
									<option value="" disabled selected>- Satuan -</option>
									<?php $sat = $data->showsat()?>
									<?php foreach ($sat as $key => $value): ?>
										<?php echo "<option value='".$value['kodesatuan']."'>";?><?php echo $value['namasatuan']."</option>"; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-2">
							<div class="form-group">
								<input type="text" class="form-control text-center" placeholder="Rp." disabled>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="number" name="edtharga" class="form-control text-center" id="edtharga" placeholder="Harga" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="date" name="edttglmsk" id="edttglmsk" class="form-control" max="<?php echo date("Y-m-d");?>" required>
					</div>
					<div class="form-group">
						<select class="form-control text-center" name="edtsup" id="edtsup" required>
							<option value="" disabled selected>- Supplier -</option>
							<?php $sup = $data->showsup()?>
							<?php foreach ($sup as $key => $value): ?>
								<?php echo "<option value='".$value['kodesup']."'>";?><?php echo $value['namasup']."</option>"; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								 <span class="input-group-text"><i class="fa fa-image"></i></span>
							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="edtfoto" name="edtfoto" onchange="edtgetkode(event)">
								<label class="custom-file-label" for="edtfoto" id="label"><i class="fa fa-folder-open"></i>&nbsp;Pilih Gambar</label>
							</div>
						</div>
						<input type="hidden" name="edtlabelfoto" id="edtlabelfoto" readonly class="form-control">
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-primary" type="submit" name="edt_brg" id="edt_brg">
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
			<div class="modal-header" style="background-color: #dc3545; color: #fff;">
				<h5 class="modal-title" id="modaltitlebrg">Hapus Data Barang</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-del" method="POST" enctype="multipart/form-data">
					<h4 align="center" style="color: red;">Yakin ingin menghapus data ini ?</h4>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input class="form-control text-center text-danger" type="text" name="delkodebrg2" id="delkodebrg2" disabled>
								<input class="form-control text-center" type="hidden" name="delkodebrg" id="delkodebrg">
							</div>
						</div>
						<div class="col">
							<input class="form-control text-center" type="text" name="delnamabrg2" id="delnamabrg2" disabled>
							<input class="form-control text-center" type="hidden" name="delnamabrg" id="delnamabrg">
						</div>
					</div>
					<div class="modal-footer form-group">
						<button class="btn btn-sm btn-danger" type="submit" name="del_brg" id="del_brg">
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
<div class="modal fade" id="modaldet" tabindex="-1" role="dialog" aria-labelledby="DialogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #007bff; color: #fff;">
				<h5 class="modal-title" id="modaltitlesup">Detail Data Barang</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: #fff">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-det" method="POST">
					<div class="row">
						<div class="col-4">
							<p>Kode Barang :</p>
						</div>
						<div class="col">
							<p id="detkodebrg"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<p>Nama Barang :</p>
						</div>
						<div class="col">
							<p id="detnamabrg"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<p>Jenis Barang :</p>
						</div>
						<div class="col">
							<p id="detkodejen"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<p>Jumlah Barang :</p>
						</div>
						<div class="col">
							<p id="detjumlah"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<p>Harga Barang :</p>
						</div>
						<div class="col">
							<p id="detharga"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<p>Satuan :</p>
						</div>
						<div class="col">
							<p id="detkodesatuan"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<p>Tgl Masuk :</p>
						</div>
						<div class="col">
							<p id="dettglmsk"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<p>Supplier :</p>
						</div>
						<div class="col">
							<p id="detsup"></p>
						</div>
					</div>
					<p hidden id="detfoto"></p>
					<center><img id="image-id" style="width: auto;height: 170px;" src="../../assets/images/barang/default.png"></center>
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