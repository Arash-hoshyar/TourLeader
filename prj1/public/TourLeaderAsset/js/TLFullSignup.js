$(document).ready(function (event) {
    $('.signup_submit').click(function (event) {
        event.preventDefault();
        data = {
            name: $('#name').val(),
            email: $('#exampleInputEmail1').val(),
            password: $('#exampleInputPassword1').val(),
            age: $('#age').val(),
            country: $('#country').val(),
            city: $('#city').val(),
            number: $('#number').val(),
            Language: $('#Language').val(),
            id: $('#id').val(),
        }

        $.post("/tlfullsignup/",
            data,
            function (response) {
                if (response.url) {
                    window.location = response.url;
                }
        });
    })

})
