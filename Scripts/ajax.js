function getTopic(category, page) {
    $.ajax({
        type: "POST",
        url: "../Categories/getCatTopics.php",
        data: {
            page,
            category
        },
        success: function (data) {
            $('#vysledok').html(data);
        }
    });
}

function deleteData(category, remove) {
    $.ajax({
        type: "POST",
        url: "../Topics/remove-topic.php",
        data: {
            category,
            remove
        },
        success: function (data) {
            getTopic(category, 1);
            getCatPageCount(category);

        }
    });
}


function getCatPageCount(category) {
    $.ajax({
        type: "POST",
        url: "../Categories/paging-category.php",
        data: {
            category
        },
        success: function (data) {
            $('#paging').html(data);

        }
    });

}

