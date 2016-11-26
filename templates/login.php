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
<h2>Login</h2>

	<form action="#" method="post" enctype="multipart/form-data">
		Usuario:<input name="user" type="text">
		<br><br>
		Password: <input name="pass" type="password" /><br>
		<input type="submit" value="Send">
	</form>	
	
	<h3><?php echo $msg;?></h3>
</section>
