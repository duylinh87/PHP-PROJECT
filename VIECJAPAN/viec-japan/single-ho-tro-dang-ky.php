<?php get_header(); ?>

<?php if (!is_user_logged_in()) { set_post_views(get_the_ID()); } ?>
<?php 
	if(get_the_terms( $post->ID, 'htdk_area_tag')) {
		$terms = get_the_terms( $post->ID, 'htdk_area_tag' );
	}
    $var = commonVariables();
?>

<div id="content">
	<?php do_action('xeory_prepend_content'); ?>
	<div class="wrap">
		<?php do_action('xeory_prepend_wrap'); ?>
		<?php bzb_breadcrumb(); ?>
		<div id="main" <?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<div class="row01 clearfix">
				<p class="btn01">
					<?php $page_url = get_the_permalink($post->ID); ?>
					<span class="btn-fb"><a href="http://www.facebook.com/share.php?u=<?php echo $page_url; ?>" onclick="window.open(encodeURI(decodeURI(this.href)), 'FBwindow', 'width=554, height=470, menubar=no, toolbar=no, scrollbars=yes'); return false;" rel="nofollow">Chia sẻ</a></span>
					<?php 
						if ( ! is_user_logged_in() ) {
							echo '<a class="login-xkld" href="'.home_url('/login').'">' . $var['login'] . '</a>';
							}
						else{
							echo do_shortcode('[favorite_button]'); 
						}
					?>	
				</p>
				<div class="clearfix sticky-menu">　　
					<div id="xkld-menu" class="ul01-inner">
						<ul class="ul01 clearfix">
							<li><a href="#anchor01"><?php echo $var['company_overview']; ?></a></li>
							<?php if (get_field('performance')) : ?>	
								<li><a href="#anchor02"><?php echo $var['company_performance']; ?></a></li>
							<?php endif ; ?>											
							<li><a href="#anchor03"><?php echo $var['company_cost']; ?></a></li>
							<li><a href="#anchor05"><?php echo $var['vieclam']; ?></a></li>
						</ul>　
					</div>
				</div>　
				<p class="img01"><?php echo get_the_post_thumbnail( $post->ID, 'full')?></p> 　　　　　　
			</div>

			<div class="sec01 box-df01 clearfix">
				<?php 
					$image = get_field('htdk_logo');
					$alt = $image['alt']; 
				?>
				<p class="img01"><img alt="<?php echo $alt; ?>" src="<?php echo $image['url']; ?>"></p>
				<div class="col01">
					<ul class="ul01">						
						<li><?php echo $var['company_htdk_name']; ?></li>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					</ul>
					<p class="link01"><a href="<?php the_field('htdk_url'); ?>" target="_blank"><?php the_field('htdk_url'); ?></a></p>

					<ul class="ul02">
						<li><?php echo $var['address'] . ': '; ?></li>
						<?php
							if($terms){
								foreach($terms as $term){
									echo '<li> ' . $term->name . '</li>';
									if(next($terms)){
										echo ' / ';
									}
								}
							}
						?>
					</ul>						
				</div>

			</div>

			<div class="sec02 box-df por01">
				<p id="anchor01">anchor01</p>
				<div class="box-df-inner">
					<?php if (get_field('htdk_overview')) : ?>
						<h2 class="h2-style01"><?php echo $var['company_overview']; ?></h2>
						<div class="txt01"><?php the_field('htdk_overview'); ?></div>
					<?php endif; ?>					
					<div class="list-dl01">
						<dl class="clearfix">
							<dt><?php echo $var['company_info']; ?></dt>
							<dd>
								<?php if (get_field('htdk_address')) : ?>
									<dl class="clearfix">
										<dt><?php echo $var['company_office']; ?></dt>
										<dd><?php the_field('htdk_address'); ?></dd>
									</dl>
								<?php endif; ?>	

								<?php if (get_field('htdk_branch')) : ?>
									<dl class="clearfix">
										<dt><?php echo $var['company_branch']; ?></dt>
										<dd><?php the_field('htdk_branch'); ?></dd>
									</dl>
								<?php endif; ?>	

								<?php if (get_field('htdk_representative')) : ?>
									<dl class="clearfix">
										<dt><?php echo $var['company_representative']; ?></dt>
										<dd><?php the_field('htdk_representative'); ?></dd>
									</dl>
								<?php endif; ?>	

								<?php if (get_field('htdk_registration_number')) : ?>
									<dl class="clearfix">
										<dt><?php echo $var['company_registration_number']; ?></dt>
										<dd><?php the_field('htdk_registration_number'); ?></dd>
									</dl>
								<?php endif; ?>	
								
								<?php if(get_field('htdk_establishment_year')): ?>
								<dl class="clearfix">
									<dt><?php echo $var['company_establishment_year']; ?></dt>
									<dd>
										<?php
										if(get_field('htdk_establishment_year')) {
											if(get_field('htdk_establishment_month')) {
												if(get_field('htdk_establishment_day')) {
													echo get_field('htdk_establishment_day') . '/' .  get_field('htdk_establishment_month') . '/' . get_field('htdk_establishment_year');
												}
												else {
													echo get_field('htdk_establishment_month') . '/' . get_field('htdk_establishment_year');
												}
											}
											else echo get_field('htdk_establishment_year');
										}
										?>										
									</dd>
								</dl>
								<?php endif; ?>

								<?php if (get_field('htdk_support_language')) : ?>
									<dl class="clearfix">
										<dt><?php echo $var['company_support_language']; ?></dt>
										<dd><?php the_field('htdk_support_language'); ?></dd>
									</dl>
								<?php endif; ?>	

								<?php if( have_rows('htdk_pic') ) : ?>
								<dl class="clearfix">
									<dt><?php echo $var['company_company_pic']; ?></dt>
									<dd>                                        
									<?php while( have_rows('htdk_pic') ) : the_row(); ?>
										<?php 
											if(get_sub_field('email')) echo get_sub_field('name') . ' ('.get_sub_field('email').')' . '<br />'; 	                                          	
										?>
									<?php endwhile; ?>                       
									</dd>
								</dl>
								<?php endif; ?> 
								
								<?php if (get_field('htdk_pic_email')) : ?>
									<dl class="clearfix">
										<dt><?php echo $var['company_company_pic_email']; ?></dt>
										<dd><?php the_field('htdk_pic_email'); ?></dd>
									</dl>
								<?php endif; ?>								
							
							</dd>
						</dl>

						<?php if (get_field('htdk_management_policy')) : ?>
							<dl class="clearfix">
								<dt><?php echo $var['company_management_policy']; ?></dt>
								<dd><?php the_field('htdk_management_policy'); ?></dd>
								<?php if( have_rows('htdk_management_policy_image') ): while( have_rows('htdk_management_policy_image') ): the_row(); ?>
									<ul class="ul02 clearfix">
										<?php
											$image = get_sub_field('image');
											$size = 'single-image';
											$thumb = $image['sizes'][ $size ];
											$alt = $image['alt'];
										?>
										<li><a class="single-xkld-slides01" rel="group01" href="<?php echo esc_url($thumb); ?>" data-fancybox="gallery01"><img alt="<?php echo $alt; ?>" src="<?php echo esc_url($thumb); ?>"></a></li>
									</ul>
								<?php endwhile; endif; ?>								
							</dl>
						<?php endif; ?>	
						
						<?php if (get_field('performance')) : ?>
							<dl class="clearfix por01">
								<dt id="anchor02"></dt>
								<dt><?php echo $var['company_performance']; ?></dt>
								<dd>
									<dl class="clearfix">
										<dt><?php echo $var['company_supported']; ?></dt>
										<dd>										
											<?php the_field('performance'); ?>
										</dd>
									</dl>									
								</dd>
							</dl>
						<?php endif; ?>	
						
						<dl class="clearfix por01">
							<dt id="anchor03"></dt>
							<dt><?php echo $var['company_cost']; ?></dt>
							<dd>
								<?php
								$cost = get_field('htdk_cost');
								if($cost){ ?>
									<p class="cost-ttl"><b>Từ <?php echo number_format($cost); ?></b></p>
								<?php } ?>

								<?php
								$about_cost = get_field('htdk_cost_text');
								if($about_cost){ ?>
								<p class="cost-text"><?php the_field('htdk_cost_text'); ?></p>
								<?php }else{ ?>
								<p class="cost-text"><?php echo $var['please_contact']; ?></p>
								<?php } ?>
							</dd>
						</dl>						
					</div>
				</div>
			</div>

			<?php $terms = get_the_terms($post->ID, 'feature_tag');
            if($terms): ?>
                <div class="sec04 sec04v1">
                    <h2 class="h2-style01 tag-title"><?php echo $var['company_highlight']; ?></h2>
                    <ul class="ul01 clearfix">
                        <?php
                        foreach($terms as $term) {
                            ?>
                            <li><a href="<?php echo get_category_link( $term->term_id ); ?>"><?php echo $term->name; ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
			<?php endif; ?>

			<?php if(have_rows('htdk_photo') || get_field('htdk_youtube')): ?>			
				<div class="sec04">
					<h2 class="h2-style01"><?php echo $var['photo']; ?></h2>
					<ul class="ul02 clearfix">
						<?php if( have_rows('htdk_photo') ): while( have_rows('htdk_photo') ): the_row(); ?>
							<?php
                                $image = get_sub_field('image');
                                $size = 'single-image';
                                $thumb = $image['sizes'][ $size ];
                                $alt = $image['alt'];
							?>
							<li class="heightLine-01"><a class="single-xkld-slides04" rel="group04" href="<?php echo esc_url($thumb); ?>" data-fancybox="gallery04"><img alt="<?php echo $alt; ?>" src="<?php echo esc_url($thumb); ?>"></a></li>

						<?php endwhile; endif; ?>
					</ul>	
					<div class="video01">
						<?php echo get_field('htdk_youtube'); ?>
					</div>
				</div>
			<?php endif; ?>		
		<?php endwhile; endif; ?>
		
		<?php 						
			$date = date('Y/m/d');
			$connected = new WP_Query( array(
				'connected_type' => 'vieclam_to_ho-tro-dang-ky',
				'connected_items' => get_queried_object(),
				'posts_per_page' => '8',
        		'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,			
				'meta_query' => array(array(
					'key'=>'募集期限',
					'value'=> $date,
					'compare' => '>=',
					'type' => 'DATE',
					)),
				)
			);
			if($connected->have_posts()):
		?>
		<div class="sec06" id="anchor05">
			<h2 class="h2-style01 registration-support"><?php echo $var['company_vieclam_recruiting']; ?><span class="job-count"><?php echo $var['company_vieclam_recruiting_note'] . $connected->found_posts . ' ' . $var['company_vieclam_recruiting_num']; ?></span></h2>
			<ul class="ul02 clearfix">	
				<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>				
					<?php 
						$p_id = get_the_ID(); 						
						if(get_the_terms( $p_id, 'recruit_tokuteigino_cat' )) {$jobs_b = get_the_terms( $p_id, 'recruit_tokuteigino_cat' );}	
						foreach($jobs_b as $job){
							$job_name = $job->name;
							$job_slug = $job->slug;
						}
					?>
					<li>
						<a href="<?php the_permalink($p_id); ?>">
							<?php	
								$auto_add_image = get_field('auto_add_image', $p_id);				
								$filename1 = $job->slug . '-' . 'thumb' . '.jpg';
								$filename2 = $job->slug . '-' . 'thumb' . '.png';

								$auto_thumb_image1 = get_url_image_vieclam($filename1);
								$auto_thumb_image2 = get_url_image_vieclam($filename2);

								$auto_base_thumb_image1 = get_path_image_vieclam($filename1);
								$auto_base_thumb_image2 = get_path_image_vieclam($filename2);

								if (file_exists($auto_base_thumb_image1)) {
									$auto_thumb_image = $auto_thumb_image1;  
									$auto_base_thumb_image = $auto_thumb_image1;
								}   
								elseif (file_exists($auto_base_thumb_image2)) {
									$auto_thumb_image = $auto_thumb_image2;  
									$auto_base_thumb_image = $auto_thumb_image2;
								}
								else {
									$auto_thumb_image = ''; 
									$auto_base_thumb_image = '';
								}																
							?>								
							<p class="img-df">
								<?php if ($auto_add_image != 'n' && $auto_thumb_image) : ?>	
									<img style="width:480px;" alt="<?php echo $job_name; ?>" src="<?php echo esc_url($auto_thumb_image); ?>">
								<?php else: ?> <?php echo  get_the_post_thumbnail( $p_id, array('480' , '300')); ?>
								<?php endif; ?>												
							</p>  							
							<p class="ttl01">
								<?php 
									$title = get_the_title(); 
									if(mb_strlen($title)>40) {
										$title= mb_substr($title,0,40) ;
										echo $title . ' ...';
									} else {
										echo $title;
									}
								?>									
							</p>
							<?php
								if ( have_rows('salary') ) :
									while ( have_rows('salary') ) : the_row();
										if (get_sub_field('salary_type', $p_id) == 1) {
											$sub_field = get_sub_field_object( 'hourly_salary', $p_id );
											$salary_type = '/' . $var['hour'];
										}
										if (get_sub_field('salary_type', $p_id) == 2) {
											$sub_field = get_sub_field_object( 'daily_salary', $p_id );
											$salary_type = '/' . $var['day'];
										}	
										if (get_sub_field('salary_type', $p_id) == 3) {
											$sub_field = get_sub_field_object( 'monthly_salary', $p_id );
											$salary_type = '/' . $var['month'];
										}							
										$value = $sub_field['value'];                                     	                                                      
									endwhile; 
									$salary_tg_jp = $sub_field['choices'][ $value ] . $salary_type;
								endif;
								?>
							<p class="price"><?php echo esc_html($salary_tg_jp); ?></p>
							<ul class="meta ul-area font-awesome">
								<li><?php the_field('勤務地'); ?></li>
							</ul>
							<ul class="meta ul-jobtype font-awesome">
								<li>
									<?php		
										if($jobs_b){
											echo '<ul class="occupation">';										
											echo '<li>' . $job_name . '</li>';			
											if(next($jobs_b)){
												echo ', ';
											}						
											echo '</ul>';
										}                                       
									?>
								</li>
							</ul>							
						</a>
					</li>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</ul>
			<?php if( $connected->found_posts > 4){ ?>
			<p class="button button-blue"><a href="<?php echo home_url('/vieclam'); ?>?htdk_id=<?php echo $post->ID; ?>" ><span>Xem thêm</span></a></p>
			<?php } ?>
		</div>
		<?php endif; ?>
		<div class="sec07">
			<div class="box-inner">
				<h2><?php echo $var['company_htdk_contact']; ?></h2>
				<div class="box01-child"><?php echo $var['company_htdk_contact_note']; ?></div>
				<p class="btn01"><a href="<?php echo home_url('/inquiry_htdk'); ?>?post_id=<?php echo $post->ID; ?>" ><?php echo $var['faq']; ?></a></p>
			</div>
		</div>
		<div class="sec08 sec-concierge">
			<?php get_template_part('template-parts/block', 'concierge'); ?>
		</div>

	</div><!-- /main -->
	<?php do_action('xeory_append_wrap'); ?>
</div><!-- /wrap -->
<?php do_action('xeory_append_content'); ?>
</div><!-- /content -->
<?php get_footer(); ?>