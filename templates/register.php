<?php
	$error="";
	$msg="";
	
	if($_POST)
	{
		
		//Comprobamos si los campos se han rellenado
		if( empty($_POST['login']) || empty($_POST['password']) || 
			empty($_POST['email']) 	|| empty($_POST['firstname']) || empty($_POST['lastname'])){
				
				$error="Debes rellenar todos los campos";
			
		}else{
				$user = new User();
				$user->setLogin($_POST['login']);
				$user->setFirstName($_POST['firstname']);
				$user->setLastName($_POST['lastname']);
				$user->setPassword(password_hash($_POST['password'],PASSWORD_DEFAULT));
				$user->setEmail($_POST['email']);
				$user->setRole(2);
				
				$userDAO=new UserDAO();
				$result=$userDAO->insert($user);
				
				if($result==false){
						$error="Ha ocurrido un error al insertar el usuario. ".$stm->errorInfo()[2];
				}else{
						$msg="Usuario registrado correctamente";
					header('Location: index.php?section=login');
				}
					
				
		}
	}
?>
<section class="col-md-10">

	<!-- REGISTRATION FORM -->
	<div class="text-center" style="padding:50px 0">
		<div class="logo">Registro</div>
		<!-- Main Form -->
		<div class="login-form-1">
			<form id="register-form" action="#" method="post" class="text-left">
				<div class="login-form-main-message"></div>
				<div class="main-login-form">
					<div class="login-group">
						<div class="form-group">
							<label for="reg_username" class="sr-only">Email address</label>
							<input type="text" class="form-control" id="reg_username" name="login" placeholder="username">
						</div>
						<div class="form-group">
							<label for="reg_password" class="sr-only">Password</label>
							<input type="password" class="form-control" id="reg_password" name="password" placeholder="password">
						</div>

						<div class="form-group">
							<label for="reg_email" class="sr-only">Email</label>
							<input type='email'  class="form-control" id="reg_email"  name='email' placeholder="email">
						</div>
						<div class="form-group">
							<label for="reg_fullname" class="sr-only">Nombre</label>
							<input type="text" class="form-control" id="reg_fullname" name="firstname" placeholder="Nombre">
						</div>

						<div class="form-group">
							<label for="reg_fullname" class="sr-only">Apellidos</label>
							<input type="text" class="form-control" id="reg_fullname" name="lastname" placeholder="Apellido">
						</div>

					</div>
					<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
				</div>
				<div class="etc-login-form">
					<p>Ya tienes una cuenta? <a href="index.php?section=login">Inicia Session aqui</a></p>
				</div>
			</form>
		</div>
		<!-- end:Main Form -->
	</div>


	<br><br>
	<h3 style="color:red"><?php echo $error;?></h3>
	<h3 style="color:green"><?php echo $msg;?></h3>
</section>


<!-- end:Main Form
<form action="#" method="post">
	Login:<input type='text' name='login'><br>
	Password:<input type='password' name='password'><br>
	Email:<input type='email' name='email'><br>
	Nombre:<input type='text' name='firstname'><br>
	Apellidos:<input type='text' name='lastname'><br>
	<br><br>
	<input type="submit" value="Send">
</form>

-->