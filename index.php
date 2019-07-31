<?php

if (!isset($_POST['step'])) {
    include('install/html/step1.php');
    exit();
}

if ($_POST['step'] == '1') {
    $driver = $_POST['driver'];
    include('install/html/step2head.php');
    include('install/html/'.$driver.'.php');
    include('install/html/step2foot.php');
    exit();
}

if ($_POST['step'] != '2') {
    exit();
}

$driver = $_POST['driver'];
$name   = $_POST['dbname'];
if ($driver == 'sqlite') {
    $host = $port = $user = $pass = null;
} else {
    $host = $_POST['dbhost'];
    $port = $_POST['dbport'];
    $user = $_POST['dbuser'];
    $pass = $_POST['dbpass'];
}

$file = 'data/config.php';

include('install/class/DSNCreator.php');
$pdo_dsn = new DSNCreator($driver, $host, $port, $name, $user, $pass);
$pdo_dsn->fileWrite($file);
$pdo_dsn->pdoTest();

include('install/html/finish.php');
exit();
