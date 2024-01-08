$(document).ready(function () {
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


$("#uploadImage").on("click", (e) => {
    $.ajax({
        type: "FILES",
        url: "action.php",
        data: $("#autorsForm").serialize(),
        success: function (data) {
            list();
            resetForm();
        },
    });
});

$(function () {
    list();
    $("#autorsFormButton").on("click", (e) => {
        $.ajax({
            type: "POST",
            url: "action.php",
            data: $("#autorsForm").serialize(),
            success: function (data) {
                list();
                resetForm();
            },
        });
    });

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
                console.log("success-id", id);
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

    list("", page);
})



function list(sortType = "asc", page) {
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
