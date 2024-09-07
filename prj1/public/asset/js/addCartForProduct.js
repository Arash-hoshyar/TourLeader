$(document).ready(function (event) {
    $('.submit2').click(function (event) {
        event.preventDefault();
        data = {
            value: $(event.target).val(),
        }
        $.post("/",
            data,
            function (response) {
                if (response.url) {
                    window.location = response.url + '?id=' + data.value;
                }
            }
        );

    })

})
