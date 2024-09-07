$(document).ready(function (event) {
    $('#txtSearch').click(function (event) {
        event.preventDefault();
        let category_id = $('#search').val()
            console.log(category_id);

        $.get("/api/product/search/?category_id=" + category_id,
            function (data) {
                $('#decoy').html(data)
            });
    })

})
