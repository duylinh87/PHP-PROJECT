jQuery(function($) {
    $(function() {
        $(".single-xkld-slides01,.single-xkld-slides02,.single-xkld-slides03,.single-xkld-slides04").fancybox(); //fancybox
        //login form header
        
		
		$(document).ready(function(){
			var href = window.location;
			var url = new URL(href);
			var action = url.searchParams.get("action");
			if(action == "register"){
				$("#post-6").addClass("heigh-main");
			}
		});
		
        /*
		//check radio show		
		$(document).ready(function(){
			var href = window.location;
			var url = new URL(href);
			var visa = url.searchParams.get("visa");
			$(".item-skill input").each(function(){
				var val = $(this).val();
				if(val == visa){
					$(this).attr("checked", "checked");
				}
			});
		});
		
		*/
        $("#header .hd-user").click(function() {
                $('#header .fua-wrap').toggleClass("open");
            })
            //slider đơn hàng về mobile
        if (window.matchMedia("(max-width: 767px)").matches) {
            $('.special-skills .slider-homepage').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                dots: true,
                responsive: [{
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }]
            });
        } else {
            $('.special-skills .slider-homepage').slick('unslick');
        }

        window.addEventListener("resize", function() {
            if (window.matchMedia("(max-width: 767px)").matches) {
                $('.special-skills .slider-homepage').slick({
                    infinite: true,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    dots: true,
                    responsive: [{
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }]
                });
            } else {
                $('.special-skills .slider-homepage').slick('unslick');
            }
        });
        //end slider đơn hàng về mobile     

        $('.multiple-items').slick({
            slidesToShow: 3,
            responsive: [{
                breakpoint: 650,
                settings: {
                    arrows: true,
                    slidesToShow: 1
                }
            }]
        });

        // 並び替えの条件が変わった時の処理
        $("select[name='sort']").change(function() {
            var href = $(this).val();
            if (href != '') {
                location.href = href;
            }
        });
    });
    // code TAB
    let listTab = $('.tab-item');
    let Content = $('.about-site');
    $(listTab).click(function(e) {
        listTab.removeClass('active');
        indexlistTab = listTab.index(this)
        listTab.eq(indexlistTab).addClass('active');
        Content.css('display', 'none');
        Content.eq(indexlistTab).css('display', 'block');
    });
    // FAQタブ切り替え
    $(function() {
        $('.tabContents:first-of-type').addClass("active")
        $(".tab a").click(function() {
            $(this).parent().addClass("active").siblings(".active").removeClass("active");
            var tabContents = $(this).attr("href");
            $(tabContents).addClass("active").siblings(".active").removeClass("active");
            return false;
        });
    });

    $(function() {
        $('.search-change').on('click', function() {
            $(this).toggleClass('search-close search-open');
            $(this).next().slideToggle();
        });
    });

    $(function() {
        // #で始まるリンクをクリックしたら実行されます
        $('a[href^="#"]').click(function() {
            // スクロールの速度
            var speed = 400; // ミリ秒で記述
            var href = $(this).attr("href");
            var target = $(href == "#" || href == "" ? 'html' : href);
            var position = target.offset().top;
            $('body,html').animate({ scrollTop: position }, speed, 'swing');
            return false;
        });
    });

    //slider home
    $('.slick-1').slick({
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        dots: false,
        arrows: false,
        fade: true,
        cssEase: 'linear'
    });

    //change text login
    $('<span>Với tài khoản Google</span>').insertAfter('#wpg-login .lsf-google');
    $('<span>Với tài khoản Facebook</span>').insertAfter('#wpg-login .lsf-facebook');

    //add new class for page register to coding css
    $(function() {
        var formAction = $('#registerform').attr('action');
        if (formAction) {
            var lastFive = formAction.substr(formAction.length - 8); // => "Tabs1"
            if (lastFive == 'register') {
                $('.form-table').addClass('active')
            } else {
                $('.form-table').removeClass('active')
            }
        }
        //Slider home sp top
        var width = $(window).innerWidth();
        if (width <= 550) {
            $('.slick-2').slick({
                centerMode: true,
                dots: true,
                centerPadding: '22%',
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                dots: true,
                arrows: false,
            });
        }

        // Q&A about page
        $('.qa-list dt').on('click', function() {
            $(this).next().slideToggle();
            $(this).toggleClass('open');
        });

        $(".page-about h2").wrapInner("<span></span>");

        //remove tag p empty content
        $('p').each(function() {
            var $this = $(this);
            if ($this.html().replace(/\s|&nbsp;/g, '').length === 0) {
                $this.remove();
            }
        });

        //active popup when Favorate
        $('.simplefavorite-button').click(function() {
            if ($(this).hasClass('active')) {
                $('.popup.remove').show();
                $('.popup.remove i').click(function() {
                    $('.popup.remove').hide();
                });

            } else {
                $('.popup.active').show();
                $('.popup.active i').click(function() {
                    $('.popup.active').hide();
                });
            }
        });

        //move login google and facebook at form
        $('#wpg-login').insertBefore('.fua-wrap #loginform p.submit');
        $('.page-login #registerform #wpg-login').insertBefore('.page-login #registerform .form-table');
        $('<p>Sử dụng email có thật để xác thực.</p>').insertAfter('.page-login #content .main-inner .post-content .frontend-user-admin-login #registerform .form-table tr:nth-of-type(3)');
        var body = $('body').width();

    });

    $(function() {
        $("#side .popular-posts ul li .wpp-date").attr("id", "wpp-date");

        var str = $("#wpp-date").innerHTML;
        //alert(str);
        if (str) {
            var res = str.replace("posted on", "");
            $("#wpp-date").innerHTML = res;
        }
    });

    function heightLine() {

        this.className = "heightLine";
        this.parentClassName = "heightLineParent"
        reg = new RegExp(this.className + "-([a-zA-Z0-9-_]+)", "i");
        objCN = new Array();
        var objAll = document.getElementsByTagName ? document.getElementsByTagName("*") : document.all;
        for (var i = 0; i < objAll.length; i++) {
            if (typeof objAll[i].className == "string") {
                var eltClass = objAll[i].className.split(/\s+/);
                for (var j = 0; j < eltClass.length; j++) {
                    if (eltClass[j] == this.className) {
                        if (!objCN["main CN"]) objCN["main CN"] = new Array();
                        objCN["main CN"].push(objAll[i]);
                        break;
                    } else if (eltClass[j] == this.parentClassName) {
                        if (!objCN["parent CN"]) objCN["parent CN"] = new Array();
                        objCN["parent CN"].push(objAll[i]);
                        break;
                    } else if (eltClass[j].match(reg)) {
                        var OCN = eltClass[j].match(reg)
                        if (!objCN[OCN]) objCN[OCN] = new Array();
                        objCN[OCN].push(objAll[i]);
                        break;
                    }
                }
            }
        }

        //check font size
        var e = document.createElement("div");
        var s = document.createTextNode("S");
        e.appendChild(s);
        e.style.classname = "check-fontsize";
        e.style.visibility = "hidden";
        e.style.position = "absolute";
        e.style.top = "0";
        document.body.appendChild(e);
        var defHeight = e.offsetHeight;

        changeBoxSize = function() {
            for (var key in objCN) {
                if (objCN.hasOwnProperty(key)) {
                    //parent type
                    if (key == "parent CN") {
                        for (var i = 0; i < objCN[key].length; i++) {
                            var max_height = 0;
                            var CCN = objCN[key][i].childNodes;
                            for (var j = 0; j < CCN.length; j++) {
                                if (CCN[j] && CCN[j].nodeType == 1) {
                                    CCN[j].style.height = "auto";
                                    max_height = max_height > CCN[j].offsetHeight ? max_height : CCN[j].offsetHeight;
                                }
                            }
                            for (var j = 0; j < CCN.length; j++) {
                                if (CCN[j].style) {
                                    var stylea = CCN[j].currentStyle || document.defaultView.getComputedStyle(CCN[j], '');
                                    var newheight = max_height;
                                    if (stylea.paddingTop) newheight -= stylea.paddingTop.replace("px", "");
                                    if (stylea.paddingBottom) newheight -= stylea.paddingBottom.replace("px", "");
                                    if (stylea.borderTopWidth && stylea.borderTopWidth != "medium") newheight -= stylea.borderTopWidth.replace("px", "");
                                    if (stylea.borderBottomWidth && stylea.borderBottomWidth != "medium") newheight -= stylea.borderBottomWidth.replace("px", "");
                                    CCN[j].style.height = newheight + "px";
                                }
                            }
                        }
                    } else {
                        var max_height = 0;
                        for (var i = 0; i < objCN[key].length; i++) {
                            objCN[key][i].style.height = "auto";
                            max_height = max_height > objCN[key][i].offsetHeight ? max_height : objCN[key][i].offsetHeight;
                        }
                        for (var i = 0; i < objCN[key].length; i++) {
                            if (objCN[key][i].style) {
                                var stylea = objCN[key][i].currentStyle || document.defaultView.getComputedStyle(objCN[key][i], '');
                                var newheight = max_height;
                                if (stylea.paddingTop) newheight -= stylea.paddingTop.replace("px", "");
                                if (stylea.paddingBottom) newheight -= stylea.paddingBottom.replace("px", "");
                                if (stylea.borderTopWidth && stylea.borderTopWidth != "medium") newheight -= stylea.borderTopWidth.replace("px", "")
                                if (stylea.borderBottomWidth && stylea.borderBottomWidth != "medium") newheight -= stylea.borderBottomWidth.replace("px", "");
                                objCN[key][i].style.height = newheight + "px";
                            }
                        }
                    }
                }
            }
        }

        checkBoxSize = function() {
            if (defHeight != e.offsetHeight) {
                changeBoxSize();
                defHeight = e.offsetHeight;
            }

            // var elm = document.querySelector(".check-fontsize");
            // if (elm) elm.parentNode.removeChild(elm);
        }
        changeBoxSize();
        setInterval(checkBoxSize, 1000)
        window.onresize = changeBoxSize;
    }

    function addEvent(elm, listener, fn) {
        try {
            elm.addEventListener(listener, fn, false);
        } catch (e) {
            elm.attachEvent("on" + listener, fn);
        }
    }
    addEvent(window, "load", heightLine);
    // END: heightLine

});

