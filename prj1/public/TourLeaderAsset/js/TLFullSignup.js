$(document).ready(function (event) {
    $('#signup_submit').click(function (event) {
        event.preventDefault();
        data = {
            email: $('#exampleInputEmail1').val(),
            password: $('#exampleInputPassword1').val(),
        }

        $.post("/tlsignup",
            data,
            function (response) {
                if (response.url) {
                    window.location = response.url;
                }

                let password_errors = response.password;
                var errors = ''
                for (let key in password_errors) {
                    errors += (`${password_errors[key]}` + '<br>');
                }

                document.getElementById("password_alert").innerHTML = errors;

                let email_errors = response.email;
                var emailErrors = ''
                for (let key in email_errors) {
                    emailErrors += (`${email_errors[key]}` + '<br>');
                }

                document.getElementById("email_alert").innerHTML = emailErrors;

        });
    })

})
