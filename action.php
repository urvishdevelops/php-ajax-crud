<?php

include "crud.php";

$crud = new Crud();

switch ($_POST['type']) {



    case 'insert':
        $id = $_POST['hiddenId'];
        $name = $_POST['name'];
        $fakeemail = $_POST['fakeemail'];
        $book = $_POST['book'];

        if (!empty($id)) {
            // echo "We got it bro!";
            $query = "UPDATE authors SET id='$id', name='$name', book='$book', email= '$fakeemail' where id='$id';";
        } else {
            $query = "INSERT INTO authors(name, book, email)VALUES('$name', '$book', '$fakeemail');";
        }
        $result = $crud->executeQuery($query);
        break;


    case 'list':
        $crud = new Crud();
        $query = "SELECT * from authors;";
        $result = $crud->getData($query);
        $html = '';
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $id = $value['id'];
                $html .= "<tr>";
                $html .= "<td class='id'>" . $value['id'] . "</td>";
                $html .= "<td>" . $value['name'] . "</td>";
                $html .= "<td>" . $value['book'] . "</td>";
                $html .= "<td>" . $value['email'] . "</td>";
                $html .= "<td><a class='btn btn-warning edit' id='$id'>Edit</a>|<a class='btn btn-warning delete' id='$id'>Delete</a>";
                $html .= "<tr>";
            }
        }
        echo $html;
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