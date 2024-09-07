$(document).ready(function (event) {
    $('#admin_submit').click(function (event) {
        event.preventDefault();
        data = {
            id: $('#id').val(),
            name: $('#name').val(),
        }
        console.log(data)

        $.post("/admineditmaterial/",
            data,
            function (response) {

                if (response.url) {
                    window.location = response.url;
                }

                let name_errors = response.name;
                var errors = ''
                for (let key in name_errors) {
                    errors += (`${name_errors[key]}` + '<br>');
                }

                document.getElementById("name_alert").innerHTML = errors;
            });
    })

})
