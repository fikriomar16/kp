<?php
include '../../config/db.php';
if (!isset($_SESSION['id'])) {
	die("Anda Belum Login");
} else {
	$id=$_SESSION['id'];
}
if ($_SESSION['hakakses']!=="admin") {
	die("Anda Bukan Admin");
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
				<li>
					<a href="index.php?page=supplier"><i class="fa fa-truck"></i>&nbsp;&nbsp;Data Supplier</a>
				</li>
				<li class="active">
					<a href="#brgSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle"><i class="fa fa-th-list"></i>&nbsp;&nbsp;Data Barang</a>
					<ul class="collapse list-unstyled" id="brgSubmenu">
						<li>
							<a href="index.php?page=inputbrg"><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Input Data Barang</a>
						</li>
						<li>
							<!--<a href="index.php?page=penambahan"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Penambahan Stok</a>-->
						</li>
					</ul>
				</li>
				<li class="active">
					<a href="#kategori" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle"><i class="fa fa-tags"></i>&nbsp;&nbsp;Input Kategori Barang</a>
					<ul class="collapse list-unstyled" id="kategori">
						<li>
							<a href="index.php?page=satuan"><i class="fa fa-book"></i>&nbsp;&nbsp;Satuan Barang</a>
						</li>
						<li>
							<a href="index.php?page=jenis"><i class="fa fa-book"></i>&nbsp;&nbsp;Jenis Barang</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="index.php?page=admin"><i class="fa fa-user"></i>&nbsp;&nbsp;Kelola Data Admin</a>
				</li>
				<li>
					<a href="../user/"><i class="fa fa-arrow-circle-right"></i>&nbsp;&nbsp;Menuju Form User</a>
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
					if ($_GET['page']=="supplier") {
						include_once 'supplier.php';
					}
					elseif ($_GET['page']=="inputbrg") {
						include_once 'inputbrg.php';
					}
					elseif ($_GET['page']=="penambahan") {
						include_once 'penambahan.php';
					}
					elseif ($_GET['page']=="satuan") {
						include_once 'satuan.php';
					}
					elseif ($_GET['page']=="jenis") {
						include_once 'jenis.php';
					}
					elseif ($_GET['page']=="admin") {
						include_once 'admin.php';
					}
				}		
				?>
			</div>
		</div>
	</div>
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
			$('#tabsup').DataTable();
			$('#tabbrg').DataTable();
			$('#tabsat').DataTable();
			$('#tabjen').DataTable();
			$('#admintab').DataTable();
		});
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
    </script>
</body>
</html>
