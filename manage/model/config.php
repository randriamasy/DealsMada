<?php

error_reporting(E_ALL);

/**
 * setup infrastructure
 */
define('DEBUG', true);

/**
 * Server configuration
 */
if (DEBUG) {
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'dealsmada');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('ROOT_URL', 'http://localhost/manage'); // root folder
    define('BASE_URL', ROOT_URL . '/index.php'); // web root page
} else {
    define('DB_HOST', 'localhost');
    define('DB_NAME', '949318');
    define('DB_USERNAME', '949318');
    define('DB_PASSWORD', 'bc2635');
    define('ROOT_URL', 'http://dealsmada.freetzi.com/manage');
    define('BASE_URL', ROOT_URL . '/index.php');
}

/**
 * File upload configuration
 */
define('UPLOAD_DIR', 'uploads');

/**
 * Assets
 */
define('EDIT_ICON_URL', ROOT_URL . '/assets/edit_icon.png');
define('DELETE_ICON_URL', ROOT_URL . '/assets/delete_icon.png');
define('LINK_ICON_URL', ROOT_URL . '/assets/link_icon.png');

?>
