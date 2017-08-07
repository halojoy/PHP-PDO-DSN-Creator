<?php

if (!isset($_POST['step'])) {
    include('install_files/html/step1.htm');
    exit();
}

if ($_POST['step'] == '1') {
    $driver = $_POST['driver'];
    include('install_files/html/step2head.htm');
    include('install_files/html/'.$driver.'.htm');
    include('install_files/html/step2foot.htm');
    exit();
}

if ($_POST['step'] != '2') {
    exit();
}

$driver = $_POST['driver'];
$name = $_POST['dbname'];
if ($driver == 'sqlite') {
    $host = $port = $user = $pass = null;
} else {
    $host = $_POST['dbhost'];
    $port = $_POST['dbport'];
    $user = $_POST['dbuser'];
    $pass = $_POST['dbpass'];
}

$file = 'config/pdo_config.php';

include('install_files/class/DSNCreator.php');
$pdo_dsn = new DSNCreator($driver, $host, $port, $name, $user, $pass);
$pdo_dsn->makeDSN();
$pdo_dsn->fileWrite($file);
$pdo_dsn->pdoTest();

include('install_files/html/finish.htm');
exit();
