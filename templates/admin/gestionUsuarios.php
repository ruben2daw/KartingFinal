<?php
/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 26/11/2016
 * Time: 21:38
 */

echo "● Un usuario administrador podrá crear otro usuario administrador, así como actualizar
sus datos o eliminarlo";

if($_POST){

    if(!empty($_POST['id'])){
        $userDAO=new UserDAO();
        $user= $userDAO->getByIdForAdmin($_POST['id']);
        $user->setLogin($_POST['login']);
        $user->setFirstName($_POST['firstname']);
        $user->setLastName($_POST['lastname']);
        $user->setPassword(password_hash($_POST['password'],PASSWORD_DEFAULT));
        $user->setEmail($_POST['email']);
        $user->setRole($_POST['role']);

        $result=$userDAO->updateForAdmin($user);

        if($result==false){
            $error="Ha ocurrido un error al insertar el usuario. ";
        }else{
            $msg="Usuario registrado correctamente";
        }


    }else{


        $user = new User();
        $user->setLogin($_POST['login']);
        $user->setFirstName($_POST['firstname']);
        $user->setLastName($_POST['lastname']);
        $user->setPassword(password_hash($_POST['password'],PASSWORD_DEFAULT));
        $user->setEmail($_POST['email']);
        $user->setRole($_POST['role']);

        $userDAO=new UserDAO();
        $result=$userDAO->insert($user);

        if($result==false){
            $error="Ha ocurrido un error al insertar el usuario. ";
        }else{
            $msg="Usuario registrado correctamente";
        }


    }

   // header("Location: ".$_SERVER['PHP_SELF']."?option=gestionUsuarios");
}

?>
<section class="col-md-10">
    <?php
    if(isset($_GET['action'])){
        $action=$_GET['action'];

        $users=null;

        if($action=="update"){

            $id=$_GET['id'];
            $userDAO=new UserDAO();
            $users=$userDAO->getByIdForAdmin($id);

        }else if($action=="delete"){

            $id=$_GET['id'];
            $userDAO=new UserDAO();
            $userDAO->delete($id);

            header("Location: ".$_SERVER['PHP_SELF']."?option=gestionUsuarios");
        }

        if($action=="create" || $action=="update"){
            ?>



            <form action="#" method="POST">
                login:<input name="login" type="text" value="<?php echo $users!=null ? $users->getLogin() : ''; ?>"><br>
                password:<input name="password" type="text" value="<?php echo $users!=null ? $users->getPassword() : ''; ?>"><br>
                email:<input name="email" type="text" value="<?php echo $users!=null ? $users->getEmail() : ''; ?>"><br>
                firstname:<input name="firstname" type="text" value="<?php echo $users!=null ? $users->getFirstname() : ''; ?>"><br>
                lastName:<input name="lastname" type="text" value="<?php echo $users!=null ? $users->getLastname() : ''; ?>"><br>
                role:<input name="role" type="text" value="<?php echo $users!=null ? $users->getRole() : ''; ?>"><br>

                <input type="hidden" name="id" value="<?php echo $users!=null ? $users->getId() : ''; ?>">
                <input type="submit" value="Enviar">
            </form>

            <?php
        }


    }else{
        $userDAO=new UserDAO();
        $listUser=$userDAO->getAllForAdmin();


        echo "<a href='".$_SERVER['PHP_SELF']."?option=gestionUsuarios&action=create'>Crear Usuario</a>";
        if($listUser){
            echo "<table border='1'>
                <tr>
                    <td>login</td>
                    <td>password</td>
                    <td>email</td>
                    <td>firstname</td>
                    <td>lastname</td>
                    <td>role</td>
                    
                </tr>";

            foreach($listUser as $users){
                echo "<tr><td>".$users->getId()."</td><td>".$users->getLogin()."</td><td>".$users->getPassword()."</td><td>".$users->getEmail()."</td><td>".$users->getFirstname()."</td><td>".$users->getLastname()."</td><td>".$users->getRole()."</td></tr>
              <td>
                <a href='".$_SERVER['PHP_SELF']."?option=gestionUsuarios&action=update&id=".$users->getId()."'>Actualizar</a>&nbsp;|
                <a href='".$_SERVER['PHP_SELF']."?option=gestionUsuarios&action=delete&id=".$users->getId()."'>Borrar</a>&nbsp;
              </td></tr>";
            }
            echo "</table>";
        }else{
            echo "<h1>No hay Usuarios</h1>";
        }
    }

    ?>
</section>