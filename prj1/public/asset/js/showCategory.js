$(document).ready(function (event) {
    $('.api').click(function (event) {
        event.preventDefault();
        let category_id = $(event.target).data('category_id');
        console.log(category_id);

        $.get("/api/product/?category_id=" + category_id,
            function (data) {
                $('#decoy').html(data)
        });
    })

})
