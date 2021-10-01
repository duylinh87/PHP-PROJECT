<?php
    global $post;
    $date = date('Y/m/d');
    $metaquerysp[] = array(
        'key' => '募集期限',
        'value' => $date,
        'compare' => '>=',
        'type' => 'DATE'
    );
    $args = array(
        'post_type' => 'vieclam',
        'meta_query' => $metaquerysp,
        'tax_query' => array(
            array(
                'taxonomy' => 'visa',
                'field' => 'slug',
                'terms' => $tearn_visa
            )
        ),
        'posts_per_page' => 9,
        'order' => 'DESC'
    );

    $var = commonVariables();

    if ($tearn_visa == 'thuc-tap-sinh') {
        $tearn_visa_title = $var['visa_tts'];
        $tearn_visa_slug = 'thuc-tap-sinh';
    }
    if ($tearn_visa == 'ky-nang-dac-dinh-viet-nam') {
        $tearn_visa_title = $var['visa_tgVN'];
        $tearn_visa_slug = 'ky-nang-dac-dinh-viet-nam';
    }
    if ($tearn_visa == 'ky-nang-dac-dinh-nhat-ban') {
        $tearn_visa_title = $var['visa_tgJP'];
        $tearn_visa_slug = 'ky-nang-dac-dinh-nhat-ban';
    }
    ?>

    <div class="special-interns special-skills">
        <?php
        $loop = new WP_Query( $args );
        if (!empty($loop -> have_posts()))
        {
            echo '<h2 class="section-subtitle"><span>';
            echo $tearn_visa_title;
            echo '</span></h2>';
            echo '<ul class="slider-homepage content-loop">';
        }
        ?>
        <?php

        if( $loop -> have_posts() ): while( $loop -> have_posts() ): $loop -> the_post();
            $thumbnailjob = get_the_post_thumbnail( $loop->post->ID, $size = 'top_new_job');
            ?>
            <?php
                $occupation_s = commonObjects::get_occupations($loop->post->ID);
                foreach($occupation_s as $occupation) {
                    $occupation_name = $occupation->name;
                    $occupation_slug = $occupation->slug;
                }

            ?>
            <li class="job-box">
                <a class="clearfix" href="<?php the_permalink(); ?>">
                    <?php if( time() - strtotime(get_the_time('d.m.Y', $loop->post->ID)) < 604800 ): ?>
                        <span class="new-mark">new</span>
                    <?php endif; ?>

                    <?php
                    $auto_add_image = get_field('auto_add_image', $loop->post->ID);

                    $filename1 = $occupation_slug . '-' . 'thumb' . '.jpg';
                    $filename2 = $occupation_slug . '-' . 'thumb' . '.png';

                    $auto_thumb_image1 = get_url_image_vieclam($filename1);
                    $auto_thumb_image2 = get_url_image_vieclam($filename2);

                    $auto_base_thumb_image1 = get_path_image_vieclam($filename1);
                    $auto_base_thumb_image2 = get_path_image_vieclam($filename2);

                    if (is_file($auto_base_thumb_image1)) {
                        $auto_thumb_image = $auto_thumb_image1;
                        $auto_base_thumb_image = $auto_thumb_image1;
                    }
                    elseif (is_file($auto_base_thumb_image2)) {
                        $auto_thumb_image = $auto_thumb_image2;
                        $auto_base_thumb_image = $auto_thumb_image2;
                    }
                    else {
                        $auto_thumb_image = '';
                        $auto_base_thumb_image = '';
                    }

                    ?>
                    <div class="images">
                        <?php if ($auto_add_image != 'n' && $auto_thumb_image) : ?>
                            <img alt="<?php echo $occupation_name; ?>" src="<?php echo esc_url($auto_thumb_image); ?>">
                        <?php else: ?> <?php echo  $thumbnailjob; ?>
                        <?php endif; ?>
                    </div>

                    <?php if (has_post_thumbnail() || ($auto_add_image != 'n' && $auto_thumb_image)) : ?>
                    <div class="content">
                        <?php else: ?>
                        <div class="content content-noimage <?php $tuision =  get_field('無料授業', $loop->post->ID); if( $tuision){ ?>free-class<?php } ?>">
                            <?php endif; ?>
                            <?php if( time() - strtotime(get_the_time('d.m.Y', $loop->post->ID)) < 604800 ): ?>
                            <h2 class="title-new">
                                <?php else: ?>
                                <h2>
                                    <?php endif; ?>
                                    <?php
                                    $title = $loop->post->post_title;
                                    if(mb_strlen($title)>40) {
                                        $title= mb_substr($title,0,40);
                                        echo $title . ' ...';
                                    } else {
                                        echo $title;
                                    }
                                    ?>
                                </h2>
                                <?php
                                $field_key = "field_5f0809a259c30";
                                $field = get_field_object($field_key, $loop->post->ID);
                                $value = $field['value'];
                                if($field['choices'][ $value ]) :
                                    $salary = $field['choices'][ $value ];
                                else:
                                    if ( have_rows('salary') ) :
                                        while ( have_rows('salary') ) : the_row();
                                            if (get_sub_field('salary_type', $loop->post->ID) == 1) {
                                                $sub_field = get_sub_field_object('hourly_salary', $loop->post->ID );
                                                $salary_type = '/giờ';
                                            }
                                            if (get_sub_field('salary_type', $loop->post->ID) == 2) {
                                                $sub_field = get_sub_field_object('daily_salary', $loop->post->ID );
                                                $salary_type = '/ngày';
                                            }
                                            if (get_sub_field('salary_type', $loop->post->ID) == 3) {
                                                $sub_field = get_sub_field_object('monthly_salary', $loop->post->ID );
                                                $salary_type = '/tháng';
                                            }
                                            $value = $sub_field['value'];
                                            $salary = $sub_field['choices'][ $value ] . $salary_type;
                                        endwhile;
                                    endif;
                                endif;
                                ?>
                                <p class="salary"><?php echo esc_html($salary); ?></p>
                                <p class="local font-awesome"><?php the_field('勤務地', $loop->post->ID); ?></p>
                                <?php
                                if ( $occupation_s ) {
                                    if(mb_strlen($occupation_name)>40) {
                                        $occupation_name= mb_substr($occupation_name,0,20) ;
                                        $occupation_name =  $occupation_name . ' ...';
                                    }
                                    echo '<ul class="occupation font-awesome">';
                                    echo '<li>' . $occupation_name . '</li>';
                                    if(next($occupation_s)){
                                        echo ', ';
                                    }
                                    echo '</ul>';
                                }
                                ?>
                                <?php if( get_field('無料授業') ){ ?>
                                    <p class="note-freeClass"><?php the_field('無料授業', $loop->post->ID); ?></p>
                                <?php } ?>
                        </div>
                </a>
            </li>
        <?php endwhile; endif; wp_reset_postdata(); ?>
        </ul>
    </div>
    <?php if (!empty($loop -> have_posts())) : ?>
        <p class="button button-blue"><a href="<?php echo home_url('/?s=&post_type=vieclam&visa='.$tearn_visa_slug); ?>"><span><?php echo $var['view_more'];?></span></a></p>
    <?php endif; ?>
