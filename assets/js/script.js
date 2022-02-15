jQuery(function ($) {
    'use strict';
    jQuery('.mean-menu').meanmenu({meanScreenWidth: "1059"});
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 50) {
            $('.navbar-area').addClass('is-sticky');
        } else {
            $('.navbar-area').removeClass('is-sticky');
        }
    });
    $(function () {
        $('body').addClass('pre-loaded');
    });
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 300) {
            $("#scrolltop").fadeIn();
        } else {
            $("#scrolltop").fadeOut();
        }
    });
    $("#scrolltop").on('click', function () {
        $("html").animate({scrollTop: 0}, 2000);
        return false;
    });
    $('[data-toggle="tooltip"]').tooltip();

    function dealTimer() {
        var endTime = new Date("15 October 2020 9:56:00 GMT+01:00");
        endTime = (Date.parse(endTime) / 1000);
        var now = new Date();
        now = (Date.parse(now) / 1000);
        var timeLeft = endTime - now;
        var days = Math.floor(timeLeft / 86400);
        var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
        var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
        var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
        if (hours < "10") {
            hours = "0" + hours;
        }
        if (minutes < "10") {
            minutes = "0" + minutes;
        }
        if (seconds < "10") {
            seconds = "0" + seconds;
        }
        $("#days").html(days);
        $("#hours").html(hours);
        $("#minutes").html(minutes);
        $("#seconds").html(seconds);
    }

    setInterval(function () {
        dealTimer();
    }, 1000);
    $(document).ready(function () {
        $('.logo-slider').owlCarousel({
            loop: true,
            margin: 50,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayHoverPause: true,
            autoplayTimeout: 2520,
            smartSpeed: 1500,
            rtl: true,
            responsive: {0: {items: 2}, 768: {items: 3}, 1000: {items: 5}}
        })
        $(".navbar-language").each(function () {
            var each = $(this)
            each.find(".lang-name").html(each.find(".language-dropdown-menu a:nth-child(1)").text());
            each.find(".lang-name").html(each.find(".language-top-menu a:nth-child(1)").html());
            each.find(".language-option img").addClass("language-flag");
            var allOptions = $(".language-dropdown-menu").children('a');
            var allOptions2 = $(".language-top-menu").children('a');
            each.find(".language-dropdown-menu").on("click", "a", function () {
                allOptions.removeClass('selected');
                $(this).addClass('selected');
                $(this).closest(".navbar-language").find(".lang-name").html($(this).text());
                $(this).closest(".navbar-language").find(".language-option img").addClass("language-flag");
            });
            each.find(".language-top-menu").on("click", "a", function () {
                allOptions2.removeClass('selected');
                $(this).addClass('selected');
                $(this).closest(".navbar-language").find(".lang-name").html($(this).html());
                $(this).closest(".navbar-language").find(".language-option img").addClass("language-flag");
            });
        })
        $("#dot").on("click", function (e) {
            $(this).siblings(".navbar-dots-dropdown").toggleClass("show");
        })
        $('body').on('click', function (e) {
            if (!$('#dot').is(e.target) && $('#dot').has(e.target).length === 0 && $('.show').has(e.target).length === 0) {
                $('.navbar-dots-dropdown').removeClass('show');
            }
        });
        $("#video-popup").magnificPopup({
            disableOn: 0,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
        $('.client-carousel').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            // navText: ["<span class='bx bxs-left-arrow-circle'></span>", "<span class='bx bxs-right-arrow-circle'></span>"],
            dots: false,
            smartSpeed: 1500,
            rtl: true,
            responsive: {0: {items: 1}}
        })
        var sync1 = $('.client-content-carousel'), sync2 = $('.client-thumb-carousel'), slidesPerPage = 5;
        var syncedSecondary = true;
        sync1.owlCarousel({
            items: 1,
            slideSpeed: 2000,
             nav: false,
            autoplay: false,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            // navText: ["<span class='bx bxs-left-arrow-circle'></span>", "<span class='bx bxs-right-arrow-circle'></span>"],
            rtl: true,
        }).on('changed.owl.carousel', syncPosition);
        sync2.on('initialized.owl.carousel', function () {
            sync2.find(".owl-item").eq(0).addClass("current");
        }).owlCarousel({
            items: slidesPerPage,
            dots: false,
            nav: false,
            smartSpeed: 200,
            slideSpeed: 500,
            slideBy: slidesPerPage,
            responsiveRefreshRate: 100,
            rtl: true,
        }).on('changed.owl.carousel', syncPosition2);

        function syncPosition(el) {
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);
            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }
            sync2.find(".owl-item").removeClass("current").eq(current).addClass("current");
            var onscreen = sync2.find('.owl-item.active').length - 1;
            var start = sync2.find('.owl-item.active').first().index();
            var end = sync2.find('.owl-item.active').last().index();
            if (current > end) {
                sync2.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                sync2.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                sync1.data('owl.carousel').to(number, 100, true);
            }
        }

        sync2.on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).index();
            sync1.data('owl.carousel').to(number, 300, true);
        });
        $(".faq-accordion-header").click(function () {
            $(this).parent(".faq-accordion-item").toggleClass("faq-accordion-item-active").siblings().removeClass("faq-accordion-item-active")
        })
        $(".feature-tab-item").click(function () {
            var tab_modal = $(this).attr("data-feature-tab");
            $(this).addClass("active").siblings().removeClass("active");
            $(".feature-tab-content-item[data-feature-details=" + tab_modal + "]").slideDown(600).siblings().slideUp(500);
        })
        $(".authentication-tab-item").click(function () {
            var tab_modal = $(this).attr("data-authentcation-tab");
            $(this).addClass("authentication-tab-active").siblings().removeClass("authentication-tab-active");
            $(".authentication-tab-details-item[data-authentcation-details=" + tab_modal + "]").addClass("authentication-tab-details-active").siblings().removeClass("authentication-tab-details-active");
        })
        $(".newsletter-form").validator().on("submit", function (event) {
            if (event.isDefaultPrevented()) {
                formErrorSub();
                submitMSGSub(false, "Please enter your email correctly.");
            } else {
                event.preventDefault();
            }
        });

        function callbackFunction(resp) {
            if (resp.result === "success") {
                formSuccessSub();
            } else {
                formErrorSub();
            }
        }

        function formSuccessSub() {
            $(".newsletter-form")[0].reset();
            submitMSGSub(true, "Thank you for subscribing!");
            setTimeout(function () {
                $("#validator-newsletter").addClass('hide');
            }, 4000)
        }

        function formErrorSub() {
            $(".newsletter-form").addClass("animate__animated animate__shakeX");
            setTimeout(function () {
                $(".newsletter-form").removeClass("animate__animated animate__shakeX");
            }, 1000)
        }

        function submitMSGSub(valid, msg) {
            if (valid) {
                var msgClasses = "validation-success";
            } else {
                var msgClasses = "validation-danger";
            }
            $("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);
        }
    });
});