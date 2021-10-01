<div class="archive-wrap archive-xkld-wrap">
	<h2>
		<?php if( time() - get_the_time('G') < 604800 ): ?>
		<span class="new">NEW</span>
		<?php endif; ?>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
	<?php 
		if(get_the_terms( $post->ID, 'htdk_area_tag')) {
			$areas = get_the_terms( $post->ID, 'htdk_area_tag' );
		}
        $var = commonVariables();
	?>
	<div class="archive-detail clearfix">	
		<div class="left">
			<?php 
				$image = get_field('htdk_logo', get_the_ID());
			 ?>
			<div class="thumbnail"><img alt="<?php echo $image['alt']; ?>" src="<?php echo $image['url']; ?>"></div>
		</div>

		<div class="right">
			<div class="archive-info">
				<table>
					<tr class="tr1">
						<th><?php echo $var['area'] ?></th>
						<td>
							<?php						
							if($areas){
								$list_area = array();								
								foreach ($areas as $area) { 
									$list_area[] = '<a href="'.home_url(). '/?s=&post_type=ho-tro-dang-ky&htdk_area_tag='.$area->slug.'" title="'.esc_attr($area->name).'">'.esc_html($area->name).'</a>';							
								}
								echo implode(', ', $list_area);								
							}
							?>
						</td>
					</tr>								
				</table>
			</div>		
		</div>
	</div>

	<div class="button-area clearfix">		
	<p class="button button-m button-blue"><a href="<?php the_permalink(); ?>"><span><?php echo $var['view_detail']; ?></span></a></p>
	<?php 
	if ( ! is_user_logged_in() ) {
		echo '<a class="login-xkld" href="'.home_url('/login').'">' . $var['login'] . '</a>';
		}
	else{
		echo do_shortcode('[favorite_button]'); 
	}
	?>	
	</div>
</div>
