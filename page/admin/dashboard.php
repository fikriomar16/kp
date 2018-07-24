<center>
	<img src="../../assets/images/puskesmasbanner1.png" style="width: auto;height: 300px;" class="rounded img-fluid">
</center>
<div class="content-wrapper mt-3 ml-auto">
	<section class="content">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-aqua">
					<div class="inner">
						<?php
						$supplier = $dashboard->supplier();
						foreach ($supplier as $key => $value):
						?>
						<h3><?php echo $value['jumlah']; ?></h3>
						<?php
						endforeach;
						?>
						<p>Supplier</p>
					</div>
					<div class="icon">
						<i class="fa fa-truck"></i>
					</div>
					<a href="index.php?page=supplier" class="small-box-footer"> Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-green">
					<div class="inner">
						<?php
						$barang = $dashboard->barang();
						foreach ($barang as $key => $value):
						?>
						<h3><?php echo $value['jumlah']; ?></h3>
						<?php
						endforeach;
						?>
						<p>Barang</p>
					</div>
					<div class="icon">
						<i class="fa fa-briefcase"></i>
					</div>
					<a href="index.php?page=inputbrg" class="small-box-footer"> Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
					<div class="inner">
						<?php
						$satuan = $dashboard->satuan();
						foreach ($satuan as $key => $value):
						?>
						<h3><?php echo $value['jumlah']; ?></h3>
						<?php
						endforeach;
						?>
						<p>Satuan Barang</p>
					</div>
					<div class="icon">
						<i class="fa fa-tags"></i>
					</div>
					<a href="index.php?page=satuan" class="small-box-footer"> Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-red">
					<div class="inner">
						<?php
						$jenis = $dashboard->jenis();
						foreach ($jenis as $key => $value):
						?>
						<h3><?php echo $value['jumlah']; ?></h3>
						<?php
						endforeach;
						?>
						<p>Jenis Barang</p>
					</div>
					<div class="icon">
						<i class="fa fa-tags"></i>
					</div>
					<a href="index.php?page=jenis" class="small-box-footer"> Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	</section>
</div>
	<center>
		<footer class="footer fixed-bottom" style="background-color: #222d32;">
			<div class="container-fluid">
				<span class="text-white">Puskesmas Mlati I, Jalan Wijaya Kusuma, Sinduadi, Mlati, Kabupaten Sleman, Yogyakarta</span><br>
				<span class="text-white">Copyright &copy; <a href="https://github.com/fikriomar16">Mohammad Fikri Omar</a>, 2018</span>
			</div>
		</footer>
	</center>