
$(function () {
    list()
    $('#autorsFormButton').on('click', (e) => {

        $.ajax({
            type: 'POST',
            url: 'action.php',
            data: $('#autorsForm').serialize(),
            success: function (data) {
                console.log(data);
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
           $('#tbody').html(data)
            console.log("Yayy success see", data);
        }
    })
}