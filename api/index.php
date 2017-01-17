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


/* Método para obtener información de un usuario a partir de su login */
$app->get('/user/{login}', function (Request $request, Response $response) {

    $token = getTokenFromHeader($request);
    $code = checkToken($token, $response);
    if ($code != null) return $response->withStatus($code);

    $login = $request->getAttribute("login");
    $data = JwtAuth::GetData($token);

    if ($data->name != $login)
        return $response->withStatus(401, "No se puede obtener información de otro usuario");

    $userDAO = new UserDAO();
    $user = $userDAO->getByLogin($login);

    if ($user) {

        $json = json_encode($user);
        $JsonResponse = $response->withJson($json);

        return $JsonResponse;
    } else
        return $response->withStatus(500, "No se ha podido obtener el usuario");

});


$app->get('/reservas/{login}', function (Request $request, Response $response) {

    $token = getTokenFromHeader($request);
    $code = checkToken($token, $response);
    if ($code != null) return $response->withStatus($code);

    $login = $request->getAttribute("login");
    $data = JwtAuth::GetData($token);

    if ($data->name != $login)
        return $response->withStatus(401, "No se pueden obtener reservas de otro usuario");

    $reservesDAO = new ReservesDAO();
    $listReserves = $reservesDAO->getAllFromUser($data->id);
    $jsonList = json_encode($listReserves);

    return $response->withJson($jsonList);


});


$app->post('/reserva', function (Request $request, Response $response) {

    $token = getTokenFromJson($request, "access_token");
    $code = checkToken($token, $response);
    if ($code != null) return $response->withStatus($code);

    $data = JwtAuth::GetData($token);
    $json = $request->getParsedBody();

    $reserve_ins = new Reserve();
    $reserve_ins->setUser($data->id);
    $reserve_ins->setDate($json['date']);
    $reserve_ins->setNumber($json['number']);
    $reserve_ins->setType($json['type']);
    $reserve_ins->setKartType($json['kart_type']);

    $reservesDAO = new ReservesDAO();
    if ($reservesDAO->insert($reserve_ins) == 1) {
        return $response->withStatus(201, 'Reserva creada correctamente');
    } else {
        return $response->withStatus(500, 'La reserva no pudo ser creada');
    }

});


$app->put('/reserva/{id}', function (Request $request, Response $response) {

    $token = getTokenFromJson($request, "access_token");
    $code = checkToken($token, $response);
    if ($code != null) return $response->withStatus($code);

    $data = JwtAuth::GetData($token);
    $json = $request->getParsedBody();

    $id = $request->getAttribute("id");

    $reservesDAO = new ReservesDAO();
    $reserve_upd = $reservesDAO->getById($id);

    if ($reserve_upd->getUser() != $data->id)
        return $response->withStatus(401, "No estás autorizado para editar esta reserva");

    $reserve_upd->setUser($data->id);
    $reserve_upd->setDate($json['date']);
    $reserve_upd->setNumber($json['number']);
    $reserve_upd->setType($json['type']);
    $reserve_upd->setKartType($json['kart_type']);

    if ($reservesDAO->update($reserve_upd) == 1) {
        return $response->withStatus(202, 'Reserva actualizada correctamente');
    } else {
        return $response->withStatus(500, 'La reserva no pudo ser actualizada');
    }

});


$app->delete('/reserva/{id}', function (Request $request, Response $response) {

    $token = getTokenFromJson($request, "access_token");
    $code = checkToken($token, $response);
    if ($code != null) return $response->withStatus($code);

    $data = JwtAuth::GetData($token);
    $json = $request->getParsedBody();

    $id = $request->getAttribute("id");

    $reservesDAO = new ReservesDAO();
    $reserva = $reservesDAO->getById($id);

    if ($reserva->getUser() != $data->id)
        return $response->withStatus(401, "No estás autorizado para eliminar esta reserva");


    if ($reservesDAO->delete($id) == 1) {
        return $response->withStatus(204);
    } else {
        return $response->withStatus(500, "La reserva no pudo ser eliminada");
    }

});




$app->run();
