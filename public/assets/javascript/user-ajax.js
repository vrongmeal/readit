$(document).ready(function() {
    $("#follow-button").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $("#follow-button").attr("href"),
            success: function(result) {
                $("#followers").html(result + " followers");
                var button = $("#follow-button");
                if (button.attr("class") == "following") {
                    button.attr("class", "not-follow");
                } else {
                    button.attr("class", "following");
                }
            },
        });
    });
});