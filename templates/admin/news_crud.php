<?php
if($_POST){
   
    if(!empty($_POST['id'])){ 
        
        $newsDAO=new NewsDAO();
        $news_upd=$newsDAO->getById($_POST['id']);
        $news_upd->setTitle($_POST['title']);
        $news_upd->setContent($_POST['content']);
        $newsDAO->update($news_upd);header("Loaction: ".$_SERVER['PHP_SELF']."?option=news");
        
    }else{
        
        $news_ins=new News();
        $news_ins->setTitle($_POST['title']);
        $news_ins->setContent($_POST['content']);
        $newsDAO=new NewsDAO();
        $newsDAO->insert($news_ins);
        
    }
    
    header("Location: ".$_SERVER['PHP_SELF']."?option=news");
}

?>
<section class="col-md-10">
<?php
if(isset($_GET['action'])){
    $action=$_GET['action'];

    $news=null;

    if($action=="update"){
        
        $id=$_GET['id'];
        $newsDAO=new NewsDAO();
        $news=$newsDAO->getById($id);
        
    }elseif($action=="delete"){
        
        $id=$_GET['id'];
        $newsDAO=new NewsDAO();
        $newsDAO->delete($id);
        
        header("Location: ".$_SERVER['PHP_SELF']."?option=news");
    }
    
    if($action=="create" || $action=="update"){
?>     
        <script src="../resources/js/tinymce/tinymce.min.js"></script>
        <script src="../resources/js/loadtiny.js"></script>
        <form action="#" method="POST"> 
            Titulo:<input name="title" type="text" value="<?php echo $news!=null ? $news->getTitle() : ''; ?>"><br>
            Contenido:<textarea name="content"><?php echo $news!=null ? $news->getContent() : ''; ?></textarea>
            <input type="hidden" name="id" value="<?php echo $news!=null ? $news->getId() : ''; ?>">
            <input type="submit" value="Enviar">
        </form>            
    
<?php        
    }

    
}else{
    $newsDAO=new NewsDAO();
    $listNews=$newsDAO->getAll();
    
    
    echo "<a href='".$_SERVER['PHP_SELF']."?option=news&action=create'>Crear noticia</a>";
    if($listNews){
        echo "<table border='1'>
                <tr>
                    <td>Título</td>
                    <td>Contenido</td>
                    <td>Fecha de creación</td>
                    <td>Operaciones</td>
                </tr>";
                
        foreach($listNews as $news){
              echo "<tr><td>".$news->getTitle()."</td><td>".$news->getContent()."</td><td>".$news->getCreated()."</td>
              <td>
                <a href='".$_SERVER['PHP_SELF']."?option=news&action=update&id=".$news->getId()."'>Actualizar</a>&nbsp;|
                <a href='".$_SERVER['PHP_SELF']."?option=news&action=delete&id=".$news->getId()."'>Borrar</a>&nbsp;
              </td></tr>";
        }
        echo "</table>";
    }else{
        echo "<h1>No hay noticias</h1>";
    }
}

?>
</section>