<?php

	$msg="";
	
	if($_POST){
		$user=$_POST['user'];
		$pass=$_POST['pass'];
		
		if(!Auth::get()->doLogin($user,$pass))
			$msg="ERROR: Usuario o contraseña no válidos";
	}
?>

<section class="col-md-10">



	<!-- Where all the magic happens -->
	<!-- LOGIN FORM -->
	<div class="text-center" style="padding:50px 0">
		<div class="logo">login</div>
		<!-- Main Form -->
		<div class="login-form-1">
			<form id="login-form" class="text-left" action="#" method="post" enctype="multipart/form-data">
				<div class="login-form-main-message"></div>
				<div class="main-login-form">
					<div class="login-group">
						<div class="form-group">
							<label for="lg_username" class="sr-only">Username</label>
							<input type="text" class="form-control" id="lg_username" name="user" placeholder="username">
						</div>
						<div class="form-group">
							<label for="lg_password" class="sr-only">Password</label>
							<input type="password" class="form-control" id="lg_password" name="pass" placeholder="password">
						</div>
						<div class="form-group login-group-checkbox">
							<input type="checkbox" id="lg_remember" name="lg_remember">
							<label for="lg_remember">remember</label>
						</div>
					</div>
					<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
				</div>

			</form>
		</div>
		<!-- end:Main Form -->
	</div>


	<h3><?php echo $msg;?></h3>


</section>


