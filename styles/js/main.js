$(document).ready(function() {
    'use strict';

    /* global vaviables */

    var userId = 0, project_id = 0;

    var pOneFields = [
        {
            fieldName: "contrat_id",
            pattern: /^[a-z0-9]+$/ig,
            msg: "contrat_id incorrect format"
        },
        {
            fieldName: "num_ap",
            pattern: /^\d+$/ig,
            msg: "num_ap incorrect format"
        },
        {
            fieldName: "obj_contract",
            pattern: /^[a-z0-9]+$/ig,
            msg: "obj_contract incorrect format"
        },
        {
            fieldName: "lieu",
            pattern: /^[a-z0-9]+$/ig,
            msg: "lieu incorrect format"
        },
        {
            fieldName: "constructeur",
            pattern: /^[a-z0-9]+$/ig,
            msg: "constructeur incorrect format"
        },
        {
            fieldName: "conc",
            pattern:/^[a-z0-9]+$/ig,
            msg: "conc incorrect format"
        },
        {
            fieldName: "date_approvation",
            pattern: /^\d{4}\-\d{2}\-\d{2}$/ig,
            msg: "date_approvation incorrect format"
        },
        {
            fieldName: "date_mise_ev",
            pattern: /^\d{4}\-\d{2}\-\d{2}$/ig,
            msg: "date_mise_ev incorrect format"
        },
        {
            fieldName: "date_drp",
            pattern: /^\d{4}\-\d{2}\-\d{2}$/ig,
            msg: "date_drp incorrect format"
        },
        {
            fieldName: "date_drd",
            pattern: /^\d{4}\-\d{2}\-\d{2}$/ig,
            msg: "date_drd incorrect format"
        },        
        {
            fieldName: "delai_realisation",
            pattern: /^\d+$/ig,
            msg: "delai_realisation incorrect format"
        },
        {
            fieldName: "montant_or_tva_devise",
            pattern: /^[0-9\.]+$/ig,
            msg: "montant_or_tva_devise incorrect format"
        },
        {
            fieldName: "montant_o_tva_da",
            pattern: /^[0-9\.]+$/ig,
            msg: "montant_o_tva_da incorrect format"
        },
        {
            fieldName: "montant_tota",
            pattern: /^[0-9\.]+$/ig,
            msg: "montant_tota incorrect format"
        }
    ];

    var pTwoFields = [
        {
            fieldName: "nom_phase",
            pattern: /^[a-z0-9]{1,15}$/ig,
            msg: "nom_phase incorrect format"
        },
        {
            fieldName: "date_debut",
            pattern: /^\d{4}\-\d{2}\-\d{2}$/ig,
            msg: "date_debut incorrect format"
        },
        {
            fieldName: "duree",
            pattern: /^\d+$/ig,
            msg: "duree incorrect format"
        },
        {
            fieldName: "taux_av_r",
            pattern: /^[0-9\.]+$/ig,
            msg: "taux_av_r incorrect format"
        },
        {
            fieldName: "taux_p",
            pattern: /^[0-9\.]+$/ig,
            msg: "taux_p incorrect format"
        }
    ];

    /* global vaviables */

    /* functions */

    function formValidation(feild, fields = [
        {
            fieldName: "fname",
            pattern: /^[a-z]{3,11}$/ig,
            msg: "number of character betwwen 3 and 11"
        },
        {
            fieldName: "lname",
            pattern: /^[a-z]{3,11}$/ig,
            msg: "number of character betwwen 3 and 11"
        },
        {
            fieldName: "email",
            pattern: /^[a-z0-9]+@(gmail|yahoo|outlook)\.(com|dz)$/ig,
            msg: "email incorrect forma"
        },
        {
            fieldName: "phoneNumber",
            pattern: /^0(5|6|7)\d{8}$/ig,
            msg: "number of character betwwen 3 and 11"
        },
        {
            fieldName: "username",
            pattern: /^\w{3,11}$/ig,
            msg: "username incorrect format"
        },
        {
            fieldName: "password",
            pattern: /^.{7,55}$/ig,
            msg: "password incorrect format"
        },
    ]) {
        for(let f in fields) {
            if(fields[f].fieldName == feild.attr("name")) {
                if(feild.val() == "") {
                    feild.addClass("border border-danger").siblings(".local-error").text("requaire !!");
                } else if(!fields[f].pattern.test(feild.val())) {
                    feild.addClass("border border-danger").siblings(".local-error").text(fields[f].msg);
                } else {
                    feild.removeClass("border border-danger req").siblings(".local-error").text(fields[f].msg);
                    feild.siblings(".local-error").text("").fadeOut();
                }   
            }
        }

    }

    /* functions */



    /* general style */

    $(".dashboard .container").css("max-width", $(window).innerWidth());

    $(".side-item").on({
        mouseenter: function() {
            $(this).removeClass("bg-white text-secondary").addClass("bg-info text-white");
        },
        mouseleave: function() {
            $(this).removeClass("bg-info text-white").addClass("bg-white text-secondary");
        }
    });

    /* general style */

    /* Admin part */

    $(".side-item").on("click", function(e) {
        e.preventDefault();

        $(this).addClass("side-active").siblings().removeClass("side-active");

    });

    $('.sub-body').height($(window).innerHeight() - ($(".navbar").innerHeight() + 29));

    $("#userManagementBtn > button").on('click', function(e) {
        e.preventDefault();

        if($(this).hasClass("btn-outline-info")) {
            $("#register-form").removeClass("update");
            $("#register-form input:not([name='prv'])").val("");
            $('.table').siblings("#user-management-form").removeClass("fade").addClass("show");

        } else if($(this).hasClass("btn-outline-danger")) {

            if(confirm("are you sure ?!!")) {
                $.ajax({
                    url: `profile.php?do=deleteall`,
                    success: function(response) {
                        if(response == -1) {
                            $(".global-error").text("operation fild :(").removeClass("text-success fade").addClass("text-danger show");
                        } else {
                            window.location.reload();
                        }
                    }
                });
            }
        }

    });

    $("#control-form-user-management > button").on("click", function(e) {
        e.preventDefault();
        if($(this).hasClass("btn-danger")) {
            $(this).parents('#user-management-form').removeClass("show").addClass("fade");
        }
    });

    /* form validation */

    $("#register-form input").on("blur", function() {
        formValidation($(this));
    });

    /* form validation */

    /* Add user from admin */

    $("#register-form").on("submit", function(e) {
        e.preventDefault();

        var fd = new FormData($(this).get(0)), stat;

        console.log($("#register-form .req").length);

        if($(this).hasClass("update")) {
            stat = "update";
            fd.append("user_id", userId);
            $("#register-form input").each(function() {
                if($(this).val() != "" || $(this).val() != 0) {
                    $(this).removeClass("req");
                    $('[name="password"]').removeClass("req");
                }
            });
        } else {
            stat = "insert";
        }

        console.log($("#register-form .req").length, $("#register-form .req"));

        fd.append("form-stat", stat);

        if($("#register-form .req").length === 0) {
            $.ajax({
                url: `login.php?do=registerform`,
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function(response) {
                    if(response == -1) {
                        $(".global-error").text("feild !!!").removeClass("text-success fade").addClass("text-danger show");
                    } else if(response == -2) {
                        $(".global-error").text("password feild is require !").removeClass("text-success fade").addClass("text-danger show");
                    } else if(parseInt(response) > 1) {
                        $(".global-error").text(`congratulation :)`).removeClass("text-danger fade").addClass("text-success show");
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }
                }
            });
        } else {
            $("#register-form .req").each(function() {
                formValidation($(this));
            });
        }

    });

    /* Add user from admin */

    $(".table td > i").on('click', function() {
        let parentRow = $(this).parents('tr'),
            user_id = parentRow.find("td:first-of-type").text();

        userId = user_id;

        if($(this).hasClass("text-danger")) {
            if(confirm("are you sure ?!!")) {
                $.ajax({
                    url: `profile.php?do=deletepk`,
                    type: "POST",
                    data: {user_id: user_id},
                    success: function(response) {
                        if(response == -1) {
                            $(".global-error").text("operation fild :(").removeClass("text-success fade").addClass("text-danger show");
                        } else {
                            window.location.reload();
                        }
                    }
                });
            }
        } else if($(this).hasClass("text-info")) {
            $("#register-form").addClass("update");
            $("#register-form [name='fname']").val(parentRow.find("td:nth-of-type(2)").text());
            $("#register-form [name='lname']").val(parentRow.find("td:nth-of-type(3)").text());
            $("#register-form [name='email']").val(parentRow.find("td:nth-of-type(5)").text());
            $("#register-form [name='phoneNumber']").val(parentRow.find("td:nth-of-type(6)").text());
            $("#register-form [name='username']").val(parentRow.find("td:nth-of-type(4)").text());
            $(`#register-form [value="${parentRow.find("td:nth-of-type(7)").attr("data-prv")}"]`).attr("checked", "checked").parent().siblings().find("input").removeAttr("checked");
            $('.table').siblings("#user-management-form").removeClass("fade").addClass("show");
        }

    });

    /* Admin part */

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
                    setTimeout(function() {
                        let pattern = /admin/gi;
                        if(pattern.test(window.location.href)) {
                            window.location = "/project/admin/profile.php";
                        } else {
                            window.location = "/project/users/profile.php";
                        }
                    }, 1500);
                }
            }
        });

    });


    /* start ch.projet functions */

    $("#continue").on("click", function(e) {
        e.preventDefault();
        var partOne = $(this).parents(".partOne");
        if($(".partOne .req").length === 0) {
            var fd = new FormData($("#add-prj-form").get(0));
            $.ajax({
                url: `project.php?do=insert&type=one`,
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function(response) {
                    project_id = parseInt(response);
                    if(parseInt(response) > 0) {
                        partOne.addClass("d-none").siblings(".partTwo").removeClass("d-none");
                    }
                }
            });
        } else {
            $(".partOne .req").each(function() {
                formValidation($(this), pOneFields);
            });
        }
    });

    $("#add-prj-form .partTwo input").on("blur", function() {
        formValidation($(this), pTwoFields);
    });


    /* form validation */ 

    $("#add-prj-form .partOne input, #add-prj-form .partOne select").on("blur", function() {
        formValidation($(this), pOneFields);
    });

    /* form validation */

    $("#closePr").on("click", function(e) {
        e.preventDefault();

        

    });

    $("#add-prj-form").on("submit", function(e) {
        e.preventDefault();
        var fd = new FormData($(this).get(0));
            fd.append("pr_id", project_id);
        $.ajax({
            url: `project.php?do=insert`,
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function(response) {
                if(parseInt(response) > 0) {
                    $(".global-error").text(`phase ajoutee`).removeClass("text-danger fade").addClass("text-success show");
                    setTimeout(function() {
                        $(".global-error").text(``).removeClass("show").addClass("fade");
                    }, 1500);
                } else {
                    console.log(response);
                }
                // if(response == -1) {
                //     $(".global-error").text("login feild !!!").removeClass("text-success fade").addClass("text-danger show");
                // } else {
                //     $(".global-error").text(`Welcome ${fd.get("username")}`).removeClass("text-danger fade").addClass("text-success show");
                //     setTimeout(function() {
                //         let pattern = /admin/gi;
                //         if(pattern.test(window.location.href)) {
                //             window.location = "/project/admin/profile.php";
                //         } else {
                //             window.location = "/project/users/profile.php";
                //         }
                //     }, 1500);
                // }
            }
        });
    });

    /* end ch.projet functions */


});