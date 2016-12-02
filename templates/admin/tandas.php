<?php
/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 26/11/2016
 * Time: 21:32
 */

echo "● Las tandas pueden crearse de forma independiente, por ejemplo para una carrera
individual o a partir de una reserva</br>
● Una vez creada la tanda, se tendrán que asignar los pilotos que van a participar y los
karts<br>
● Una vez creada la tanda se podrá iniciar, indicando que los pilotos pueden empezar
a correr<br>
● Cuando la tanda finaliza, se deben poder consultar los resultados<br>";


if($_POST){

    $sesionDAO= new SessionsDAO();


    if(!empty($_POST['id'])){

        $sesion= $sesionDAO->getById($_POST['id']);
        $sesion->setName($_POST['nombre']);
        $sesion->setDate($_POST['fecha']);
        $sesion->setType($_POST['tipo']);
        $result = $sesionDAO->update($sesion);

        if($result==false){
            $error="Ha ocurrido un error al actualizar la tanda ";
        }else{
            $msg="tanda insertada correctamente";
        }


    }  else{

        $sesion = new Session();
        $sesion->setName($_POST['nombre']);
        $sesion->setDate($_POST['fecha']);
        $sesion->setType($_POST['tipo']);
        $result = $sesionDAO->insert($sesion);


        if($result==false){
            $error="Ha ocurrido un error al insertar la tanda. ";
        }else{
            $msg="tanda registrada correctamente";
        }


    }

     header("Location: ".$_SERVER['PHP_SELF']."?option=tandas");
}

?>
<section class="col-md-10">
    <?php
    if(isset($_GET['action'])){
        $action=$_GET['action'];

        $sesion=null;

        if($action=="update"){
            $sesionDAO = new SessionsDAO();

            $id=$_GET['id'];
            $sesion=$sesionDAO->getById($id);
            $sesionDAO->update($sesion);

        }else if($action=="delete"){
            $sesionDAO = new SessionsDAO();

            $id=$_GET['id'];
            $sesionDAO->delete($id);
            header("Location: ".$_SERVER['PHP_SELF']."?option=tandas");
        }



        //$sesionTypeDAO= new SessionTypeDAO();
       // $listaSesionesTypeForm= $sesionTypeDAO->getAll();

        if($action=="create" || $action=="update"){
            ?>



            <form action="#" method="POST">
                Nombre:<input name="nombre" type="text" value="<?php echo $sesion!=null ? $sesion->getName() : ''; ?>"><br>
                Fecha:<input name="fecha" type="datetime-local" value="<?php echo $sesion!=null ? $sesion->getDate() : ''; ?>"><br>




                Tipo:<input name="tipo" type="text" value="<?php echo $sesion!=null ? $sesion->getType() : ''; ?>"><br>


                <input type="hidden" name="id" value="<?php echo $sesion!=null ? $sesion->getId() : ''; ?>">
                <input type="submit" value="Enviar">
            </form>

            <?php
        }


    }else{

        $sesionDAO = new SessionsDAO();
        $listaSessionForm=$sesionDAO->getAll();



        echo "<a href='".$_SERVER['PHP_SELF']."?option=tandas&action=create'>Crear Tanda</a>";
        if($listaSessionForm){
            echo "<table border='1'>
                <tr>
                    <td>Nombre</td>
                    <td>Fecha</td>
                    <td>Tipo</td>
                    
                </tr>";

            foreach($listaSessionForm as $sesion){

                echo "<tr><td>".$sesion->getName()."</td><td>".$sesion->getDate()."</td><td>".$sesion->getType()."</td></tr>
              <td>
                <a href='".$_SERVER['PHP_SELF']."?option=tandas&action=update&id=".$sesion->getId()."'>Actualizar</a>&nbsp;|
                <a href='".$_SERVER['PHP_SELF']."?option=tandas&action=delete&id=".$sesion->getId()."'>Borrar</a>&nbsp;
                <a href='".$_SERVER['PHP_SELF']."?option=tandas&action=asignar&id=".$sesion->getId()."'>Asignar</a>&nbsp;
                <a href='".$_SERVER['PHP_SELF']."?option=tandas&action=go&id=".$sesion->getId()."'>Go</a>&nbsp;
              </td></tr>";
            }
            echo "</table>";
        }else{
            echo "<h1>No hay Tandas</h1>";
        }
    }

    ?>
</section>