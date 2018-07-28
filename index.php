<?php
include 'config/db.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Puskesmas Mlati I</title>
	<link rel="icon" href="assets/images/puskesmas.png">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/awesome/css/font-awesome.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/sweetalert/dist/sweetalert2.css">
	<script src="assets/sweetalert/dist/sweetalert2.js"></script>
	<script type="text/javascript">
		function admin() {
			swal(
				'Sukses Login!',
				'Masuk Sebagai Admin!',
				'success'
				)
		}
		function user() {
			swal(
				'Sukses Login!',
				'Masuk Sebagai User!',
				'success'
				)
		}
	</script>
</head>
<body style="background-color: #e7e8eb;">
	<center>
		<img src="assets/images/puskesmasbanner1.png" style="width: auto;height: 250px;margin-top: 50px;margin-bottom: -100px" class="rounded img-fluid">
		<div class="card box" style="width: 400px;height: 280px;margin-top: 70px">
			<div class="card-header boxtitle" style="background-color: #E0EFD8">
				Login Admin
			</div>
			<div class="card-body">
				<form method="POST" class="form-signin">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa-2x" style="padding-left: 10px;padding-right: 10px;padding-top: 4px;"></i></span>
							<input type="text" name="username" id="username" class="form-control text-center mr-sm-2" placeholder="username">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock fa-2x " style="padding-left: 10px;padding-right: 10px;padding-top: 4px;"></i></span>
							<input type="password" name="pass" id="pass" class="form-control text-center mr-sm-2" placeholder="password">
						</div>
					</div>
					<button class="btn btn-success btn-block" id="signin" name="signin" style="margin-top: 25px"><i class="fa fa-lg fa-sign-in"></i>&nbsp;&nbsp;Login</button>
					<hr>
					<?php
					if (isset($_POST['signin'])) {
						$hasil=$user->login($_POST['username'],$_POST['pass']);
						if ($hasil=="admin") {
							#header("location:index.php");
							echo '<script type="text/javascript">',
							'admin()',
							'</script>';
							echo "<meta http-equiv='refresh' content='2;url= page/admin'>";
						}
						else if ($hasil=="user") {
							#header("location:index.php");
							echo '<script type="text/javascript">',
							'user()',
							'</script>';
							echo "<meta http-equiv='refresh' content='2;url= page/user'>";
						}else{
							header("location:./");
						}
					}
					?>
				</form>
			</div>
		</div>
	</center>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
