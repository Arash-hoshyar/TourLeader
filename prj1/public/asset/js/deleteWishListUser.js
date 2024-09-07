$(document).ready(function (event) {
    $('.submit3').click(function (event) {
        event.preventDefault();
        data = {
            delete: $(event.target).data('delete-btn'),
        }

        $.post("/wish/and/get",
            data,
            function (response) {
                if (response.url) {
                    window.location = response.url;
                }
            }
        );

    })

})
