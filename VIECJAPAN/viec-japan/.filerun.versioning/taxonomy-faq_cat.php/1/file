<?php get_header(); ?>

<div id="content">

    <div class="wrap">
        <?php bzb_breadcrumb(); ?>

        <div id="main" <?php bzb_layout_main(); ?>>

            <h2>技能実習生制度についてのよくある質問 (FAQ)</h2>

            <ul>
                <?php
                    $args = array(
                        'orderby' => 'id',
                        'taxonomy' => 'faq_cat'
                    );
                    $faq_cats = get_categories($args);
                        
                    foreach($faq_cats as $faq_cat) {
                        echo '<li><a href="' . get_category_link($faq_cat->term_id) . '">' . $faq_cat->name . '</a></li>';
                    }
                ?>
            </ul>

            <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
                
                <p><?php the_title(); ?></p>
                <?php the_content(); ?>
                
            <?php endwhile; endif; ?>

            <?php get_template_part('template-parts/block', 'concierge'); ?>
            
        </div><!-- /main -->

        <?php get_sidebar(); ?>

    </div><!-- /wrap -->

</div><!-- /content -->

<?php get_footer(); ?>