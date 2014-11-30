<?php
echo "hello";

require '../bootstrap.php';
require '../MiniBlogApplication.php';

$app = new MiniBlogApplication(false) ;
$app->run();