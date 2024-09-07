$('#admin_brand_submit').click(function (event) {
    event.preventDefault();
    data = {
        name: $('#name').val(),
        logo: $('#logo').val(),
        url: $('#url').val(),
    }

    $.post("/admin/add/brand",
        data,
        function (response) {

            if (response.urlPj) {
                window.location = response.urlPj;
            }


            let name_errors = response.name;
            var errors = ''
            for (let key in name_errors) {
                errors += (`${name_errors[key]}` + '<br>');
            }

            document.getElementById("name_alert").innerHTML = errors;

            let logo_errors = response.image;
            var logoErrors = ''
            for (let key in logo_errors) {
                logoErrors += (`${logo_errors[key]}` + '<br>');
            }

            document.getElementById("logo_alert").innerHTML = logoErrors;

            let url_errors = response.url;
            var urlErrors = ''
            for (let key in url_errors) {
                urlErrors += (`${url_errors[key]}` + '<br>');
            }

            document.getElementById("url_alert").innerHTML = urlErrors;

        });
})


