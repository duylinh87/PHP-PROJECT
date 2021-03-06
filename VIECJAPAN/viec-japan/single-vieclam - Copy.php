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
                    $deadline = date("Y-m-d", strtotime(get_field('????????????')));
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
                            <!--<?php $tuision =  get_field('????????????'); if( $tuision){ ?><div class="note-freeClass"><?php the_field('????????????'); ?></div><?php } ?>-->
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
                            <p class="date01"><?php _e('[:vi]H???n ???ng tuy???n: [:jp]????????????: '); ?> <?php the_field('????????????'); ?><span class="btn-fb"><a href="http://www.facebook.com/share.php?u=<?php echo $page_url; ?>" onclick="window.open(encodeURI(decodeURI(this.href)), 'FBwindow', 'width=554, height=470, menubar=no, toolbar=no, scrollbars=yes'); return false;" rel="nofollow">Chia s???</a></span></p>
                            <ul class="list-btn01">
                                <?php
                                if ( ! is_user_logged_in() ) {?>
                                    <li class="button button-m button-blue"><a href="<?php echo home_url('/login'); ?>?redirect_to=<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php _e('[:vi]???ng tuy???n[:jp]??????'); ?></a></li>
                                    <li><a class="login-xkld" href="<?php echo home_url('/login');?>"><?php _e('[:vi]????ng nh???p[:jp]????????????'); ?></a></li>
                                    <?php
                                }else{?>
                                    <li class="button button-m button-blue"><a href="<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php _e('[:vi]???ng tuy???n[:jp]??????'); ?></a></li>
                                    <?php
                                    echo '<li>';
                                    echo do_shortcode('[favorite_button]');
                                    echo '</li>';
                                    ?>
                                <?php }
                                ?>
                            </ul>
                        <?php }else{ ?>
                            <p><?php _e('[:vi]C??ng vi???c n??y ???? h???t h???n [:jp]???????????????????????????'); ?></p>
                        <?php } ?>

                        <?php
                        $field = get_field_object( '??????' );
                        $value = $field['value'];
                        $salary = $field['choices'][ $value ] . '/th??ng';
                        ?>

                        <?php
                        if( have_rows('salary') ):
                            while ( have_rows('salary') ) : the_row();
                                if (get_sub_field('salary_type') == 1) {
                                    $sub_field = get_sub_field_object( 'hourly_salary' );
                                    $salary_type = '/gi???';
                                }
                                if (get_sub_field('salary_type') == 2) {
                                    $sub_field = get_sub_field_object( 'daily_salary' );
                                    $salary_type = '/ng??y';
                                }
                                if (get_sub_field('salary_type') == 3) {
                                    $sub_field = get_sub_field_object( 'monthly_salary' );
                                    $salary_type = '/th??ng';
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
                                <?php _e('[:vi]Ng??nh ngh???: [:jp]??????????????????:'); ?>
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
                            <li><?php _e('[:vi]?????a ??i???m: [:jp]?????????????????????:'); ?> <?php the_field('?????????'); ?></li>
                            <li>
                                <?php _e('[:vi]M???c l????ng: [:jp]??????????????????: '); ?>
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
                                _e('[:vi]T?? c??ch l??u tr??: [:jp]????????????: ');
                                echo ' ' . $visa_name;
                                echo '</li>';
                            }
                            ?>
                            <!--
						<?php
                            $tuision =  get_field('????????????');
                            if( $tuision) { ?>
                            <li class="free-class"><?php the_field('????????????'); ?></li>
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
                            if($visa_slug == 'thuc-tap-sinh') $image = get_field('????????????');
                            else $image = get_field('htdk_logo');
                            $alt = $image['alt'];
                            ?>
                            <p class="img01"><img alt="<?php echo $alt; ?>" src="<?php echo $image['url']; ?>"></p>
                            <div class="col01">
                                <ul class="ul01">
                                    <li><?php _e('[:vi]????n h??ng tuy???n d???ng c??ng ty ph??i c??? [:jp]?????????????????????'); ?></li>
                                    <li><a href="<?php the_permalink(); ?>"><?php echo $company_name; ?></a></li>
                                </ul>
                                <?php
                                if($visa_slug == 'thuc-tap-sinh') $url = get_field('?????????url');
                                else $url = get_field('htdk_url');
                                ?>
                                <p class="link01"><a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a></p>
                                <?php if(get_field('????????????????????????') && $visa_slug == 'thuc-tap-sinh'): ?>
                                    <div class="rate">VAMAS RANKING
                                        <?php get_template_part('template-parts/parts', 'ranking'); ?>
                                        <p>B???ng x???p h???ng do Hi???p h???i ph??i c??? lao ?????ng Vi???t Nam ??? n?????c ngo??i (VAMAS) c??ng b???</p>
                                    </div>
                                <?php endif; ?>
                                <ul class="ul02">
                                    <li><?php _e('[:vi]?????a ch???: [:jp]??????: '); ?></li>
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
                                <h2 class="h2-style01"><?php _e('[:vi]Th??ng tin ????n h??ng [:jp]????????????'); ?></h2>
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

                            <?php if(have_rows('??????????????????') && $auto_add_image != 'y'): ?>
                                <h2 class="h2-style01"><?php _e('[:vi]Th??ng tin ????n h??ng [:jp]????????????'); ?></h2>
                                <ul class="ul01 clearfix">
                                    <?php if( have_rows('??????????????????') ): while( have_rows('??????????????????') ): the_row(); ?>
                                        <?php
                                        $image = get_sub_field('??????');
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
                                    <dt><?php _e('[:vi]N???i dung c??ng vi???c [:jp]????????????'); ?></dt>
                                    <dd><?php the_field('????????????'); ?></dd>
                                </dl>
                                <dl class="clearfix">
                                    <dt><?php _e('[:vi]Y??u c???u ???ng tuy???n [:jp]????????????'); ?></dt>
                                    <dd>
                                        <?php
                                        if ( $visa_s ) {
                                            echo '<dl class="clearfix">';
                                            echo '<dt>';
                                            _e('[:vi]T?? c??ch l??u tr?? [:jp]????????????');
                                            echo '</dt>';
                                            echo '<dd>'. $visa_name . '</dd>';
                                            echo '</dl>';
                                        }
                                        ?>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]?????a ??i???m [:jp]?????????????????????'); ?></dt>
                                            <dd><?php the_field('?????????'); ?></dd>
                                        </dl>
                                        <?php if ($visa_slug != 'thuc-tap-sinh' && get_field('work_by')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]H??nh t???c di chuy???n [:jp]'); ?></dt>
                                                <dd><?php the_field('work_by'); ?></dd>
                                            </dl>
                                        <?php endif; ?>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]Ng??nh ngh???[:jp]??????????????????'); ?></dt>
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
                                                <dt><?php _e('[:vi]H??nh t???c tuy???n d???ng [:jp]'); ?></dt>
                                                <dd><?php the_field('type_of_employment'); ?></dd>
                                            </dl>
                                        <?php endif; ?>
                                        <?php if ($visa_slug == 'thuc-tap-sinh') : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Th???i gian [:jp]????????????'); ?></dt>
                                                <dd><?php
                                                    if(get_field('????????????')){
                                                        echo get_field('????????????') . ' ';
                                                        _e('[:vi]n??m [:jp]???');
                                                    };
                                                    ?> </dd>
                                            </dl>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Tu???i [:jp]??????'); ?></dt>
                                                <dd><?php
                                                    if(get_field('??????')){
                                                        echo get_field('??????') . ' ';
                                                        _e('[:vi]tu???i [:jp]??????');
                                                    };
                                                    ?></dd>
                                            </dl>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Gi???i t??nh [:jp]??????'); ?></dt>
                                                <dd><?php the_field('??????'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('??????')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Tr??nh ????? [:jp]??????'); ?></dt>
                                                <dd><?php the_field('??????'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('japanese_level')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Tr??nh ????? ti???ng Nh???t [:jp]'); ?></dt>
                                                <dd><?php the_field('japanese_level'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('??????????????????')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Y??u c???u kh??c [:jp]??????????????????'); ?></dt>
                                                <dd><?php the_field('??????????????????'); ?></dd>
                                            </dl>
                                        <?php endif; ?>
                                    </dd>
                                </dl>

                                <dl class="clearfix">
                                    <dt><?php _e('[:vi]M???c l????ng [:jp]????????????'); ?><span><br></span><?php _e('[:vi]Ph??c l???i - B???o hi???m [:jp]????????????'); ?></dt>
                                    <dd>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]L????ng c?? b???n (ch??a c?? t??ng ca) [:jp]????????????(????????????)'); ?></dt>
                                            <dd>
                                                <p>
                                                    <?php
                                                    if ($visa_slug == 'thuc-tap-sinh') {
                                                        echo esc_html($salary) . ' ';
                                                        _e('[:vi](???? bao g???m thu???) [:jp](??????)');
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
                                                <dt><?php _e('[:vi]T??ng l????ng, th?????ng [:jp]'); ?></dt>
                                                <dd>
                                                    <?php
                                                    echo 'T??ng l????ng: ' . $salary_increase;
                                                    echo ' - Th?????ng: ' . $bonus;
                                                    echo '<br />' . $salary_increase_and_bonus_remark;
                                                    ?>
                                                </dd>
                                            </dl>
                                        <?php endif; ?>
                                        <?php if($visa_slug == 'thuc-tap-sinh' && get_field('3????????????????????????????????????')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]S??? ti???n t??ch l??y sau 3 n??m [:jp]3????????????????????????????????????'); ?></dt>
                                                <dd><?php
                                                    echo get_field('3????????????????????????????????????');
                                                    echo ' VND';
                                                    ?> </dd>
                                            </dl>
                                        <?php endif; ?>

                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]B???o hi???m [:jp]????????????'); ?></dt>
                                            <dd><?php the_field('????????????'); ?></dd>
                                        </dl>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]Th???i gian l??m vi???c [:jp]????????????'); ?></dt>
                                            <dd><?php the_field('????????????'); ?></dd>
                                        </dl>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]Ng??y ngh??? trong n??m [:jp]????????????'); ?></dt>
                                            <dd><?php the_field('????????????'); ?></dd>
                                        </dl>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]Ngo??i ra [:jp]??????????????????'); ?></dt>
                                            <dd><?php the_field('tab_salary_??????????????????'); ?></dd>
                                        </dl>
                                    </dd>
                                </dl>
                                <dl class="clearfix spec01">
                                    <dt><?php _e('[:vi]L???ch tr??nh tham gia [:jp]????????????'); ?></dt>
                                    <dd>
                                        <?php if (get_field('????????????')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Th???i h???n ????ng k?? [:jp]????????????'); ?></dt>
                                                <dd><?php the_field('????????????'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('????????????')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Ph???ng v???n [:jp]????????????'); ?></dt>
                                                <dd><?php the_field('????????????'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('?????????????????????')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]Xu???t c???nh d??? ki???n [:jp]?????????????????????'); ?></dt>
                                                <dd><?php the_field('?????????????????????'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('????????????')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php _e('[:vi]S??? ng?????i ???ng tuy???n [:jp]????????????'); ?></dt>
                                                <dd><?php
                                                    echo get_field('????????????') .' ';
                                                    _e('[:vi] ng?????i [:jp]???');
                                                    ?> </dd>
                                            </dl>
                                        <?php endif; ?>
                                        <dl class="clearfix">
                                            <dt><?php _e('[:vi]H??nh th???c ph???ng v???n [:jp]????????????'); ?></dt>
                                            <dd><?php the_field('????????????'); ?></dd>
                                        </dl>
                                    </dd>
                                </dl>

                                <?php
                                if($difference_date >= 0){
                                    ?>
                                    <ul class="list-btn01 clearfix">
                                        <?php
                                        if ( ! is_user_logged_in() ) {?>
                                            <li class="button button-m button-blue"><a href="<?php echo home_url('/login');?>"><?php _e('[:vi]???ng tuy???n[:jp]??????'); ?></a></li>
                                            <li><a class="login-xkld" href="<?php echo home_url('/login');?>"><?php _e('[:vi]????ng nh???p[:jp]????????????'); ?></a></li>
                                            <?php
                                        }else{?>
                                            <li class="button button-m button-blue"><a href="<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php _e('[:vi]???ng tuy???n[:jp]??????'); ?></a></li>
                                            <?php
                                            echo '<li>';
                                            echo do_shortcode('[favorite_button]');
                                            echo '</li>';
                                            ?>
                                        <?php }
                                        ?>
                                    </ul>
                                <?php }else{ ?>
                                    <p style="text-align: center;"><?php _e('[:vi]C??ng vi???c n??y ???? qu?? h???n [:jp]???????????????????????????'); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                <?php
                $args = array(
                    'post_type' => 'vieclam',
                    'meta_query' => array(
                        array(
                            'key' => '????????????',
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
                        <h2 class="h2-style01 tag-title"><?php _e('[:vi]Nh???ng ????n h??ng c??ng ng??nh ngh??? [:jp]????????????????????????'); ?></h2>
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
                                            <div class="content content-noimage <?php $tuision =  get_field('????????????', $the_query->post->ID); if( $tuision ){ ?>free-class<?php } ?>">
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
                                                                    $salary_type = '/gi???';
                                                                }
                                                                if (get_sub_field('salary_type', $the_query->post->ID) == 2) {
                                                                    $sub_field = get_sub_field_object('daily_salary', $the_query->post->ID );
                                                                    $salary_type = '/ng??y';
                                                                }
                                                                if (get_sub_field('salary_type', $the_query->post->ID) == 3) {
                                                                    $sub_field = get_sub_field_object('monthly_salary', $the_query->post->ID );
                                                                    $salary_type = '/th??ng';
                                                                }
                                                                $value = $sub_field['value'];
                                                                $salary = $sub_field['choices'][ $value ] . $salary_type;
                                                            endwhile;
                                                        endif;
                                                    endif;
                                                    ?>
                                                    <p class="salary"><?php echo esc_html($salary); ?></p>
                                                    <p class="local font-awesome"><?php the_field('?????????', $the_query->post->ID) ?></p>
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
                                                    <?php $tuision =  get_field('????????????', $the_query->post->ID); if( $tuision ){ ?>
                                                        <p class="note-freeClass"><?php the_field('????????????', $the_query->post->ID); ?></p>
                                                    <?php } ?>
                                            </div>
                                    </a>
                                </li>
                            <?php endwhile; ?>

                        </ul>
                        <p class="button button-blue">
                            <a href="<?php echo home_url('/?s=&post_type=vieclam'); ?><?php echo $recruit_cat_link; ?>"><span><?php _e('[:vi]Xem th??m [:jp]???????????????');?></span></a>
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
                                <h2 class="section-title"><i class="fa fa-comments"></i><span>???????????????????????????????????????</span></h2>
                                <p>???????????????????????????????????????????????????????????????????????? "Visicomi Global"??????????????????????????????????????????????????????????????????????????????????????????????????????????????????<br/><small>"Visicomi Global"?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</small></p>

                            </div>
                            <div class="content-blog-get">
                                <div class="blog-get">
                                    <iframe sandbox="allow-scripts" security="restricted" src="https://intetour.jp/global/vi/corp/sgs-seiko-2/embed/" width="600" height="400" title="&#8220;????????????????????????&#8221; &#8212; visicomiglobal" frameborder="0" marginwidth="0" marginheight="0" scrolling="auto" class="wp-embedded-content"></iframe>
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
                            if($visa_slug == 'thuc-tap-sinh') $image = get_field('????????????');
                            else $image = get_field('htdk_logo');
                            $alt = $image['alt'];
                            ?>
                            <p class="img01"><img alt="<?php echo $alt; ?>" src="<?php echo $image['url']; ?>"></p>
                            <div class="col01">
                                <ul class="ul01">
                                    <li><?php _e('[:vi]????n h??ng tuy???n d???ng c??ng ty ph??i c??? [:jp]?????????????????????'); ?></li>
                                    <li><a href="<?php the_permalink(); ?>"><?php echo $company_name; ?></a></li>
                                </ul>
                                <?php
                                if($visa_slug == 'thuc-tap-sinh') $url = get_field('?????????url');
                                else $url = get_field('htdk_url');
                                ?>
                                <p class="link01"><a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a></p>
                                <?php if(get_field('????????????????????????') && $visa_slug == 'thuc-tap-sinh'): ?>
                                    <div class="rate">VAMAS RANKING
                                        <?php get_template_part('template-parts/parts', 'ranking'); ?>
                                        <p>B???ng x???p h???ng do Hi???p h???i ph??i c??? lao ?????ng Vi???t Nam ??? n?????c ngo??i (VAMAS) c??ng b???</p>
                                    </div>
                                <?php endif; ?>
                                <ul class="ul02">
                                    <li><?php _e('[:vi]?????a ch???: [:jp]??????: '); ?></li>
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
                        <h2 class="h2-style01 tag-title"><?php _e('[:vi]Nh???ng ????n h??ng xem nhi???u [:jp]????????????????????????');?></h2>
                        <div class="sec03">
                            <h3 class="section-subtitle"><?php _e('[:vi]Th???c t???p sinh [:jp]???????????????');?></h3>
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
                                            'key' => '????????????',
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
                                            $salary = $field['choices'][ $value ] . '/th??ng';
                                            ?>
                                            <p class="price"><?php echo esc_html($salary); ?></p>
                                            <ul class="ul03 clearfix">
                                                <li><?php the_field('?????????', $the_query1->post->ID) ?></li>
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
                                    'key' => '????????????',
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
                                <h3 class="section-subtitle"><?php _e('[:vi]K??? n??ng ?????c ?????nh (Vi???t Nam) [:jp]??????????????????????????????????????????)');?></h3>
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
                                                            $salary_type = '/gi???';
                                                        }
                                                        if (get_sub_field('salary_type', $the_query2->post->ID) == 2) {
                                                            $sub_field = get_sub_field_object( 'daily_salary', $the_query2->post->ID );
                                                            $salary_type = '/ng??y';
                                                        }
                                                        if (get_sub_field('salary_type', $the_query2->post->ID) == 3) {
                                                            $sub_field = get_sub_field_object( 'monthly_salary', $the_query2->post->ID );
                                                            $salary_type = '/th??ng';
                                                        }
                                                        $value = $sub_field['value'];
                                                    endwhile;
                                                    $salary_tg_vn = $sub_field['choices'][ $value ] . $salary_type;
                                                endif;
                                                ?>
                                                <p class="price"><?php echo esc_html($salary_tg_vn); ?></p>
                                                <ul class="ul03 clearfix">
                                                    <li><?php the_field('?????????', $the_query2->post->ID) ?></li>
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
                                    'key' => '????????????',
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
                                <h3 class="section-subtitle"><?php _e('[:vi]K??? n??ng ?????c ?????nh (Nh???t B???n) [:jp]????????????????????????????????????)');?></h3>
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
                                                            $salary_type = '/gi???';
                                                        }
                                                        if (get_sub_field('salary_type', $the_query3->post->ID) == 2) {
                                                            $sub_field = get_sub_field_object( 'daily_salary', $the_query3->post->ID );
                                                            $salary_type = '/ng??y';
                                                        }
                                                        if (get_sub_field('salary_type', $the_query3->post->ID) == 3) {
                                                            $sub_field = get_sub_field_object( 'monthly_salary', $the_query3->post->ID );
                                                            $salary_type = '/th??ng';
                                                        }
                                                        $value = $sub_field['value'];
                                                    endwhile;
                                                    $salary_tg_jp = $sub_field['choices'][ $value ] . $salary_type;
                                                endif;
                                                ?>
                                                <p class="price"><?php echo esc_html($salary_tg_jp); ?></p>
                                                <ul class="ul03 clearfix">
                                                    <li><?php the_field('?????????', $the_query3->post->ID) ?></li>
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
                            <h2 class="h2-style01"><?php _e('[:vi]Ph????ng ph??p ???ng tuy???n [:jp]????????????'); ?></h2>
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

                                        <dd><?php the_field('????????????'); ?></dd>
                                    </dl>
                                    <dl class="clearfix">
                                        <dt><?php _e('[:vi]Th??ng tin li??n l???c sau khi ???ng tuy???n [:jp]????????????????????????'); ?></dt>
                                        <dd><?php the_field('????????????????????????'); ?></dd>
                                    </dl>
                                    <dl class="clearfix">
                                        <dt><?php _e('[:vi]Quy tr??nh tuy???n d???ng [:jp]??????????????????'); ?></dt>
                                        <dd>
                                            <?php if( have_rows('??????????????????') ): while( have_rows('??????????????????') ): $i++; the_row(); ?>

                                                <p class="ttl01">STEP<?php echo $i; ?></p>
                                                <p class="txt01"><?php the_sub_field('????????????'); ?></p>

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
                                            <li class="button button-m button-blue"><a href="<?php echo home_url('/login');?>"><?php _e('[:vi]???ng tuy???n[:jp]??????'); ?></a></li>
                                            <li><a class="login-xkld" href="<?php echo home_url('/login');?>"><?php _e('[:vi]????ng nh???p[:jp]????????????'); ?></a></li>
                                            <?php
                                        }else{?>
                                            <li class="button button-m button-blue"><a href="<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php _e('[:vi]???ng tuy???n[:jp]??????'); ?></a></li>
                                            <?php
                                            echo '<li>';
                                            echo do_shortcode('[favorite_button]');
                                            echo '</li>';
                                            ?>
                                        <?php }
                                        ?>
                                    </ul>
                                <?php }else{ ?>
                                    <p style="text-align: center;"><?php _e('[:vi]C??ng vi???c n??y ???? qu?? h???n [:jp]???????????????????????????'); ?></p>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                <?php endwhile; endif; ?>
                <?php //Form ???ng tuy???n ????n h??ng c??? ?????nh khi tr?????t
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
                                    <li class="button button-m button-blue"><a href="<?php echo home_url('/login'); ?>?redirect_to=<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php _e('[:vi]???ng tuy???n[:jp]??????'); ?></a></li>
                                    <li><a class="login-xkld" href="<?php echo home_url('/login');?>"><?php _e('[:vi]????ng nh???p[:jp]????????????'); ?></a></li>
                                    <?php
                                }else{?>
                                    <li class="button button-m button-blue"><a href="<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&company_name=<?php echo $company_name; ?>"><?php _e('[:vi]???ng tuy???n[:jp]??????'); ?></a></li>
                                    <?php
                                    echo '<li>';
                                    echo do_shortcode('[favorite_button]');
                                    echo '</li>';
                                    ?>
                                <?php }
                                ?>
                            </ul>

                            <?php }else{ ?>
                                <p><?php _e('[:vi]C??ng vi???c n??y ???? h???t h???n [:jp]???????????????????????????'); ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div><!-- /main -->
            <?php do_action('xeory_append_wrap'); ?>
        </div><!-- /wrap -->

        <div class="sec06">
            <div class="box-inner">
                <h2><?php _e('[:vi]B???n c?? kh??c m???c trong qu?? tr??nh ???ng tuy???n [:jp]???????????????????????????'); ?></h2>
                <div class="box01-child">
                    <?php _e('[:vi]N???u b???n c?? b???t k??? m???i quan t??m v??? c??ng vi???c n??y ho???c mu???n bi???t th??m th??ng tin, xin vui l??ng li??n h??? v???i ch??ng t??i b???ng c??ch s??? d???ng m???u d?????i ????y. Nh??n vi??n c???a ch??ng t??i s??? tr??? l???i. 
			[:jp]??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????'); ?>
                </div>
                <?php
                if($visa_slug == 'thuc-tap-sinh') $company_type_name = 'xkld_name';
                else $company_type_name = 'htdk_name';
                ?>
                <p class="btn01"><a href="<?php echo home_url('/inquiry_vieclam'); ?>?post_id=<?php echo $post->ID; ?>&<?php echo $company_type_name; ?>=<?php echo $company_name; ?>"><?php _e('[:vi]Xem chi ti???t [:jp]???????????????');?></a></p>
            </div>
        </div>

        <div class="sec07">
            <div class="box-inner">
                <h2>Ch??? ????? lao ?????ng t???i Nh???t B???n</h2>
                <div class="box01-child">????y l?? m???t d??? ??n ph??t tri???n ngu???n nh??n l???c qu???c t??? do ch??nh ph??? Nh???t B???n th??nh l???p. V???i m???c ????ch gi??p ngu???n nh??n l???c ti???p thu c??ng ngh??? tr??nh ????? cao v?? ????o t???o nh??n t??i mong mu???n d???n d???t s??? ph??t tri???n c???a ?????t n?????c ????. T??? th??ng 11 n??m 2017 "ph????ng ph??p ????o t???o k??? n??ng" ???????c thi h??nh v?? b???t ?????u tri???n khai v???i ch??? ????? lao ?????ng ng?????i n?????c ngo??i.</div>
                <p class="btn01"><a href="<?php echo home_url('/about'); ?>">Xem chi ti???t</a></p>
            </div>
        </div>

        <?php do_action('xeory_append_content'); ?>
    </div><!-- /content -->
<?php get_footer(); ?>