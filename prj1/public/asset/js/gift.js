$(document).ready(function (event) {
    $('#submit').click(function (event) {
        event.preventDefault();
        data = {
            firstName2: $('#firstName2').val(),
            email2: $('#email2').val(),
            address2: $('#address2').val(),
            city2: $('#city2').val(),
            country2: $('#country2').val(),
            zipCode2: $('#zipCode2').val(),
            tel2: $('#tel2').val(),
        }
        console.log(data)

        $.post("/lastcheck",
            data,
            function (response) {

                if (response.url) {
                    window.location = response.url;
                }

                let firstName_errors = response.firstName2;
                var errors = ''
                for (let key in firstName_errors) {
                    errors += (`${firstName_errors[key]}` + '<br>');
                }

                document.getElementById("name_alert2").innerHTML = errors;

                let email_errors = response.email2;
                var emailErrors = ''
                for (let key in email_errors) {
                    emailErrors += (`${email_errors[key]}` + '<br>');
                }

                document.getElementById("email_alert2").innerHTML = emailErrors;

                let address_errors = response.address2;
                var addressErrors = ''
                for (let key in address_errors) {
                    addressErrors += (`${address_errors[key]}` + '<br>');
                }

                document.getElementById("address_alert2").innerHTML = addressErrors;

                let city_errors = response.city2;
                var cityErrors = ''
                for (let key in city_errors) {
                    cityErrors += (`${city_errors[key]}` + '<br>');
                }

                document.getElementById("city_alert2").innerHTML = cityErrors;

                let country_errors = response.country2;
                var countryErrors = ''
                for (let key in country_errors) {
                    countryErrors += (`${country_errors[key]}` + '<br>');
                }

                document.getElementById("country_alert2").innerHTML = countryErrors;

                let zipCode_errors = response.zipCode2;
                var zipCodeErrors = ''
                for (let key in zipCode_errors) {
                    zipCodeErrors += (`${zipCode_errors[key]}` + '<br>');
                }

                document.getElementById("zipCode_alert2").innerHTML = zipCodeErrors;

                let tel_errors = response.tel2;
                var telErrors = ''
                for (let key in tel_errors) {
                    telErrors += (`${tel_errors[key]}` + '<br>');
                }

                document.getElementById("tel_alert2").innerHTML = telErrors;

            });
    })

})
