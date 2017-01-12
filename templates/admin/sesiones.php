<?php
/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 26/11/2016
 * Time: 21:45
 */




$id_session=$_GET['id_session'];

$session_userDAO = new SessionsUsersDAO();
//$id_session_user=$session_userDAO->getById()

if($_POST){

        $sessionUser = new SessionUser();
        $sessionUser->setKart($_POST['kart']);
        $sessionUser->setSession($id_session);
        $sessionUser->setUser($_POST['user_id']);
        $session_userDAO = new SessionsUsersDAO();
        $result = $session_userDAO->insert($sessionUser);


        if($result!=1){
            $error="Ha ocurrido un error al insertar session_user. ";
            echo $error;
        }else{
            $msg="session user correctamente insertado";

        }


    header("Location: ".$_SERVER['PHP_SELF']."?option=sesiones&id_session=".$id_session);

}
?>

<section class="col-md-10">
    <?php
    if(isset($_GET['action'])){
        $action=$_GET['action'];

        $session_users=null;

       if($action=="delete"){

            $id=$_GET['id'];
           $session_userDAO = new SessionsUsersDAO();
           $session_userDAO->delete($Id);

            header("Location: ".$_SERVER['PHP_SELF']."?option=sesiones&id_session=".$id_session);
        }

        $kartsDAO= new KartsDAO();
        $listaKartsForm= $kartsDAO->getAll();


        $userDAO= new UserDAO();
        $listaUsersForm = $userDAO->getAll();


        if($action=="create" || $action=="update"){


            ?>



            <form action="#" method="POST">

                Nombre Usuario:
                <select name="user_id">
                    <?php

                    //var_dump($listaKartsTypeForm);
                    foreach ($listaUsersForm as $user) {

                        echo '<option value="' . $user->getId() . '">' . $user->getLogin() . '</option>';

                    }

                    ?>
                </select><br>





                Tipo de coche:
                <select name="kart">
                    <?php

                    // var_dump($listaKartsTypeForm);
                    foreach ($listaKartsForm as $kart) {

                        echo '<option value="' . $kart->getId() . '">' . $kart->getId() . '</option>';

                    }

                    ?>
                </select><br>






                <input type="submit" value="Enviar">
            </form>

            <?php
        }

        /**
         *  tipo reserva:
        <input name="tipo_reserva" type="number" value="<?php echo $reservas!=null ? $reservas->getNumber() : ''; ?>"><br>

         */


    }else{

          $session_userDAO = new SessionsUsersDAO();
        $queryFields = null;

            if(empty($id_session)){
                header("Location: ".$_SERVER['PHP_SELF']."?option=tandas");
            }else{
                $queryFields = $session_userDAO->getAllUserAndKartsWhereIdSession($id_session);
            }


        echo "<a href='" . $_SERVER['PHP_SELF'] . "?option=sesiones&action=create&id_session=$id_session' class='btn btn-success'>Asignar Usuario a la Tanda</a>";
        if($queryFields){
            echo "<table class=\"table\"  border='1'>
                <tr>
                    <td>Usuario</td>
                    <td>Coche</td>
                    <td>Numero Coche</td>                                        
                </tr>";

            for ($a = 0; $a < count($queryFields); $a++) {
                echo "<tr><td>".$queryFields[$a][0]."</td><td>".$queryFields[$a][1]."</td><td>". $queryFields[$a][2]."</td></tr>
              <td>
               
                <a href='" . $_SERVER['PHP_SELF'] . "?option=sesiones&action=delete&id=" . $id_session . "' class='btn btn-danger btn-xs'>Borrar</a>&nbsp;
              </td></tr>";
            }
            echo "</table>";
        }else{
            echo "<h1>No hay Session de Usuarios</h1>";
        }

        echo "<a href='".$_SERVER['PHP_SELF']."?option=tandas&id_session_user=$id_session'>Para empezar la carrera</a>";

    }

    ?>
</section>