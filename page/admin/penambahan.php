<center>
	<h4>Penambahan Stok</h4>
</center>
<div class="container-fluid mb-auto mt-5">
	<form method="POST">
		<div class="row">
			<div class="col">
				<div class="form-group">
					<select class="form-control text-center" name="kodebrg" id="kodebrg" required>
						<option value="" disabled selected>Pilih Barang</option>
						<?php
						$cari = $data->showupdatebrg();
						foreach ($cari as $key => $value):
							echo "<option value='".$value['kodebrg']."'>".$value['namabrg']." - ".$value['namajen']." - ".$value['jumlah']." ".$value['namasatuan']."</option>";
						endforeach;
						?>
					</select>
				</div>
			</div>
			<div class="col-2">
				<div class="form-group">
					<input type="number" name="tambah" id="tambah" class="form-control text-center" placeholder="Tambah" required>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-plus-circle"></i>&nbsp;Tambah
					</button>
				</div>
			</div>
		</div>
	</form>
</div>