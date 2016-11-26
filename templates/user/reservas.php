<?php

$reservasDAO=new ReservesDAO();

if($_POST){



    if(!empty($_POST['id'])){

        $reservas_upd=$reservasDAO->getById($_POST['id']);
        $reserva = new Reserve();
        $reserva->setDate($_POST['fecha']);
        $reserva->setNumber($_POST['NumeroPersonas']);
        $reserva->setType($_POST['reservaTipo']);
        $reserva->setKartType($_POST['coche']);
        $reservasDAO->update($reserva,$reservas_upd);
        header("Loaction: ".$_SERVER['PHP_SELF']."?option=reservasCliente");

    }else{


        $reserva = new Reserve();
        $reserva->setUser($_SESSION['user']->getId());
        $reserva->setDate($_POST['fecha']);
        $reserva->setNumber($_POST['NumeroPersonas']);
        $reserva->setType($_POST['reservaTipo']);
        $reserva->setKartType($_POST['coche']);
        $reservasDAO->insert($reserva);


    }

    header("Location: ".$_SERVER['PHP_SELF']."?option=reservasCliente");
}

?>
<section class="col-md-10">
    <?php
    if(isset($_GET['action'])){
        $action=$_GET['action'];

        $reserva=null;

        if($action=="update"){

            $id=$_GET['id'];
            $reservasDAO=new ReservesDAO();
            $reserva=$reservasDAO->getById($id);

        }elseif($action=="delete"){

            $id=$_GET['id'];
            $reservasDAO=new ReservesDAO();
            $reservasDAO->delete($id);

            header("Location: ".$_SERVER['PHP_SELF']."?option=reservasCliente");
        }

        if($action=="create" || $action=="update"){
            ?>
    <!--
            <script src="../resources/js/tinymce/tinymce.min.js"></script>
            <script src="../resources/js/loadtiny.js"></script>
            <form action="#" method="POST">
                Titulo:<input name="title" type="text" value="<?php echo $news!=null ? $news->getTitle() : ''; ?>"><br>
                Contenido:<textarea name="content"><?php echo $news!=null ? $news->getContent() : ''; ?></textarea>
                <input type="hidden" name="id" value="<?php echo $news!=null ? $news->getId() : ''; ?>">
                <input type="submit" value="Enviar">
            </form>

            -->
<h1>RESERVAS</h1>


<form action="#" method="post">
    <h2>REGISTRO</h2></br>

    <br/>
    <p>Tipo Evento:</p>
    <select name="reservaTipo">
        <option value="1">Individual Infantil</option>
        <option value="2">Individual Senior</option>
        <option value="3">Grupo infantil</option>
        <option value="4">Grupo senior</option>
    </select>
    <br/>
    Numero Personas <input type="text" name="NumeroPersonas" max="10"></br>
    Fecha y hora <input type="datetime-local" name="fecha"></br>
    Email <input type="email" name="email"></br></br>

    <select name="coche">
        <option value="1">honda</option>
        <option value="2">speed car</option>
        <option value="3">especial 270</option>
        <option value="4">honda 200</option>
        <option value="5">BIPLAZA</option>

    </select>

    <input type="submit" name="btnReserva"></br></br>

</form>


            <?php
        }


    }else{


        $listaReservas = $reservasDAO ->getAll();


        echo "<a href='".$_SERVER['PHP_SELF']."?option=reservasCliente&action=create'>Crear Reserva</a>";
        if($listaReservas){
            echo "<table border='1'>
                <tr>
                    <td>id</td>
                    <td>user</td>
                    <td>date</td>
                    <td>number</td>
                    <td>type</td>
                   <td>kart_type</td>

                </tr>";


            foreach($listaReservas as $reserva){
                echo  "<tr><td>".$reserva->getId()."</td><td>"."<tr><td>".$reserva->getUser()."</td><td>".$reserva->getDate()."<tr><td>".$reserva->getNumber()."</tr></td>"."<tr><td>".$reserva->getType."</td></td>"."<tr><td>".$reserva->getKartType."</td></td>";
             echo "<td>
                <a href='".$_SERVER['PHP_SELF']."?option=reservasCliente&action=update&id=".$reserva->getId()."'>Actualizar</a>&nbsp;|
                <a href='".$_SERVER['PHP_SELF']."?option=reservasCliente&action=delete&id=".$reserva->getId()."'>Borrar</a>&nbsp;
              </td></tr>";
            }
            echo "</table>";
        }else{
            echo "<h1>No hay reservas</h1>";
        }
    }

    ?>
</section>