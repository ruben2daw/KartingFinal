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
        include_once("../templates/user/user_aside.php");

        if (isset($_GET["option"])) {

            $option = $_GET["option"];

            if($option=="datosPersonales"){

                include_once("../templates/user/editarDatos.php");

            }elseif($option=="reservasCliente"){
                include_once("../templates/user/reservas.php");
            }elseif ($option=="datosCarreras") {
                include_once("../templates/user/datosCarreras.php");
            }elseif ($option=="mejorTiempo") {
                include_once("../templates/user/mejorTiempo.php");
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