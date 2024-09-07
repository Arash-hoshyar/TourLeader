$(document).ready(function (event) {
    $('.submit2').click(function (event) {
        event.preventDefault();
        data = {
            delete: $(event.target).data('delete-btn'),
        }

        $.post("/store",
            data,
            function (response) {
                if (response.url) {
                    window.location = response.url;
                }
            }
        );

    })

})
