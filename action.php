<?php

include "crud.php";

$crud = new Crud();

switch ($_POST['type']) {

    case 'insert':
        $name = $_POST['name'];
        $fakeemail = $_POST['fakeemail'];
        $book = $_POST['book'];
        $query = "INSERT INTO authors(name, book, email)VALUES('$name', '$book', '$fakeemail');";
        $result = $crud->executeQuery($query);
        break;


    case 'list':
        $crud = new Crud();
        $query = "SELECT * from authors;";
        $result = $crud->getData($query);

        if (!empty($result)) {
            $html = '';
            foreach ($result as $key => $value) {
                $id = $value['id'];
                $html .= "<tr>";
                $html .= "<td>" . $value['id'] . "</td>";
                $html .= "<td>" . $value['name'] . "</td>";
                $html .= "<td>" . $value['book'] . "</td>";
                $html .= "<td>" . $value['email'] . "</td>";
                $html .= "<td><a class='btn btn-warning edit'>Edit</a>|<a class='btn btn-warning delete'>Delete</a>";
                $html .= "<tr>";
            }
        }
        echo $html;
    default:

        # code...
        break;
}

?>