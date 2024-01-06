$(document).ready(function () {
    $("#txtsearch").on("keyup", function () {
        let searchVal = $("#txtsearch").val()
        $.ajax({
            type: 'POST',
            url: 'action.php',
            data: {
                type: 'searchVal',
                searchVal: searchVal
            },
            success: function (data) {
                $('#tbody').html(data);
                console.log(data);
            }
        })
    })

})


let incDec = ''


$('.dec').on('click', () => {
    $.ajax({
        type: 'POST',
        url: 'action.php',
        data: {
            type: 'dec',
        },
        success: function (data) {
            $('#tbody').html(data);
            console.log(data);
        }
    })
})


$('.inc').on('click', () => {
    $.ajax({
        type: 'POST',
        url: 'action.php',
        data: {
            type: 'inc',
        },
        success: function (data) {
            $('#tbody').html(data);
            console.log(data);
        }
    })
})




$(function () {
    list()

    $('#autorsFormButton').on('click', (e) => {
        $.ajax({
            type: 'POST',
            url: 'action.php',
            data: $('#autorsForm').serialize(),
            success: function (data) {
                list();
                resetForm();
            }
        })
    })


    $(document).on("click", ".edit", function () {

        let editId = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: 'action.php',
            data: {
                type: 'edit',
                editId: editId
            },
            success: function (data) {
                let newData = JSON.parse(data)[0];

                let name = newData['name'];
                let id = newData['id'];
                let email = newData['email'];
                let book = newData['book'];
                console.log('success-id', id);
                $('#name').val(name)
                $('#hiddenId').val(id)
                $('#book').val(book)
                $('#fakeemial').val(email)

            }
        })

    })


    $(document).on("click", ".delete", function () {
        list()
        let deleteId = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: 'action.php',
            data: {
                type: 'delete',
                deleteId: deleteId
            },
            success: function (data) {
            }
        })

    })
})

function list() {
    $.ajax({
        type: 'POST',
        url: 'action.php',
        data:
        {
            type: "list"
        },
        success: function (data) {
            $('#tbody').html(data);
        }
    })
}

function resetForm() {
    document.getElementById("autorsForm").reset();
}
