<html>

<head>
    <title>Add Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

</html>

<body>

    <div class="container justify-content-center mt-5" style="margin-top: 05%">


        <!-- Add -->

        <form id="autorsForm" onsubmit="return false;">
            <input type="hidden" name="type" value="insert">
            <div class="mb-3">
                <label for="Name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="book" class="form-label">Book</label>
                <input type="text" name="book" class="form-control" id="book">
            </div>
            <div class="mb-3">
                <label for="fakeemial" class="form-label">Fake Email address</label>
                <input type="email" name="fakeemail" class="form-control" id="fakeemial">
            </div>
            <button type="submit" id="autorsFormButton" class="btn btn-primary">Submit</button>
        </form>



        <!-- View  -->
        <table class="table table-striped  table-bordered mt-5">
            <thead>

                <tr>
                    <td>Id</td>
                    <td>Name</td>
                    <td>Book</td>
                    <td>Fake Email</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody id="tbody">
             <?php

                // include "crud.php";

                // $crud = new Crud();
                // $query = "SELECT * from authors;";
                // $result = $crud->getData($query);

                // foreach ($result as $key => $value) {

                //     $id = $value['id'];
                //     $name = $value['name'];
                //     $book = $value['book'];
                //     $email = $value['email'];

                  
                    // echo "<tr>";
                    // echo "<td>$id</td>";
                    // echo "<td>$name</td>";
                    // echo "<td>$book</td>";
                    // echo "<td>$email</td>";
                    // echo "<td><a href=\"view.php?id=$id\"class=\"btn btn-warning\">Edit</a>|<a href=\"view.php?id=$id\"class=\"btn btn-warning\">Delete</a>";
                    // echo "</tr>";
                // }

                ?> 

            </tbody>
        </table>
    </div>
</body>
<script src="index.js"></script>

</html>