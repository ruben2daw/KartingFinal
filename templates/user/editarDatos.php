<?php

define("ROLE_USUARIO",     2);


function estaValidadoElFormulario()
{

    $arrayValoresFormulario = array("login", "firstname", "lastname", "email", "pass");
    $validacionCorrecta = true;

    foreach ($arrayValoresFormulario as $nombreItem) {
        if (empty($_POST["$nombreItem"]))
            $validacionCorrecta = false;
    }


    return $validacionCorrecta == 1;
}


function inicializarFuncionalidad()
{

    if (estaValidadoElFormulario()) {

        $userText = $_POST['login'];
        $passText = $_POST['pass'];
        $firstnameText = $_POST['firstname'];
        $lastnameText = $_POST['lastname'];
        $emailText = $_POST['email'];


        $userDao = new UserDAO();


        $user = new User();
        $user->setId($_SESSION['user']->getId());
        $user->setLogin($userText);
        $user->setPassword(password_hash($passText,PASSWORD_DEFAULT));
        $user->setFirstName($firstnameText);
        $user->setLastName($lastnameText);
        $user->setEmail($emailText);
        $user->setRole(ROLE_USUARIO);

        if ($userDao->update($user)) {

            $_SESSION['user'] = $user;

            echo "Nuevos Datos de Usuario</br>" . $user;
            //    echo '<a href="../../view/ruben_interfaz/areaClientes/editarDatosPersonalesView.php">Volver a Edicion</a>';

            // print_r($user-> __toString());

            //header("Location: ../../view/ruben_interfaz/areaClientes/editarDatosPersonalesView");
        } else {
            //header("Location: ../../view/ruben_interfaz/areaClientes/editarDatosPersonalesView.php?errorEditarDatos=" . true);

            echo "error";
        }


    } else {
        echo "No se ha enviado el formulario de datos a editar, revisa los campos vacios";


    }
}

if ($_POST)
    inicializarFuncionalidad();


?>


<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h1>EDITAR DATOS PERSONALES</h1>

<form action="#" method="post">
    Usuario <input type="text" name="login" value="<?php echo $_SESSION['user']->getLogin() ?>"></br>
    Contraseña <input type="text" name="pass" value=""></br>
    Nombre <input type="text" name="firstname" value="<?php echo $_SESSION['user']->getFirstname() ?>"></br>
    Apellidos <input type="text" name="lastname" value="<?php echo $_SESSION['user']->getLastname() ?>"></br>
    Email <input type="email" name="email" value="<?php echo $_SESSION['user']->getEmail() ?>"></br></br>
    <input type="submit" name="btnRegistro"></br></br>
    <a href="index.php?section=login">Atras</a>


</form>


</body>
</html>
