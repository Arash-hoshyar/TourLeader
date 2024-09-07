$(document).ready(function (event) {
    $('#admin_submit').click(function (event) {
        event.preventDefault();
        data = {
            name: $('#name').val(),
            label: $('#label').val(),
            brand_id: $('#brand_id').val(),
            description: $('#description').val(),
            price: $('#price').val(),
            height: $('#height').val(),
            width: $('#width').val(),
            material: $('#material').val(),
            category_id: $('#category_id').val(),
            package: $('#package').val(),
        }
        console.log(data)

        $.post("/admin/add/protuct",
            data,
            function (response) {

                if (response.url) {
                    window.location = response.url;
                }

                if (data.brand_id === "choose your brand") {
                    console.log(data.brand_id)

                    document.getElementById("brand_id_alert").innerHTML = 'choose your brand';

                }

                if (data.category_id === "choose your category") {
                    console.log(data.category_id)

                    document.getElementById("category_id_alert").innerHTML = 'choose your category';

                }

                if (data.material === null) {
                    console.log(data.material)

                    document.getElementById("material_alert").innerHTML = 'choose your material';
                }

                let name_errors = response.name;
                var errors = ''
                for (let key in name_errors) {
                    errors += (`${name_errors[key]}` + '<br>');
                }

                document.getElementById("name_alert").innerHTML = errors;

                let label_errors = response.label;
                var labelErrors = ''
                for (let key in label_errors) {
                    labelErrors += (`${label_errors[key]}` + '<br>');
                }

                document.getElementById("label_alert").innerHTML = labelErrors;

                let description_errors = response.description;
                var descriptionErrors = ''
                for (let key in description_errors) {
                    descriptionErrors += (`${description_errors[key]}` + '<br>');
                }

                document.getElementById("description_alert").innerHTML = descriptionErrors;

                let price_errors = response.price;
                var priceErrors = ''
                for (let key in price_errors) {
                    priceErrors += (`${price_errors[key]}` + '<br>');
                }

                document.getElementById("price_alert").innerHTML = priceErrors;

                let height_errors = response.height;
                var heightErrors = ''
                for (let key in height_errors) {
                    heightErrors += (`${height_errors[key]}` + '<br>');
                }

                document.getElementById("height_alert").innerHTML = heightErrors;

                let width_errors = response.width;
                var widthErrors = ''
                for (let key in width_errors) {
                    widthErrors += (`${width_errors[key]}` + '<br>');
                }

                document.getElementById("width_alert").innerHTML = widthErrors;

                let package_errors = response.package;
                var packageErrors = ''
                for (let key in package_errors) {
                    packageErrors += (`${package_errors[key]}` + '<br>');
                }

                document.getElementById("package_alert").innerHTML = packageErrors;

            });
    })

})
