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
        $response['status'] = 0;
        $id = $_POST['hiddenId'];
        $name = $_POST['name'];
        $fakeemail = $_POST['fakeemail'];
        $book = $_POST['book'];
        $image = $_FILES["image"]["name"];
        $filename = $image;
        $tempImg = $_FILES["image"]["tmp_name"];
        $folder = "./tempFile/" . $filename;


        if (move_uploaded_file($tempImg, $folder)) {
            if (!empty($id)) {
                if (!empty($image)) {
                    $query = "UPDATE authors SET id='$id', name='$name', book='$book', email='$fakeemail', image='$image' where id='$id'";
                    $result = $crud->executeQuery($query);
                    if ($result) {
                        $response['status'] = 1;
                        $response['message'] = "Data update successfully!";

                    } else {
                        $response['message'] = "Data not update!";

                    }
                } else {
                    $response['message'] = "Please upload an image";
                }
            } else {
                if (!empty($image)) {
                    $query = "INSERT INTO authors(name, book, email, image)VALUES('$name', '$book', '$fakeemail', '$image');";
                    $result = $crud->executeQuery($query);
                    if ($result) {
                        $response['status'] = 1;
                        $response['message'] = "Data insert successfully!";

                    } else {
                        $response['message'] = "Data not insert!";

                    }
                } else {
                    $response['message'] = "Please upload an image";
                }
            }

        } else {
            $response['message'] = "Something gone wrong!";
        }

        echo json_encode($response);
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
                $image = $value['image'];
                $path = "./tempFile/$image";
                $html .= "<tr>";
                $html .= "<td class='id'>" . $value['id'] . "</td>";
                $html .= "<td>" . $value['name'] . "</td>";
                $html .= "<td>" . $value['book'] . "</td>";
                $html .= "<td>" . $value['email'] . "</td>";
                $html .= "<td>" . " <img src=$path height='100' width='100' id='authorImg'>" . "</td>";
                $html .= "<td><a class='btn btn-warning edit' id='$id'>Edit</a>|<a class='btn btn-warning delete' id='$id'>Delete</a>";
                $html .= "</tr>";
            }
        }
        $htmlArr['tbody'] = $html;

        $pagination .= '<ul class="pagination">';

        if ($page > 1) {
            $previous = $page - 1;
            $pagination .= '<li class="page-item" id="1"><span class="page-link">First Page</span></li>';
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_class = ($i == $page) ? "active" : "";

            $pagination .= '<li class="page-item ' . $active_class . '" id="' . $i . '"><span class="page-link">' . $i . '</span></li>';
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

        $query = "SELECT * FROM authors where name like '%$searchVal%' or id like '%$searchVal%' or email like '%$searchVal%' or book like '%$searchVal%' or image like '%$searchVal%';";

        $result = $crud->executeQuery(($query));

        $record = "";

        foreach ($result as $row) {
            $record .= "<tr> 
            <td>$row[id]</td>
            <td>$row[name]</td>
            <td>$row[book]</td>
            <td>$row[email]</td>
            <td><img src='$row[image]' height='100' width='100' id='authorImg'></td>;
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