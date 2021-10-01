<?php
/*
 * Template Name: Template ngành nghề
 * Template Post Type: page
 */
get_header();
?>

<div id="career-page" class="">
	<div class="wrap">
		<?php bzb_breadcrumb(); ?>
		<div id="main" <?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage">
			<div class="career-content">
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
				<header class="header-image" style="background-image: url(<?php echo $image[0]; ?>)">
					<h1 class="title">
						<span class="t1">テキストテキストテキスト</span>
						<span class="t2">テキスト</span>
					</h1>
				</header>
				<div class="description-box">
					<?php the_content(); ?>
				</div>
				<div class="content">
					<div class="career-block">
						<h2 class="heading-block"><i class="fa fa-medal"></i>テキスト</h2>
						<?php echo get_post_nganh_nghe(); ?>
					</div>
					<div class="industry-all">
						<h2 class="heading-block"><i class="fa fa-briefcase"></i>テキスト</h2>
						<div class="professions-content">
							<?php
							$category = get_category_by_slug('all-professions'); 
							$id = $category->term_id;
							$args = array('child_of' => $id);
							$categories = get_categories( $args );
							foreach($categories as $cate) { 
								echo '<div class="professions-list">
									<div class="icon"><img src="' .$cate->description. '"></div><div class="info"><h3 class="title" data-id="' .$cate->term_id. '">'.$cate->name.'</h3>';
								$args = array(
									'posts_per_page'   => -1,
									'category'         => $cate->term_id,
									'post_type'        => 'nganh-nghe'
								);
								$posts = get_posts($args);
								echo '<div class="all">';
								foreach($posts as $post) { 
									echo '<a class="link-blog" href="'.get_permalink($post).'">'.get_the_title($post).'</a>';
								}
								echo '</div></div></div>';
							}
							?>
						</div>
						<?php
						
						?>
					</div>
				</div>
			</div><!-- /main -->
		</div><!-- /wrap -->
	</div><!-- /content -->

	<?php get_footer(); ?>