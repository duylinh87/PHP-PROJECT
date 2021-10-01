<?php

if ( ! is_active_sidebar( 'sp_nav' ) ) {
	return;
}
?>

<aside class="xeory-spnav-wrap">

	<div class="sp-nav-inner">
		<?php echo get_custom_logo(); ?>
	<span class="xeory-spnav-btn-close"></span>
		<?php do_action('xeory_prepend_spnav-area');?>
		<?php do_action('xeory_append_contacttopSP')?>
		<?php dynamic_sidebar( 'sp_nav' ); ?>
		<?php do_action('xeory_append_spnav-area');?>
		<div class="user-content">
			<div class="user">
				<img src="<?php echo get_stylesheet_directory_uri().'/images/iconmonstr-user-circle-thin.png'?>">
			</div>
		<div class="fua-wrap">
			<?php if( is_user_logged_in() ){ ?>
			<p class="button-mypage"><a href="<?php echo home_url('/mypage'); ?>">Trang cá nhân</a></p>
			<?php } ?>
			<?php echo do_shortcode('[fua]'); ?>
		</div>
	</div>
	</div>
</aside>