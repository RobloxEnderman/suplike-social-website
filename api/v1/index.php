<?php
header('content-type: application/json');
require '../../inc/dbh.inc.php';
require '../../inc/Auth/Auth.php';
require '../../inc/errors/error.inc.php';
$error->_set_log("../../inc/errors/error.log.txt");
require 'login.api.php';
require 'following.api.php';