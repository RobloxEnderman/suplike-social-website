<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

if (!defined('DB_DATABASE')) define('DB_DATABASE', 'suplike');
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_PORT')) define('DB_PORT', 3306);
if (!defined('SETUP')) define('SETUP', false);
if (!defined('BASE_URL')) define('BASE_URL', $protocol . $_SERVER['HTTP_HOST']);
if (!defined('EMAIL_VERIFICATION')) define('EMAIL_VERIFICATION', false);
if (!defined('APP_EMAIL')) define('APP_EMAIL', 'bethro@localhost');