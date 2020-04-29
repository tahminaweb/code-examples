<?php
session_start();

include_once "../app.php";

$app = new App();
$app->request();
$app->run();


