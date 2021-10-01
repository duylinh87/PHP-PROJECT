
<div class="concierge">
	<div class="top">
        <?php $var = commonVariables(); ?>
		<h2><?php echo $var['concierge_title']; ?></h2>
		<h3><?php echo $var['concierge_subtitle']; ?></h3>
		<div class="concierge_service">
			<img src="<?php echo get_stylesheet_directory_uri().'/images/Concierge_Service.png'; ?>">
		</div>
		<p><?php echo $var['concierge_note01'] . ' '; if($post_type == 'xkld') echo $var['company_xkld']; if($post_type == 'ho-tro-dang-ky') echo $var['company_htdk'] . ' ' . $var['concierge_note02'] . ' '; if($post_type == 'xkld') echo $var['company_xkld']; if($post_type == 'ho-tro-dang-ky') echo $var['company_htdk']; ?>.</p>
		<p class=" link-more">
			<a href="<?php echo home_url('/inquiry_concierge'); ?>?c_id=<?php echo $post_type; ?>"><span><?php echo $var['concierge_link']; ?></span></a>
		</p>
	</div>
	<div class="bottom">
		<?php 
			$i = 0;
			if( have_rows('コンシェルジュスタッフ', 'option') ): 
			while( have_rows('コンシェルジュスタッフ', 'option') ): the_row(); $i++?>
			<div class="block">
				<?php $image = get_sub_field('画像'); ?>
				<div class="images"><img alt="<?php echo $image['alt']; ?>" src="<?php echo $image['url']; ?>"></div> 
				<div class="content">
					<p class="title"><?php the_sub_field('名前'); ?></p>
					<p><?php the_sub_field('プロフィール文') ?></p>
					<?php 
						if( $i == 1) {
							echo '<p class="user-tel"><a href="tel:0348725686">0348-725-686</a></p>';
						} else{
							echo '<p class="user-tel"><a href="tel:0975666358">0975-666-358</a></p>';
						}
					?>
				</div>
			</div>
			<?php endwhile; 
		endif; ?>
	</div>
</div>