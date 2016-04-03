<?php

session_cache_limiter(false);
session_start();

require_once './libs/Slim/Slim.php';
require_once './libs/Swift/swift_required.php';
require_once './model/report.class.php';
require_once './model/reportpack.class.php';

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

/**
 * Adding Middle Layer to authenticate every API request
 * Checking Basic Authentication {email, password} POST fields
 */
function authenticateAPI(\Slim\Route $route) {
    $app = \Slim\Slim::getInstance();

    // Get request credentials
    $email = $app->request()->headers('PHP_AUTH_USER');
    $password = $app->request()->headers('PHP_AUTH_PW');

    $user = User::authenticate($email, $password);
    if ($user == null) {

        $app->response()->setStatus(403);
        echo '{"error":{"text":"Authentication error"}}';
        $app->stop();
    }
}

// =======================================================================================
// INIT APP
// =======================================================================================
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim ();
$app->config(array(
    'debug' => true,
    'templates.path' => './view'
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
$app->get('/', function () use($app) {

    $app->redirect(BASE_URL . '/report');
});

// =======================================================================================
// REPORT
// =======================================================================================
$app->get('/report', function () use($app) {
    $errors = ReportPack::selectAllErrors();
    $events = ReportPack::selectAllEvents();
    $app->render('container.php', array(
        'content' => 'content_report_list.php',
        'errors' => $errors,
        'events' => $events,
        'rootPath' => '../'
    ));
});

$app->get('/report/view/', function () use($app) {
    $event = $_REQUEST['event'];
    $reports = Report::selectAllByEvent($event);
    $app->render('container.php', array(
        'content' => 'content_report_item.php',
        'reports' => $reports,
        'rootPath' => '../../../'
    ));
});

$app->post('/report/delete/', function () use($app) {
    $event = $_REQUEST['event'];
    Report::deleteAllByEvent($event);
    $app->redirect(BASE_URL . '/report');
});

// =======================================================================================
$app->post('/api/report', function () use($app) {

    verifyRequiredParams(array(
        'event',
        'description',
        'device',
        'os',
        'build'
    ));

    $event = $_REQUEST['event'];
    $description = $_REQUEST['description'];
    $device = $_REQUEST['device'];
    $os = $_REQUEST['os'];
    $build = $_REQUEST['build'];
    
    $success = Report::insert($event, $description, $device, $os, $build);
    if ($success) {
        $app->response->setStatus(200);
        echo '{"result":"success"}';
    } else {
        $app->response->setStatus(404);
        echo '{"error":{"text":"Failed to create send report"}}';
    }
});

// =======================================================================================
// RUN APP
// =======================================================================================

$app->run();
?>
