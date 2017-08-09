<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDO Installation step 1</title>
    <link rel="stylesheet" type="text/css" href="install_files/css/install.css">
</head>
<body>

    <h2>PDO Installation step 1</h2>
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <fieldset>
        <legend>Select Database</legend>
        <br>
        <select name="driver">
            <option value="mysql" selected>MySQL</option>
            <option value="pgsql">PostgreSQL</option>
            <option value="sqlite">SQLite</option>
            <option value="sqlsrv">MS SQL Server(Express)</option>
            <option value="firebird">Firebird</option>
            <option value="oci">Oracle</option>
        </select>
        <input type="hidden" name="step" value="1">
        <br><br>
        <input type="submit" value="SUBMIT">
        </fieldset>
    </form>

</body>
</html>
