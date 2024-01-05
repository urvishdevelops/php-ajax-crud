<?php

class Dbconfig{

    private $hostname = "localhost";
    private $db = "authorslist" ;
    private $username = "root";
    private $password = "";

    protected $conn;

    public function __construct(){
       $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->db);
       return $this->conn;
    }

}



?>