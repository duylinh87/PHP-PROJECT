<?php get_header(); ?>
<div id="content">
	<div class="wrap">
		<?php bzb_breadcrumb(); ?>
		<div id="main" <?php bzb_layout_main(); ?>>
			<div class="entry-form-inner">
				<h1 class="post-title"><?php the_title();?></h1>
				<div class="box01">
					<?php
						$job_id = $_GET['post_id'];
                        $var = commonVariables();

						if($_GET['xkld_name']) {
							$company_name = $_GET['xkld_name'];
							$company_type = $var['company_xkld'] . ':';
							$terms = get_the_terms( $job_id, 'recruit_cat' );
						} 
						if($_GET['htdk_name']) {
							$company_name = $_GET['htdk_name'];
							$company_type = $var['company_htdk'] . ':';
							$terms = get_the_terms( $job_id, 'recruit_tokuteigino_cat' );
						} 
										
					?>
					<p class="txt01"><?php echo _e(get_post( $job_id )->post_title); ?></p>					
					<div class="list-dl">
						<dl class="clearfix">
							<dt><?php echo $company_type; ?></dt>
							<dd><?php echo $company_name; ?></dd>
						</dl>
						<dl class="clearfix">
							<dt><?php echo $var['occupation'] . ':'; ?></dt>
							<dd>
								<?php														
								if ( $terms ) {
									foreach($terms as $term){
										echo '<span>' . $term->name . '</span>';
									}
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
