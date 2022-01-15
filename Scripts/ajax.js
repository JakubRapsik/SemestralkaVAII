function getTopic(category, page, limit) {
    $.ajax({
        type: "POST",
        url: "../Categories/getCatTopics.php",
        data: {
            page,
            category,
            limit
        },
        success: function (data) {
            $('#vysledok').html(data);
        }
    });
}

function getCategory(data, page) {
    $.ajax({
        type: "POST",
        url: "../Categories/favCategory.php",
        data: {
            data,
            page
        },
        success: function (data) {
            $('#catvysledok').html(data);
        }
    });
}

function deleteTopics(category, remove) {
    $.ajax({
        type: "POST",
        url: "../Topics/remove-topic.php",
        data: {
            category,
            remove
        },
        success: function (data) {
            getTopic(category, 1, 5);
            getTopicPageCount(category);

        }
    });
}

function deleteCategory(remove) {
    $.ajax({
        type: "POST",
        url: "../Topics/remove-topic.php",
        data: {
            remove
        },
        success: function (data) {
            getCategory('all', 1);
            getCatPageCount();

        }
    });
}

function getTopicPageCount(category) {
    $.ajax({
        type: "POST",
        url: "../Topics/paging-topic.php",
        data: {
            category
        },
        success: function (data) {
            $('#paging').html(data);

        }
    });

}

function getCatPageCount() {
    $.ajax({
        type: "POST",
        url: "../Categories/paging-category.php",
        data: {},
        success: function (data) {
            $('#paging').html(data);

        }
    });

}