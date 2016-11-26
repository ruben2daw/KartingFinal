<?php


	session_start();
	
	class Auth{
	
		private $loginURL;
		private $redirectURL;
		private $adminURL;
		private $userURL;
	
	
	/* constructor de la clase Auth */
	public function __construct($loginURL,$redirectURL,$adminURL,$userURL){
			$this->loginURL=$loginURL;
			$this->redirectURL=$redirectURL;
			$this->adminURL=$adminURL;
			$this->userURL=$userURL;
	}
	
	
	/* método para instanciar objetos Auth con parámetros de configuración */
	public static function get(){
		return new Auth(Config::get('login_page'),Config::get('login_redirect'),
						Config::get('admin_page'),Config::get('user_page'));
	}
	

	/* método login */
	public function doLogin($login,$pass){
		
		$userDAO=new UserDAO();
		$user=$userDAO->getByLogin($login);
		
		if($user){
			if(password_verify($pass,$user->getPassword())){
				
				$_SESSION['user']=$user;
				
				if($userDAO->isAdmin($login))
					header("Location: ".$this->adminURL);	
				else
					header("Location: ".$this->userURL);	
			
			}else	
				return false;
		}
		
		return false;
	}
	
	
	/* método cierre sesión */
	public function closeSession(){
		
		if(!empty($_GET['session']) && $_GET['session']=="close"){
			
			if(isset($_SESSION['user'])){
				unset($_SESSION['user']);
				session_destroy();
				
				header("Location: ".$this->redirectURL);
			}
		}
	}
	
	
	/* comprueba si usuario está logado */
	public function isLogged(){
		if(isset($_SESSION["user"]))
			return true;
		else
			return false;
	}
	
	
	/* muestra mensaje de bienvenida si el usuario está logado */
	function showWelcomeMessage(){
		
		if($this->isLogged()){
				echo "Bienvenido ".$_SESSION["user"]->getFirstName()." has iniciado sesión<br>";
				echo "<a href='".$_SERVER['PHP_SELF']."?session=close'>Cerrar Sesión</a>";
		}
	}
	
}	
?>