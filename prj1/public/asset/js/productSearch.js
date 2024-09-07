$(document).ready(function (event) {
    $('.search-detail-btn').click(function (event) {
        event.preventDefault();

        data = {
            category_id: document.querySelectorAll('input[type="checkbox"]:checked'),
        }
        console.log(data)
        $.post("/search/result/",
            data,

        );

    })

})
