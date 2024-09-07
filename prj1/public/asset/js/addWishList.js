$(document).ready(function (event) {
    $('.add-to-wishlist').click(function (event) {
        event.preventDefault();
        data = {
            wishListValue: $(event.target).val(),
        }

        $.post("/",
            data,
            function (response) {
                if (response.url) {
                    window.location = response.url;
                }
            }
        );

    })

})
