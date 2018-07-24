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
						$masuk = $dashboard->masuk();
						foreach ($masuk as $key => $value):
						?>
						<h3><?php echo $value['jumlah']; ?></h3>
						<?php
						endforeach;
						?>
						<p>Barang Masuk</p>
					</div>
					<div class="icon">
						<i class="fa fa-share-square-o"></i>
					</div>
					<a href="index.php?page=penerimaan" class="small-box-footer"> Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-red">
					<div class="inner">
						<?php
						$keluar = $dashboard->keluar();
						foreach ($keluar as $key => $value):
						?>
						<h3><?php echo $value['jumlah']; ?></h3>
						<?php
						endforeach;
						?>
						<p>Barang Keluar</p>
					</div>
					<div class="icon">
						<i class="fa fa-check-square-o"></i>
					</div>
					<a href="index.php?page=pemakaian" class="small-box-footer"> Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
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