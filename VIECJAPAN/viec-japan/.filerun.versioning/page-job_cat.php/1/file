<?php get_header(); ?>

<div id="content" class="job-cat-inner">

	<div class="wrap">
		<?php bzb_breadcrumb(); ?>

		<div id="main" <?php bzb_layout_main(); ?>>

		<h1><?php the_title()?></h1>
		
		<ul class="ul01 clearfix">
			<?php
				$taxonomy_name = 'job_cat';
				$taxonomys = get_terms($taxonomy_name);
				if(!is_wp_error($taxonomys) && count($taxonomys)):
					foreach($taxonomys as $taxonomy):
				$term_id = esc_html($taxonomy->term_id);
				$term_idsp = "job_cat_".$term_id;
				$photo = get_field('job_cat_image',$term_idsp);
				$photosp = wp_get_attachment_image_src($photo, 'full');
			?>
			<li>
				<a href="/job_cat/<?php echo esc_html($taxonomy->slug); ?>" style="background: url('<?php echo $photosp[0]; ?>') no-repeat center center; -webkit-background-size: cover;background-size: cover;">
					<p class="title"><?php echo esc_html($taxonomy->name); ?></p>
				</a>
			</li>
			<?php
				endforeach;
			endif;
			?>
		</ul>

		</div><!-- /main -->

	</div><!-- /wrap -->

</div><!-- /content -->

<?php get_footer(); ?>