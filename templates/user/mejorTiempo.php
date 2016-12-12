<?php
/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 25/11/2016
 * Time: 9:56
 */



$id_user = $_SESSION['user']->getId();


$objeto = new SessionsLapsDAO();
echo "Mejores tiempos";
echo $objeto->getBestTimesPerUser($id_user, 1);
echo $objeto->getBestTimesPerUser($id_user, 2);
echo $objeto->getBestTimesPerUser($id_user, 3);
echo $objeto->getBestTimesPerUser($id_user, 4);
echo $objeto->getBestTimesPerUser($id_user, 5);


?>

