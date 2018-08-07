<?php
include '../../config/db.php';
if (!isset($_SESSION['id'])) {
	die("Anda Belum Login");
} else {
	$id=$_SESSION['id'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Puskesmas Mlati I</title>
	<link rel="icon" href="../../assets/images/puskesmas.png">
	<link rel="stylesheet" href="../../assets/datatable/bootstrap.css">
	<!--<link rel="stylesheet" href="../../assets/css/bootstrap.css">-->
	<link rel="stylesheet" href="../../assets/css/simple-sidebar.css">
	<link rel="stylesheet" href="../../assets/awesome/css/font-awesome.css">
	<link rel="stylesheet" href="../../assets/css/style.css">
	<link rel="stylesheet" href="../../assets/sweetalert/dist/sweetalert2.css">
	<script src="../../assets/sweetalert/dist/sweetalert2.js"></script>
	<link rel="stylesheet" href="../../assets/datatable/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../../assets/datatable/responsive.bootstrap4.min.css">
	<script type="text/javascript">
		function masuk(){
			const toast = swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});
			toast({
				type: 'success',
				title: 'Selamat Datang'
			})
		}
		$(document).ready(function(){
			$("#wrapper").toggleClass("toggled");
		});
	</script>
</head>
<body style="background-color: #e7e8eb;">
	<div id="wrapper">
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li class="sidebar-brand mt-4" style="margin-bottom: 100px">
					<center>
						<img style="width: auto;height: 100px;" src="../../assets/images/puskesmas.png">
						<label><i class="fa fa-stethoscope"></i> Puskesmas Mlati I</label>
					</center>
				</li>
				<li>
					<a href="./"><i class="fa fa-tachometer"></i>&nbsp;&nbsp;Dashboard</a>
				</li>
				<li class="active">
					<a href="#brgSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle"><i class="fa fa-th-list"></i>&nbsp;&nbsp;Data Barang</a>
					<ul class="collapse list-unstyled" id="brgSubmenu">
						<li>
							<a href="index.php?page=penerimaan"><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Penerimaan Barang</a>
						</li>
						<li>
							<a href="index.php?page=pemakaian"><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;Pemakaian Barang</a>
						</li>
					</ul>
				</li>
				<li class="active">
					<a href="#cetak" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak Laporan</a>
					<ul class="collapse list-unstyled" id="cetak">
						<li>
							<a href="index.php?page=lapsup"><i class="fa fa-book"></i>&nbsp;&nbsp;Laporan Penerimaan</a>
						</li>
						<li>
							<a href="index.php?page=lapbrgin"><i class="fa fa-book"></i>&nbsp;&nbsp;Laporan Barang Masuk</a>
						</li>
						<li>
							<a href="index.php?page=lapbrgout"><i class="fa fa-book"></i>&nbsp;&nbsp;Laporan Barang Keluar</a>
						</li>
					</ul>
				</li>
				<li>
					<?php
					if ($_SESSION['hakakses']=="admin") {
						echo '<a href="../admin/"><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Menuju Form Admin</a>';
					}
					?>
				</li>
				<li>
					<form method="POST">
						<center>
							<button type="submit" class="btn btn-danger mt-4" name="logout" id="logout" onclick="swal('Berhasil Logout');">
								<i class="fa fa-hand-o-left"></i>&nbsp;Logout
							</button>
							<?php
							if (isset($_POST['logout'])) {
								$user->logout();
							}
							?>
						</center>
					</form>
				</li>
			</ul>
		</div>
		<div id="page-content-wrapper">
			<button href="#menu-toggle" class="btn btn-success btn-sm" id="menu-toggle" data-toggle="tooltip" data-placement="Right" title=""><i class="fa fa-bars"></i></button>
			<button class="btn btn-sm btn-warning float-right ml-2" type="button" onclick="swal('<?php echo date("d M Y") ?>');">
				<i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<?php echo date("d/m/Y"); ?>
			</button>
			<?php
			if ($_SESSION['id']) {
			?>
			<button class="btn btn-sm btn-outline-success float-right" type="button" onclick="">
				<i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $_SESSION['id']; ?>
			</button>
			<?php
			}
			?>
			<div class="container-fluid">
				<?php
				if (!isset($_GET['page'])) {
					include 'dashboard.php';
				} else {
					if ($_GET['page']=="penerimaan") {
						include 'penerimaan.php';
					}
					elseif ($_GET['page']=="pemakaian") {
						include 'pemakaian.php';
					}
					elseif ($_GET['page']=="penambahan") {
						include 'penambahan.php';
					}
					elseif ($_GET['page']=="lapsup") {
						include 'laporansupplier.php';
					}
					elseif ($_GET['page']=="lapbrgin") {
						include 'laporanbarangmasuk.php';
					}
					elseif ($_GET['page']=="lapbrgout") {
						include 'laporanbarangkeluar.php';
					}
				}		
				?>
			</div>
		</div>
	</div>
	<!--
	<center>
		<footer class="footer fixed-bottom" style="background-color: #222d32;">
			<div class="container-fluid">
				<span class="text-white">Puskesmas Mlati I, Jalan Wijaya Kusuma, Sinduadi, Mlati, Kabupaten Sleman, Yogyakarta</span><br>
				<span class="text-white">Copyright &copy; <a href="https://github.com/fikriomar16">Mohammad Fikri Omar</a>, 2018</span>
			</div>
		</footer>
	</center>
	-->
	<script src="../../assets/js/popper.min.js"></script>
	<script src="../../assets/js/jquery.min.js"></script>
	<script src="../../assets/js/bootstrap.min.js"></script>
	<script src="../../assets/datatable/jquery.dataTables.min.js"></script>
	<script src="../../assets/datatable/dataTables.bootstrap4.min.js"></script>
	<script src="../../assets/datatable/dataTables.responsive.min.js"></script>
	<script src="../../assets/datatable/responsive.bootstrap4.min.js"></script>
	<script>
		$("#wrapper").toggleClass("toggled");
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();
			$('#tabbrgmasuk').DataTable();
			$('#tabbrgkeluar').DataTable();
			$('#tabdetbrg').DataTable();
		});
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
    </script>
</body>
</html>
