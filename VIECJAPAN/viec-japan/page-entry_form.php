<?php get_header(); ?>
<div id="content">
	<div class="wrap">
		<?php bzb_breadcrumb(); ?>
		<div id="main" <?php bzb_layout_main(); ?>>
			<div class="entry-form-inner">
				<h1 class="post-title"><?php the_title();?></h1>
				<div class="box01">
					<?php
						$company_name = $_GET['company_name'];
						$job_id = $_GET['post_id'];
                        $var = commonVariables();
					?>
					<p class="txt01"><?php echo _e(get_post( $job_id )->post_title); ?></p>					
					<div class="list-dl job-details">
						<dl class="clearfix">
							<dt><?php echo $var['company'] . ':'; ?></dt>
							<dd><?php echo $company_name; ?></dd>
						</dl>
						<dl class="clearfix">
							<dt><?php echo $var['occupation'] . ':'; ?></dt>
							<dd>
								<?php
								$terms = get_the_terms( $job_id, 'recruit_cat' );
								if ( $terms ) {
									foreach($terms as $term){
										echo '<span>' . $term->name . '</span>';
									}
                                    if (next($terms)) echo ', ';
								}
								?>	
							</dd>
						</dl>
						<dl class="clearfix">
							<dt><?php echo $var['area'] . ':'; ?></dt>
							<dd><?php the_field('勤務地',$job_id); ?></dd>
						</dl>
						<dl class="visa-form clearfix">
							<dt><?php echo $var['visa_type'] . ':'; ?></dt>
							<dd>
								<?php
									$visa_s = get_the_terms( $job_id, 'visa' );								
									if ( $visa_s ) {
										foreach($visa_s as $visa){
											echo $visa->name;
										}
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
