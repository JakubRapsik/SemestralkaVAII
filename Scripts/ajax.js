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

function getPosts(topic, page) {
    $.ajax({
        type: "POST",
        url: "../Posts/get-posts.php",
        data: {
            page,
            topic,
        },
        success: function (data) {
            $('#postvysledok').html(data);
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

function deleteTopics(category, remove, page, type, pocet) {
    $.ajax({
        type: "POST",
        url: "../Topics/remove-topic.php",
        data: {
            category,
            remove
        },
        success: function () {
            let $n;
            if (type == null) {
                getTopic(null, page, 3);
                getCategory(null, page);
            } else {
                $n = (pocet % 5);
                if ($n === 0 && page !== 1) {
                    getTopic(category, page - 1, 5);
                } else {
                    getTopic(category, page, 5);
                }
                getTopicPageCount(category);
            }

        }
    });
}

function deleteCategory(remove, type, page, pocet) {
    $.ajax({
        type: "POST",
        url: "../Categories/remove-category.php",
        data: {
            remove
        },
        success: function () {
            let $n;
            if (type == null) {
                getCategory(null, page);
                getTopic(null, page, 3);
            } else {
                $n = (pocet % 5);
                if ($n === 0 && page !== 1) {
                    getCategory('all', page - 1);
                } else {
                    getCategory('all', page);
                }
                getCatPageCount();
            }

        }
    });
}

function deletePost(remove, page, pocet, topic) {
    $.ajax({
        type: "POST",
        url: "../Posts/remove-post.php",
        data: {
            remove
        },
        success: function () {
            let $n;
            $n = (pocet % 2);
            if ($n === 0 && page !== 1) {
                getPosts(topic, page - 1);
            } else {
                getPosts(topic, page);
            }
            getPostPageCount(topic);


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

function getPostPageCount(topic) {
    $.ajax({
        type: "POST",
        url: "../Posts/paging-post.php",
        data: {
            topic
        },
        success: function (data) {
            $('#postpaging').html(data);

        }
    });
}