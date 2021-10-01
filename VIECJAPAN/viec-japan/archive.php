<?php get_header(); ?>
<?php
    $xkld_id = $_GET['xkld_id'];
    $htdk_id = $_GET['htdk_id'];
    $var = commonVariables();
?>
<div id="content">

    <div class="wrap">
        <?php bzb_breadcrumb(); ?>
        <div class="search-wrap">
        <p class="sp search-change search-close"><?php echo $var['change_search']; ?></p>
        <?php if ( is_post_type_archive('vieclam') || is_tax( 'job_cat' )) : ?>
            <?php get_template_part( 'template-parts/vieclam', 'form' ); ?>
        <?php elseif( is_post_type_archive('xkld') || is_post_type_archive('ho-tro-dang-ky') || is_tax( 'feature_tag' ) ) : ?>
            <?php get_template_part( 'template-parts/company', 'form' ); ?>
        <?php endif; ?>
        </div>

        <div id="main" <?php bzb_layout_main(); ?>>

        <?php if ( is_post_type_archive('vieclam') || is_tax( 'job_cat' )) : ?>
            <h1 class="post-title"><?php echo $var['vieclam_title']; ?></h1>
        <?php elseif( is_post_type_archive('xkld') || is_tax( 'feature_tag' ) ) : ?>
            <h1 class="post-title"><?php echo $var['company_xkld_heading']; ?></h1>
       
        <?php elseif( is_post_type_archive('ho-tro-dang-ky') ) : ?>
            <h1 class="post-title"><?php $var['company_htdk_heading']; ?></h1>
        <?php endif; ?>

        <?php if ( is_post_type_archive('vieclam') || is_tax( 'job_cat' )) : ?>
            <?php get_template_part( 'template-parts/vieclam', 'sort' ); ?><!-- ソート -->
        <?php endif; ?>
			
		<?php if ( is_post_type_archive('xkld') || is_tax( 'feature_tag' )) : ?>
            <?php get_template_part( 'template-parts/xkld', 'sort' ); ?><!-- ソート -->
        <?php endif; ?>

        <?php if ( is_post_type_archive('ho-tro-dang-ky') || is_tax( 'feature_tag' )) : ?>
            <?php get_template_part( 'template-parts/ho-tro-dang-ky', 'sort' ); ?><!-- ソート -->
        <?php endif; ?>

        <?php if ( is_post_type_archive('thong-tin-huu-ich') || is_tax( 'feature_tag' )) : ?>
            <?php get_template_part( 'template-parts/thong-tin-huu-ich', 'loop' ); ?><!-- ソート -->
        <?php endif; ?>

        <?php if ( is_post_type_archive('vieclam')  ) : ?>
        
        <?php
        if($xkld_id){ ?>
            <?php
                $date = date('Y/m/d');
                $metaquerysp[] = array(
                    'key'=>'募集期限',
                    'value'=> $date,
                    'compare' => '>=',
                    'type' => 'DATE'
                );
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $posts_per_page = 10;
                $args = array(
                    'post_type' => 'vieclam',
                    'meta_query' => $metaquerysp,
                    "paged" => $paged,
                    'posts_per_page' => $posts_per_page,
                    'connected_type' => 'vieclam_to_xkld',
                    'connected_items' => $xkld_id
                );
                $wp_query = new WP_Query( $args );
        }
        elseif($htdk_id){ ?>
            <!-- 募集期限切れを一覧から除外 -->
            <?php
                $date = date('Y/m/d');
                $metaquerysp[] = array(
                    'key'=>'募集期限',
                    'value'=> $date,
                    'compare' => '>=',
                    'type' => 'DATE'
                );
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $posts_per_page = 10;
                $args = array(
                    'post_type' => 'vieclam',
                    'meta_query' => $metaquerysp,
                    "paged" => $paged,
                    'posts_per_page' => $posts_per_page,
                    'connected_type' => 'vieclam_to_ho-tro-dang-ky',
                    'connected_items' => $htdk_id
                );
                $wp_query = new WP_Query( $args );
        }
        else{
        ?>
        <!-- 募集期限切れを一覧から除外 -->
        <?php
            $date = date('Y/m/d');
            $metaquerysp[] = array(
                'key'=>'募集期限',
                'value'=> $date,
                'compare' => '>=',
                'type' => 'DATE'
            );
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $posts_per_page = 10;
            $args = array(
                'post_type' => 'vieclam',
                'meta_query' => $metaquerysp,
                "paged" => $paged,
                'posts_per_page' => $posts_per_page,
            );
            $wp_query = new WP_Query( $args );
        ?>
        <?php } ?>
        <?php endif; ?>

        <?php if ( is_post_type_archive('xkld')  ) : ?>
        <?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $posts_per_page = 10;
            $args = array(
               'post_type' => 'xkld',
                "paged" => $paged,
                'posts_per_page' => $posts_per_page,
            );
            $wp_query = new WP_Query( $args );
        ?>
        <?php endif; ?>

        <?php if ( is_post_type_archive('ho-tro-dang-ky')  ) : ?>
        <?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $posts_per_page = 10;
            $args = array(
               'post_type' => 'ho-tro-dang-ky',
                "paged" => $paged,
                'posts_per_page' => $posts_per_page,
            );
            $wp_query = new WP_Query( $args );
        ?>
        <?php endif; ?>

        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
            <?php if ( is_post_type_archive('vieclam') || is_tax('job_cat') ) : ?>
                <?php get_template_part( 'template-parts/vieclam', 'loop' ); ?>
                <?php elseif( is_post_type_archive('xkld') || is_tax( 'feature_tag' ) ) : ?>
                <?php get_template_part( 'template-parts/xkld', 'loop' ); ?>
            <?php elseif( is_post_type_archive('ho-tro-dang-ky') || is_tax( 'feature_tag' ) ) : ?>
                <?php get_template_part( 'template-parts/ho-tro-dang-ky', 'loop' ); ?>
            <?php endif; ?>
        <?php endwhile; ?>

        <?php  wp_pagenavi(); ?>
        <?php if( is_post_type_archive('xkld') || is_post_type_archive('ho-tro-dang-ky') ) : ?>
        <?php get_template_part('template-parts/block', 'concierge'); ?>
        <?php endif; ?>
            
        </div><!-- /main -->
    </div><!-- /wrap -->
</div><!-- /content -->

<?php get_footer(); ?>