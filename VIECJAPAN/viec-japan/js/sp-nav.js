jQuery(function($){

	$(function(){

		var scrollTop;

		//sp-navのクラス名変更
		if( $( 'header span' ).hasClass('sp-nav-btn') ) {
			$( 'header span' ).removeClass('sp-nav-btn');
			$( 'header span' ).addClass('xeory-sp-nav-btn');
		}

		$( '.xeory-sp-nav-btn' ).on( 'click', function(){
			scrollTop = $(window).scrollTop();//クリックしたときのポジションを記録
			$( '.xeory-spnav-wrap' ).addClass( 'active' );
			$('body').addClass('noscroll').css('top', -scrollTop);//スクロールを固定
		});

		//navエリア外をクリックしたら、sp-nav-btnについている.activeを削除する
		$( '.xeory-spnav-wrap' ).on( 'click', function(){
			$( '.xeory-spnav-wrap' ).removeClass( 'active' );
			$('body').removeClass('noscroll').css({ 'top' : 0 });//現在のスクロール位置から、0に戻す
			window.scrollTo( scrollTop );//クリックしたときに記録した場所までスクロールする
		});

		//navエリア内はクリックから除外する
		$( '.sp-nav-inner' ).on( 'click', function(e) {
			e.stopPropagation();
		});

		//×ボタンをクリックしたら、sp-nav-btnについている.activeを削除する
		$( '.xeory-spnav-btn-close' ).on( 'click', function(){
			$( '.xeory-spnav-wrap' ).removeClass( 'active' );
			$('body').removeClass('noscroll').css({ 'top' : 0 });//現在のスクロール位置から、0に戻す
			window.scrollTo( 0, scrollTop );//クリックしたときに記録した場所までスクロールする
		});

		$(".sp-nav-inner .sub-menu").css('display', 'none'); // sp-navの場合はsub-menuを非表示

// 		var currentItem = $('.sp-nav-inner .sub-menu').find('.current-menu-item, .current-post-parent');

		// .current-menu-item もしくは .current-post-parent があるとき
// 		if(currentItem.length > 0) {
// 			var currentParent = $('.sp-nav-inner .current-post-ancestor.menu-item-has-children, .sp-nav-inner .current-menu-ancestor.menu-item-has-children');

// 			currentParent.addClass('nav-open'); // 現在表示しているメニューの親のliに nav-openクラスを付与
// 			currentParent.find('.sub-menu').show(); // sub-menuを表示
// 		}
		

		// 子カテゴリを持っているメニュー直下のaタグをクリックしたら
// 		$('.sp-nav-inner .menu-item-has-children > a').on('click', function(e){
// 			e.preventDefault(); // ページ遷移のイベントを停止
			
// 			$(".menu .menu-item-has-children").removeClass("nav-open");
// 			$(".menu .menu-item-has-children .sub-menu").slideUp();
// 			var subNav = $(this).parent('li').find('.sub-menu');
			
// 			$(this).parent('li').addClass('nav-open'); // クリックした要素にnav-openクラスを付与
// 			subNav.slideToggle(); 
// 			if($(this).parent('li').hassClass("nav-open")){
				
				
// 			}

// // 			if(subNav.length > 0) { // クリックしたメニュー内にsub-menuがあったら
// // 				$(this).parent('li').toggleClass('nav-open'); // クリックした要素にnav-openクラスを付与
// // 				subNav.slideToggle(); // sub-menuを開く（すでに開いている場合は閉じる）
// // 			}
			
			
// 		});
		
	
		
// 		$('.xeory-sp-nav-btn').on('click', function() {
// 			$('#menu-global_nav li:nth-child(1) .sub-menu').show();
// 			$('#menu-global_nav li:nth-child(1) ').addClass('nav-open');
// 		});
		
// 		$('.menu-item-type-custom').on('click', function() {
// 			$('.menu-item-type-custom').removeClass('nav-open');
// 			$('.menu-item-type-custom .sub-menu').hide();
// 			$(this).find('.sub-menu' ).show();
// 			$(this).addClass('nav-open');
// 		})
		
		
		
	});

});