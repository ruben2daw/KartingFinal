<?php
/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 25/11/2016
 * Time: 9:56
 */



?>
<section class="col-md-10">
    <?php
    if(isset($_GET['action'])){
        $action=$_GET['action'];

        $sesion=null;

        if($action=="tiempos") {
           // $sesionDAO = new SessionsDAO();

            $id = $_GET['id'];
           // $sesion = $sesionDAO->getById($id);
            //$sesionDAO->update($sesion);

            echo "aqui iran los tiempos";

        }

        $sesionTypeDAO= new SessionTypeDAO();
        $listaSesionesTypeForm= $sesionTypeDAO->getAll();


        if($action=="create" || $action=="update"){
            ?>



            <form action="#" method="POST">
                Nombre:<input name="nombre" type="text" value="<?php echo $sesion!=null ? $sesion->getName() : ''; ?>"><br>
                Fecha:<input name="fecha" type="datetime-local" value="<?php echo $sesion!=null ? $sesion->getDate() : ''; ?>"><br>
                Tipo:
                <select name="tipo">
                    <?php

                    foreach ($listaSesionesTypeForm  as $sesionType) {
                        echo '<option value="' . $sesionType->getId() . '">' .$sesionType->getType(). '</option>';

                    }

                    ?>
                </select><br>

                <input type="hidden" name="id" value="<?php echo $sesion!=null ? $sesion->getId() : ''; ?>">
                <input type="submit" value="Enviar">
            </form>

            <?php
        }


    }else{

        $sesionDAO = new SessionsDAO();
        $ID_user = $_SESSION['user']->getId();
        $queryFields=$sesionDAO->getTandasPerUser($ID_user);





        if($queryFields){
            echo "<table class=\"table\" border='1'>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                     <th>Opciones</th>
                    
                </tr>";

            for ($a = 0; $a < count($queryFields); $a++) {

                echo "<tr><td>".$queryFields[$a][1]."</td><td>".$queryFields[$a][2]."</td><td>".$queryFields[$a][3]."</td>
              <td>            
                <a href='".$_SERVER['PHP_SELF']."?option=datosCarreras&action=tiempos&id=".$queryFields[$a][0]."' class='btn btn-success btn-xl'>Go</a>&nbsp;
              </td></tr>";
            }
            echo "</table>";
        }else{
            echo "<h1>No hay Tandas</h1>";
        }
    }

    ?>
</section>
