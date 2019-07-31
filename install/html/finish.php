<html>
<head>
    <meta charset="UTF-8">
    <title>Installed</title>
</head>
<body>
    <h2 style="text-align: center">Installed</h2>
    <div style="width: 340px; margin: 0px auto;">
    <p><u>PDO Database connection</u> was sucessfully installed.<br>
    The file <b>'<?php echo $file; ?>'</b> has been written.<br>
    You should now remove the directory <b>'install'</b><br>
    and this file: <b>'index.php'</b>.</p>
    And use this for your scripts:<br>
<b>
<?php
highlight_string(
'<?php

include(\'data/config.php\');
$db = new PDO($dsn, $db_user, $db_pass);');
?> 
</b>
    </div>
</body>
</html>
