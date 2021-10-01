<?php
/*
 * Template Name: Template post ngành nghề
 * Template Post Type: post
 */
get_header();
?>

<div id="content" class="job-page">
	
	<div class="wrap">
		<?php bzb_breadcrumb(); ?>
		
		<div class="box-content">
			<div class="heading-block">
				<?php 
				global $post;
				$categories = get_the_category($post->ID);
				foreach($categories as $cate) {
					$img = $cate->description;
				}
				?>
				<div class="icon"><img src="<?php echo $img; ?>"></div>
				<div class="info">
					<h2 class="title"><?php the_title(); ?></h2>
					<p class="excerpt"><?php echo $post->post_excerpt; ?></p>
				</div>
			</div>
			<div class="job-description">
				<h2 class="title-item"><?php the_title(); ?></h2>
				<div class="job-box">
					<?php if( get_the_post_thumbnail() ) : ?>
					<div class="post-image">
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
						<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
					</div>
					<?php endif; ?>
					<div class="text-content">
						<p class="text"><?php the_field('job_description'); ?></p>
						<dl>
							<dt class="ttl">テキスト</dt>
							<dd class="text"><?php the_field('main_description'); ?></dd>
						</dl>
					</div>
				</div>
			</div>
			<div class="featured-iamge">
				<h2 class="title-item">テキスト</h2>
				<?php 
				$images = get_field('featured_image');
				$size = 'full';
				if( $images ): ?>
				<ul class="list-featured-image">
					<?php foreach( $images as $image_id ): ?>
					<li class="item-image">
						<p class="ttl">テキスト</p>
						<?php echo wp_get_attachment_image( $image_id, $size ); ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</div>
			<div class="featured-point">
				<p class="text"><?php the_field('featured_point'); ?></p>
			</div>
		</div>
		
		<div class="video-job">
			<?php

// 			$iframe = get_field('video');

			?>
		</div>
		
		<div class="content-blog-get">
			<div class="blog-get">
				<iframe sandbox="allow-scripts" security="restricted" src="<?php the_field('link_api'); ?>" width="600" height="1000" title="" frameborder="0" marginwidth="0" marginheight="0" scrolling="auto" class="wp-embedded-content" data-secret="tef2n47qb8"></iframe>
			</div>
		</div>

		<?php the_content(); ?>
	</div>
	
	

</div><!-- /content -->

<?php get_footer(); ?>
