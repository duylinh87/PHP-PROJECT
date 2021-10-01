<?php get_header(); ?>

<?php if (!is_user_logged_in()) { set_post_views(get_the_ID()); } ?>
<?php
if(get_the_terms( $post->ID, 'area_tag')) {
    $terms = get_the_terms( $post->ID, 'area_tag' );
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
                                echo '<a class="login-xkld" href="'.home_url('/login').'"> '.$var['login'].' </a>';
                            }
                            else {
                                echo do_shortcode('[favorite_button]');
                            }
                            ?>
                        </p>
                        <div class="clearfix sticky-menu">　　
                            <div id="xkld-menu" class="ul01-inner">
                                <ul class="ul01 clearfix">
                                    <?php if (get_field('送り出し機関の概要')) : ?>
                                        <li><a href="#anchor01"><?php echo $var['company_overview']; ?></a></li>
                                    <?php endif; ?>
                                    <li><a href="#anchor02"><?php echo $var['company_performance']; ?></a></li>
                                    <li><a href="#anchor03"><?php echo $var['company_cost']; ?></a></li>
                                    <li><a href="#anchor04"><?php echo $var['company_equipment']; ?></a></li>
                                    <li><a href="#anchor05"><?php echo $var['vieclam']; ?></a></li>
                                </ul>　
                            </div>
                        </div>　
                        <p class="img01"><?php echo get_the_post_thumbnail( $post->ID, 'full')?></p> 　　　　　　
                    </div>

                    <div class="sec01 box-df01 clearfix">
                        <?php
                        $image = get_field('ロゴ画像');
                        $alt = $image['alt'];
                        ?>
                        <p class="img01"><img alt="<?php echo $alt; ?>" src="<?php echo $image['url']; ?>"></p>
                        <div class="col01">
                            <ul class="ul01">
                                <li><?php echo $var['company_xkld_name']; ?></li>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                            </ul>
                            <p class="link01"><a href="<?php the_field('サイトurl'); ?>" target="_blank"><?php the_field('サイトurl'); ?></a></p>

                            <?php if(get_field('ランキングを表示') != ''): ?>
                                <div class="rate">
                                    <span class="ttl">VAMAS RANKING</span>
                                    <div  class="text-info">
                                        <?php if(get_field('ランキングを表示')): ?>
                                            <?php get_template_part('template-parts/parts', 'ranking')?>
                                            <span><?php echo $var['ranking_note']; ?></span>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            <?php endif; ?>

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
                            <?php if(get_field('送り出し実績を表示')): ?>
                                <?php
                                $result_number = get_field('送り出し機関の実績数');
                                if( $result_number ){ ?>
                                    <p class="last-txt"><?php echo $var['company_profile_year']; ?> <?php the_field('実績年'); ?>　<?php the_field('送り出し機関の実績数'); ?> người</p>
                                <?php } ?>
                            <?php endif; ?>
                        </div>

                    </div>

                    <div class="sec02 box-df por01">
                        <p id="anchor01">anchor01</p>
                        <div class="box-df-inner">
                            <?php if (get_field('送り出し機関の概要')) : ?>
                                <h2 class="h2-style01"><?php echo $var['company_overview']; ?></h2>
                                <div class="txt01"><?php the_field('送り出し機関の概要'); ?></div>
                            <?php endif; ?>
                            <div class="list-dl01">
                                <dl class="clearfix">
                                    <dt><?php echo $var['company_info']; ?></dt>
                                    <dd>
                                        <?php if(get_field('ベトナム国内支社')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['company_office']; ?></dt>
                                                <dd><?php the_field('本社住所'); ?></dd>
                                            </dl>
                                        <?php endif; ?>
                                        <?php if (get_field('ベトナム国内支社')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['company_branch']; ?></dt>
                                                <dd><?php the_field('ベトナム国内支社'); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if(get_field('代表者名')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['company_representative']; ?></dt>
                                                <dd>
                                                    <dl class="dl-style01 clearfix">
                                                        <dt><?php the_field('代表者名'); ?></dt>
                                                        <dd><?php the_field('代表者名_備考'); ?></dd>
                                                    </dl>
                                                </dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if(get_field('設立年')): ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['company_establishment_year']; ?></dt>
                                                <dd>
                                                    <dl class="dl-style01 clearfix">
                                                        <dt><?php the_field('設立年'); ?></dt>
                                                        <dd><?php the_field('設立年_備考'); ?></dd>
                                                    </dl>
                                                </dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if(get_field('総従業員数')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['company_employees']; ?></dt>
                                                <dd>
                                                    <dl class="dl-style01 clearfix">
                                                        <?php
                                                        $employee = get_field('総従業員数');
                                                        if($employee){ ?>
                                                            <dt><?php the_field('総従業員数') . ' ' . $var['people'] ; ?></dt>
                                                        <?php } ?>
                                                        <dd><?php the_field('総従業員数_備考'); ?></dd>
                                                    </dl>
                                                </dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if(get_field('日本人教師の数')) : ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['company_japanese_teachers']; ?></dt>
                                                <dd>
                                                    <dl class="dl-style01 clearfix">
                                                        <?php
                                                        $teacher = get_field('日本人教師の数');
                                                        if($teacher){ ?>
                                                            <dt><?php the_field('日本人教師の数') . ' ' . $var['people']; ?></dt>
                                                        <?php } ?>
                                                        <dd><?php the_field('日本人教師の数_備考'); ?></dd>
                                                    </dl>
                                                </dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if(get_field('ランキングを表示')){ ?>
                                            <dl class="clearfix">
                                                <dt>VAMAS RANKING</dt>
                                                <dd><?php get_template_part('template-parts/parts', 'ranking'); ?></dd>
                                            </dl>
                                        <?php } ?>
                                    </dd>
                                </dl>

                                <?php if(get_field('教育方針')){ ?>
                                    <dl class="clearfix">
                                        <dt><?php echo $var['company_educational_policy']; ?></dt>
                                        <dd>
                                            <?php the_field('教育方針'); ?>
                                            <ul class="ul02 clearfix">
                                                <?php if( have_rows('教育方針_画像') ): while( have_rows('教育方針_画像') ): the_row(); ?>

                                                    <?php $image = get_sub_field('画像'); ?>
                                                    <?php
                                                    $image = get_sub_field('画像');
                                                    $size = 'single-image';
                                                    $thumb = $image['sizes'][ $size ];
                                                    $alt = $image['alt'];
                                                    ?>
                                                    <li><a class="single-xkld-slides01" rel="group01" href="<?php echo esc_url($thumb); ?>" data-fancybox="gallery01"><img alt="<?php echo $alt; ?>" src="<?php echo esc_url($thumb); ?>"></a></li>
                                                <?php endwhile; endif; ?>
                                            </ul>

                                        </dd>
                                    </dl>
                                <?php } ?>

                                <dl class="clearfix por01">
                                    <?php if(get_field('実績人数')){ ?>
                                    <dt id="anchor02"></dt>
                                    <dt><?php echo $var['company_performance']; ?></dt>
                                    <dd>
                                        <dl class="clearfix">
                                            <dt><?php echo $var['company_people_number']; ?></dt>
                                            <dd>
                                                <?php
                                                if( have_rows('実績人数') ):

                                                    while( have_rows('実績人数') ) : the_row(); ?>
                                                        <ul class="ul03 clearfix">
                                                            <?php
                                                            $result_year = get_sub_field('年数');
                                                            if($result_year){ ?>
                                                                <li>Năm <?php the_sub_field('年数'); ?> </li>
                                                            <?php }
                                                            $result_number = get_sub_field('人数');
                                                            if($result_number){ ?>
                                                                <li><?php the_sub_field('人数') . ' ' . $var['people']; ?></li>
                                                            <?php } ?>
                                                            <li><?php the_sub_field('備考'); ?></li>
                                                        </ul>
                                                    <?php
                                                    endwhile;

                                                endif;
                                                ?>
                                            </dd>
                                        </dl>
                                        <?php } ?>

                                        <?php if(get_field('送り出した地域')){ ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['company_sending_area']; ?></dt>
                                                <dd><?php the_field('送り出した地域'); ?></dd>
                                            </dl>
                                        <?php } ?>

                                        <?php if(get_field('実績_画像')){ ?>
                                            <dl class="clearfix">
                                                <dd>
                                                    <ul class="ul02 clearfix">
                                                        <?php if( have_rows('実績_画像') ): while( have_rows('実績_画像') ): the_row(); ?>
                                                            <?php $image = get_sub_field('画像'); ?>
                                                            <?php
                                                            $image = get_sub_field('画像');
                                                            $size = 'single-image';
                                                            $thumb = $image['sizes'][ $size ];
                                                            $alt = $image['alt'];
                                                            ?>
                                                            <li><a class="single-xkld-slides02" rel="group02" href="<?php echo esc_url($thumb); ?>" data-fancybox="gallery02"><img alt="<?php echo $alt; ?>" src="<?php echo esc_url($thumb); ?>"></a></li>
                                                        <?php endwhile; endif; ?>
                                                    </ul>
                                                </dd>
                                            </dl>
                                        <?php } ?>
                                    </dd>
                                </dl>

                                <dl class="clearfix por01">
                                    <dt id="anchor03"></dt>
                                    <dt><?php echo $var['company_cost']; ?></dt>
                                    <dd>
                                        <?php
                                        $cost = get_field('費用');
                                        if($cost){ ?>
                                            <p>Từ <?php echo number_format($cost); ?> VND〜</p>
                                        <?php }else{ ?>
                                            <?php echo $var['please_contact']; ?>
                                        <?php } ?>
                                    </dd>
                                </dl>

                                <?php if (get_field('収容人数') || get_field('教育センターの有無')) : ?>
                                    <dl class="clearfix por01">
                                        <dt id="anchor04">anchor04</dt>
                                        <dt><?php echo $var['company_equipment']; ?></dt>
                                        <dd>
                                            <?php if(get_field('収容人数')){ ?>
                                                <dl class="clearfix">
                                                    <dt><?php echo $var['company_capacity']; ?></dt>
                                                    <dd>
                                                        <dl class="clearfix">
                                                            <dt>
                                                                <?php
                                                                $capacity = get_field('収容人数');
                                                                if($capacity){
                                                                    ?>
                                                                    <?php echo $capacity . ' ' . $var['people']; ?>
                                                                <?php } ?>
                                                            </dt>
                                                            <dd><?php the_field('収容人数_備考'); ?></dd>
                                                        </dl>
                                                    </dd>
                                                </dl>
                                            <?php } ?>
                                            <?php $teaching_center = get_field('教育センターの有無'); ?>
                                            <dl class="clearfix">
                                                <dt><?php echo $var['company_education_center']; ?>> </dt>
                                                <dd>
                                                    <p><?php echo $teaching_center; $j=0?></p>
                                                    <?php if($teaching_center): ?>
                                                        <?php if( have_rows('教育センター') ): while( have_rows('教育センター') ): the_row();?>
                                                            <?php if( have_rows('教育センターの住所') ): while( have_rows('教育センターの住所') ): the_row(); $j++ ?>
                                                                <dl class="clearfix">
                                                                    <dt><?php echo $var['address'] . ' ' . $j;?>:</dt>
                                                                    <dd><?php the_sub_field('住所'); ?></dd>
                                                                </dl>
                                                            <?php endwhile; endif; ?>
                                                            <p class="txt02"><?php the_sub_field('教育センターの備考'); ?></p>
                                                        <?php endwhile; endif; ?>
                                                    <?php endif; ?>

                                                </dd>
                                            </dl>

                                            <?php if(get_field('紹介可能な職種')){ ?>
                                                <dl class="clearfix dl-style03">
                                                    <dt><?php echo $var['company_job_intro']; ?>></dt>
                                                    <dd>
                                                        <ul class="ul03">
                                                            <?php
                                                            if (get_field('紹介可能な職種')) {
                                                                $terms = get_field('紹介可能な職種');
                                                                foreach($terms as $term){
                                                                    echo '<li>' . $term->name .  '</li>';
                                                                    if(next($terms)){
                                                                        echo ' , ';
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </dd>
                                                </dl>
                                            <?php } ?>
                                        </dd>
                                    </dl>
                                <?php endif; ?>

                                <?php if(get_field('日本国内の拠点とフォロー体制') || get_field('拠点一覧')) : ?>
                                    <dl class="clearfix last-dl01 hub">
                                        <dt><?php echo $var['company_base_system']; ?></dt>
                                        <dd>
                                            <?php if (get_field('日本国内の拠点とフォロー体制')):?>
                                                <dl>
                                                    <?php the_field('日本国内の拠点とフォロー体制'); ?>
                                                </dl>
                                            <?php endif; ?>

                                            <?php if(get_field('拠点一覧')){ ?>
                                                <dl class="clearfix dl-style04">
                                                    <dt><?php echo $var['company_list_base']; ?>></dt>
                                                    <dd>
                                                        <ul>
                                                            <?php
                                                            if( have_rows('拠点一覧') ):
                                                                while( have_rows('拠点一覧') ) : the_row();
                                                                    ?><li><?php
                                                                    the_sub_field('拠点');
                                                                    ?></li><?php
                                                                endwhile;
                                                            endif;
                                                            ?>
                                                        </ul>
                                                    </dd>
                                                </dl>
                                            <?php } ?>
                                        </dd>
                                    </dl>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $terms = get_the_terms($post->ID, 'feature_tag');
                    if($terms):
                        ?>
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

                    <?php if(have_rows('写真') || get_field('youtube')): ?>
                        <div class="sec04">
                            <h2 class="h2-style01"><?php echo $var['photo']; ?></h2>
                            <ul class="ul02 clearfix">
                                <?php if( have_rows('写真') ): while( have_rows('写真') ): the_row(); ?>
                                    <?php
                                    $image = get_sub_field('画像');
                                    $size = 'single-image';
                                    $thumb = $image['sizes'][ $size ];
                                    $alt = $image['alt'];
                                    ?>
                                    <li class="heightLine-01">
                                        <a class="single-xkld-slides04" rel="group04" href="<?php echo esc_url($thumb); ?>" data-fancybox="gallery04"><img alt="<?php echo $alt; ?>" src="<?php echo esc_url($thumb); ?>"></a>
                                    </li>
                                <?php endwhile; endif; ?>
                            </ul>
                            <?php if(get_field('youtube')) : ?>
                                <div class="video01">
                                    <?php echo get_field('youtube'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if( have_rows('卒業生の声') ): ?>
                        <div class="sec05">
                            <div class="sec05-inner">
                                <h2 class="h2-style01"><?php echo $var['company_few_words']; ?></h2>
                                <div class="multiple-items list-col clearfix">
                                    <?php if( have_rows('卒業生の声') ): while( have_rows('卒業生の声') ): the_row(); ?>
                                        <div class="col-df">
                                            <p class="txt01"><?php the_sub_field('テキスト'); ?></p>
                                            <ul>
                                                <li><?php echo $var['graduation_year'] . ': ' . get_sub_field('卒業年度'); ?> </li>
                                                <li><?php echo $var['age'] . ': ' . get_sub_field('年齢'); ?> </li>
                                                <li><?php echo $var['birthplace'] . ': ' . get_sub_field('出身地'); ?></li>
                                                <li><?php echo $var['gender'] . ': ' . get_sub_field('性別'); ?></li>
                                            </ul>
                                        </div>
                                    <?php endwhile; endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; endif; ?>

                <?php
                $connected = new WP_Query( array(
                    'connected_type' => 'vieclam_to_xkld',
                    'connected_items' => get_queried_object(),
                    'posts_per_page' => '8',
                    'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));
                if($connected->have_posts()): ?>
                    <div class="sec06" id="anchor05">
                        <h2 class="h2-style01 registration-support"><?php echo $var['company_vieclam_recruiting']; ?><span class="job-count"><?php echo $var['company_vieclam_recruiting_note'] . $connected->found_posts . ' ' . $var['company_vieclam_recruiting_num']; ?></span></h2>
                        <ul class="ul02 clearfix">
                            <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
                                <?php
                                $p_id = get_the_ID();
                                if(get_the_terms( $p_id, 'recruit_cat' )) {$jobs_b = get_the_terms( $p_id, 'recruit_cat' );}
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
                                        <p class="ttl01"><?php the_title(); ?></p>
                                        <?php
                                        $field = get_field_object( '月給' );
                                        $value = $field['value'];
                                        $label = $field['choices'][ $value ];
                                        ?>
                                        <p class="price"><?php echo esc_html($label); ?></p>
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
                            <p class="button button-blue"><a href="<?php echo home_url('/vieclam'); ?>?xkld_id=<?php echo $post->ID; ?>" ><span><?php echo $var['view_more']; ?></span></a></p>
                        <?php } ?>
                    </div>
                <?php endif; ?>
                <div class="sec07">
                    <div class="box-inner">
                        <h2><?php echo $var['company_xkld_contact']; ?></h2>
                        <div class="box01-child"><?php echo $var['company_xkld_contact_note']; ?></div>
                        <p class="btn01"><a href="<?php echo home_url('/inquiry_xkld'); ?>?post_id=<?php echo $post->ID; ?>" ><?php echo $var['faq']; ?></a></p>
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