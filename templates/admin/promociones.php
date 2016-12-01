<?php
/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 26/11/2016
 * Time: 21:29
 */

echo "● CRUD de promociones";



if($_POST){

    if(!empty($_POST['id'])){
        $promosDAO=new PromosDAO();

        $tableName= $promosDAO->getByIdForAdmin($_POST['id']);
        $tableName->setText($_POST['text']); //Fatal error: Uncaught Error: Call to a member function setText() on boolean in
        $tableName->setImg($_POST['img']);
        $tableName->setFrom($_POST['from']);
        $tableName->setTo($_POST['to']);

        $result=$promosDAO->updateForAdmin($tableName);

        if($result==false){
            $error="Ha ocurrido un error al insertar la promoción. ";
        }else{
            $msg="Promoción registrada correctamente";
        }

    }else{

        $tableName = new Promo();
        $tableName->setText($_POST['text']);
        $tableName->setImg($_POST['img']);
        $tableName->setFrom($_POST['from']);
        $tableName->setTo($_POST['to']);

        $promosDAO=new PromosDAO();
        $result=$promosDAO->insert($tableName);

        if($result==false){
            $error="Ha ocurrido un error al insertar la promoción. ";
        }else{
            $msg="La promoción se ha registrado correctamente";
        }


    }

    header("Location: ".$_SERVER['PHP_SELF']."?option=promociones");
}

?>
<section class="col-md-10">
    <?php
    if(isset($_GET['action'])){
        $action=$_GET['action'];

        if($action=="update"){

            $id=$_GET['id'];
            $promosDAO=new PromosDAO();
            $users=$promosDAO->getById($id);

        }elseif($action=="delete"){

            $id=$_GET['id'];
            $promosDAO=new PromosDAO();
            $promosDAO->delete($id);

            header("Location: ".$_SERVER['PHP_SELF']."?option=gestionUsuarios");

            header("Location: ".$_SERVER['PHP_SELF']."?option=promociones");
        }

        if($action=="create" || $action=="update"){
            ?>

            <form action="#" method="POST">
                from:<input name="from" type="datetime-local" value="<?php echo $tableName!=null ? $tableName->getFrom() : ''; ?>"><br>
                to:<input name="to" type="datetime-local" value="<?php echo $tableName!=null ? $tableName->getTo() : ''; ?>"><br>
                contenido:<textarea name="content"><?php echo $tableName!=null ? $tableName->getText() : ''; ?></textarea><br>
                ruta imagen:<input name="imagen" type="text" value="<?php echo $tableName!=null ? $tableName->getImg() : ''; ?>"><br>
                <input type="hidden" name="id" value="<?php echo $tableName!=null ? $tableName->getId() : ''; ?>">
                <input type="submit" value="Enviar">
            </form>


            <?php
        }


    }else{

        $promosDAO = new PromosDAO();
        $listaPromo= $promosDAO->getAll();



        echo "<a href='".$_SERVER['PHP_SELF']."?option=promociones&action=create'>Crear Promociones</a>";
        if($listaPromo){
            echo "<table border='1'>
                <tr>
                    <td>Texto</td>
                    <td>Desde</td>
                    <td>Hasta</td>
                    <td>Ruta</td>

                </tr>";

            foreach($listaPromo as $tableName){
                echo "<tr><td>".$tableName->getId()."</td><td>".$tableName->getFrom()."</td><td>".$tableName->getTo()."</td><td>".$tableName->getImg()."</td></tr>
              <td>
                <a href='".$_SERVER['PHP_SELF']."?option=promociones&action=update&id=".$promo->getId()."'>Actualizar</a>&nbsp;|
                <a href='".$_SERVER['PHP_SELF']."?option=promociones&action=delete&id=".$promo->getId()."'>Borrar</a>&nbsp;
              </td></tr>";
            }
            echo "</table>";
        }else{
            echo "<h1>No hay promociones</h1>";
        }
    }

    ?>
</section>