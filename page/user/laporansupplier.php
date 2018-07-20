<center>
	<h4>Cetak Laporan Penerimaan</h4>
	<div class="card box" style="width: 600px;height: 270px;margin-top: 100px;">
		<div class="card-header boxtitle">
			<i class="fa fa-print"></i>&nbsp;Cetak Laporan
		</div>
		<div class="card-body">
			<form method="POST" class="form-group" id="terima" name="terima" action="cetak/terima.php">
				<div class="row">
					<div class="col-3">
						<div class="form-group">
							<h5 class="mt-1">Supplier :</h5>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<select class="form-control text-center" name="sup" id="sup" required>
								<option value="" selected disabled>Pilih Supplier</option>
								<?php $sup = $data->showsup()?>
								<?php foreach ($sup as $key => $value): ?>
									<?php echo "<option value='".$value['kodesup']."'>";?><?php echo $value['namasup']."</option>"; ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<div class="form-group">
							<h5 class="mt-2">Bulan :</h5>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<select class="form-control text-center" name="bulan" id="bulan" required>
								<option value="" disabled selected>Pilih Bulan</option>
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<button class="btn btn-primary" type="submit" id="cterima" name="ctrima">
						<i class="fa fa-print"></i>&nbsp;Cetak
					</button>
				</div>
			</form>
		</div>
	</div>
</center>