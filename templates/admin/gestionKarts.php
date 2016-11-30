<?php
/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 26/11/2016
 * Time: 21:35
 */

echo "● CRUD de la tabla karts<br>
● Desde esta sección se podrán gestionar los karts disponibles";

if($_POST){

    if(!empty($_POST['id'])){
        $kartsTypeDAO= new KartsTypeDAO();
        $kartsType= $kartsTypeDAO->getById($_POST['id']);
        $kartsType->setType($_POST['type']);
        $kartsType->setDesc($_POST['desc']);
        $kartsType->setImgPath($_POST['img_path']);

        $result=$kartsTypeDAO->update($kartsType);

        if($result==false){
            $error="Ha ocurrido un error al gestionar el kart. ";
        }else{
            $msg="Kart gestionado correctamente";
        }


    }  else{


        $kartsType = new KartType();
        $kartsType->setType($_POST['type']);
        $kartsType->setDesc($_POST['desc']);
        $kartsType->setImgPath($_POST['img_path']);

        $kartsTypeDAO=new KartsTypeDAO();
        $result=$kartsTypeDAO->insert($kartsType);

        if($result==false){
            $error="Ha ocurrido un error al insertar el kart. ";
        }else{
            $msg="Kart registrado correctamente";
        }


    }

    // header("Location: ".$_SERVER['PHP_SELF']."?option=gestionKarts");
}

?>
<section class="col-md-10">
    <?php
    if(isset($_GET['action'])){
        $action=$_GET['action'];

        $kartsType=null;

        if($action=="update"){

            $id=$_GET['id'];
            $kartsTypeDAO=new KartsTypeDAO();
            $kartsType=$kartsTypeDAO->getById($id);
            $kartsTypeDAO->update($kartsType);

        }else if($action=="delete"){

            $id=$_GET['id'];
            $kartsTypeDAO=new KartsTypeDAO();
            $kartsTypeDAO->delete($id);

            header("Location: ".$_SERVER['PHP_SELF']."?option=gestionKarts");
        }

        if($action=="create" || $action=="update"){
            ?>



            <form action="#" method="POST">
                Tipo:<input name="type" type="text" value="<?php echo $kartsType!=null ? $kartsType->getType() : ''; ?>"><br>
                Descripción:<input name="desc" type="text" value="<?php echo $kartsType!=null ? $kartsType->getDesc() : ''; ?>"><br>
                Dirección imagen:<input name="img_path" type="text" value="<?php echo $kartsType!=null ? $kartsType->getImgPath() : ''; ?>"><br>

                <input type="hidden" name="id" value="<?php echo $kartsType!=null ? $kartsType->getId() : ''; ?>">
                <input type="submit" value="Enviar">
            </form>

            <?php
        }


    }else{
        $kartsTypeDAO=new KartsTypeDAO();
        $listKart=$kartsTypeDAO->getAll();


        echo "<a href='".$_SERVER['PHP_SELF']."?option=gestionKarts&action=create'>Crear Kart</a>";
        if($listKart){
            echo "<table border='1'>
                <tr>
                    <td>Tipo</td>
                    <td>Descripción</td>
                    <td>Imagen</td>
                    
                </tr>";

            foreach($listKart as $kartsType){
                echo "<tr><td>".$kartsType->getType()."</td><td>".$kartsType->getDesc()."</td><td>".$kartsType->getImgPath()."</td></tr>
              <td>
                <a href='".$_SERVER['PHP_SELF']."?option=gestionKarts&action=update&id=".$kartsType->getId()."'>Actualizar</a>&nbsp;|
                <a href='".$_SERVER['PHP_SELF']."?option=gestionKarts&action=delete&id=".$kartsType->getId()."'>Borrar</a>&nbsp;
              </td></tr>";
            }
            echo "</table>";
        }else{
            echo "<h1>No hay karts</h1>";
        }
    }

    ?>
</section>