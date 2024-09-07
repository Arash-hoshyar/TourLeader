$(document).ready(function (event) {
    $('#admin_reset_submit').click(function (event) {
        event.preventDefault();
        data = {
            email: $('#exampleInputEmailAddress').val(),
        }

        $.post("/adminlogin",
            data,
            function (response) {

            //if (response.url) {
            //    window.location = response.url;
            //}

           // let password_errors = response.password;
           // var errors = ''
           //     for (let key in password_errors){
           //         errors += (`${password_errors[key]}`);
           //     }
           //
                document.getElementById("password_alert").innerHTML = errors;

                let email_errors = response.email;
                var emailErrors = ''
                for (let key in email_errors){
                    emailErrors += (`${email_errors[key]}` + '<br>');
                }

                document.getElementById("email_alert").innerHTML = emailErrors;


            });
    })

})
