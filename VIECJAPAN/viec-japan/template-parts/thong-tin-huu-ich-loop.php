
<div id="content">
	<div class="wrap">		
		<div id="main" <?php bzb_layout_main(); ?>>
			<h1 class="post-title">
                <?php
                    $var = commonVariables();
                    echo $var['useful_info'];
                ?>
            </h1>
			<div class="content-info">
				<div class="wrap">					
					<?php
					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$args = array(						
						'post_type' => 'thong-tin-huu-ich',
						'orderby' => 'date',
						'order' => 'DESC',
						'paged' => $paged,
						'posts_per_page' => '10'
					);
					$list = new WP_Query($args);
					if ( $list->have_posts() ) :
					echo '<ul>';				
					while ( $list->have_posts() ) : $list->the_post();
					?>
					<li>												
						<?php if( get_the_post_thumbnail() ) : ?>
	                        <div class="content-image">
	                            <?php the_post_thumbnail('medium_large'); ?>
	                        </div>
	                    <?php endif; ?>						
						
						<div class="content-text">
							<h3 class="title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<?php 
	                            $content = get_the_content();
	                            if( mb_strlen( $content ) > 250 ) {
	                                $content = mb_substr( $content, 0, 250 ) ;
	                                echo '<p class="excerpt">' . $content . ' ...' . '</p>';
	                            } else {
	                                echo '<p class="excerpt">' . $content . '</p>';
	                            }
	                        ?>
						</div>						
					</li>
					<?php
					endwhile;							
					echo '</ul>';					
					wp_reset_postdata();
				endif; ?>					
				</div>
			</div>
		</div><!-- /main -->
	</div><!-- /wrap -->
</div><!-- /content -->
