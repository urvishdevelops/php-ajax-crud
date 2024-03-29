<?php
include 'crud.php';

$crud = new crud();

?>



<html>

<head>
    <title>Add Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

<link href="toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</html>

<body>

    <div class="container justify-content-center mt-5" style="margin-top: 05%">

        <!-- Add -->

        <form id="autorsForm" onsubmit="return false;">
            <input type="hidden" name="type" value="insert">
            <input type="hidden" name="hiddenId" id="hiddenId">
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
            <div class="mb-3">
                <input id="uploadImage" type="file" name="image" />
            </div>
            <button type="submit" id="autorsFormButton" class="btn btn-primary" value="Submit">Submit</button>
        </form>



        <!-- View  -->
        <div class="form-outline w-50 mt-5">
            <input type="email" placeholder="Searc|" class="form-control input-sm border border-primary" id="txtsearch">
        </div>
        <table class="table table-striped  table-bordered mt-5">
            <thead>

                <tr>
                    <td>Id <a class="inc"><i class='fa fa-arrow-up'></a> <a class="dec"><i
                                class='fa fa-arrow-down dec'></a></td>
                    <td>Name <a class="inc"><i class='fa fa-arrow-up'></a> <a class="dec"><i
                                class='fa fa-arrow-down dec'></a>
                    </td>
                    <td>Book<a class="inc"><i class='fa fa-arrow-up'></a> <a class="dec"><i
                                class='fa fa-arrow-down dec'></a>
                    </td>
                    <td>Fake Email <a class="inc"><i class='fa fa-arrow-up'></a> <a class="dec"><i
                                class='fa fa-arrow-down dec'></a></td>
                    <td>Authors Profile</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody id="tbody">


            </tbody>
        </table>
        <div id='pagination'></div>
    </div>
</body>
<script src="index.js">
</script>
<script src="toastr.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
    integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>