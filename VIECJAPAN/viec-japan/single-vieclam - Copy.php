<?php get_header(); ?>
    <div id="content">
        <?php do_action('xeory_prepend_content'); ?>
        <div class="wrap">
            <?php do_action('xeory_prepend_wrap'); ?>
            <?php bzb_breadcrumb(); ?>
            <div id="main" <?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
                <?php
                $visa_s = get_the_terms( $post->ID, 'visa' );
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

                    if(get_the_terms( $post->ID, 'recruit_cat' )) {
                        $job_taxonomy = 'recruit_cat';
                        $jobs = get_the_terms( $post->ID, 'recruit_cat' );
                    }
                    if(get_the_terms( $post->ID, 'recruit_tokuteigino_cat' )) {
                        $job_taxonomy = 'recruit_tokuteigino_cat';
                        $jobs = get_the_terms( $post->ID, 'recruit_tokuteigino_cat' );
                    }

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
                            <p class="date01"><?php _e('[:vi]Hạn ứng tuyển: [:jp]在留資格: '); ?> <?php the_field('募集期限'); ?><span class="btn-fb"><a href="http://www.facebook.com/share.php?u=<?php echo $page_url; ?>" onclick="window.open(encodeURI(decodeURI(this.href)), 'FBwindow', 'width=554, height=470, menubar=no, toolbar=no, scrollbars=yes'); return false;" rel="nofollow">Chia sẻ</a></span></p>
                            <ul class="list-btn01">
                                <?php
                                if ( ! is_user_logged_in() ) {?>
                                    <li class="button button-m button-blue"><a href="<?php echo home_url('/login'); ?>?redirect_to=<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php _e('[:vi]Ứng tuyển[:jp]応募'); ?></a></li>
                                    <li><a class="login-xkld" href="<?php echo home_url('/login');?>"><?php _e('[:vi]Đăng nhập[:jp]ログイン'); ?></a></li>
                                    <?php
                                }else{?>
                                    <li class="button button-m button-blue"><a href="<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php _e('[:vi]Ứng tuyển[:jp]応募'); ?></a></li>
                                    <?php
                                    echo '<li>';
                                    echo do_shortcode('[favorite_button]');
                                    echo '</li>';
                                    ?>
                                <?php }
                                ?>
                            </ul>
                        <?php }else{ ?>
                            <p><?php _e('[:vi]Công việc này đã hết hạn [:jp]この求人期限が終了'); ?></p>
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
                                <?php _e('[:vi]Ngành nghề: [:jp]職種から探す:'); ?>
                                <?php
                                if ( $jobs ) {
                                    foreach($jobs as $job){
                                        echo $job->name;
                                    }
                                    if (next($jobs)) {
                                        echo ', ';
                                    }
                                }
                                ?>
                            </li>
                            <li><?php _e('[:vi]Địa điểm: [:jp]勤務地から探す:'); ?> <?php the_field('勤務地'); ?></li>
                            <li>
                                <?php _e('[:vi]Mức lương: [:jp]給与から探す: '); ?>
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
                                echo '<li class="skill">';
                                _e('[:vi]Tư cách lưu trú: [:jp]在留資格: ');
                                echo ' ' . $visa_name;
                                echo '</li>';
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
                                    <li><?php _e('[:vi]Đơn hàng tuyển dụng công ty phái cử [:jp]送り出し機関名'); ?></li>
                                    <li><a href="<?php the_permalink(); ?>"><?php echo $company_name; ?></a></li>
                                </ul>
                                <?php
                                if($visa_slug == 'thuc-tap-sinh') $url = get_field('サイトurl');
                                else $url = get_field('htdk_url');
                                ?>
                                <p class="link01"><a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a></p>
                                <?php if(get_field('ランキングを表示') && $visa_slug == 'thuc-tap-sinh'): ?>
                                    <div class="rate">VAMAS RANKING
                                        <?php get_template_part('template-parts/parts', 'ranking'); ?>
                                        <p>Bảng xếp hạng do Hiệp hội phái cử lao động Việt Nam ở nước ngoài (VAMAS) công bố</p>
                                    </div>
                                <?php endif; ?>
                                <ul class="ul02">
                                    <li><?php _e('[:vi]Địa chỉ: [:jp]住所: '); ?></li>
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

                    <div class="sec02 box-df">
                        <div class="box-df-inner">
                            <?php if($auto_add_image != 'n') : ?>
                                <h2 class="h2-style01"><?php _e('[:vi]Thông tin đơn hàng [:jp]求人情報'); ?></h2>
                                <ul class="ul01 clearfix">
                                    <?php
                                    $auto_image_size = get_medium_size_image_vieclam();
                                    foreach(array(1, 2, 3) as $value) : ?>
                                        <?php
                                        $filename1 = $job->slug . '-' . '0' . $value . '-' . $auto_image_size . '.jpg';
                                        $filename2 = $job->slug . '-' . '0' . $value . '-' . $auto_image_size . '.png';

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
                                <h2 class="h2-style01"><?php _e('[:vi]Thông tin đơn hàng [:jp]求人情報'); ?></h2>
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
                                    <dt><?php _e('[:vi]Nội dung công việc [:jp]仕事内容'); ?></dt>
                                    <dd><?php the_field('仕事内容'); ?></dd>
                                </dl>
                                <dl class="clearfix">
                                    <dt><?php _e('[:vi]Yêu cầu ứng tuyển [:jp]募集要項'); ?></dt>
                                    <dd>
                                        <?php
                                        if ( $visa_s ) {
                                            echo '<dl class="clearfix">';
                                            echo '<dt>';
                                            _e('[:vi]Tư cách lưu trú [:jp]在留資格');
                                            echo '</dt>';
                                            echo '<dd>'. $visa_name . '</dd>';
                                            echo '</dl>';
                                        }
                                        ?>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]Địa điểm [:jp]勤務地から探す'); ?></dt>
                                            <dd><?php the_field('勤務地'); ?></dd>
                                        </dl>
                                        <?php if ($visa_slug != 'thuc-tap-sinh' && get_field('work_by')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Hình tức di chuyển [:jp]'); ?></dt>
                                                <dd><?php the_field('work_by'); ?></dd>
                                            </dl>
                                        <?php endif; ?>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]Ngành nghề[:jp]職種から探す'); ?></dt>
                                            <dd>
                                                <?php
                                                if ( $jobs ) {
                                                    foreach($jobs as $job){
                                                        echo $job->name;
                                                    }
                                                    if(next($jobs)){
                                                        echo ', ';
                                                    }
                                                }
                                                ?>
                                            </dd>
                                        </dl>
                                        <?php if ($visa_slug != 'thuc-tap-sinh' && get_field('type_of_employment')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Hình tức tuyển dụng [:jp]'); ?></dt>
                                                <dd><?php the_field('type_of_employment'); ?></dd>
                                            </dl>
                                        <?php endif; ?>
                                        <?php if ($visa_slug == 'thuc-tap-sinh') : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Thời gian [:jp]研修期間'); ?></dt>
                                                <dd><?php
                                                    if(get_field('研修期間')){
                                                        echo get_field('研修期間') . ' ';
                                                        _e('[:vi]năm [:jp]年');
                                                    };
                                                    ?> </dd>
                                            </dl>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Tuổi [:jp]年齢'); ?></dt>
                                                <dd><?php
                                                    if(get_field('年齢')){
                                                        echo get_field('年齢') . ' ';
                                                        _e('[:vi]tuổi [:jp]年齢');
                                                    };
                                                    ?></dd>
                                            </dl>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Giới tính [:jp]性別'); ?></dt>
                                                <dd><?php the_field('性別'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('資格')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Trình độ [:jp]資格'); ?></dt>
                                                <dd><?php the_field('資格'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('japanese_level')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Trình độ tiếng Nhật [:jp]'); ?></dt>
                                                <dd><?php the_field('japanese_level'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('その他の条件')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Yêu cầu khác [:jp]その他の条件'); ?></dt>
                                                <dd><?php the_field('その他の条件'); ?></dd>
                                            </dl>
                                        <?php endif; ?>
                                    </dd>
                                </dl>

                                <dl class="clearfix">
                                    <dt><?php _e('[:vi]Mức lương [:jp]給与条件'); ?><span><br></span><?php _e('[:vi]Phúc lợi - Bảo hiểm [:jp]福利厚生'); ?></dt>
                                    <dd>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]Lương cơ bản (chưa có tăng ca) [:jp]基本月給(残業除く)'); ?></dt>
                                            <dd>
                                                <p>
                                                    <?php
                                                    if ($visa_slug == 'thuc-tap-sinh') {
                                                        echo esc_html($salary) . ' ';
                                                        _e('[:vi](Đã bao gồm thuế) [:jp](税込)');
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
                                                <dt><?php _e('[:vi]Tăng lương, thưởng [:jp]'); ?></dt>
                                                <dd>
                                                    <?php
                                                    echo 'Tăng lương: ' . $salary_increase;
                                                    echo ' - Thưởng: ' . $bonus;
                                                    echo '<br />' . $salary_increase_and_bonus_remark;
                                                    ?>
                                                </dd>
                                            </dl>
                                        <?php endif; ?>
                                        <?php if($visa_slug == 'thuc-tap-sinh' && get_field('3年間で貯金できる目安金額')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Số tiền tích lũy sau 3 năm [:jp]3年間で貯金できる目安金額'); ?></dt>
                                                <dd><?php
                                                    echo get_field('3年間で貯金できる目安金額');
                                                    echo ' VND';
                                                    ?> </dd>
                                            </dl>
                                        <?php endif; ?>

                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]Bảo hiểm [:jp]福利厚生'); ?></dt>
                                            <dd><?php the_field('福利厚生'); ?></dd>
                                        </dl>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]Thời gian làm việc [:jp]労働時間'); ?></dt>
                                            <dd><?php the_field('労働時間'); ?></dd>
                                        </dl>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]Ngày nghỉ trong năm [:jp]年間休日'); ?></dt>
                                            <dd><?php the_field('年間休日'); ?></dd>
                                        </dl>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]Ngoài ra [:jp]その他の条件'); ?></dt>
                                            <dd><?php the_field('tab_salary_その他の条件'); ?></dd>
                                        </dl>
                                    </dd>
                                </dl>
                                <dl class="clearfix spec01">
                                    <dt><?php _e('[:vi]Lịch trình tham gia [:jp]参加日程'); ?></dt>
                                    <dd>
                                        <?php if (get_field('登録期限')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Thời hạn đăng ký [:jp]登録期限'); ?></dt>
                                                <dd><?php the_field('登録期限'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('面接日程')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Phỏng vấn [:jp]面接日程'); ?></dt>
                                                <dd><?php the_field('面接日程'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('就業開始予定日')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Xuất cảnh dự kiến [:jp]就業開始予定日'); ?></dt>
                                                <dd><?php the_field('就業開始予定日'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('募集人数')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Số người ứng tuyển [:jp]募集人数'); ?></dt>
                                                <dd><?php
                                                    echo get_field('募集人数') .' ';
                                                    _e('[:vi] người [:jp]人');
                                                    ?> </dd>
                                            </dl>
                                        <?php endif; ?>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]Hình thức phỏng vấn [:jp]面接方法'); ?></dt>
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
                                            <li class="button button-m button-blue"><a href="<?php echo home_url('/login');?>"><?php _e('[:vi]Ứng tuyển[:jp]応募'); ?></a></li>
                                            <li><a class="login-xkld" href="<?php echo home_url('/login');?>"><?php _e('[:vi]Đăng nhập[:jp]ログイン'); ?></a></li>
                                            <?php
                                        }else{?>
                                            <li class="button button-m button-blue"><a href="<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php _e('[:vi]Ứng tuyển[:jp]応募'); ?></a></li>
                                            <?php
                                            echo '<li>';
                                            echo do_shortcode('[favorite_button]');
                                            echo '</li>';
                                            ?>
                                        <?php }
                                        ?>
                                    </ul>
                                <?php }else{ ?>
                                    <p style="text-align: center;"><?php _e('[:vi]Công việc này đã quá hạn [:jp]この求人期限が終了'); ?></p>
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
                            'taxonomy' => $job_taxonomy,
                            'field' => 'slug',
                            'terms' => $job->slug
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
                        <h2 class="h2-style01 tag-title"><?php _e('[:vi]Những đơn hàng cùng ngành nghề [:jp]よく見られる求人'); ?></h2>
                        <ul class="slider-homepage content-loop">
                            <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                                <?php
                                if(get_the_terms( $the_query->post->ID, 'recruit_cat' )) $jobs = get_the_terms( $the_query->post->ID, 'recruit_cat' );
                                if(get_the_terms( $the_query->post->ID, 'recruit_tokuteigino_cat' )) {$jobs = get_the_terms( $the_query->post->ID, 'recruit_tokuteigino_cat' );}
                                foreach($jobs as $job) {
                                    if($job->taxonomy == 'recruit_cat') {
                                        $recruit_cat_link = '&recruit_cat=' . $job->slug;
                                    }
                                    if($job->taxonomy == 'recruit_takecat') {
                                        $recruit_cat_link = '&recruit_take_cat=' . $job->slug;
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
                                                        if ( $jobs ) {
                                                            foreach($jobs as $job){
                                                                echo  '<li>' . $job->name . '</li>';
                                                            }
                                                            if (next($jobs)) {
                                                                echo ', ';
                                                            }
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
                            <a href="<?php echo home_url('/?s=&post_type=vieclam'); ?><?php echo $recruit_cat_link; ?>"><span><?php _e('[:vi]Xem thêm [:jp]もっと見る');?></span></a>
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
                                    <li><?php _e('[:vi]Đơn hàng tuyển dụng công ty phái cử [:jp]送り出し機関名'); ?></li>
                                    <li><a href="<?php the_permalink(); ?>"><?php echo $company_name; ?></a></li>
                                </ul>
                                <?php
                                if($visa_slug == 'thuc-tap-sinh') $url = get_field('サイトurl');
                                else $url = get_field('htdk_url');
                                ?>
                                <p class="link01"><a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a></p>
                                <?php if(get_field('ランキングを表示') && $visa_slug == 'thuc-tap-sinh'): ?>
                                    <div class="rate">VAMAS RANKING
                                        <?php get_template_part('template-parts/parts', 'ranking'); ?>
                                        <p>Bảng xếp hạng do Hiệp hội phái cử lao động Việt Nam ở nước ngoài (VAMAS) công bố</p>
                                    </div>
                                <?php endif; ?>
                                <ul class="ul02">
                                    <li><?php _e('[:vi]Địa chỉ: [:jp]住所: '); ?></li>
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

                    <div class="top-views">
                        <h2 class="h2-style01 tag-title"><?php _e('[:vi]Những đơn hàng xem nhiều [:jp]よく見られる求人');?></h2>
                        <div class="sec03">
                            <h3 class="section-subtitle"><?php _e('[:vi]Thực tập sinh [:jp]技能実習生');?></h3>
                            <ul class="ul02 clearfix">
                                <?php
                                $args1 = array(
                                    'post_type' => 'vieclam',
                                    'posts_per_page' => 6,
                                    'post__not_in' => array($post->ID),
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
                                            'terms' => 'thuc-tap-sinh'
                                        )
                                    )
                                );

                                $the_query1 = new WP_Query($args1); if($the_query1->have_posts()):
                                    ?>
                                    <?php while ($the_query1->have_posts()): $the_query1->the_post(); ?>
                                    <?php
                                    if(get_the_terms( $the_query1->post->ID, 'recruit_cat' )) {$jobs_b = get_the_terms( $the_query1->post->ID, 'recruit_cat' );}
                                    foreach($jobs_b as $job){
                                        $job_name = $job->name;
                                        $job_slug = $job->slug;
                                    }
                                    ?>
                                    <li>
                                        <a href="<?php the_permalink() ?>">
                                            <?php if( time() - strtotime(get_the_time('d.m.Y')) < 604800 ): ?>
                                                <span class="new-mark">new</span>
                                            <?php endif; ?>

                                            <?php
                                            $auto_add_image = get_field('auto_add_image', $the_query1->post->ID);
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
                                            <div class="img-df">
                                                <?php if ($auto_add_image != 'n' && $auto_thumb_image) : ?>
                                                    <img style="width:240px;" alt="<?php echo $job_name; ?>" src="<?php echo esc_url($auto_thumb_image); ?>">
                                                <?php else: ?> <?php echo  get_the_post_thumbnail( $the_query1->post->ID, array('240' , '175')); ?>
                                                <?php endif; ?>
                                            </div>

                                            <p class="ttl01">
                                                <?php
                                                if(mb_strlen($the_query1->post->post_title)>30) {
                                                    $title= mb_substr($the_query1->post->post_title,0,30) ;
                                                    echo $title . ' ...';
                                                } else {
                                                    echo $the_query1->post->post_title;
                                                }
                                                ?>
                                            </p>
                                            <?php
                                            $field_key = "field_5f0809a259c30";
                                            $field = get_field_object($field_key, $the_query1->post->ID);
                                            $value = $field['value'];
                                            $salary = $field['choices'][ $value ] . '/tháng';
                                            ?>
                                            <p class="price"><?php echo esc_html($salary); ?></p>
                                            <ul class="ul03 clearfix">
                                                <li><?php the_field('勤務地', $the_query1->post->ID) ?></li>
                                                <?php
                                                if ( $jobs_b ) {
                                                    echo '<li>' . $job_name . '</li>';
                                                    if (next($jobs_b)) {
                                                        echo ', ';
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                <?php endif; ?>
                            </ul>
                            <?php
                            $visa_tts = 'thuc-tap-sinh';
                                include 'template-parts/vieclam-related-visa-item.php';
                            //get_template_part('template-parts/vieclam', 'related-visa-item');
                                ?>
                        </div>

                        <?php $args2 = array(
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
                                    'terms' => 'ky-nang-dac-dinh-viet-nam'
                                )
                            )
                        );
                        $the_query2 = new WP_Query($args2); if($the_query2->have_posts()): ?>
                            <div class="sec03">
                                <h3 class="section-subtitle"><?php _e('[:vi]Kỹ năng đặc định (Việt Nam) [:jp]特定技能（ベトナム在住者向け)');?></h3>
                                <ul class="ul02 clearfix">
                                    <?php while ($the_query2->have_posts()): $the_query2->the_post(); ?>
                                        <?php
                                        if(get_the_terms( $post->ID, 'recruit_tokuteigino_cat' )) {$jobs_b = get_the_terms( $the_query2->post->ID, 'recruit_tokuteigino_cat' );}
                                        foreach($jobs_b as $job){
                                            $job_name = $job->name;
                                            $job_slug = $job->slug;
                                        }
                                        ?>
                                        <li>
                                            <a href="<?php the_permalink() ?>">
                                                <?php if( time() - strtotime(get_the_time('d.m.Y')) < 604800 ): ?>
                                                    <span class="new-mark">new</span>
                                                <?php endif; ?>
                                                <?php
                                                //$auto_image_size = get_small_size_image_vieclam();
                                                $auto_add_image = get_field('auto_add_image', $the_query2->post->ID);
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
                                                <div class="img-df">
                                                    <?php if ($auto_add_image != 'n' && $auto_thumb_image) : ?>
                                                        <img style="width:240px;" alt="<?php echo $job_name; ?>" src="<?php echo esc_url($auto_thumb_image); ?>">
                                                    <?php else: ?> <?php echo  get_the_post_thumbnail( $the_query2->post->ID, array('240' , '175')); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <p class="ttl01">
                                                    <?php
                                                    if(mb_strlen($the_query2->post->post_title)>25) {
                                                        $title= mb_substr($the_query2->post->post_title,0,25) ;
                                                        echo $title . ' ...';
                                                    } else {
                                                        echo $the_query2->post->post_title;
                                                    }
                                                    ?>
                                                </p>
                                                <?php
                                                if ( have_rows('salary') ) :
                                                    while ( have_rows('salary') ) : the_row();
                                                        if (get_sub_field('salary_type', $the_query2->post->ID) == 1) {
                                                            $sub_field = get_sub_field_object( 'hourly_salary', $the_query2->post->ID );
                                                            $salary_type = '/giờ';
                                                        }
                                                        if (get_sub_field('salary_type', $the_query2->post->ID) == 2) {
                                                            $sub_field = get_sub_field_object( 'daily_salary', $the_query2->post->ID );
                                                            $salary_type = '/ngày';
                                                        }
                                                        if (get_sub_field('salary_type', $the_query2->post->ID) == 3) {
                                                            $sub_field = get_sub_field_object( 'monthly_salary', $the_query2->post->ID );
                                                            $salary_type = '/tháng';
                                                        }
                                                        $value = $sub_field['value'];
                                                    endwhile;
                                                    $salary_tg_vn = $sub_field['choices'][ $value ] . $salary_type;
                                                endif;
                                                ?>
                                                <p class="price"><?php echo esc_html($salary_tg_vn); ?></p>
                                                <ul class="ul03 clearfix">
                                                    <li><?php the_field('勤務地', $the_query2->post->ID) ?></li>
                                                    <?php
                                                    if ( $jobs_b ) {
                                                        echo '<li>' . $job_name . '</li>';
                                                        if (next($jobs_b)) {
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

                        <?php $args3 = array(
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
                                    'terms' => 'ky-nang-dac-dinh-nhat-ban'
                                )
                            )
                        );
                        $the_query3 = new WP_Query($args3); if($the_query3->have_posts()): ?>
                            <div class="sec03">
                                <h3 class="section-subtitle"><?php _e('[:vi]Kỹ năng đặc định (Nhật Bản) [:jp]特定技能（日本在住者向け)');?></h3>
                                <ul class="ul02 clearfix">
                                    <?php while ($the_query3->have_posts()): $the_query3->the_post(); ?>
                                        <?php
                                        if(get_the_terms( $post->ID, 'recruit_tokuteigino_cat' )) {$jobs_b = get_the_terms( $the_query3->post->ID, 'recruit_tokuteigino_cat' );}
                                        foreach($jobs_b as $job){
                                            $job_name = $job->name;
                                            $job_slug = $job->slug;
                                        }
                                        ?>
                                        <li>
                                            <a href="<?php the_permalink() ?>">
                                                <?php if( time() - strtotime(get_the_time('d.m.Y')) < 604800 ): ?>
                                                    <span class="new-mark">new</span>
                                                <?php endif; ?>
                                                <?php
                                                $auto_add_image = get_field('auto_add_image', $the_query3->post->ID);
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
                                                <div class="img-df">
                                                    <?php if ($auto_add_image != 'n' && $auto_thumb_image) : ?>
                                                        <img style="width:240px;" alt="<?php echo $job_name; ?>" src="<?php echo esc_url($auto_thumb_image); ?>">
                                                    <?php else: ?> <?php echo  get_the_post_thumbnail( $the_query3->post->ID, array('240' , '175')); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <p class="ttl01">
                                                    <?php
                                                    if(mb_strlen($the_query3->post->post_title)>30) {
                                                        $title= mb_substr($the_query3->post->post_title,0,30) ;
                                                        echo $title . ' ...';
                                                    } else {
                                                        echo $the_query3->post->post_title;
                                                    }
                                                    ?>
                                                </p>
                                                <?php
                                                if ( have_rows('salary') ) :
                                                    while ( have_rows('salary') ) : the_row();
                                                        if (get_sub_field('salary_type', $the_query3->post->ID) == 1) {
                                                            $sub_field = get_sub_field_object( 'hourly_salary', $the_query3->post->ID );
                                                            $salary_type = '/giờ';
                                                        }
                                                        if (get_sub_field('salary_type', $the_query3->post->ID) == 2) {
                                                            $sub_field = get_sub_field_object( 'daily_salary', $the_query3->post->ID );
                                                            $salary_type = '/ngày';
                                                        }
                                                        if (get_sub_field('salary_type', $the_query3->post->ID) == 3) {
                                                            $sub_field = get_sub_field_object( 'monthly_salary', $the_query3->post->ID );
                                                            $salary_type = '/tháng';
                                                        }
                                                        $value = $sub_field['value'];
                                                    endwhile;
                                                    $salary_tg_jp = $sub_field['choices'][ $value ] . $salary_type;
                                                endif;
                                                ?>
                                                <p class="price"><?php echo esc_html($salary_tg_jp); ?></p>
                                                <ul class="ul03 clearfix">
                                                    <li><?php the_field('勤務地', $the_query3->post->ID) ?></li>
                                                    <?php
                                                    if ( $jobs_b ) {
                                                        echo '<li>' . $job_name . '</li>';
                                                        if (next($jobs_b)) {
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
                    </div>

                    <div class="sec04 box-df">
                        <div class="box-df-inner">
                            <h2 class="h2-style01"><?php _e('[:vi]Phương pháp ứng tuyển [:jp]応募方法'); ?></h2>
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
                                        <dt><?php _e('[:vi]Thông tin liên lạc sau khi ứng tuyển [:jp]応募受付後の連絡'); ?></dt>
                                        <dd><?php the_field('応募受付後の連絡'); ?></dd>
                                    </dl>
                                    <dl class="clearfix">
                                        <dt><?php _e('[:vi]Quy trình tuyển dụng [:jp]採用プロセス'); ?></dt>
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
                                            <li class="button button-m button-blue"><a href="<?php echo home_url('/login');?>"><?php _e('[:vi]Ứng tuyển[:jp]応募'); ?></a></li>
                                            <li><a class="login-xkld" href="<?php echo home_url('/login');?>"><?php _e('[:vi]Đăng nhập[:jp]ログイン'); ?></a></li>
                                            <?php
                                        }else{?>
                                            <li class="button button-m button-blue"><a href="<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php _e('[:vi]Ứng tuyển[:jp]応募'); ?></a></li>
                                            <?php
                                            echo '<li>';
                                            echo do_shortcode('[favorite_button]');
                                            echo '</li>';
                                            ?>
                                        <?php }
                                        ?>
                                    </ul>
                                <?php }else{ ?>
                                    <p style="text-align: center;"><?php _e('[:vi]Công việc này đã quá hạn [:jp]この求人期限が終了'); ?></p>
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
                                    <li class="button button-m button-blue"><a href="<?php echo home_url('/login'); ?>?redirect_to=<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php _e('[:vi]Ứng tuyển[:jp]応募'); ?></a></li>
                                    <li><a class="login-xkld" href="<?php echo home_url('/login');?>"><?php _e('[:vi]Đăng nhập[:jp]ログイン'); ?></a></li>
                                    <?php
                                }else{?>
                                    <li class="button button-m button-blue"><a href="<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php _e('[:vi]Ứng tuyển[:jp]応募'); ?></a></li>
                                    <?php
                                    echo '<li>';
                                    echo do_shortcode('[favorite_button]');
                                    echo '</li>';
                                    ?>
                                <?php }
                                ?>
                            </ul>

                            <?php }else{ ?>
                                <p><?php _e('[:vi]Công việc này đã hết hạn [:jp]この求人期限が終了'); ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div><!-- /main -->
            <?php do_action('xeory_append_wrap'); ?>
        </div><!-- /wrap -->

        <div class="sec06">
            <div class="box-inner">
                <h2><?php _e('[:vi]Bạn có khúc mắc trong quá trình ứng tuyển [:jp]この求人期限が終了'); ?></h2>
                <div class="box01-child">
                    <?php _e('[:vi]Nếu bạn có bất kỳ mối quan tâm về công việc này hoặc muốn biết thêm thông tin, xin vui lòng liên hệ với chúng tôi bằng cách sử dụng mẫu dưới đây. Nhân viên của chúng tôi sẽ trả lời. 
			[:jp]この求人について「気になる点がある」「もっと詳しく知りたい」という場合は、下記のフォームよりお問い合わせください。弊社のスタッフより返信いたします。'); ?>
                </div>
                <?php
                if($visa_slug == 'thuc-tap-sinh') $company_type_name = 'xkld_name';
                else $company_type_name = 'htdk_name';
                ?>
                <p class="btn01"><a href="<?php echo home_url('/inquiry_vieclam'); ?>?post_id=<?php echo $post->ID; ?>&<?php echo $company_type_name; ?>=<?php echo $company_name; ?>"><?php _e('[:vi]Xem chi tiết [:jp]詳しく見る');?></a></p>
            </div>
        </div>

        <div class="sec07">
            <div class="box-inner">
                <h2>Chế độ lao động tại Nhật Bản</h2>
                <div class="box01-child">Đây là một dự án phát triển nguồn nhân lực quốc tế do chính phủ Nhật Bản thành lập. Với mục đích giúp nguồn nhân lực tiếp thu công nghệ trình độ cao và đào tạo nhân tài mong muốn dẫn dắt sự phát triển của đất nước đó. Từ tháng 11 năm 2017 "phương pháp đào tạo kỹ năng" được thi hành và bắt đầu triển khai với chế độ lao động người nước ngoài.</div>
                <p class="btn01"><a href="<?php echo home_url('/about'); ?>">Xem chi tiết</a></p>
            </div>
        </div>

        <?php do_action('xeory_append_content'); ?>
    </div><!-- /content -->
<?php get_footer(); ?>