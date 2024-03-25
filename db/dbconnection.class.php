<?php

class dbconnection extends PDO
{
    private $host = "localhost";
    private $dbname = "rekenen";
    private $user = "rekenuser";
    private $pass = "jy7k(66kpvm8xilW";
    public function __construct()
    {
        parent::__construct("mysql:host=".$this->host.";dbname=".$this->dbname."; charset=utf8", $this->user, $this->pass);
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}
