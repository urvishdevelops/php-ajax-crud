<?php

include "dbconfig.php";

class Crud extends Dbconfig
{

    public function __construct()
    {

        parent::__construct();

    }

    public function getData($query)
    {
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

        if ($result) {
            return $result;
        } else {
            echo "Failed to execute";
        }

    }

    public function delete($table, $deleteId)
    {
        $query = "DELETE FROM $table WHERE id=$deleteId";

        $result = $this->conn->query($query);


        if ($result == False) {
            echo "Cannot delete the $deleteId in the given $table";
            return False;
        } else {
            return True;
        }
    }


}




?>