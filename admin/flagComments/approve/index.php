<?php
require('../../../config.php');
require(APP_ROOT . 'app/controllers/backend.php');

$backend = new backend;
$backend->approveComment($_GET);
?>