jQuery(function($) {

    var ua = navigator.userAgent.toLowerCase();
    var isMobile = /iphone/.test(ua) || /android(.+)?mobile/.test(ua);

    //retina
    $(window).on('load resize', function () {
        function control_imgResize() {
            if (parseInt($(window).width()) < 768) {
                $('.retina-img').each(function () {
                    var objElement = $(this);
                    var objOmg = new Image();
                    objOmg.src = objElement.attr('src');
                    if (objOmg.width != 0) {
                        objElement.css({'width': objOmg.width / 2});
                    }
                });

                $(window).scroll(function () {
                    $('.animatedFadeInUp').each(function () {
                        var ptop = $(this).offset().top;
                        var scroll = $(window).scrollTop();
                        var windowHeight = $(window).height();
                        if (scroll > ptop - windowHeight) {
                            $(this).addClass('fadeInUp');
                        }
                    });
                });
            } else {
                $('.retina-img').css('width', '');
            }
        }

        control_imgResize();
        $(function () {
            var timer = false;
            $(window).resize(function () {
                if (timer !== false) {
                    clearTimeout(timer);
                }
                timer = setTimeout(function () {
                    $('.retina-img').removeAttr('style');
                    control_imgResize();
                }, 200);
            });
        });
    });

    //sp tel
    $(function () {
        if (!isMobile) {
            $('a[href^="tel:"]').on('click', function (e) {
                e.preventDefault();
            });
            $('a[href^="tel:"]').css({
                "pointer-events": "none",
                "color": "#333333"
            });
            $('a[href^="tel:"]').hover(function () {
                $(this).css({
                    "opacity": "1",
                    "cursor": "default",
                    "text-decoration": "none"
                });
            });
        }
    });


    //switching image
    $(function () {
        var i = $('.switch-img'), t = "_pc", s = "_sp", a = 768;
        i.each(function () {
            function i() {
                var i = parseInt($(window).width());
                i >= a ? c.attr('src', c.data('img').replace(s, t)).css({visibility: 'visible'}) : c.attr('src', c.data('img')).css({visibility: 'visible'})
            }

            var c = $(this);
            $(window).resize(function () {
                i()
            }), i()
        })
    });

    // js fadeIn Up
    $(window).scroll(function () {
        $('.animatedFadeInUp').each(function () {
            var ptop = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();
            if (scroll > ptop - windowHeight) {
                $(this).addClass('fadeInUp');
            }
        });
    });

    $('.animatedFadeInUp').each(function () {
        var ptop = $(this).offset().top;
        var firstView = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (firstView > ptop - windowHeight) {
            $(this).addClass('fadeInUp');
        }
    });

    //scroll
    $(function () {
        $('.scroll').click(function (event) {
            event.preventDefault();
            var url = $(this).attr('href');
            var dest = url.split('#');
            var target = dest[1];
            var target_offset = $('#' + target).offset();
            var target_top = target_offset.top;
            $('html, body').animate({scrollTop: target_top}, 500, 'swing');
            return false;
        });
    });

    $(function () {
        $(window).scroll( function(){
            if( $(this).scrollTop() > 150 ){
                $('.back-top').addClass('is-active');
            } else {
                $('.back-top').removeClass('is-active');
            }
        });

        $('.back-top').click(function(){
            var speed = 500;
            var href= $(this).attr("href");
            var target = $(href == "#" || href == "" ? 'html' : href);
            var position = target.offset().top;
            $("html, body").animate({scrollTop:position}, speed, "swing");
            return false;
        });

        $('#tenriku-speedgrade .close').click(function(){
            var url = window.location.href;
            $url = url.split('?')[0];
            location.replace($url);
            // window.history.replaceState(null, null, $url);
            // $("#tenriku-speedgrade .complete").hide();
            // $("body").removeClass("complete-isActive");
        });

        var email = $("#confirm-email");
        email.change(function () {
            var valConfirmEmail = $(this).val(),
                valEmail = $("#email").val();
            var $this = $(this).parent();
            if(valConfirmEmail != valEmail){
                $(".error").remove();
                $("<p class='error'>メールアドレスを再入力してください</p>").appendTo($this);
            } else {
                $(".error").remove();
            }
        })


        $(document).ready(function(){
            var href = window.location,
                url = new URL(href),
                action = url.searchParams.get("contact");
            var target_offset = $('#contact').offset(),
                target_top = target_offset.top;

            if(action == "complete"){
                $("#tenriku-speedgrade .complete").css("display","flex");
                $("body").addClass("complete-isActive");
                $('html, body').animate({scrollTop: target_top}, 0, 'swing');
            } else if(action == "confirm"){
                $('.title-confirm').show();
                $('#tenriku-speedgrade .none-confirm').remove();
                $('#tenriku-speedgrade').addClass("confirm");
                $(".inner-radio .sub_field").each(function () {
                    if(!$(this).hasClass("checked")){
                        $(this).remove();
                    }
                });
                $('.contact .checkBox-content .text').remove();
                $('.field_label .required-txt').remove();
                $('.contact .check-privacy').remove();
                $('.input_container').hide();
                $('.confirm input').attr('type', 'hidden');
                $('.submit input').attr('type', 'submit');
                $('.submit #go-back').attr('type', 'submit');

            }
        });
    });

    $("#tenriku-speedgrade .header-main .logo a").click(function () {
        var url = window.location.href;
        $url = url.split('?')[0];
        location.replace($url);
    });

    // Hide Header on on scroll down
    // var didScroll;
    // var lastScrollTop = 5;
    // var delta = 10;
    //
    // $(window).scroll(function(event){
    //     didScroll = true;
    // });
    //
    // setInterval(function() {
    //     if (didScroll) {
    //         hasScrolled();
    //         didScroll = false;
    //     }
    // },1);
    //
    // function hasScrolled() {
    //     var st = $(window).scrollTop();
    //     if(Math.abs(lastScrollTop - st) <= delta)
    //
    //         if (st > lastScrollTop){
    //             $("#tenriku-speedgrade .header-main").addClass("scroll-top");
    //         } else {
    //             $("#tenriku-speedgrade .header-main").removeClass("is-active");
    //             $("#tenriku-speedgrade .header-main").addClass("scroll-top");
    //             if(st < 5){
    //                 $("#tenriku-speedgrade .header-main").removeClass("scroll-top");
    //             }
    //         }
    //     lastScrollTop = st;
    // }

    $(window).scroll(function(){
        if ($(window).scrollTop() >= 20) {
            $("#tenriku-speedgrade .header-main").addClass("scroll-top");
        }
        else {
            $("#tenriku-speedgrade .header-main").removeClass("scroll-top");
        }
    });

});