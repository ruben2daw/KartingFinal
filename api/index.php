<?php
/**
 *
 * http://localhost/phpStormProyects/2ev/store/api/index.php/products
 *
 * http://localhost/store/api/products
 * C:/wamp64/www/phpStormProyects/2ev/store/api/index.php
 * http://localhost/store/api/user/dwes
 */

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';
require '../lib/autoload.php';

/**
 * @param $request
 * @return mixed
 *
 * http://localhost/ProyectoFinal/ProyectoKarting/api/index.php/token
 * http://localhost/ProyectoFinal/ProyectoKarting/api/index.php/sessions/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE0ODQyNDg1MDcsImF1ZCI6IjQ0YzhlNzkyODkwZjdhYzI4MWE3MmMyMWI3ZGI0MjcyYjhkYjFhN2IiLCJkYXRhIjp7ImlkIjoiNCIsIm5hbWUiOiJiaW1ibyJ9fQ.fx0HH58brBtj-P_9ZYKbeVko7PUACRvnqhYspNcqUrg
 * https://jwt.io/
 */

function getTokenFromHeader($request)
{

    $header = $request->getHeader("Authorization")[0];
    return explode(" ", $header)[1];
}

//MY FUNCION, PARA OBTENER EL TOKEN
function getTokenFromHeaderWithoutText($request)
{

    $header = $request->getHeader("Authorization")[0];
    return $header;
}

function getTokenFromJson($request, $tokenField)
{

    $json = $request->getParsedBody();
    return $json[$tokenField];
}

function getTokenFromUrl($request, $parameter)
{
    return $request->getAttribute($parameter);
}


function checkToken($token, $response)
{

    if (empty($token))
        return 403;

    try {
        JwtAuth::check($token);
    } catch (Throwable $t) {
        return 401;
    } catch (Exception $e) {
        return 401;
    }

    return null;

}

/**
 * API
 */

$app = new \Slim\App;

/* Método para obtener token a partir de login-password */
$app->post('/token', function (Request $request, Response $response) {

    $data = $request->getParsedBody();
    $user = Auth::get()->apiAuth($data['login'], $data['password']);

    if ($user) {

        try {

            $token = JwtAuth::SignIn([
                'id' => $user->getId(),
                'name' => $user->getLogin()
            ]);

            return $response->withJson(json_encode(['access_token' => $token]));

        } catch (Throwable $t) {
            return $response->withStatus(500, $t->getMessage());
        }
    }

    return $response->withStatus(403, "Bad credentials");
});


$app->get('/sessions/{token}', function (Request $request, Response $response) {


    $token = getTokenFromUrl($request, "token");
    $code = checkToken($token, $response);
    if ($code != null) return $response->withStatus($code);

    $data = JwtAuth::GetData($token);
    $sessionDAO = new SessionsDAO();
    //$list = $sessionDAO->getAll($data->id);
    $list = $sessionDAO->getAll();

    if ($list) {
        $JsonResponse = $response->withJson(json_encode($list));
        return $JsonResponse;
    } else
        return $response->withStatus(404, "No se encontraron tandas para el usuario");

});


