// Check browser support
if (typeof(Storage) !== "undefined") {
    // Store
    // localStorage.setItem('id', 'null');
    // Retrieve
    // console.log("\n\nreload local : " + localStorage.getItem("id"));
} else {
    // console.log("Sorry, your browser does not support Web Storage...");
}
$(document).ready(function() {


    //pricing plan select
    $("input:radio[name=package]:checked").parents('.pricing-block').addClass("active").siblings().removeClass("active");
    $("input:radio[name=package]").change(function() {
        if ($(this).attr("name")) {
            $(this).parents('.pricing-block').addClass("active").siblings().removeClass("active");
        } else {
            $(this).parents('.pricing-block').toggleClass("active");
        }
    });

    $('.modal').on('shown.bs.modal', function(e) {
        $('body').addClass('modal-open');
        $(this).find('.has-error-div').remove();
    });

    //Initialise Date Picker
    $('#datetimepicker').datetimepicker({
        format: 'DD/MM/YYYY',
        icons: {
            previous: 'fa fa-arrow-left',
            next: 'fa fa-arrow-right'
        }
    });
    $('#birthday-pick').datetimepicker({
        viewMode: 'years',
        format: 'MM/DD/YYYY',
        icons: {
            previous: 'fa fa-arrow-left',
            next: 'fa fa-arrow-right'
        }
    });

    // expect -tast toggle show/hide
    $('.what-expect-content ul li p.expect-text').hide();

    $('.what-expect-content ul li').on('mouseover mousemove', function() {
        var this_text = $(this).find('.expect-text');
        $(this).find('a').hide();
        $(this_text).show();
    }).mouseleave(function() {
        var this_text = $(this).find('.expect-text');
        $(this_text).hide();
        $(this).find('a').show();
    });

    //scrolltop button jquery
    $("#toTop").click(function() {
        $("html, body").animate({ scrollTop: 0 }, 1000);
    });

    check_URl();
    // click on nav item
    $('a[href*="#"]:not([href="#"]):not([href="#show"]):not([href="#hide"]):not([href^="#modal-tab-"])').click(function() {
        // target element id
        var targetId = $(this).attr('href');
        $('.custom-link').removeClass('active');
        $(this).parent().addClass('active');

        // check element is in same page or not
        var ele = $('body').find(targetId);
        if (ele.length == 1) {
            // same page
            localStorage.setItem("id", targetId);
            $(targetId).click(scroll_to(targetId));
        } else {
            // redirect page
            localStorage.setItem("id", targetId);
            // window.location = 'index.html';

        }
        // scrolling animation
        function scroll_to(thisobj) {
            var target = thisobj;

            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 1000);
        }
    });

    function check_URl() {
        var url = window.location.href;
        var varr;
        var $tmpId;
        if (localStorage.getItem('id') != 'null') {
            $tmpId = localStorage.getItem("id");

            //scroll to div
            if ($tmpId != null) {
                $('html, body').animate({
                    scrollTop: $($tmpId).offset().top
                }, 1000);
            }
            localStorage.setItem('id', 'null');
        } else {
            //no scroll and remove local storage
            localStorage.setItem('id', 'null');
        }
    }
    $('.tester-signup-modal').find('.modal-custom-footer.active').hide();
    $('#tester-register-form').validate({
        rules: {
            firstname: {
                required: true,
                lettersonly: true
            },
            lastname: {
                required: true,
                lettersonly: true
            },
            email: "required",
            o1: "required",
            selectbirth: "required",
            pass: {
                required: true,
                minlength: 8,
                pwcheck: true
            },
            confirmpass: {
                required: true,
                equalTo: "#pass"
            }
        },
        messages: {
            firstname: {
                required: "Please enter your firstname",
                lettersonly: "Please enter only letters"
            },
            lastname: {
                required: "Please enter your firstname",
                lettersonly: "Please enter only letters"
            },
            email: "Please enter valid email",
            o1: "Please select gender",
            selectbirth: "Please select birthdate",
            pass: {
                required: "Please enter password",
                minlength: "One uppercase, one lowercase and one special character and minmum 8 character needed",
                pwcheck: "One uppercase, one lowercase and one special character and minmum 8 character needed"
            },
            confirmpass: {
                required: "Please enter confirm password",
                equalTo: "Password doesn't match"
            }
        },
        errorPlacement: function(error, element) {
            if (element.prop("type") === "radio") {
                error.insertAfter(element.parents("div.radio-btn-wrap"));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) { // <- pass 'form' argument in
            // var findDiv = $('.tester-signup-modal').find('.modal-custom-footer');
            // var exchangeDiv = $('.tester-signup-modal').find('.modal-custom-footer.active');
            // $(findDiv).hide();
            // $(exchangeDiv).show();
            // $('#signup-submit').addClass('disable');
        }
    });
    $('#publisher-reg-form').validate({
        rules: {
            pfirstname: {
                required: true,
                lettersonly: true
            },
            plastname: {
                required: true,
                lettersonly: true
            },
            pemail: "required",
            publisher_pass: {
                required: true,
                minlength: 8,
                pwcheck: true
            },
            publisher_confirmpass: {
                required: true,
                equalTo: "#publisher_pass"
            },
            cname: "required",
            contactnumber: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 13
            }
        },
        messages: {
            pfirstname: {
                required: "Please enter your firstname",
                lettersonly: "please enter only letters"
            },
            plastname: {
                required: "Please enter your firstname",
                lettersonly: "Please enter only letters"
            },
            pemail: "Please enter valid email",
            publisher_pass: {
                required: "Please enter password",
                minlength: "One uppercase, one lowercase and one special character and minmum 8 character needed",
                pwcheck: "One uppercase, one lowercase and one special character and minmum 8 character needed"
            },
            publisher_confirmpass: {
                required: "Please enter confirm password",
                equalTo: "Password doesn't match"
            },
            cname: "Please enter company name",
            contactnumber: {
                required: "Please enter mobile number",
                number: "Please enter only digits",
                minlength: "Please enter 10 digit",
                maxlength: "Please enter maximum 13 digit"
            }
        },
        submitHandler: function(form) {
            // $('#publisherSignup').modal('toggle');
            // $('#sucessSignup').modal('show');
        }
    });
    $('#foo-cont-form').validate({
        rules: {
            foo_con_name: {
                required: true,
                lettersonly: true
            },
            foo_con_email: "required",
            foo_con_number: {
                required: true,
                number: true,
                maxlength: 10,
                minlength: 10
            },
            foo_con_comments: "required"
        },
        messages: {
            foo_con_name: {
                required: "Please enter name",
                lettersonly: "Please enter only alphabets"
            },
            foo_con_email: "Please enter valid email",
            foo_con_number: {
                required: "Please enter number",
                number: "Please enter only digits",
                minlength: "Please enter 10 digits number",
                maxlength: "Please enter 10 digits number"
            },
            foo_con_comments: "Please enter comments"
        }
    });
    $.validator.addMethod("pwcheck", function(value) {
        return /(?=.*?[A-Z])/.test(value) // consists of only these
            &&
            /(?=.*?[a-z])/.test(value) // has a lowercase letter
            &&
            /(?=.*?[#?!@$%^&*-])/.test(value) // has a digit
    });
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetical characters");
});
//password strength checker js starts here
var cnt = 1;
var pop_html;

//one time password checker condition intialisation information
if (cnt == 1) {
    pop_html = '<div class="popover-content pass-stregth-checker"><h5 class="text-center popover-subtitle">Weak</h5><div class="popover-media-img"><img src="http://www.thebetaplan.com/html/images/weak-password.png" class="img-fluid pass-strength-img" alt="password img"></div><p class="pass-info">Password must Include</p><p class="text-red min-length-val"><span class="d-inline-block"><i class="fa fa-times" aria-hidden="true"></i></span><span class="d-inline-block">8 digits in length</span></p><p class="text-red capital-val"><span class="d-inline-block"><i class="fa fa-times" aria-hidden="true"></i></span><span class="d-inline-block">1 capital letters</span></p><p class="text-red lowercase-val"><span class="d-inline-block"><i class="fa fa-times" aria-hidden="true"></i></span><span class="d-inline-block">1 Lowercase</span></p><p class="text-red specialchar-val"><span class="d-inline-block"><i class="fa fa-times" aria-hidden="true"></i></span><span class="d-inline-block">1 Symbol</span></p></div>';
}
$('[data-toggle="popover"]').popover({
    html: true,
    trigger: "focus",
    content: pop_html
});
$('#pass,#publisher_pass').on('focus keyup', function() {
    cnt++;
    passchecker($(this).val());
});

function passchecker(value) {
    //updater information after the password box has focused
    pop_html = $('.pass-stregth-checker').html();
    //password rules updateder
    value.length > 8 ? pass_condition_success($('.min-length-val')) : pass_condition_failure($('.min-length-val')); // min 8 character require
    /[a-z]/.test(value) ? pass_condition_success($('.lowercase-val')) : pass_condition_failure($('.lowercase-val')); // one lowercase checker
    /[A-Z]/.test(value) ? pass_condition_success($('.capital-val')) : pass_condition_failure($('.capital-val')); // one capital checker
    /[#?!@$%^&*-]/.test(value) ? pass_condition_success($('.specialchar-val')) : pass_condition_failure($('.specialchar-val')); // special case checker

    // header information change of password srangth checker
    if ($('.pass-stregth-checker .text-green').length == 1) {
        $('.popover-subtitle').html('Weak');
        $('.pass-strength-img').attr('src', 'http://www.thebetaplan.com/html/images/weak-password.png');
    }
    if ($('.pass-stregth-checker .text-green').length == 2) {
        $('.popover-subtitle').html('Normal');
        $('.pass-strength-img').attr('src', 'http://www.thebetaplan.com/html/images/normal-password.png');
    }
    if ($('.pass-stregth-checker .text-green').length == 3) {
        $('.popover-subtitle').html('Mediam');
        $('.pass-strength-img').attr('src', 'http://www.thebetaplan.com/html/images/medium-password.png');
    }
    if ($('.pass-stregth-checker .text-green').length == 4) {
        $('.popover-subtitle').html('Strong');
        $('.pass-strength-img').attr('src', 'http://www.thebetaplan.com/html/images/strong-password.png');
    }
}

function pass_condition_success(el) {
    el.removeClass('text-red').addClass('text-green').find('span i').removeClass('fa-times').addClass('fa-check');
}

function pass_condition_failure(el) {
    el.removeClass('text-green').addClass('text-red').find('span i').removeClass('fa-check').addClass('fa-times');
}