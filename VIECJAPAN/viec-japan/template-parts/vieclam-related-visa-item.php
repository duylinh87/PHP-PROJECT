<?php
    global $post;
    $args = array(
        'post_type' => 'vieclam',
        'posts_per_page' => 6,
        'meta_key' => 'post_views_count',
        'orderby' => 'meta_key_num',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => '募集期限',
                'value' => date('Y/m/d'),
                'compare' => '>=',
                'type' => 'date'
            )
        ),
        'tax_query' => array(
            array(
                'taxonomy' => 'visa',
                'field' => 'slug',
                'terms' => $tearn_visa,
            )
        )
    );
    $query = new WP_Query($args); if($query->have_posts()):
    $var = commonVariables();

    if ($tearn_visa == 'thuc-tap-sinh') $tearn_visa_title = $var['visa_tts'];
    if ($tearn_visa == 'ky-nang-dac-dinh-viet-nam') $tearn_visa_title = $var['visa_tgVN'];
    if ($tearn_visa == 'ky-nang-dac-dinh-nhat-ban') $tearn_visa_title = $var['visa_tgJP'];
    ?>

    <div class="sec03">
        <h3 class="section-subtitle"><?php echo $tearn_visa_title ;?></h3>
        <ul class="ul02 clearfix">
            <?php while ($query->have_posts()): $query->the_post(); ?>
                <?php
                $occupation_s = commonObjects::get_occupations($query->post->ID);
                foreach($occupation_s as $occupation){
                    $occupation_name = $occupation->name;
                    $occupation_slug = $occupation->slug;
                }
                ?>
                <li>
                    <a href="<?php the_permalink() ?>">
                        <?php if( time() - strtotime(get_the_time('d.m.Y')) < 604800 ): ?>
                            <span class="new-mark">new</span>
                        <?php endif; ?>
                        <?php
                        //$auto_image_size = get_small_size_image_vieclam();
                        $auto_add_image = get_field('auto_add_image', $query->post->ID);
                        $filename1 = $occupation_slug . '-' . 'thumb' . '.jpg';
                        $filename2 = $occupation_slug . '-' . 'thumb' . '.png';

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
                        <div class="img-df">
                            <?php if ($auto_add_image != 'n' && $auto_thumb_image) : ?>
                                <img style="width:240px;" alt="<?php echo $occupation_name; ?>" src="<?php echo esc_url($auto_thumb_image); ?>">
                            <?php else: ?> <?php echo  get_the_post_thumbnail( $query->post->ID, array('240' , '175')); ?>
                            <?php endif; ?>
                        </div>
                        <p class="ttl01">
                            <?php
                            if(mb_strlen($query->post->post_title)>25) {
                                $title= mb_substr($query->post->post_title,0,25) ;
                                echo $title . ' ...';
                            } else {
                                echo $query->post->post_title;
                            }
                            ?>
                        </p>
                        <?php
                        $field_key = "field_5f0809a259c30";
                        $field = get_field_object($field_key, $query->post->ID);
                        $value = $field['value'];
                        if($field['choices'][ $value ]) :
                            $salary = $field['choices'][ $value ];
                        else:
                            if ( have_rows('salary') ) :
                                while ( have_rows('salary') ) : the_row();
                                    if (get_sub_field('salary_type', $query->post->ID) == 1) {
                                        $sub_field = get_sub_field_object('hourly_salary', $query->post->ID );
                                        $salary_type = '/giờ';
                                    }
                                    if (get_sub_field('salary_type', $query->post->ID) == 2) {
                                        $sub_field = get_sub_field_object('daily_salary', $query->post->ID );
                                        $salary_type = '/ngày';
                                    }
                                    if (get_sub_field('salary_type', $query->post->ID) == 3) {
                                        $sub_field = get_sub_field_object('monthly_salary', $query->post->ID );
                                        $salary_type = '/tháng';
                                    }
                                    $value = $sub_field['value'];
                                    $salary = $sub_field['choices'][ $value ] . $salary_type;
                                endwhile;
                            endif;
                        endif;
                        ?>
                        <p class="price"><?php echo esc_html($salary); ?></p>
                        <ul class="ul03 clearfix">
                            <li><?php the_field('勤務地', $query->post->ID) ?></li>
                            <?php
                            if ( $occupation_s ) {
                                echo '<li>' . $occupation_name . '</li>';
                                if (next($occupation_s)) {
                                    echo ', ';
                                }
                            }
                            ?>
                        </ul>
                    </a>
                </li>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    </div>
<?php endif; ?>