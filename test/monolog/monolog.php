<?php

require_once '../../vendor/autoload.php';
require_once "PDOHandler.php";

use Monolog\Logger;

$dsn = "mysql:host=localhost;dbname=test";
$pdo = new PDO($dsn, 'root', 'root');

$logger = new Logger('learn_test');
$logger->pushHandler(new PDOHandler($pdo));
$logger->addInfo('我只是个简单的测试，你让我怎么办呢',array('name'=>'lugui','data'=>'data'));