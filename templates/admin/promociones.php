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

        $promo= $promosDAO->getById($_POST['id']);
        $promo->setText($_POST['content']); //Fatal error: Uncaught Error: Call to a member function setText() on boolean in
        $promo->setImg($_POST['imagen']);
        $promo->setFrom($_POST['from']);
        $promo->setTo($_POST['to']);

        $result=$promosDAO->update($promo);

        if($result==false){
            $error="Ha ocurrido un error al insertar la promoción. ";
        }else{
            $msg="Promoción registrada correctamente";
        }

    }else{

        $promo = new Promo();
        $promo->setText($_POST['content']);
        $promo->setImg($_POST['imagen']);
        $promo->setFrom($_POST['from']);
        $promo->setTo($_POST['to']);

        $promosDAO=new PromosDAO();
        $result=$promosDAO->insert($promo);

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
        $promo=null;
        if($action=="update"){

            $id=$_GET['id'];
            $promosDAO=new PromosDAO();
            $promo=$promosDAO->getById($id);

        }elseif($action=="delete"){

            $id=$_GET['id'];
            $promosDAO=new PromosDAO();
            $promosDAO->delete($id);


            header("Location: ".$_SERVER['PHP_SELF']."?option=promociones");
        }

        if($action=="create" || $action=="update"){
            ?>


           <form action="#" method="POST">
               from:<input name="from" type="datetime-local" value="<?php echo $promo!=null ? $promo->getFrom() : ''; ?>"><br>
                to:<input name="to" type="datetime-local" value="<?php echo $promo!=null ? $promo->getTo() : ''; ?>"><br>
                contenido:<textarea name="content"><?php echo $promo!=null ? $promo->getText() : ''; ?></textarea><br>
                ruta imagen:<input name="imagen" type="file" value="<?php echo $promo!=null ? $promo->getImg() : ''; ?>"><br>
                <input type="hidden" name="id" value="<?php echo $promo!=null ? $promo->getId() : ''; ?>">
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

            foreach($listaPromo as $promo){
                echo "<tr><td>".$promo->getId()."</td><td>".$promo->getFrom()."</td><td>".$promo->getTo()."</td><td>".$promo->getImg()."</td></tr>
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