$(document).ready(function() {
    $("#vote-link-button").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $("#vote-link-button").attr("href"),
            success: function(ans) {
                $(".tab-info").html(ans + " &hearts;");
                var button = $("#vote-link-button");
                if (button.attr("class") == "voted") {
                    button.attr("class", "to-vote");
                } else {
                    button.attr("class", "voted");
                }
            },
        });
    });
    $(".vote-comment-button").click(function(e) {
        e.preventDefault();
        var index = $(".vote-comment-button").index(this);
        $.ajax({
            type: "POST",
            url: this.href,
            success: function(ans) {
                $(".comment-votes").eq(index).html(ans + " &hearts;");
                var button = $(".vote-comment-button").eq(index);
                if (button.html() == "Upvote") {
                    button.html("Downvote");
                } else {
                    button.html("Upvote");
                }
            },
        });
    });
});
