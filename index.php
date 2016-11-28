<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karting</title>
 
    <link href="resources/css/main.css" rel="stylesheet" media="screen"> 
    <!-- CSS de Bootstrap -->
    <link href="resources/css/bootstrap.min.css" rel="stylesheet" media="screen">
 
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container" >
      
      <?php
          include_once 'lib/autoload.php';
          error_reporting(E_ALL);
          //include de cabecera
          include_once("templates/header.php");
          
          //include de barra menu
          include_once("templates/nav_menu.php");
     ?>
     <div class="row" >
     <?php  
          
          if(isset($_GET['page'])){

            $id_page=$_GET['page'];
            $pageDAO=new PageDAO();
            $page=$pageDAO->getByPage($id_page);
            $content=$page->getContent();
            include_once("templates/page.php");
            
          }elseif (isset($_GET["section"])) {
            
            $section = $_GET["section"];
            
            if($section=="karts"){
              $kartsTypeDAO = new KartsTypeDAO();
              $kartsList = $kartsTypeDAO->getAll();
              
              include_once('templates/karts.php');
              
            }else if ($section=="records") {
              include_once("templates/records.php");
            }else if($section=="promociones"){
              include_once("templates/promociones.php");
            }else if ($section=="login") {
              include_once("templates/login.php");
            }else if ($section=="register") {
              include_once("templates/register.php");
            }else {
              echo "PAGINA NO INCLUIDA";
            }
          
          }else {

              $objeto = new NewsDAO;
              $listaNews= $objeto->getAll();
              include_once("templates/home.php");
            }
          
          include_once("templates/aside.php");
          include_once("templates/footer.php");
            
      ?>
      </div>
    </div>
 
    <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
 
    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
    <script src="resources/js/bootstrap.min.js"></script>
    
  </body>
</html>