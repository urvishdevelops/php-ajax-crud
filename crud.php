<?php

include "dbconfig.php";

class Crud extends Dbconfig
{

    public function __construct()
    {

        parent::__construct();

    }

    public function getData($query){
        $result = $this->conn->query($query);


        $rows = [];

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function executeQuery($query)
    {
        $result = $this->conn->query($query);

        if ($result == True) {
            echo "Query executed";
        } else {
            echo "Failed to execute";
        }

    }
    public function deleteQuery($table, $id)
    {

        $query = 'DELETE FROM $table WHERE id = $id';
        $result = $this->conn->query($query);

        if ($result == True) {
            echo "Query executed";
        } else {
            echo "Failed to execute";
        }

    }

}




?>