//open tab home 
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}


/* JS thêm */
function OnChangeVisa(radio) {   
    $radio_value = radio.value;
    if ($radio_value == 'thuc-tap-sinh') {
        document.getElementById('recruit_cat').style.display = "inline-block";
        document.getElementById('recruit_tokuteigino_cat').style.display = "none";

        document.getElementById('span-salary-type').style.display = "none";
        document.getElementById('span-salary').style.display = "inline-block";


        document.getElementById('span-hourly-salary').style.display = "none";
        document.getElementById('span-daily-salary').style.display = "none";
        document.getElementById('span-monthly-salary').style.display = "none";
    } else {
        document.getElementById('recruit_cat').style.display = "none";
        document.getElementById('recruit_tokuteigino_cat').style.display = "inline-block";

        document.getElementById('span-salary-type').style.display = "inline-block";
        document.getElementById('span-salary').style.display = "none";
    }
}

function OnChangeSalaryType(selectObject) {   
    var value = selectObject.value;  
    if (value == 1) {
        document.getElementById('span-hourly-salary').style.display = "inline-block";
        document.getElementById('span-daily-salary').style.display = "none";
        document.getElementById('span-monthly-salary').style.display = "none";
    }
    if (value == 2) {
        document.getElementById('span-hourly-salary').style.display = "none";
        document.getElementById('span-daily-salary').style.display = "inline-block";
        document.getElementById('span-monthly-salary').style.display = "none";
    }
    if (value == 3) {
        document.getElementById('span-monthly-salary').style.display = "inline-block";
        document.getElementById('span-hourly-salary').style.display = "none";
        document.getElementById('span-daily-salary').style.display = "none";
    }
    if (value == 0 || value == '') {        
        document.getElementById('span-hourly-salary').style.display = "none";
        document.getElementById('span-daily-salary').style.display = "none";
        document.getElementById('span-monthly-salary').style.display = "none";
    }
    
}


