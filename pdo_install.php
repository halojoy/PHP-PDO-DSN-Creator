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

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Installed</title>
</head>
<body>
    <h2 style="text-align: center">Installed</h2>
    <div style="width: 400px; margin: 0px auto;">
    <p><u>PDO Database connection</u> was sucessfully installed.<br>
    The file <b>'<?php echo $file; ?>'</b> has been written.<br>
    You should now remove the directory <b>'install_files'</b><br>
    and this file.</p>
    And use this for your scripts:<br>
<b>
<?php
highlight_string(
'<?php

include(\'config/pdo_config.php\');
$db = new PDO($dsn, $db_user, $db_pass);');
?>
</b>
    </div>
</body>
</html>
