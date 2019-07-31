<?php

class DSNCreator
{
    public $user;
    public $pass;
    public $dsn;
    public $file;

    public function __construct($driver, $host, $port, $name, $user, $pass)
    {
        if ($driver == 'sqlite') {
            $this->dsn = 'sqlite:' . $name;
        } else {
            $this->dsn = $driver . ':host=' . $host .
                ';port=' . $port . ';dbname=' . $name;
        }
        $this->user = $user;
        $this->pass = $pass;
    }

    public function fileWrite($file)
    {
        $this->file = $file;
        $write = <<<WRITE
<?php

\$dsn = '$this->dsn';
\$db_user = '$this->user';
\$db_pass = '$this->pass';\n
WRITE;
        file_put_contents($this->file, $write);
    }

    public function pdoTest()
    {
        // Connect database
        require($this->file);
        try {
            $db = new PDO($dsn, $db_user, $db_pass);
        } catch (PDOException $e) {
            exit('PDOException: '.$e->getMessage());
        }
        $db = null; 
        return true;
    }

}
