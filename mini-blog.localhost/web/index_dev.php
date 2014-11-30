<?php
//echo "hello";
//phpinfo();
//ini_set("display_errors", On);
error_reporting(E_ALL);

require '../bootstrap.php';
require '../MiniBlogApplication.php';

$app = new MiniBlogApplication(true) ;
$app->run();

error_log(1111);