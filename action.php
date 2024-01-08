<?php

include "crud.php";

$crud = new Crud();


switch ($_POST['type']) {
    case 'inc':
        $crud = new Crud();
        $query = "SELECT * from authors ORDER BY Price DESC;";
        $result = $crud->executeQuery($query);
        break;

    case 'insert':
        $id = $_POST['hiddenId'];
        $name = $_POST['name'];
        $fakeemail = $_POST['fakeemail'];
        $book = $_POST['book'];

        if (!empty($id)) {
            $query = "UPDATE authors SET id='$id', name='$name', book='$book', email= '$fakeemail' where id='$id';";
        } else {
            $query = "INSERT INTO authors(name, book, email)VALUES('$name', '$book', '$fakeemail');";
        }
        $result = $crud->executeQuery($query);
        break;


    case 'list':
        $crud = new Crud();
        $sort = $_POST['sort'];

        // pagination
        $limit = 5;
        $page = isset($_POST['page']) ? $_POST['page'] : 1;

        $htmlarr = [];
        $html = '';
        $pagination = "";

        $start_from = ($page - 1) * $limit;

        $count_users = $crud->getData("SELECT COUNT(id) FROM authors");
        $total_rows = $crud->getData("SELECT COUNT(id) as total FROM authors");

        foreach ($total_rows as $key => $value) {
            $row_count = $value['total'];
        }

        $total_pages = ceil($row_count / $limit);

        if ($sort) {
            $query = "SELECT * FROM authors ORDER BY id $sort, name $sort, book $sort, email $sort LIMIT $start_from, $limit";
        } else {
            $query = "SELECT * FROM authors LIMIT $start_from, $limit";
        }

        $result = $crud->getData($query);

        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $id = $value['id'];
                $html .= "<tr>";
                $html .= "<td class='id'>" . $value['id'] . "</td>";
                $html .= "<td>" . $value['name'] . "</td>";
                $html .= "<td>" . $value['book'] . "</td>";
                $html .= "<td>" . $value['email'] . "</td>";
                $html .= "<td><a class='btn btn-warning edit' id='$id'>Edit</a>|<a class='btn btn-warning delete' id='$id'>Delete</a>";
                $html .= "</tr>";
            }
        }
        $htmlArr['tbody'] = $html;

        $pagination .= '<ul class="pagination">';

        if ($page > 1) {
            $previous = $page - 1;
            $pagination .= '<li class="page-item" id="1"><span class="page-link">First Page</span></li>';
            $pagination .= '<li class="page-item" id="' . $previous . '"><span class="page-link">' . $previous . '</span></li>';
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_class = ($i == $page) ? "active" : "";
            $pagination .= '<li class="page-item ' . $active_class . '" id="' . $i . '"><span class="page-link">' . $i . '</span></li>';
        }

        if ($page < $total_pages) {
            $next = $page + 1;
            $pagination .= '<li class="page-item" id="' . $next . '"><span class="page-link">' . $next . '</span></li>';
        }

        $pagination .= '<li class="page-item" id="' . $total_pages . '"><span class="page-link">Last Page</span></li>';
        $pagination .= '</ul>';
        $htmlArr['pagination'] = $pagination;
        echo json_encode($htmlArr);



        break;



    case 'edit':
        $editId = $_POST['editId'];
        $crud = new Crud();
        $query = "SELECT * from authors WHERE id='$editId';";
        $result = $crud->getData($query);
        echo json_encode($result);
        break;

    case 'delete':
        $deleteId = $_POST['deleteId'];
        $crud = new Crud();
        $query = $crud->delete('authors', $deleteId);

        break;

    case 'searchVal':
        $searchVal = $_POST['searchVal'];
        $crud = new crud();

        $query = "SELECT * FROM authors where name like '%$searchVal%' or id like '%$searchVal%' or email like '%$searchVal%' or book like '%$searchVal%';";

        $result = $crud->executeQuery(($query));

        $record = "";

        foreach ($result as $row) {
            $record .= "<tr> 
            <td>$row[id]</td>
            <td>$row[name]</td>
            <td>$row[book]</td>
            <td>$row[email]</td>
            <td><a class='btn btn-warning edit' id='$row[id]'>Edit</a>|<a class='btn btn-warning delete' id='$row[id]'>Delete</a>
            </tr>";
        }
        echo $record;
        break;
    default:

        # code...
        break;
}

?>