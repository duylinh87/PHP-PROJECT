<?php get_header(); ?>
<div id="content">
	<div class="wrap">
		<?php bzb_breadcrumb(); ?>
		<div id="main" <?php bzb_layout_main(); ?>>
			<div class="entry-form-inner">
				<h1 class="post-title"><?php the_title();?></h1>
				<div class="box01">
					<?php
						$xkld_id = $_GET['post_id'];
                        $var = commonVariables();
					?>					
					<p><?php echo $var['vieclam_apply_note']; ?></p>
					<div class="list-dl">
						<dl class="clearfix">
							<dt><?php echo $var['compay_xkld']; ?></dt>
							<dd><?php echo get_the_title($xkld_id); ?></dd>
						</dl>
						<dl class="clearfix">
							<dt><?php echo $var['area']; ?></dt>
							<dd>
								<?php
								$terms = get_the_terms( $xkld_id, 'area_tag' );
								if($terms) {
									foreach($terms as $term) {
                                        echo '<span> ' . $term->name . '</span>';
									}
                                    if (next($terms)) echo ', ';
								}
								?>
							</dd>
						</dl>
					</div>
				</div>
				<div class="box02">
					<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
					<?php the_content(); ?>
					<?php endwhile; endif; ?>
				</div>
			</div>
		</div><!-- /main -->
	</div><!-- /wrap -->
</div><!-- /content -->
<?php get_footer(); ?>