//
///* Método para obtener listado de productos en formato JSON */
//$app->get('/products', function (Request $request, Response $response) {
//
//    $prodDAO=new ItemsDAO();
//    $prodList=$prodDAO->getAllJson();
//
//    $JsonResponse = $response->withJson($prodList);
//
//    return $JsonResponse;
//
//
//});
//
//
///* Método para obtener listado de productos en formato JSON */
//$app->get('/hello/{name}', function (Request $request, Response $response) {
//
//    $name = $request->getAttribute("name");
//    $response->getBody()->write("hello".$name);
//
//    return $response;
//
//
//});
//
///* Método para obtener listado de productos en formato JSON */
//$app->post('/hello/{name}', function (Request $request, Response $response) {
//
//        $data = $request->getParsedBody();
//        $
//
//    $name = $request->getAttribute("name");
//    $response->getBody()->write("hello".$name);
//
//    return $response;
//
//
//});
//
///* Método para obtener información de un usuario a partir de su login */
//$app->get('/user/{login}', function(Request $request, Response $response)
//{
//
//    $login = $request->getAttribute("login");
//    $userDAO = new UserDAO();
//    $user=$userDAO->getByLogin($login);
//    $json = json_encode($user);
//
//    $JsonResponse = $response->withJson($json);
//    return $JsonResponse;
//});
//
//
//
///* Método para crear un usuario */
//$app->post('/user', function(Request $request, Response $response)
//{
//
//    $json = $request->getParsedBody();
//
//    try{
//        JwtAuth::check($json['access_token']);
//    }catch(Throwable $t){
//        return $response->withStatus(401);
//    }
//
//    $login = $json['login'];
//    $email = $json['email'];
//    $password = password_hash($json['password'],true);
//    $firstname = $json['firstname'];
//    $lastname = $json['lastname'];
//
//    $user=new User();
//    $user->setLogin($login);
//    $user->setEmail($email);
//    $user->setPassword($password);
//    $user->setFirstName($firstname);
//    $user->setLastName($lastname);
//
//    $userDAO = new UserDAO();
//
//    if ($userDAO->insert($user) == 1) {
//        return $response->withStatus(201, 'Usuario registrado correctamente');
//    } else {
//        return $response->withStatus(500, 'El usuario no pudo ser registrado');
//    }
//
//    /*
//     *
//      {
//        "login":"pepe",
//        "password":"pepe",
//        "firstname":"Pepe",
//        "lastname":"Pilon",
//        "email":"pepe@pepe.es"
//      }
//     */
//
//});
//
//
//
///* Método para actualizar un usuario */
//$app->put('/user', function(Request $request, Response $response)
//{
//
//    $json = $request->getParsedBody();
//
//    try{
//        JwtAuth::check($json['access_token']);
//    }catch(Throwable $t){
//        return $response->withStatus(401);
//    }
//
//    $login = $json['login'];
//    $email = $json['email'];
//    $password = password_hash($json['password'],true);
//    $firstname = $json['firstname'];
//    $lastname = $json['lastname'];
//
//    $userDAO = new UserDAO();
//    $user= $userDAO->getByLogin($login);
//
//    if($user == null){
//        return $response->withStatus(404, 'Usuario no encontrado');
//    }
//
//    $user->setEmail($email);
//    $user->setPassword($password);
//    $user->setFirstName($firstname);
//    $user->setLastName($lastname);
//
//
//
//    if ($userDAO->update($user) == 1) {
//        return $response->withStatus(202, 'Usuario actualizado correctamente');
//    } else {
//        return $response->withStatus(500, 'El usuario no pudo ser actualizado');
//    }
//
//    /*
//     *
//      {
//        "login":"pepe",
//        "password":"pepe",
//        "firstname":"Pepin",
//        "lastname":"Pilon",
//        "email":"pepe@pepe.es"
//      }
//     */
//
//});
//
//
//
///* Método para eliminar un usuario */
//$app->delete('/user/{login}', function(Request $request, Response $response)
//{
//    $json = $request->getParsedBody();
//
//    try{
//        JwtAuth::check($json['access_token']);
//    }catch(Throwable $t){
//        return $response->withStatus(401);
//    }
//
//    $login = $request->getAttribute("login");
//    $userDAO = new UserDAO();
//    $user=$userDAO->getByLogin($login);
//
//    if($user == null){
//        return $response->withStatus(404, 'Usuario no encontrado');
//    }
//
//    if ($userDAO->delete($user->getId()) == 1) {
//        return $response->withStatus(204);
//    } else {
//        return $response->withStatus(500, 'El usuario no pudo ser eliminado');
//    }
//
//});


$app->run();
