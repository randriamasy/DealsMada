<?php

session_cache_limiter(false);
session_start();

require_once './libs/Slim/Slim.php';
require_once './model/config.php';
require_once './model/city.class.php';

/**
 * Adding Middle Layer to authenticate every request
 * Checking if the request has valid $_SESSION
 */
function authenticate(\Slim\Route $route) {
    $app = \Slim\Slim::getInstance();
    if (!isset($_SESSION ['login']) || null == $_SESSION ['login']) {
        require_once './view/login.php';
        $app->stop();
    }
}

/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    $request_params = $_REQUEST;
    // Handling PUT request params
    if ($_SERVER ['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset($request_params [$field]) || strlen(trim($request_params [$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $app = \Slim\Slim::getInstance();
        $message = 'Required field(s) ' . substr($error_fields, 0, - 2) . ' is missing or empty';
        $app->response()->setStatus(404);
        echo '{"error":{"text":"' . $message . '"}}';
        $app->stop();
    }
}

/**
 * Verifying required images posted or not
 */
function verifyRequiredImages($required_images) {
    $error = false;
    $error_fields = "";
    foreach ($required_images as $field) {
        if (!isset($_FILES [$field]) || null == $_FILES [$field] ['tmp_name']) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }
    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $app = \Slim\Slim::getInstance();
        $message = 'Required image(s) ' . substr($error_fields, 0, - 2) . ' is missing or empty';
        $app->response()->setStatus(404);
        echo '{"error":{"text":"' . $message . '"}}';
        $app->stop();
    }
}

// =======================================================================================
// INIT APP
// =======================================================================================
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim ();
$app->config(array(
    'debug' => true
));

// =======================================================================================
// LOGIN
// =======================================================================================
$app->post('/login', function () use($app) {

    $login = $app->request()->params()['login'];
    $password = $app->request()->params()['password'];
    // Default BO credentials admin:admin
    if ($login == 'admin' && $password == 'admin') {
        $_SESSION ['login'] = $login;
    }

    $app->redirect(BASE_URL);
});

$app->get('/logout', function () use($app) {

    $_SESSION = array();
    session_destroy();

    $app->redirect(BASE_URL);
});

// =======================================================================================
// HOME
// =======================================================================================
$app->get('/', 'authenticate', function () use($app) {

    $app->render('index.php', array(
    ));
});

// =======================================================================================
// CITY
// =======================================================================================
$app->get('/cities', function () use($app) {
    $cities = City::selectAll();
    $app->render('container.php', array(
        'content' => 'content_city_list.php',
        'cities' => $cities,
        'rootPath' => '../'
    ));
});

$app->get('/city', function () use($app) {
    $app->render('container.php', array(
        'content' => 'content_city_item.php',
        'rootPath' => '../'
    ));
});

$app->post('/city/add', function () use($app) {
    verifyRequiredParams(array(
        'name'
    ));
    $name = $_REQUEST["name"];
    City::insert($name);
    $app->redirect(BASE_URL . '/cities');
});

$app->get('/city/delete/:id', function ($id) use($app) {
    City::deleteById($id);
    $app->redirect(BASE_URL . '/cities');
});

// =======================================================================================
// RUN APP
// =======================================================================================

$app->run();
?>
