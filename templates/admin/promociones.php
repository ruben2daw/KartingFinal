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

        $promosDAO = new PromosDAO;
        $promos_upd=$promosDAO->getById($_POST['id']);
        $promos_upd->setText($_POST['content']);
        $promos_upd->setFrom($_POST['from']);
        $promos_upd->setTo($_POST['to']);

        $promos_upd->update($promos_upd);

    }else{

        $promociones_ins= new Promo();
        $promociones_ins->setText($_POST['content']);
        $promociones_ins->setFrom($_POST['from']);
        $promociones_ins->setTo($_POST['to']);
        $promosDAO = new PromosDAO;
        $promosDAO->insert($promociones_ins);


    }

   // header("Location: ".$_SERVER['PHP_SELF']."?option=promociones");
}

?>
<section class="col-md-10">
    <?php
    if(isset($_GET['action'])){
        $action=$_GET['action'];
        $promosDAO=null;
        $promo=null;

        if($action=="update"){

            $id=$_GET['id'];
            $promosDAO=new PromosDAO();
            $promosDAO=$promosDAO->getById($id);

        }elseif($action=="delete"){

            $id=$_GET['id'];
            $promosDAO=new PromosDAO();
            $promosDAO=$promosDAO->delete($Id);

            header("Location: ".$_SERVER['PHP_SELF']."?option=promociones");
        }

        if($action=="create" || $action=="update"){
            ?>



            <script src="../resources/js/tinymce/tinymce.min.js"></script>
            <script src="../resources/js/loadtiny.js"></script>
            <form action="#" method="POST">
               from:<input name="from" type="datetime-local" value="<?php echo $promo!=null ? $promo->getFrom() : ''; ?>"><br>
                to:<input name="to" type="datetime-local" value="<?php echo $promo!=null ? $promo->getTo() : ''; ?>"><br>
                contenido:<textarea name="content"><?php echo $promo!=null ? $promo->getText() : ''; ?></textarea>
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
                </tr>";

            foreach($listaPromo as $promo){
                echo "<tr><td>".$promo->getId()."</td><td>".$promo->getFrom()."</td><td>".$promo->getTo()."</td>
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