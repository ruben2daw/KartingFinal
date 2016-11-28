<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karting</title>
 
    <link href="../resources/css/main.css" rel="stylesheet" media="screen"> 
    <!-- CSS de Bootstrap -->
    <link href="../resources/css/bootstrap.min.css" rel="stylesheet" media="screen">
 
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container" >
      
      <?php
          include_once '../lib/autoload.php';
          
          //include de cabecera
          include_once("../templates/header.php");
          
       
     ?>
     <div class="row" >
     <?php  
          include_once("../templates/admin/admin_aside.php");
          
          if (isset($_GET["option"])) {
            
            $option = $_GET["option"];
            
            if($option=="news"){
              
              include_once("../templates/admin/news_crud.php");
              
            }else if ($option=="reservas") {
              include_once("../templates/admin/reservas.php");
            }else if ($option=="tandas") {
              include_once("../templates/admin/tandas.php");
            }else if ($option=="gestionKarts") {
              include_once("../templates/admin/gestionKarts.php");
            }else if ($option=="gestionUsuarios") {
              include_once("../templates/admin/gestionUsuarios.php");
            }else if($option=="sesiones"){
              include_once("../templates/admin/sesiones.php");
            }elseif ($option=="promociones") {
              include_once("../templates/admin/promociones.php");
            }elseif ($option=="page") {
              include_once("../templates/admin/page_editor.php");
            }
          
          }
      ?>
      </div>
      <?php
          include_once("../templates/footer.php");
            
      ?>

    </div>
 
    <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
 
    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
    <script src="../../resources/js/bootstrap.min.js"></script>
    
  </body>
</html>