<?php
/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 25/11/2016
 * Time: 10:18
 */


/**
 * POST
 */

function estaValidadoElFormulario()
{

    $arrayValoresFormulario = array("evento", "NumeroPersonas", "fecha", "email");
    $validacionCorrecta = true;

    foreach ($arrayValoresFormulario as $nombreItem) {
        if (empty($_POST["$nombreItem"]))
            $validacionCorrecta = false;
    }


    return $validacionCorrecta == 1;
}


function inicializarFuncionalidad($id)
{

    if (estaValidadoElFormulario()) {

        $eventoNumero = $_POST['evento'];
        $numeroPersonasText = $_POST['NumeroPersonas'];
        $fechaText = $_POST['fecha'];
        $emailText = $_POST['email'];//ESTE CAMPO SE USARA, CUANDO SE MANDE LA CONFIRMACION POR MAIL


        $reservasDao = new ReservesDAO();


        $reserva = new Reserve();
        $reserva->setType($eventoNumero);
        $reserva->setUser($_SESSION['user']->getId());//TENGO QUE OBTENER EL IDENTIFICADOR DE SESSION.
        $reserva->setDate($fechaText);
        $reserva->setNumber($numeroPersonasText);


        $reservasBD = $reservasDao->getDateFech($fechaText);

        if (empty($reservasBD)) {

            if ($reservasDao->insert($reserva)) {


                echo "RESERVA CONFIRMADA";
            } else {
                echo "RESERVA FALLIDA";
            }

        } else {
            echo "HAY OTRA RESERVA EN LA MISMA FECHA";
        }


    } else {
        echo "No se ha enviado el formulario, revisa los campos vacios";


    }
}

/**
 * POST
 */


if (isset($_SESSION['user'])) {
    if ($_POST) {
        inicializarFuncionalidad($_SESSION['user']->getId());
    }


} else {
    header("Location: ../view/index.php?section=login");
}


?>


<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<h1>RESERVAS</h1>


<form action="#" method="post">
    <h2>REGISTRO</h2></br>

    <br/>
    <p>Tipo Evento:</p>
    <select name="evento">
        <option value="1">Carrera Individual</option>
        <option value="2">En Grupò</option>
    </select>
    <br/>
    Numero Personas <input type="text" name="NumeroPersonas" max="10"></br>
    Fecha y hora <input type="datetime" name="fecha"></br>
    Email <input type="email" name="email"></br></br>
    <input type="submit" name="btnReserva"></br></br>

</form>

<?php
$reservasDao = new ReservesDAO();
echo "hola";
echo $reservasDao->showList($_SESSION['user']->getId());

?>


</body>
</html>





