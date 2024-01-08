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

class Pagination {

    private $totalItems;
    private $itemsPerPage;
    private $totalPages;
    private $currentPage;
    private $offset;
    private $pageLimit = 10;

    public function __construct($totalItems, $itemsPerPage)
    {
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
        $this->totalPages = ceil($totalItems / $itemsPerPage);
        $this->currentPage = isset($_GET['page']) ? max(1, min($this->totalPages, intval($_GET['page']))) : 1;
        $this->offset = ($this->currentPage - 1) * $this->itemsPerPage;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }

    public function displayPaginationLinks()
    {
        echo "<div class='pagination'>";

        $startPage = max(1, min($this->totalPages - $this->pageLimit + 1, $this->currentPage - floor($this->pageLimit / 2)));
        $endPage = min($this->totalPages, $startPage + $this->pageLimit - 1);

        for ($page = $startPage; $page <= $endPage; $page++) {
            echo "<a href='?page=$page'>$page</a> ";
        }

        echo "</div>";
    }
}



?>