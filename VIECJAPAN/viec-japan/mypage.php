<?php
/*
Template Name: マイページ
*/
?>
<?php get_header(); ?>
<div id="content" class="page-mypage-inner">
<div class="wrap clearfix">
  <?php bzb_breadcrumb(); ?>
    <?php $var = commonVariables(); ?>
  <div id="main"<?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage">
    <div class="main-inner">
        <h1 class="post-title"><?php echo $var['user_page']; ?></h1>
    <?php
if(is_user_logged_in()){
?>
  <div class="box01 box-df">
     <div class="box-df-inner">
       <h2><?php echo $var['favourite_job']; ?></h2>
      <ul class="ul01 clearfix">
        <?php
        $favorites = get_user_favorites();
          if ( $favorites ) : 
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // If you want to include pagination
          $favorites_query = new WP_Query(array(
              'post_type' => 'vieclam', // If you have multiple post types, pass an array
              'posts_per_page' => -1,
              'ignore_sticky_posts' => true,
              'post__in' => $favorites,
              'paged' => $paged, // If you want to include pagination, and have a specific posts_per_page set
              // 'meta_query' => array(array(
              // 'key' => 'contracts',
              // 'value' => '空'
              // )
              // ),
          ));
          if ($favorites_query->have_posts()) : while ($favorites_query->have_posts()) : $favorites_query->the_post();
            ?>
              <li>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <div>
                  <p class="button button-m button-blue"><a href="<?php echo home_url('/entry_form'); ?>?post_id=<?php echo $post->ID; ?>&xkld_name=<?php echo $xkld_name; ?>"><span><?php echo $var['vieclam_apply']; ?></span></a></p>
                  <?php the_favorites_button(get_the_ID()); ?>
                </div>
              </li>

              <?php
          endwhile;
              next_posts_link('Older Favorites', $favorites_query->max_num_pages);
              previous_posts_link('Newer Favorites');
          else:
              echo '<p class="text-center">' .$var['no_favourite_job'] . '</p>';
          endif;
          wp_reset_postdata();
          endif;
          ?>
      </ul>
     </div>
  </div>
  <div class="box02 box-df">
    <div class="box-df-inner">
      <h2>Công ty XKLĐ yêu thích</h2>
      <ul class="ul01 clearfix">
      <?php
      if ( $favorites ) : 
      //送り出し機関
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // If you want to include pagination
        $favorites_query = new WP_Query(array(
            'post_type' => 'xkld, ho-tro-dang-ky', // If you have multiple post types, pass an array
            'posts_per_page' => -1,
            'ignore_sticky_posts' => true,
            'post__in' => $favorites,
            'paged' => $paged, // If you want to include pagination, and have a specific posts_per_page set
            // 'meta_query' => array(array(
            // 'key' => 'contracts',
            // 'value' => '空'
            // )
            // ),
        ));
        if ($favorites_query->have_posts()) : while ($favorites_query->have_posts()) : $favorites_query->the_post();
          ?>
            <li>
              <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
              <div>
                <?php the_favorites_button(get_the_ID()) ?>
              </div>
            </li>
          <?php
        endwhile;
            next_posts_link('Older Favorites', $favorites_query->max_num_pages);
            previous_posts_link('Newer Favorites');
        else:
            echo '<p class="text-center">Không có công ty XKLĐ, tổ chức hỗ trợ đăng ký nào nào.</p>';
        endif;
        wp_reset_postdata();
        endif;
      }else{
        the_content();
      }
      ?>
  </ul>
    </div>
  </div>

  <div class="box03">
    <?php echo do_shortcode('[fua]'); ?>
    <ul class="ul02">
      <li class="delete"><a href="<?php echo home_url(); ?>/login/?action=withdrawal"><?php echo $var['out_group']; ?></a></li>
    </ul>
  </div>
    </div><!-- /main-inner -->
  </div><!-- /main -->
<?php //get_sidebar(); ?>
</div><!-- /wrap -->
</div><!-- /content -->
<?php get_footer(); ?>

