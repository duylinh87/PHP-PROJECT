<?php get_header(); ?>
    <div id="content">
        <?php do_action('xeory_prepend_content'); ?>
        <div class="wrap">
            <?php do_action('xeory_prepend_wrap'); ?>
            <?php bzb_breadcrumb(); ?>
            <div id="main" <?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
                <?php
                $var = commonVariables();
                $occupation_s = commonObjects::get_occupations($post->ID);
                foreach($occupation_s as $occupation) {
                    $occupation_name = $occupation->name;
                    $occupation_slug = $occupation->slug;
                    $occupation_taxonomy = $occupation->taxonomy;
                }
                $visa_s = commonObjects::get_visa($post->ID);
                foreach($visa_s as $visa){
                    $visa_slug = $visa->slug;
                    $visa_name = $visa->name;
                }
                ?>
                <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
                    <?php
                    if ($visa_slug != 'thuc-tap-sinh') {
                        $connected = new WP_Query( array(
                            'connected_type' => 'vieclam_to_ho-tro-dang-ky',
                            'connected_items' => get_queried_object(),
                            'nopaging' => true,
                            'suppress_filters' => false
                        ) );
                    }
                    else {
                        $connected = new WP_Query( array(
                            'connected_type' => 'vieclam_to_xkld',
                            'connected_items' => get_queried_object(),
                            'nopaging' => true,
                            'suppress_filters' => false
                        ) );
                    }

                    while ( $connected->have_posts() ) : $connected->the_post();
                        $company_name = get_the_title();
                    endwhile;
                    wp_reset_postdata();

                    //$date = date('Y/m/d');
                    $today = date("Y-m-d");
                    $deadline = date("Y-m-d", strtotime(get_field('募集期限')));
                    $difference_date = strtotime($deadline) - strtotime($today);

                    ?>

                    <h1>
                        <?php if( time() - strtotime(get_the_time('d.m.Y')) < 604800 ): ?>
                            <span class="new">NEW</span>
                        <?php endif; ?>
                        <?php the_title(); ?>
                    </h1>
                    <div class="row01 clearfix">
                        <div class="note-skillSearch order-details">
                            <!--<?php $tuision =  get_field('無料授業'); if( $tuision){ ?><div class="note-freeClass"><?php the_field('無料授業'); ?></div><?php } ?>-->
                            <?php
                            if ( $visa_s ) {
                                if ($visa_slug == 'thuc-tap-sinh')
                                    echo '<div class="item-note-skill note-skill01">' . $visa_name . '</div>';
                                elseif ($visa_slug == 'ky-nang-dac-dinh-viet-nam')
                                    echo '<div class="item-note-skill note-skill02">' . $visa_name . '</div>';
                                else {
                                    echo '<div class="item-note-skill note-skill03">' . $visa_name . '</div>';
                                }
                            } ?>
                        </div>

                        <?php
                        $page_url = get_the_permalink($post->ID);
                        if($difference_date >= 0){
                            ?>
                            <p class="date01"><?php echo $var['deadline'] . ': '; ?> <?php the_field('募集期限'); ?><span class="btn-fb"><a href="http://www.facebook.com/share.php?u=<?php echo $page_url; ?>" onclick="window.open(encodeURI(decodeURI(this.href)), 'FBwindow', 'width=554, height=470, menubar=no, toolbar=no, scrollbars=yes'); return false;" rel="nofollow">Chia sẻ</a></span></p>
                            <ul class="list-btn01">
                                <?php
                                if ( ! is_user_logged_in() ) {?>
                                    <li class="button button-m button-blue"><a href="<?php echo home_url('/login'); ?>?redirect_to=<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php echo $var['vieclam_apply']; ?></a></li>
                                    <li><a class="login-xkld" href="<?php echo home_url('/login');?>"><?php _e('[:vi]Đăng nhập[:jp]ログイン'); ?></a></li>
                                    <?php
                                }else{?>
                                    <li class="button button-m button-blue"><a href="<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php echo $var['vieclam_apply']; ?></a></li>
                                    <?php
                                    echo '<li>';
                                    echo do_shortcode('[favorite_button]');
                                    echo '</li>';
                                    ?>
                                <?php }
                                ?>
                            </ul>
                        <?php }else{ ?>
                            <p><?php echo $var['vieclam_expired']; ?></p>
                        <?php } ?>

                        <?php
                        $field = get_field_object( '月給' );
                        $value = $field['value'];
                        $salary = $field['choices'][ $value ] . '/tháng';
                        ?>

                        <?php
                        if( have_rows('salary') ):
                            while ( have_rows('salary') ) : the_row();
                                if (get_sub_field('salary_type') == 1) {
                                    $sub_field = get_sub_field_object( 'hourly_salary' );
                                    $salary_type = '/giờ';
                                }
                                if (get_sub_field('salary_type') == 2) {
                                    $sub_field = get_sub_field_object( 'daily_salary' );
                                    $salary_type = '/ngày';
                                }
                                if (get_sub_field('salary_type') == 3) {
                                    $sub_field = get_sub_field_object( 'monthly_salary' );
                                    $salary_type = '/tháng';
                                }
                                $value = $sub_field['value'];
                                if (get_sub_field('salary_remark')) $salary_remark =  ' (' . get_sub_field('salary_remark') . ')';
                            endwhile;
                            $salary_tg = $sub_field['choices'][ $value ] . $salary_type;
                        endif;

                        if( have_rows('salary_increase_and_bonus') ):
                            while ( have_rows('salary_increase_and_bonus') ) : the_row();
                                if (get_sub_field('salary_increase')) {
                                    $salary_increase = get_sub_field( 'salary_increase' );
                                }
                                if (get_sub_field('bonus')) {
                                    $bonus = get_sub_field( 'bonus' );
                                }
                                if (get_sub_field('salary_increase_and_bonus_remark')) $salary_increase_and_bonus_remark =  ' (' . get_sub_field('salary_increase_and_bonus_remark') . ')';
                            endwhile;
                        endif;
                        ?>

                    </div>
                    <div class="row02 skill-search-detail">
                        <ul class="ul01">
                            <li>
                                <?php echo $var['occupation'] . ': '; ?>
                                <?php
                                    echo $occupation_name;
                                    if (next($occupation_s)) {
                                        echo ', ';
                                    }
                                ?>
                            </li>
                            <li><?php echo $var['area'] . ': '; ?> <?php the_field('勤務地'); ?></li>
                            <li>
                                <?php echo $var['salary'] . ': '; ?>
                                <?php
                                if ($visa_slug == 'thuc-tap-sinh') echo esc_html($salary);
                                else {
                                    echo esc_html($salary_tg);
                                    if ($salary_remark) echo $salary_remark;
                                }
                                ?>
                            </li>
                            <?php
                            if ( $visa_s ) {
                                echo '<li class="skill">' . $var['visa_type'] . ': ' . $visa_name .'</li>';
                            }
                            ?>
                            <!--
						<?php
                            $tuision =  get_field('無料授業');
                            if( $tuision) { ?>
                            <li class="free-class"><?php the_field('無料授業'); ?></li>
                        <?php } ?>
						-->
                        </ul>
                    </div>

                    <?php if ($connected->have_posts()) : ?>
                    <div class="sec01 box-df01 clearfix">
                        <?php
                        $auto_add_image = get_field( 'auto_add_image' );
                        while ( $connected->have_posts() ) : $connected->the_post();
                            ?>
                            <?php
                            if($visa_slug == 'thuc-tap-sinh') $image = get_field('ロゴ画像');
                            else $image = get_field('htdk_logo');
                            $alt = $image['alt'];
                            ?>
                            <p class="img01"><img alt="<?php echo $alt; ?>" src="<?php echo $image['url']; ?>"></p>
                            <div class="col01">
                                <ul class="ul01">
                                    <li><?php echo $var['vieclam_company']; ?></li>
                                    <li><a href="<?php the_permalink(); ?>"><?php echo $company_name; ?></a></li>
                                </ul>
                                <?php
                                if($visa_slug == 'thuc-tap-sinh') $url = get_field('サイトurl');
                                else $url = get_field('htdk_url');
                                ?>
                                <p class="link01"><a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a></p>
                                <?php if(get_field('ランキングを表示') && $visa_slug == 'thuc-tap-sinh'): ?>
                                    <div class="rate">VAMAS RANKING
                                        <?php
                                            get_template_part('template-parts/parts', 'ranking');
                                            echo '<p>' . $var['ranking_note'] . '</p>';
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <ul class="ul02">
                                    <li><?php echo $var['address'] . ': '; ?></li>
                                    <?php
                                    if ($visa_slug == 'thuc-tap-sinh' && get_the_terms( $post->ID, 'area_tag' )) $location_s = get_the_terms( $post->ID, 'area_tag' );
                                    if ($visa_slug != 'thuc-tap-sinh' && get_the_terms( $post->ID, 'htdk_area_tag' )) $location_s = get_the_terms( $post->ID, 'htdk_area_tag' );
                                    if($location_s){
                                        foreach($location_s as $location){
                                            echo '<li> ' . $location->name . '</li>';
                                            if(next($location_s)){
                                                echo ' / ';
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                    <?php endif; ?>

                    <div class="sec02 box-df">
                        <div class="box-df-inner">
                            <?php if($auto_add_image != 'n') : ?>
                                <h2 class="h2-style01"><?php echo $var['vieclam_info']; ?></h2>
                                <ul class="ul01 clearfix">
                                    <?php
                                    $auto_image_size = get_medium_size_image_vieclam();
                                    foreach(array(1, 2, 3) as $value) : ?>
                                        <?php
                                        $filename1 = $occupation_slug . '-' . '0' . $value . '-' . $auto_image_size . '.jpg';
                                        $filename2 = $occupation_slug  . '-' . '0' . $value . '-' . $auto_image_size . '.png';

                                        $auto_image1 = get_url_image_vieclam($filename1);
                                        $auto_image2 = get_url_image_vieclam($filename2);

                                        $auto_base_image1 = get_path_image_vieclam($filename1);
                                        $auto_base_image2 = get_path_image_vieclam($filename2);

                                        if (file_exists($auto_base_image1)) {
                                            $auto_image = $auto_image1;
                                            $auto_base_image = $auto_image1;
                                        }
                                        elseif (file_exists($auto_base_image2)) {
                                            $auto_image = $auto_image2;
                                            $auto_base_image = $auto_image2;
                                        }
                                        else {
                                            $auto_image = '';
                                            $auto_base_image = '';
                                        }
                                        ?>
                                        <?php if($auto_image) : ?>
                                            <li><a class="single-xkld-slides03" rel="group03" href="<?php echo esc_url($auto_image); ?>" data-fancybox="gallery03"><img alt="<?php echo $job->name; ?>" src="<?php echo esc_url($auto_image); ?>"></a></li>
                                        <?php endif; ?>
                                    <?php endforeach;
                                    ?>
                                </ul>
                            <?php endif; ?>

                            <?php if(have_rows('イメージ画像') && $auto_add_image != 'y'): ?>
                                <h2 class="h2-style01"><?php echo $var['vieclam_info']; ?></h2>
                                <ul class="ul01 clearfix">
                                    <?php if( have_rows('イメージ画像') ): while( have_rows('イメージ画像') ): the_row(); ?>
                                        <?php
                                        $image = get_sub_field('画像');
                                        $size = 'single-image';
                                        $thumb = $image['sizes'][ $size ];
                                        $alt = $image['alt'];
                                        ?>
                                        <li><a class="single-xkld-slides03" rel="group03" href="<?php echo esc_url($thumb); ?>" data-fancybox="gallery03"><img alt="<?php echo $alt; ?>" src="<?php echo esc_url($thumb); ?>"></a></li>

                                    <?php endwhile; endif; ?>
                                </ul>
                            <?php endif; ?>

                            <div class="list-dl01">
                                <dl class="clearfix">
                                    <dt><?php echo $var['vieclam_des'] = 'Nội dung công việc'; ?></dt>
                                    <dd><?php the_field('仕事内容'); ?></dd>
                                </dl>
                                <dl class="clearfix">
                                    <dt><?php echo $var['vieclam_required']; ?></dt>
                                    <dd>
                                        <?php
                                        if ( $visa_s ) {
                                            echo '<dl class="clearfix">';
                                                echo '<dt>' . $var['visa_type'] . '</dt>';
                                                echo '<dd>'. $visa_name . '</dd>';
                                            echo '</dl>';
                                        }
                                        ?>
                                        <dl class="clearfix">
                                            <dt><?php echo $var['area']; ?></dt>
                                            <dd><?php the_field('勤務地'); ?></dd>
                                        </dl>
                                        <?php if ($visa_slug != 'thuc-tap-sinh' && get_field('work_by')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['vieclam_workby']; ?></dt>
                                                <dd><?php the_field('work_by'); ?></dd>
                                            </dl>
                                        <?php endif; ?>
                                        <dl class="clearfix">
                                            <dt><?php echo $var['occupation']; ?></dt>
                                            <dd>
                                                <?php
                                                if ( $occupation_s ) {
                                                    echo $occupation_name;
                                                    if(next($occupation_s)){
                                                        echo ', ';
                                                    }
                                                }
                                                ?>
                                            </dd>
                                        </dl>
                                        <?php if ($visa_slug != 'thuc-tap-sinh' && get_field('type_of_employment')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['vieclam_recruit_form']; ?></dt>
                                                <dd><?php the_field('type_of_employment'); ?></dd>
                                            </dl>
                                        <?php endif; ?>
                                        <?php if ($visa_slug == 'thuc-tap-sinh') : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['time']; ?></dt>
                                                <dd><?php
                                                    if(get_field('研修期間')){
                                                        echo get_field('研修期間') . ' ' . $var['year_lower'];
                                                    };
                                                    ?> </dd>
                                            </dl>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['age']; ?></dt>
                                                <dd><?php
                                                    if(get_field('年齢')){
                                                        echo get_field('年齢') . ' ' . $var['age_lower'];
                                                    };
                                                    ?></dd>
                                            </dl>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['gender']; ?></dt>
                                                <dd><?php the_field('性別'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('資格')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['qualification']; ?></dt>
                                                <dd><?php the_field('資格'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('japanese_level')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['japanese_level']; ?></dt>
                                                <dd><?php the_field('japanese_level'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('その他の条件')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['other_conditions']; ?></dt>
                                                <dd><?php the_field('その他の条件'); ?></dd>
                                            </dl>
                                        <?php endif; ?>
                                    </dd>
                                </dl>

                                <dl class="clearfix">
                                    <dt>
                                        <?php echo $var['salary']; ?>
                                        <span><br></span><?php echo $var['vieclam_welfare_insurance']; ?>
                                    </dt>
                                    <dd>
                                        <dl class="clearfix">
                                            <dt><?php echo $var['vieclam_salary_base']; ?></dt>
                                            <dd>
                                                <p>
                                                    <?php
                                                    if ($visa_slug == 'thuc-tap-sinh') {
                                                        echo esc_html($salary) . ' ' . $var['vieclam_tax_included'];
                                                    }
                                                    else {
                                                        echo esc_html($salary_tg);
                                                        echo esc_html($salary_remark);
                                                    }
                                                    ?>
                                                    <?php ?>
                                                </p>
                                            </dd>
                                        </dl>
                                        <?php if ($visa_slug != 'thuc-tap-sinh' && have_rows('salary_increase_and_bonus')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['vieclam_salary_increase_bonus']; ?></dt>
                                                <dd>
                                                    <?php
                                                    echo $var['vieclam_salary_increase'] . ': ' . $salary_increase;
                                                    echo '- ' . $var['vieclam_salary_bonus'] . ': ' . $bonus;
                                                    echo '<br />' . $salary_increase_and_bonus_remark;
                                                    ?>
                                                </dd>
                                            </dl>
                                        <?php endif; ?>
                                        <?php if($visa_slug == 'thuc-tap-sinh' && get_field('3年間で貯金できる目安金額')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['vieclam_money_saved']; ?></dt>
                                                <dd><?php
                                                    echo get_field('3年間で貯金できる目安金額');
                                                    echo ' VND';
                                                    ?> </dd>
                                            </dl>
                                        <?php endif; ?>

                                        <dl class="clearfix">
                                            <dt><?php echo $var['vieclam_insurance']; ?></dt>
                                            <dd><?php the_field('福利厚生'); ?></dd>
                                        </dl>
                                        <dl class="clearfix">
                                            <dt><?php echo $var['vieclam_workingtime']; ?></dt>
                                            <dd><?php the_field('労働時間'); ?></dd>
                                        </dl>
                                        <dl class="clearfix">
                                            <dt><?php echo $var['vieclam_holyday']; ?></dt>
                                            <dd><?php the_field('年間休日'); ?></dd>
                                        </dl>
                                        <dl class="clearfix">
                                            <dt><?php echo $var['vieclam_other']; ?></dt>
                                            <dd><?php the_field('tab_salary_その他の条件'); ?></dd>
                                        </dl>
                                    </dd>
                                </dl>
                                <dl class="clearfix spec01">
                                    <dt><?php echo $var['vieclam_schedule']; ?></dt>
                                    <dd>
                                        <?php if (get_field('登録期限')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['vieclam_registration_deadline']; ?></dt>
                                                <dd><?php the_field('登録期限'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('面接日程')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['vieclam_interview']; ?></dt>
                                                <dd><?php the_field('面接日程'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('就業開始予定日')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['vieclam_start_work']; ?></dt>
                                                <dd><?php the_field('就業開始予定日'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('募集人数')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['vieclam_applicants']; ?></dt>
                                                <dd><?php
                                                    echo get_field('募集人数') .' ' . $var['people'];
                                                    ?> </dd>
                                            </dl>
                                        <?php endif; ?>
                                        <dl class="clearfix">
                                            <dt><?php echo $var['vieclam_interview_form']; ?></dt>
                                            <dd><?php the_field('面接方法'); ?></dd>
                                        </dl>
                                    </dd>
                                </dl>

                                <?php
                                if($difference_date >= 0){
                                    ?>
                                    <ul class="list-btn01 clearfix">
                                        <?php
                                        if ( ! is_user_logged_in() ) {?>
                                            <li class="button button-m button-blue"><a href="<?php echo home_url('/login');?>"><?php echo $var['vieclam_apply']; ?></a></li>
                                            <li><a class="login-xkld" href="<?php echo home_url('/login');?>"><?php echo $var['login'];; ?></a></li>
                                            <?php
                                        }else{?>
                                            <li class="button button-m button-blue"><a href="<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php echo $var['vieclam_apply'];; ?></a></li>
                                            <?php
                                            echo '<li>';
                                            echo do_shortcode('[favorite_button]');
                                            echo '</li>';
                                            ?>
                                        <?php }
                                        ?>
                                    </ul>
                                <?php }else{ ?>
                                    <p style="text-align: center;"><?php echo $var['vieclam_expired']; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                <?php
                $args = array(
                    'post_type' => 'vieclam',
                    'meta_query' => array(
                        array(
                            'key' => '募集期限',
                            'value' => date('Y/m/d'),
                            'compare' => '>=',
                            'type' => 'DATE'
                        )
                    ),
                    'tax_query' => array(
                        array(
                            'taxonomy' => $occupation_taxonomy,
                            'field' => 'slug',
                            'terms' => $occupation_slug
                        )
                    ),
                    'posts_per_page' => 9,
                    'post__not_in' => array($post->ID),
                    'orderby' => array(
                        'meta_value_num' => 'DESC'
                    )
                );

                $the_query = new WP_Query($args);
                if(!empty($the_query -> have_posts())): ?>
                    <div class="sec05 job">
                        <h2 class="h2-style01 tag-title"><?php echo $var['vieclam_realted_title']; ?></h2>
                        <ul class="slider-homepage content-loop">
                            <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                                <?php
                                $occupation_s = commonObjects::get_occupations($the_query->post->ID);

                                foreach($occupation_s as $occupation) {
                                    if($occupation->taxonomy == 'recruit_cat') {
                                        $recruit_cat_link = '&recruit_cat=' . $occupation->slug;
                                    }
                                    if($occupation->taxonomy == 'recruit_takecat') {
                                        $recruit_cat_link = '&recruit_take_cat=' . $occupation->slug;
                                    }
                                }
                                ?>
                                <li class="job-box">
                                    <a class="clearfix" href="<?php the_permalink() ?>">
                                        <?php if( time() - strtotime(get_the_time('d.m.Y')) < 604800 ): ?>
                                            <span class="new-mark">new</span>
                                        <?php endif; ?>
                                        <?php

                                        $auto_add_image = get_field('auto_add_image', $the_query->post->ID);

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
                                        <div class="images">
                                            <?php if ($auto_add_image != 'n' && $auto_thumb_image) : ?>
                                                <img style="width:240px;" alt="<?php echo $job->name; ?>" src="<?php echo esc_url($auto_thumb_image); ?>">
                                            <?php else: ?> <?php echo  get_the_post_thumbnail( $the_query->post->ID, array('240' , '175')); ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (has_post_thumbnail() || ($auto_add_image != 'n' && $auto_thumb_image)) : ?>
                                        <div class="content">
                                            <?php else: ?>
                                            <div class="content content-noimage <?php $tuision =  get_field('無料授業', $the_query->post->ID); if( $tuision ){ ?>free-class<?php } ?>">
                                                <?php endif; ?>
                                                <?php if( time() - strtotime(get_the_time('d.m.Y') ) < 604800): ?>
                                                <h2 class="title-new">
                                                    <?php else: ?>
                                                    <h2>
                                                        <?php endif; ?>
                                                        <?php
                                                        if(mb_strlen($the_query->post->post_title)>30) {
                                                            $title= mb_substr($the_query->post->post_title,0,30);
                                                            echo $title . ' ...';
                                                        } else {
                                                            echo $the_query->post->post_title;
                                                        }
                                                        ?>
                                                    </h2>

                                                    <?php
                                                    $field_key = "field_5f0809a259c30";
                                                    $field = get_field_object($field_key, $the_query->post->ID);
                                                    $value = $field['value'];
                                                    if($field['choices'][ $value ]) :
                                                        $salary = $field['choices'][ $value ];
                                                    else:
                                                        if ( have_rows('salary') ) :
                                                            while ( have_rows('salary') ) : the_row();
                                                                if (get_sub_field('salary_type', $the_query->post->ID) == 1) {
                                                                    $sub_field = get_sub_field_object('hourly_salary', $the_query->post->ID );
                                                                    $salary_type = '/giờ';
                                                                }
                                                                if (get_sub_field('salary_type', $the_query->post->ID) == 2) {
                                                                    $sub_field = get_sub_field_object('daily_salary', $the_query->post->ID );
                                                                    $salary_type = '/ngày';
                                                                }
                                                                if (get_sub_field('salary_type', $the_query->post->ID) == 3) {
                                                                    $sub_field = get_sub_field_object('monthly_salary', $the_query->post->ID );
                                                                    $salary_type = '/tháng';
                                                                }
                                                                $value = $sub_field['value'];
                                                                $salary = $sub_field['choices'][ $value ] . $salary_type;
                                                            endwhile;
                                                        endif;
                                                    endif;
                                                    ?>
                                                    <p class="salary"><?php echo esc_html($salary); ?></p>
                                                    <p class="local font-awesome"><?php the_field('勤務地', $the_query->post->ID) ?></p>
                                                    <ul class="occupation font-awesome">
                                                        <?php
                                                            echo  '<li>' . $occupation->name . '</li>';
                                                            if (next($occupation_s)) {
                                                                echo ', ';
                                                            }
                                                        ?>
                                                    </ul>
                                                    <?php $tuision =  get_field('無料授業', $the_query->post->ID); if( $tuision ){ ?>
                                                        <p class="note-freeClass"><?php the_field('無料授業', $the_query->post->ID); ?></p>
                                                    <?php } ?>
                                            </div>
                                    </a>
                                </li>
                            <?php endwhile; ?>

                        </ul>
                        <p class="button button-blue">
                            <a href="<?php echo home_url('/?s=&post_type=vieclam'); ?><?php echo $recruit_cat_link; ?>"><span><?php echo $var['view_more'] ;?></span></a>
                        </p>
                    </div>
                <?php endif; ?>

                    <script type='text/javascript'>
                        <!--//--><![CDATA[//><!--
                        /! This file is auto-generated /
                        !function(c,d){"use strict";var e=!1,n=!1;if(d.querySelector)if(c.addEventListener)e=!0;if(c.wp=c.wp||{},!c.wp.receiveEmbedMessage)if(c.wp.receiveEmbedMessage=function(e){var t=e.data;if(t)if(t.secret||t.message||t.value)if(!/[^a-zA-Z0-9]/.test(t.secret)){for(var r,a,i,s=d.querySelectorAll('iframe[data-secret="'+t.secret+'"]'),n=d.querySelectorAll('blockquote[data-secret="'+t.secret+'"]'),o=0;o<n.length;o++)n[o].style.display="none";for(o=0;o<s.length;o++)if(r=s[o],e.source===r.contentWindow){if(r.removeAttribute("style"),"height"===t.message){if(1e3<(i=parseInt(t.value,10)))i=1e3;else if(~~i<200)i=200;r.height=i}if("link"===t.message)if(a=d.createElement("a"),i=d.createElement("a"),a.href=r.getAttribute("src"),i.href=t.value,i.host===a.host)if(d.activeElement===r)c.top.location.href=t.value}}},e)c.addEventListener("message",c.wp.receiveEmbedMessage,!1),d.addEventListener("DOMContentLoaded",t,!1),c.addEventListener("load",t,!1);function t(){if(!n){n=!0;for(var e,t,r=-1!==navigator.appVersion.indexOf("MSIE 10"),a=!!navigator.userAgent.match(/Trident.*rv:11./),i=d.querySelectorAll("iframe.wp-embedded-content"),s=0;s<i.length;s++){if(!(e=i[s]).getAttribute("data-secret"))t=Math.random().toString(36).substr(2,10),e.src+="#?secret="+t,e.setAttribute("data-secret",t);if(r||a)(t=e.cloneNode(!0)).removeAttribute("security"),e.parentNode.replaceChild(t,e)}}}}(window,document);
                        //--><!]]>
                    </script>
                    <div class="blog-box box-df">
                        <div class="box-df-inner">
                            <div class="section-blog">
                                <h2 class="section-title"><i class="fa fa-comments"></i><span>お仕事インタビューレポート</span></h2>
                                <p>当社グループ企業が運営するクチコミ・企業レポート "Visicomi Global"より、日本に住む外国人留学生が募集職種のインタビューレポートをお届けします。<br/><small>"Visicomi Global"とは、日本に住む外国人留学生が実際に日本の企業に訪問して直接インタビューして、感想・フィードバックを発信する企業口コミコンテンツです。</small></p>

                            </div>
                            <div class="content-blog-get">
                                <div class="blog-get">
                                    <iframe sandbox="allow-scripts" security="restricted" src="https://intetour.jp/global/vi/corp/sgs-seiko-2/embed/" width="600" height="400" title="&#8220;東豊製菓株式会社&#8221; &#8212; visicomiglobal" frameborder="0" marginwidth="0" marginheight="0" scrolling="auto" class="wp-embedded-content"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if ($connected->have_posts()) : ?>
                    <div class="sec01 box-df01 clearfix">
                        <?php
                        $auto_add_image = get_field( 'auto_add_image' );
                        while ( $connected->have_posts() ) : $connected->the_post();
                            ?>
                            <?php
                            if($visa_slug == 'thuc-tap-sinh') $image = get_field('ロゴ画像');
                            else $image = get_field('htdk_logo');
                            $alt = $image['alt'];
                            ?>
                            <p class="img01"><img alt="<?php echo $alt; ?>" src="<?php echo $image['url']; ?>"></p>
                            <div class="col01">
                                <ul class="ul01">
                                    <li><?php echo $var['vieclam_company']; ?></li>
                                    <li><a href="<?php the_permalink(); ?>"><?php echo $company_name; ?></a></li>
                                </ul>
                                <?php
                                if($visa_slug == 'thuc-tap-sinh') $url = get_field('サイトurl');
                                else $url = get_field('htdk_url');
                                ?>
                                <p class="link01"><a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a></p>
                                <?php if(get_field('ランキングを表示') && $visa_slug == 'thuc-tap-sinh'): ?>
                                    <div class="rate">VAMAS RANKING
                                        <?php
                                            get_template_part('template-parts/parts', 'ranking');
                                            echo '<p>' . $var['ranking_note'] . '</p>';
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <ul class="ul02">
                                    <li><?php echo $var['address'] . ': '; ?></li>
                                    <?php
                                    if ($visa_slug == 'thuc-tap-sinh' && get_the_terms( $post->ID, 'area_tag' )) $location = get_the_terms( $post->ID, 'area_tag' );
                                    if ($visa_slug != 'thuc-tap-sinh' && get_the_terms( $post->ID, 'htdk_area_tag' )) $location = get_the_terms( $post->ID, 'htdk_area_tag' );
                                    if($location){
                                        foreach($location as $location_item){
                                            echo '<li> ' . $location_item->name . '</li>';
                                            if(next($location)){
                                                echo ' / ';
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                    <?php endif; ?>

                    <div class="top-views">
                        <h2 class="h2-style01 tag-title"><?php echo $var['vieclam_views_title'];?></h2>
                        <?php
                            $tearn_visa = 'thuc-tap-sinh';
                            include 'template-parts/vieclam-related-visa-item.php';
                            $tearn_visa = 'ky-nang-dac-dinh-viet-nam';
                            include 'template-parts/vieclam-related-visa-item.php';
                            $tearn_visa = 'ky-nang-dac-dinh-nhat-ban';
                            include 'template-parts/vieclam-related-visa-item.php';
                        ?>
                    </div>

                    <div class="sec04 box-df">
                        <div class="box-df-inner">
                            <h2 class="h2-style01"><?php echo $var['vieclam_apply_method']; ?></h2>
                            <div class="list-dl01">
                                <?php
                                $args = array(
                                    'connected_type' => 'vieclam_to_entry',
                                    'connected_items' => get_queried_object(),
                                    'nopaging' => true,
                                    'suppress_filters' => false
                                );
                                $connected_posts = get_posts( $args );
                                foreach ( $connected_posts as $post ):
                                    setup_postdata( $post );
                                    ?>
                                    <dl class="clearfix">

                                        <dd><?php the_field('応募方法'); ?></dd>
                                    </dl>
                                    <dl class="clearfix">
                                        <dt><?php echo $var['vieclam_apply_method']; ?></dt>
                                        <dd><?php the_field('応募受付後の連絡'); ?></dd>
                                    </dl>
                                    <dl class="clearfix">
                                        <dt><?php echo $var['vieclam_recruit_schedule']; ?></dt>
                                        <dd>
                                            <?php if( have_rows('採用プロセス') ): while( have_rows('採用プロセス') ): $i++; the_row(); ?>

                                                <p class="ttl01">STEP<?php echo $i; ?></p>
                                                <p class="txt01"><?php the_sub_field('ステップ'); ?></p>

                                            <?php endwhile; endif; ?>
                                        </dd>
                                    </dl>

                                    <?php
                                    wp_reset_postdata();
                                endforeach;
                                ?>
                                <?php
                                if($difference_date >= 0){
                                    ?>
                                    <ul class="list-btn01 clearfix">
                                        <?php
                                        if ( ! is_user_logged_in() ) {?>
                                            <li class="button button-m button-blue"><a href="<?php echo home_url('/login');?>"><?php echo $var['vieclam_apply']; ?></a></li>
                                            <li><a class="login-xkld" href="<?php echo home_url('/login');?>"><?php echo $var['login']; ?></a></li>
                                            <?php
                                        }else{?>
                                            <li class="button button-m button-blue"><a href="<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php echo $var['vieclam_apply']; ?></a></li>
                                            <?php
                                            echo '<li>';
                                            echo do_shortcode('[favorite_button]');
                                            echo '</li>';
                                            ?>
                                        <?php }
                                        ?>
                                    </ul>
                                <?php }else{ ?>
                                    <p style="text-align: center;"><?php echo $var['vieclam_expired']; ?></p>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                <?php endwhile; endif; ?>
                <?php //Form ứng tuyển đơn hàng cố định khi trượt
                if($difference_date >= 0){
                ?>
                <div id="apply-bar" class="hidden-xs">
                    <div class="wrap">
                        <div class="row01">
                            <div class="note-skillSearch order-details">
                                <?php
                                while ( $connected->have_posts() ) : $connected->the_post();
                                    ?>
                                    <p class="apply-bar-company">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </p>
                                <?php
                                endwhile;
                                wp_reset_postdata();
                                ?>

                                <p class="apply-bar-jobtitle">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </p>
                            </div>
                            <ul class="list-btn01">
                                <?php
                                if ( ! is_user_logged_in() ) {?>
                                    <li class="button button-m button-blue"><a href="<?php echo home_url('/login'); ?>?redirect_to=<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php echo $var['vieclam_apply']; ?></a></li>
                                    <li><a class="login-xkld" href="<?php echo home_url('/login');?>"><?php echo $var['login']; ?></a></li>
                                    <?php
                                }else{?>
                                    <li class="button button-m button-blue"><a href="<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php echo $var['vieclam_apply']; ?></a></li>
                                    <?php
                                    echo '<li>';
                                    echo do_shortcode('[favorite_button]');
                                    echo '</li>';
                                    ?>
                                <?php }
                                ?>
                            </ul>

                            <?php }else{ ?>
                                <p><?php echo $var['vieclam_deadline']; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div><!-- /main -->
            <?php do_action('xeory_append_wrap'); ?>
        </div><!-- /wrap -->

        <div class="sec06">
            <div class="box-inner">
                <h2><?php echo $var['vieclam_apply_q']; ?></h2>
                <div class="box01-child">
                    <?php echo $var['vieclam_apply_a']; ?>
                </div>
                <?php
                if($visa_slug == 'thuc-tap-sinh') $company_type_name = 'xkld_name';
                else $company_type_name = 'htdk_name';
                ?>
                <p class="btn01"><a href="<?php echo home_url('/inquiry_vieclam'); ?>?post_id=<?php echo $post->ID; ?>&<?php echo $company_type_name; ?>=<?php echo $company_name; ?>"><?php echo $var['view_detail'];?></a></p>
            </div>
        </div>

        <div class="sec07">
            <div class="box-inner">
                <h2><?php echo $var['labor_policy']; ?></h2>
                <div class="box01-child"><?php echo $var['labor_policy_note']; ?></div>
                <p class="btn01"><a href="<?php echo home_url('/about'); ?>"><?php echo $var['view_detail']; ?></a></p>
            </div>
        </div>

        <?php do_action('xeory_append_content'); ?>
    </div><!-- /content -->
<?php get_footer(); ?>