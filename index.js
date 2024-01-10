$(document).ready(function () {

    $('#autorsForm').validate({
        rules: {
            name: "required",
            fakeemail: {
                required: true,
                email: true
            },
            book: "required",
            image: "required"
        }, messages: {
            name: "Please enter your author's name!",
            fakeemail: {
                required: "Please enter your author's email address!",
                fakeemail: "Please enter valid email address!"
            },
            book: "Enter a book by author!",
            image: "Please upload an profile of an author!"
        },
        submitHandler:function(form){
            let formData = new FormData(document.getElementById("autorsForm"));
            $.ajax({
                type: "POST",
                url: "action.php",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    let res = JSON.parse(data)
                    if (res.status == 1) {
                        console.log("yup!");
                        list();
                        resetForm();
                        toastr.success(res.message, { timeOut: 1000 })
                    } else {
                        toastr.error(res.message, { timeOut: 2000 })
                    }
                },
            });
        }

    })

    $("#txtsearch").on("keyup", function () {
        let searchVal = $("#txtsearch").val();
        $.ajax({
            type: "POST",
            url: "action.php",
            data: {
                type: "searchVal",
                searchVal: searchVal,
            },
            success: function (data) {
                $("#tbody").html(data);
                console.log(data);
            },
        });
    });
});


$(function () {
    list();
    // $("#autorsForm").on("submit", (e) => {
    //     let formData = new FormData(document.getElementById("autorsForm"));
    //     $.ajax({
    //         type: "POST",
    //         url: "action.php",
    //         data: formData,
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: function (data) {
    //             let res = JSON.parse(data)
    //             if (res.status == 1) {
    //                 console.log("yup!");
    //                 list();
    //                 resetForm();
    //                 toastr.success(res.message, 'Turtle Bay Resort', { timeOut: 1000 })
    //             } else {
    //                 toastr.error(res.message, { timeOut: 2000 })
    //             }
    //         },
    //     });
    // });

    $(document).on("click", ".edit", function () {
        let editId = $(this).attr("id");

        $.ajax({
            type: "POST",
            url: "action.php",
            data: {
                type: "edit",
                editId: editId,
            },
            success: function (data) {
                let newData = JSON.parse(data)[0];

                let name = newData["name"];
                let id = newData["id"];
                let email = newData["email"];
                let book = newData["book"];

                $("#name").val(name);
                $("#hiddenId").val(id);
                $("#book").val(book);
                $("#fakeemial").val(email);
            },
        });
    });

    $(document).on("click", ".delete", function () {
        list();
        let deleteId = $(this).attr("id");

        $.ajax({
            type: "POST",
            url: "action.php",
            data: {
                type: "delete",
                deleteId: deleteId,
            },
            success: function (data) { },
        });
    });
});

$(".dec").on("click", (e) => {
    console.log(e);
    let dec = "DESC";
    list(dec);
});

$(".inc").on("click", (e) => {
    console.log(e);
    let asc = "ASC";
    list(asc);
});


$(document).on('click', '.page-item', function () {
    let page = $(this).attr("id")

    list("", page, "");
})

function list(sortType = "asc", page = 1) {
    $.ajax({
        type: "POST",
        url: "action.php",
        data: {
            type: "list",
            sort: sortType,
            page: page
        },
        success: function (data) {
            let parsedData = JSON.parse(data);

            $tbody = parsedData['tbody'];
            $pagination = parsedData['pagination'];
            $("#tbody").html($tbody);
            $("#pagination").html($pagination);
        },
    });
}


function resetForm() {
    document.getElementById("autorsForm").reset();
}
