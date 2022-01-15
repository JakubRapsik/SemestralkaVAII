// noinspection JSUnusedGlobalSymbols,JSUnusedLocalSymbols

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

function deleteTopics(category, remove, page, type) {
    $.ajax({
        type: "POST",
        url: "../Topics/remove-topic.php",
        data: {
            category,
            remove
        },
        success: function (data) {
            if (type == null) {
                getTopic(null, page, 3);
                getCategory(null, page);
            } else {
                getTopic(category, page, 5);
                getTopicPageCount(category);
            }

        }
    });
}

function deleteCategory(remove, type, page) {
    $.ajax({
        type: "POST",
        url: "../Categories/remove-category.php",
        data: {
            remove
        },
        success: function (data) {
            if (type == null) {
                getCategory(null, page);
                getTopic(null, page, 3);
            } else {
                getCategory('all', page);
                getCatPageCount();
            }

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