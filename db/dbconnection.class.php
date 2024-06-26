<?php
class Dbconnection extends PDO
{
    private $host = "localhost";
    private $dbname = "u935988077_rekenen";
    private $user = "u935988077_rekenuser";
    private $pass = "qY96+KS!:1=";
    public function __construct()
    {
        parent::__construct("mysql:host=".$this->host.";dbname=".$this->dbname."; charset=utf8", $this->user, $this->pass);
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}
