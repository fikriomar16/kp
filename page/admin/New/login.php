<center>
	<img src="assets/images/puskesmasbanner1.png" style="width: auto;height: 250px;margin-top: -30px;margin-bottom: -100px" class="rounded img-fluid">
	<div class="card box" style="width: 400px;height: 320px;margin-top: 70px">
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
					if ($hasil=="sukses") {
						header("location:index.php");	
					}else{
						header("location:index.php?page=login");	
					}
				}
				?>
				<a href="#" class="btn btn-outline-primary btn-sm"><i class="fa fa-question-circle"></i> Lupa Password </a>
			</form>
		</div>
	</div>
</center>