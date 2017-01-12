<?php
/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 26/11/2016
 * Time: 21:32
 */



if($_POST){

    if(!empty($_POST['id'])){


        $reservasDAO = new ReservesDAO();
        //$reserva= new Reserve();
        $reserva=$reservasDAO->getById($_POST['id']);
        $reserva->setUser($_POST['user_id']);
        $reserva->setDate($_POST['date']);
        $reserva->setNumber($_POST['numero_personas']);
        $reserva->setType($_POST['tipo_reserva']);
        $reserva->setKartType($_POST['kart_type']);

        $result=$reservasDAO->update($reserva);


        if($result==false){
            $error="Ha ocurrido un error al actualizar el reserva. ";
            echo $error;
        }else{
            $msg="Usuario registrado correctamente";

        }


    }else{



        $reserva = new Reserve();
        $reserva->setUser($_POST['user_id']);
        $reserva->setDate($_POST['date']);
        $reserva->setNumber($_POST['numero_personas']);
        $reserva->setType($_POST['tipo_reserva']);
        $reserva->setKartType($_POST['kart_type']);
        $reservasDAO = new ReservesDAO();
        $result= $reservasDAO->insert($reserva);


        if($result==false){
            $error="Ha ocurrido un error al insertar el reserva. ";
            echo $error;

        }else{
            $msg="Usuario registrado correctamente";
        }


    }
    header("Location: ".$_SERVER['PHP_SELF']."?option=reservas");

}

?>
<section class="col-md-10">
    <?php
    if(isset($_GET['action'])){
        $action=$_GET['action'];

        $reservas=null;

        if($action=="update"){

            $id = $_GET['id'];
            $reservasDAO = new ReservesDAO();
            $reservas = $reservasDAO->getById($id);
          //  $reservasDAO->update($reservas);

        }else if($action=="delete"){

            $id=$_GET['id'];
            $reservasDAO = new ReservesDAO();
            $reservasDAO->delete($id);

            header("Location: ".$_SERVER['PHP_SELF']."?option=reservas");
        }

       $kartsTypeDAO= new KartsTypeDAO();
       $listaKartsTypeForm= $kartsTypeDAO->getAll();


       $reservasTypeDAO= new ReservesTypeDAO();
       $listaReservasTypeForm = $reservasTypeDAO->getAll();
       // var_dump($listaReservasTypeForm);

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

                        echo '<option value="' . $user->getId() . '">' . $user->getFirstname()." ".$user->getLastname() . '</option>';

                    }

                    ?>
                </select><br>





                date:<input name="date" type="datetime-local" value="<?php echo $reservas!=null ? $reservas->getDate() : ''; ?>"><br>
                numbero personas:<input name="numero_personas" type="number" value="<?php echo $reservas!=null ? $reservas->getNumber() : ''; ?>"><br>

                Tipo de coche:
                <select name="kart_type">
                    <?php

                   // var_dump($listaKartsTypeForm);
                    foreach ($listaKartsTypeForm as $kartType) {

                        echo '<option value="' . $kartType->getId() . '">' . $kartType->getType() . '</option>';

                    }

                    ?>
                </select><br>


                tipo reserva:


                <select name="tipo_reserva">
                    <?php


                    foreach ($listaReservasTypeForm as $reservaType) {

                        echo '<option value="' . $reservaType->getId() . '">' . $reservaType->getDescription() . '</option>';

                    }

                    ?>
                </select><br>


                <input type="hidden" name="id" value="<?php echo $reservas!=null ? $reservas->getId() : ''; ?>">
                <input type="submit" value="Enviar">
            </form>

            <?php
        }

        /**
         *  tipo reserva:
        <input name="tipo_reserva" type="number" value="<?php echo $reservas!=null ? $reservas->getNumber() : ''; ?>"><br>

         */


    }else{

        $reservasDAO = new ReservesDAO();
        $listaReservas =$reservasDAO->getAll();


        echo "<a href='" . $_SERVER['PHP_SELF'] . "?option=reservas&action=create' class='btn btn-success'>Crear Reserva</a>";
        if($listaReservas){
            echo "<table class=\"table\"  border='1'>
                <tr>
                    <td>id</td>
                    <td>user</td>
                    <td>date</td>
                    <td>number</td>
                    <td>type</td>
                    <td>kartType</td>
                    
                </tr>";

            foreach($listaReservas as $reservas){
                echo "<tr><td>".$reservas->getId()."</td><td>".$reservas->getUser()."</td><td>".$reservas->getDate()."</td><td>".$reservas->getNumber()."</td><td>".$reservas->getType()."</td><td>".$reservas->getKartType()."</td></tr>
              <td>
                <a href='" . $_SERVER['PHP_SELF'] . "?option=reservas&action=update&id=" . $reservas->getId() . "' class='btn btn-warning btn-xs'>Actualizar</a>&nbsp;|
                <a href='" . $_SERVER['PHP_SELF'] . "?option=reservas&action=delete&id=" . $reservas->getId() . "' class='btn btn-danger btn-xs'>Borrar</a>&nbsp;
              </td></tr>";
            }
            echo "</table>";
        }else{
            echo "<h1>No hay Reservas</h1>";
        }
    }

    ?>
</section>