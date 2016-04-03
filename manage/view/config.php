<?php

error_reporting(E_ALL);

/**
 * setup infrastructure
 */
define('DEBUG', false);

/**
 * Server configuration
 */
if (DEBUG) {
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'operator');
    define('DB_USERNAME', 'steph');
    define('DB_PASSWORD', 'steph');
    define('ROOT_URL', 'http://192.168.2.1'); // web root folder
    define('BASE_URL', ROOT_URL . '/index.php'); // web root page
} else {
    define('DB_HOST', 'bt.nelli-studio.com');
    define('DB_NAME', 'operatorv3');
    define('DB_USERNAME', '_operator');
    define('DB_PASSWORD', 'op3rator');
    define('ROOT_URL', 'http://bt.nelli-studio.com/operator/operatorv4');
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

/**
 * Mailing configuration
 */
define('SENDER_MAIL', 'rindraloic@gmail.com');
define('SENDER_MAIL_PASSWORD', 'hypotrempe');
?>
