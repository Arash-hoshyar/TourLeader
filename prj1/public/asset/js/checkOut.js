$(document).ready(function (event) {
    $('#submit').click(function (event) {
        event.preventDefault();
        data = {
            firstName: $('#firstName').val(),
            email: $('#email').val(),
            address: $('#address').val(),
            city: $('#city').val(),
            country: $('#country').val(),
            zipCode: $('#zipCode').val(),
            tel: $('#tel').val(),
            shipingAddress: document.getElementById("shiping-address").checked,
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

                if (data.shipingAddress === true) {
                    console.log(response)
                    let firstName_errors2 = response.firstName2;
                    var errors2 = ''
                    for (let key in firstName_errors2) {
                        errors2 += (`${firstName_errors2[key]}` + '<br>');
                    }

                    document.getElementById("name_alert2").innerHTML = errors2;

                    let email_errors2 = response.email2;
                    var emailErrors2 = ''
                    for (let key in email_errors2) {
                        emailErrors2 += (`${email_errors2[key]}` + '<br>');
                    }

                    document.getElementById("email_alert2").innerHTML = emailErrors2;

                    let address_errors2 = response.address2;
                    var addressErrors2 = ''
                    for (let key in address_errors2) {
                        addressErrors2 += (`${address_errors2[key]}` + '<br>');
                    }

                    document.getElementById("address_alert2").innerHTML = addressErrors2;

                    let city_errors2 = response.city2;
                    var cityErrors2 = ''
                    for (let key in city_errors2) {
                        cityErrors2 += (`${city_errors2[key]}` + '<br>');
                    }

                    document.getElementById("city_alert2").innerHTML = cityErrors2;

                    let country_errors2 = response.country2;
                    var countryErrors2 = ''
                    for (let key in country_errors2) {
                        countryErrors2 += (`${country_errors2[key]}` + '<br>');
                    }

                    document.getElementById("country_alert2").innerHTML = countryErrors2;

                    let zipCode_errors2 = response.zipCode2;
                    var zipCodeErrors2 = ''
                    for (let key in zipCode_errors2) {
                        zipCodeErrors2 += (`${zipCode_errors2[key]}` + '<br>');
                    }

                    document.getElementById("zipCode_alert2").innerHTML = zipCodeErrors2;

                    let tel_errors2 = response.tel2;
                    var telErrors2 = ''
                    for (let key in tel_errors2) {
                        telErrors2 += (`${tel_errors2[key]}` + '<br>');
                    }

                    document.getElementById("tel_alert2").innerHTML = telErrors2;
                }
                let firstName_errors = response.firstName;
                var errors = ''
                for (let key in firstName_errors) {
                    errors += (`${firstName_errors[key]}` + '<br>');
                }

                document.getElementById("name_alert").innerHTML = errors;

                let email_errors = response.email;
                var emailErrors = ''
                for (let key in email_errors) {
                    emailErrors += (`${email_errors[key]}` + '<br>');
                }

                document.getElementById("email_alert").innerHTML = emailErrors;

                let address_errors = response.address;
                var addressErrors = ''
                for (let key in address_errors) {
                    addressErrors += (`${address_errors[key]}` + '<br>');
                }

                document.getElementById("address_alert").innerHTML = addressErrors;

                let city_errors = response.city;
                var cityErrors = ''
                for (let key in city_errors) {
                    cityErrors += (`${city_errors[key]}` + '<br>');
                }

                document.getElementById("city_alert").innerHTML = cityErrors;

                let country_errors = response.country;
                var countryErrors = ''
                for (let key in country_errors) {
                    countryErrors += (`${country_errors[key]}` + '<br>');
                }

                document.getElementById("country_alert").innerHTML = countryErrors;

                let zipCode_errors = response.zipCode;
                var zipCodeErrors = ''
                for (let key in zipCode_errors) {
                    zipCodeErrors += (`${zipCode_errors[key]}` + '<br>');
                }

                document.getElementById("zipCode_alert").innerHTML = zipCodeErrors;

                let tel_errors = response.tel;
                var telErrors = ''
                for (let key in tel_errors) {
                    telErrors += (`${tel_errors[key]}` + '<br>');
                }

                document.getElementById("tel_alert").innerHTML = telErrors;

            });
    })

})