jQuery(function($) { 
    $(function() { 
        var checkInput_knddvn = $("body #content #searchform .visaSkills-block .list-skills .item-skill:nth-child(2) input");
        var checkInput_knddjp = $("body #content #searchform .visaSkills-block .list-skills .item-skill:nth-child(3) input");
        if (checkInput_knddvn.is(':checked') || checkInput_knddjp.is(':checked')) {
            $("body #content #searchform .career-search-bottom .item-career-search #recruit_cat").css("display", "none");
            $("body #content #searchform .career-search-bottom .item-career-search #recruit_tokuteigino_cat").css("display", "inline-block");
            $("body #content #searchform .visaSkills-block .list-skills .item-skill:nth-child(1) input").removeAttr("checked");

            document.getElementById('span-salary-type').style.display = "inline-block";
            document.getElementById('span-salary').style.display = "none";

            document.getElementById('span-salary-type').style.display = "inline-block";
        }
        
    }); 
    
    $(window).scroll(function() {
        if ( $(document).scrollTop() < 300 || $(document).scrollTop() + $(window).height() >= $('footer').offset().top) {
            $('#apply-bar').hide();
        } else {
            $('#apply-bar').slideDown(10);
        }
    });
    
    $(".wp-pagenavi .pages").insertAfter(".wp-pagenavi > *:last-child");
    $(".wp-pagenavi .pages").addClass("page-pagenavi");
    
    $(document).ready(function() {
        $(".pref_name").chosen({disable_search_threshold: 100});
        $("select.salary").chosen({disable_search_threshold: 100});
        $("select.recruit_cat").chosen({disable_search_threshold: 100});
        $("select.recruit_tokuteigino_cat").chosen({disable_search_threshold: 3});
        $("select.area_tag").chosen({disable_search_threshold: 100});
        $("select.htdk_area_tag").chosen({disable_search_threshold: 3});
        $("select.ranking").chosen({disable_search_threshold: 100});
        $("select.hourly_salary").chosen({disable_search_threshold: 3});
        $("select.daily_salary").chosen({disable_search_threshold: 3});
        $("select.monthly_salary").chosen({disable_search_threshold: 3});
		$("select.sort").chosen({disable_search_threshold: 100});
    });
    
            
    $('.xeory-sp-nav-btn').on('click', function() {
        $('#menu-global_nav li:nth-child(1) .sub-menu').show();
        $('#menu-global_nav li:nth-child(1) ').addClass('nav-open');
    });
    
    $('.menu-item-has-children>a').on('click', function(e) {
		e.preventDefault(); 
//         $('.menu-item-has-children').removeClass('nav-open');
//         $('.menu-item-has-children .sub-menu').slideUp();
//         $(this).next().slideToggle();

		var hasClass = $(this).parents(".menu-item-has-children").hasClass("nav-open");
		if(hasClass){
			$(this).parent().removeClass("nav-open");
			$(this).next().slideUp();
			$(this).next().find("li").removeClass("nav-open");
		} else{
			$(this).parent().addClass('nav-open');
			$(this).next().slideDown();
		}
    }) ;
    
    //// edit code 
    $(".search-company-form .list-company .item-company input").change(function() {
        var val = $(this).val(),
            $this = $(this);
        if(val == "ho-tro-dang-ky"){
            $this.parents(".search-company-form").find("#s").attr('placeholder', 'Tìm kiếm tổ chức hỗ trợ đăng ký'); 
            $("#content #searchform #span-ranking").css("display", "none");
            $("#content #searchform #span-area_tag").css("display", "none");
            $("#content #searchform #span-htdk_area_tag").css("display", "inline-block");
            $("#searchform .company-type .list-company .item-company:nth-child(1) input").removeAttr("checked");
            document.getElementById('post_type').value = 'ho-tro-dang-ky'; 
        } else{
            $this.parents(".search-company-form").find("#s").attr('placeholder', 'Tìm kiếm công ty XKLĐ');
            $("#searchform .company-type .list-company .item-company:nth-child(2) input").removeAttr("checked");
            $("#content #searchform #span-ranking").css("display", "inline-block");
            $("#content #searchform #span-area_tag").css("display", "inline-block");
            $("#content #searchform #span-htdk_area_tag").css("display", "none");
            document.getElementById('post_type').value = 'xkld'; 
        }
    });

});

function confirmLogout() {
    if (confirm("Bạn có muốn đăng xuất?") == true) {
        //alert('Bạn đã đăng xuất thành công!');
        window.location.href = "https://viecjapan.vn/login/?action=logout";
    }
}