<?php
$sql = "SELECT brgmasuk.kodemasuk,brgmasuk.tglmasuk,barang.namabrg,brgmasuk.jumlah,supplier.namasup,barang.kodebrg,satuan.namasatuan,barang.foto FROM brgmasuk INNER JOIN barang ON brgmasuk.kodebrg = barang.kodebrg INNER JOIN supplier ON barang.kodesup = supplier.kodesup INNER JOIN satuan ON barang.kodesatuan = satuan.kodesatuan WHERE brgmasuk.jumlah!='0' ORDER BY brgmasuk.kodemasuk ASC";
$query = mysqli_query($con, $sql);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($con));
}
?>
<script type="text/javascript">
	function showmodalmasuk() {
		$('#modalmasuk').modal('show');
	}
	function modalbarang() {
		$('#modalbrg').modal('show');
	}
	function showmodaldel(kodemasuk,tglmasuk,getkodebrg,kodebrg,jumlah){
		$('#delkodemasuk').val(kodemasuk);
		$('#delkodemasuk2').val(kodemasuk);
		$('#deltglmasuk').val(tglmasuk);
		$('#getkodebrg').val(getkodebrg);
		$('#delkodebrg').val(kodebrg);
		$('#deljumlah').val(jumlah);
		$('#deljumlah2').val(jumlah);
		$('#modaldel').modal('show');
	}
	function showmodaldet(foto,kodemasuk,namabrg,jumlah,satuan,tglmasuk,supplier){
		$('#detkodemasuk').text(kodemasuk);
		$('#detnamabrg').text(namabrg);
		$('#detjumlah').text(jumlah);
		$('#detkodesatuan').text(satuan);
		$('#dettglmsk').text(tglmasuk);
		$('#detsup').text(supplier);
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
</script>
<center>
	<h4>Form Penerimaan Barang</h4>
</center>
<div class="container-fluid mb-auto">
	<button type="button" class="btn btn-sm mb-2 btn-info" onclick="modalbarang();" data-toggle="tooltip" data-placement="left" title="Lihat Data Barang">
		<i class="fa fa-th-list"></i>&nbsp;Data Barang
	</button>
	<button type="button" class="btn btn-info btn-sm mb-2 float-right" onclick="showmodalmasuk();" data-toggle="tooltip" data-placement="left" title="Tambah Data">
		<i class="fa fa-plus-circle"></i>&nbsp;Tambah
	</button>
	<?php
	if (isset($_POST['add_brgin'])) {
		$data->add_brgin($_POST['kodemasuk'],$_POST['tglmasuk'],$_POST['kodebrg'],$_POST['jumlah'],$_FILES['foto']);
	}
	if (isset($_POST['del_brgin'])) {
		$data->del_brgin($_POST['delkodemasuk'],$_POST['getkodebrg'],$_POST['deljumlah']);
		echo '<script>swal("Berhasil Menghapus Data")</script>';
		echo "<script>location='index.php?page=penerimaan';</script>";
	}
	?>
	<div class="table-responsive">
		<table class="table table-hover table-striped" id="tabbrgmasuk">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Kode Masuk</th>
					<th>Tgl Masuk</th>
					<th>Nama Barang</th>
					<th>Jumlah</th>
					<th>Supplier</th>
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
					<td>
						<button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat Gambar" onclick="gambar('<?php echo $value[2] ?>','<?php echo $value[7] ?>');">
							<i class="fa fa-image"></i>
						</button>
						<button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Data"  onclick="showmodaldet('<?php echo $value[7] ?>','<?php echo $value[0] ?>','<?php echo $value[2] ?>',<?php echo $value[3] ?>,'<?php echo $value[6] ?>','<?php echo $value[1] ?>','<?php echo $value[4] ?>');">
							<i class="fa fa-eye"></i>
						</button>
						<button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data" onclick="showmodaldel('<?php echo $value[0] ?>','<?php echo $value[1] ?>','<?php echo $value[5] ?>','<?php echo $value[2] ?>',<?php echo $value[3] ?>);">
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
<div class="modal fade" id="modalmasuk" tabindex="-1" role="dialog" aria-labelledby="DialogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-success text-white">
				<h5 class="modal-title text-center col-12" id="modaltitlesup">Input Barang Masuk</h5>
			</div>
			<div class="modal-body">
				<form method="POST" id="form-brg" enctype="multipart/form-data">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="kodemasuk" id="kodemasuk" class="form-control text-center text-success" placeholder="Kode Barang Masuk" maxlength="10" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="date" name="tglmasuk" id="tglmasuk" class="form-control text-center" max="<?php echo date("Y-m-d");?>" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<select class="form-control text-center" name="kodebrg" id="kodebrg" required>
									<option value="" disabled selected>Barang (dalam satuan)</option>
									<?php $brg = $data->showbrg() ?>
									<?php foreach ($brg as $key => $value): ?>
										<?php echo "<option value='".$value['kodebrg']."'>";?><?php echo $value['namabrg']." - ".$value['namasatuan']." - Stok : ".$value['jumlah']."</option>"; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<input type="number" name="jumlah" id="jumlah" class="form-control text-center" placeholder="Jml" required>
							</div>
						</div>
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
						<button class="btn btn-sm btn-success" type="submit" name="add_brgin" id="add_brgin">
							<i class="fa fa-save"></i>&nbsp;Simpan
						</button>
						<button class="btn btn-sm btn-outline-danger" type="submit" data-dismiss="modal">
							<i class="fa fa-trash"></i>&nbsp;Batal
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
				<h5 class="modal-title text-center col-12" id="modaltitlesup">Hapus Data Barang</h5>
			</div>
			<div class="modal-body">
				<form method="POST" id="form-del">
					<h4 align="center" class="text-danger">Yakin Ingin Menghapus Data Ini ?</h4>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="text" name="delkodemasuk2" id="delkodemasuk2" class="form-control text-center text-danger" disabled>
								<input type="hidden" name="delkodemasuk" id="delkodemasuk" class="form-control text-center">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text" name="deltglmasuk" id="deltglmasuk" class="form-control text-center" disabled>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<input type="hidden" name="getkodebrg" id="getkodebrg" class="form-control text-center">
								<input type="text" name="delkodebrg" id="delkodebrg" class="form-control text-center" disabled="">
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
						<button class="btn btn-sm btn-danger" type="submit" name="del_brgin" id="del_brgin">
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
							<p>Kode Masuk :</p>
						</div>
						<div class="col">
							<p id="detkodemasuk"></p>
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
							<p>Jumlah Barang :</p>
						</div>
						<div class="col">
							<p id="detjumlah"></p>
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
<div class="modal fade" id="modalbrg" tabindex="-1" role="dialog" aria-labelledby="DialogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info text-white">
				<h5 class="modal-title text-center col-12" id="modaltitlebrg">Daftar Barang</h5>
			</div>
			<div class="modal-body">
				<form method="POST" id="formbrg">
					<div class="table-responsive">
						<table class="table table-hover table-sm table-striped" id="tabdetbrg">
							<thead class="thead-light">
								<tr>
									<th>No</th>
									<th>Kode</th>
									<th>Nama</th>
									<th>Jns</th>
									<th>Jml</th>
									<th>Sat</th>
									<th>Harga</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$detbrg = $data->showdetbrg();
								foreach ($detbrg as $key => $value):
								?>
								<tr>
									<td><?php echo $i;?></td>
									<td><?php echo $value['kodebrg'];?></td>
									<td><?php echo $value['namabrg'];?></td>
									<td><?php echo $value['namajen'];?></td>
									<td><?php echo $value['jumlah'];?></td>
									<td><?php echo $value['namasatuan'];?></td>
									<td><?php echo "Rp. ".number_format($value['harga'], 0, ',', '.'); ?></td>
								</tr>
								<?php
								$i++;
								endforeach;
								?>
							</tbody>
						</table>
					</div>
				</form>
			</div>
			<div class="modal-footer form-group">
				<button class="btn btn-sm btn-info" type="submit" data-dismiss="modal">
					<i class="fa fa-check"></i>&nbsp;OK
				</button>
			</div>
		</div>
	</div>
</div>