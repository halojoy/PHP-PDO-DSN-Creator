<?php

class DSNCreator
{

    public $dsn;
    public $driver;
    public $host;
    public $port;
    public $name;
    public $user;
    public $pass;
    public $file;
    
    public function __construct ($driver, $host, $port, $name, $user, $pass)
    {
        $this->driver = $driver;
        $this->host = $host;
        $this->port = $port;
        $this->name = $name;
        $this->user = $user;
        $this->pass = $pass;
    }

    public function makeDSN ()
    {
        if ($this->driver == 'sqlite') {
            $this->dsn = 'sqlite:'.$this->name;
        } elseif ($this->driver == 'sqlsrv') {
            $this->dsn = 'sqlsrv:Server='.$this->host.','.$this->port.';Database='.$this->name;
        } elseif ($this->driver == 'oci') {
            $this->dsn = 'oci:dbname=//'.$this->host.':'.$this->port.'/'.$this->name;
        } else {
            $this->dsn = $this->driver.':host='.$this->host.';port='.$this->port.';dbname='.$this->name;
        }
        return $this->dsn;
    }

    public function fileWrite ($file)
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

    public function pdoTest ()
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
