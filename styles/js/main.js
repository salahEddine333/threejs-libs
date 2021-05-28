$(document).ready(function() {
    'use strict';

    $("#login-form").on("submit", function(e) {
        e.preventDefault();
        var fd = new FormData($(this).get(0));

        $.ajax({
            url: `login.php?do=check`,
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response == -1) {
                    $(".global-error").text("login feild !!!").removeClass("text-success fade").addClass("text-danger show");
                } else {
                    $(".global-error").text(`Welcome ${fd.get("username")}`).removeClass("text-danger fade").addClass("text-success show");
                }
            }
        });

    })

});