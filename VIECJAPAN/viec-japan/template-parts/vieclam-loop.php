<div class="archive-wrap archive-vieclam-wrap">
	<h2>		
		<?php if( time() - strtotime(get_the_time('d.m.Y') ) < 604800): ?>
		<span class="new">NEW</span>
		<?php endif; ?>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <div class="note-skillSearch">
            <?php
            $visa_s = commonObjects::get_visa($post->ID);
            $occupation_s = commonObjects::get_occupations($post->ID);
            $var = commonVariables();
            if ( $visa_s ) {
                foreach($visa_s as $visa){
					$visa_slug = $visa->slug;
					$visa_name = $visa->name;
                    if ($visa_slug == 'thuc-tap-sinh')
                        echo '<div class="item-note-skill note-skill01">' . $visa_name . '</div>';
                    elseif ($visa_slug == 'ky-nang-dac-dinh-viet-nam')
                        echo '<div class="item-note-skill note-skill02">' . $visa_name . '</div>';
                    else {
                        echo '<div class="item-note-skill note-skill03">' . $visa_name . '</div>';
                    }
                }
            } ?>
        </div>
	</h2>
    
	<div class="archive-detail clearfix">
		<div class="left">
			<div class="archive-info">				
				<table>
					<tr class="tr1">
						<th><?php echo $var['company'];  ?></th>
						<td>
						<?php
						if ($visa_slug != 'thuc-tap-sinh') {
							$connected = new WP_Query( array(
							'connected_type' => 'vieclam_to_ho-tro-dang-ky',
							'connected_items' => $post,
							'nopaging' => true,							
							) );
						}
						else {
							$connected = new WP_Query( array(
							'connected_type' => 'vieclam_to_xkld',
							'connected_items' => $post,
							'nopaging' => true,							
							) );
						}

						while ( $connected->have_posts() ) : $connected->the_post();
						?>
						<p><?php the_title(); ?></p>
						<?php endwhile; wp_reset_postdata(); ?>
						</td>
					</tr>
					<tr class="tr2">
						<th><?php echo $var['salary']; ?></th>
						<td>
						<?php 
							$field_key = "field_5f0809a259c30";
							$field = get_field_object($field_key);
							$value = $field['value'];							
							if($visa_slug == 'thuc-tap-sinh' && $field['choices'][ $value ]) : 
								$salary = $field['choices'][ $value ] . '/' . $var['month'];
							else:         
								if ( have_rows('salary') ) :
									while ( have_rows('salary') ) : the_row();
										if (get_sub_field('salary_type') == 1) {
											$sub_field = get_sub_field_object( 'hourly_salary' );
											$salary_type = '/' . $var['hour'];
										}
										if (get_sub_field('salary_type') == 2) {
											$sub_field = get_sub_field_object( 'daily_salary' );
											$salary_type = '/' . $var['day'];
										}	
										if (get_sub_field('salary_type') == 3) {
											$sub_field = get_sub_field_object( 'monthly_salary' );
											$salary_type = '/' . $var['month'];
										}							
										$value = $sub_field['value'];																									
									endwhile;     
									$salary = $sub_field['choices'][ $value ] . $salary_type;   
								endif;
							endif; 
							echo esc_html($salary);
							?>							
						</td>
					</tr>
					
					<tr class="tr3">
						<th><?php echo $var['occupation']; ?></th>
						<td>
							<?php
								if ( $occupation_s ) {
									foreach($occupation_s as $occupation){
										echo $occupation->name;;
										if (next($occupation_s)) {
											echo ', ';
										}
									}
								}
							?>
						</td>
					</tr>
					<tr class="tr4">
						<th><?php echo $var['area']; ?></th>
						<td><?php the_field('勤務地'); ?></td>
					</tr>
					
					<tr class="tr5">
						<th><?php echo $var['visa_type']; ?></th>
						<td>
						<?php								
							if ( $visa_s ) {								
								echo $visa_name;						
							}
							?>
						</td>
					</tr>
				</table>
			</div>

			<ul class="tag">
			<?php
				$terms = get_the_terms($post->ID, 'job_cat');
				if($terms){
					foreach($terms as $term) {
						?>
						<li><a href="<?php echo get_category_link( $term->term_id ); ?>"><?php echo $term->name; ?></a></li>
						<?php
					}
				}
			?>
			</ul>
		</div>
		<?php				
			$auto_add_image = get_field('auto_add_image', $post->ID);
			$filename1 = $occupation->slug . '-' . 'thumb' . '.jpg';
	        $filename2 = $occupation->slug . '-' . 'thumb' . '.png';
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
		<div class="right thumbnail">
			<?php if ($auto_add_image != 'n' && $auto_thumb_image) : ?>	
				<img style="width:300px;" alt="<?php echo $occupation->name; ?>" src="<?php echo esc_url($auto_thumb_image); ?>">
			<?php else: ?> <?php the_post_thumbnail(array(300, 200)); ?>
			<?php endif; ?>												
		</div> 		
	</div>

	<div class="button-area clearfix xkld">
		<p class="dead-line"><?php echo $var['deadline'] . ': '; ?> <?php the_field('募集期限'); ?></p>
		
		<p class="button button-m button-blue">			
			<a href="<?php the_permalink();?>"><span><?php echo $var['view_detail']; ?></span></a>
		</p>
		<?php 
			if ( ! is_user_logged_in() ) {
				echo '<a class="login-xkld" href="'.home_url('/login').'">';
				echo $var['login'];
				echo '</a>';
				}
			else{
				echo do_shortcode('[favorite_button]'); 
			}
		?>	
	</div>
</div>