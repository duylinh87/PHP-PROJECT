<footer id="footer">
  <div class="wrap">
    <div class="logo">
      <?php echo get_custom_logo(); ?>
    </div>
    <div class="menu-footer">
      <?php if ( is_active_sidebar( 'footer-widget' ) ) { ?>
      <aside id="footer-widget" class="footer-widget-area" role="complementary">
        <?php dynamic_sidebar( 'footer-widget' ); ?>
      </aside><!-- #secondary -->
    </div>
  <?php } ?>
    <div class="social_very">
      <?php echo sougou_social_buttons(); ?>
      <?php echo sougou_verified_by();?>
    </div>  
  </div>
  

  <div class="site-info">
      <p class="footer-copy">
        Copyright© 2020 ViecJapan. All rights reserved.
      </p>
  </div><!-- /coppy-right -->
  <?php
  // }
  ?>
  
<div class="popup active"><div><span>Đã thêm vào mục yêu thích</span><i class="far fa-times"></i></div></div>
<div class="popup remove"><div><span>Đã xoá khỏi mục yêu thích</span><i class="far fa-times"></i></div></div>
</footer>
<a href="#" class="pagetop"><span><i class="fa fa-angle-up"></i></span></a>
<?php wp_footer(); ?>
<script>
(function($){

$(function(){
  <?php if( !wp_is_mobile() ){?>
  $(".sub-menu").css('display', 'none');
  $("#gnav-ul li").hover(function(){
    $(this).children('ul').fadeIn('fast');
  }, function(){
    $(this).children('ul').fadeOut('fast');
  });
  <?php }?>
  // スマホトグルメニュー
  
  <?php if( is_front_page() ){ ?>
    $('#gnav').addClass('active');
  <?php }else{ ?>
    $('#gnav').removeClass('active');
    
  <?php } ?>
  
  
  $('#header-menu-tog a').click(function(){
    $('#gnav').toggleClass('active');
  });
});


})(jQuery);

</script>
</body>
</html>