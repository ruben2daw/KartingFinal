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
				}
					
				
		}
	}
?>
<section class="col-md-10">
<h2>Registro</h2>

	<form action="#" method="post">			
		Login:<input type='text' name='login'><br>
		Password:<input type='password' name='password'><br>
		Email:<input type='email' name='email'><br>
		Nombre:<input type='text' name='firstname'><br>
		Apellidos:<input type='text' name='lastname'><br>
		<br><br>
		<input type="submit" value="Send">
	</form>
	<br><br>
	<h3 style="color:red"><?php echo $error;?></h3>
	<h3 style="color:green"><?php echo $msg;?></h3>
</section>