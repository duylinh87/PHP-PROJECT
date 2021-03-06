<style type="text/css" media="screen">
.tabContents {
display: none;
}
.tabContents.active {
display: block;
}
.tabContents,.tab li{
    border: 1px solid #000;
}
</style>

<?php
    /*Template Name: 技能実習生制度とは? */
    get_header();
?>

<div id="content">
    <div class="wrap clearfix">
        <?php bzb_breadcrumb(); ?>
        <div id="main" <?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage">
            <article>
                <header class="post-header">
                    <h1 class="post-title"><?php the_title(); ?></h1>
                </header>

                <section class="post-content">
                    <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
                    <?php the_content(); ?>
                    <?php endwhile; endif; ?>
                </section>
            </article>
            <div class="tab-content section">
                <div class="wrap">
                    <p class="section-title"><span>Câu hỏi thường gặp (FAQ) về chế độ thực tập sinh</span></p>
                    
                    <?php
                        $terms = get_terms('faq_cat','hide_empty=0'); ?>
                        <div class="tab">
                        <?php
                        $tab_num = 1;
                        foreach ( $terms as $term ) { ?>
                            <button class="tablinks<?php if($tab_num == 1){echo ' active';} ?>" onclick="openTab(event,'tab<?php echo $tab_num;?>')">
                                <?php echo  esc_html($term->name); ?>                                    
                            </button>
                        <?php
                        $tab_num++;
                        wp_reset_postdata();
                        }
                        ?>
                        </div>

                    <?php
                    $contents_num = 0;
                    foreach ( $terms as $term ) {                        
                        $contents_num =$contents_num + 1;
                        $custom_posts = get_posts(array(
                            'post_type' => 'faq', // 投稿タイプ
                            'posts_per_page' => -1, // 表示件数
                            'orderby' => 'date', // 表示順の基準
                            'order' => 'DESC', // 昇順・降順
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'faq_cat', //タクソノミーを指定
                                    'field' => 'slug', //ターム名をスラッグで指定する
                                    'terms' => $term, //表示したいタームをスラッグで指定
                                    'operator' => 'IN'
                                ),
                            )
                        ));
                        ?>

                        <div id="tab<?php echo $contents_num; ?>" class="tabcontent <?php if($contents_num == 1){echo ' active';} ?>">
                            <?php
                            global $post;
                            if($custom_posts): 
                                $nunq = 0;
                                foreach($custom_posts as $post): 
                                    $nunq ++;
                                    setup_postdata($post); ?>
                              
                                    <!-- ループはじめ -->
                                    <div class="qa-list">
                                        <dl>
                                            <dt<?php if($nunq == 1){echo ' class="open"';} ?>>
                                                <span><?php the_title(); ?></span>
                                            </dt>
                                            <dd<?php if($nunq == 1){echo ' class="open"';} ?>>
                                                <div class="answer">
                                                    <p><?php the_content(); ?></p>                                                
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                    <!-- ループおわり -->
                                <?php endforeach; 
                                wp_reset_postdata(); 
                            endif; ?>
                        </div>

                    <?php } ?>
                </div>                
            </div>           

            <?php get_template_part('template-parts/block', 'concierge'); ?>
        </div><!-- /main -->
    </div><!-- /wrap -->
</div><!-- /content -->
<?php get_footer(); ?>