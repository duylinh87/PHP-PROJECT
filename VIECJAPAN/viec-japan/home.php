<?php get_header(); ?>
<div id="content">
    <div class="wrap">
        <div id="main" <?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
            <?php echo
                sougou_slider_home();
                $var = commonVariables();
            ?>
            <div class="search-home-tab">
               <div class="tab">
                  <button class="tablinks active" onclick="openTab(event, 'vieclam')"><?php echo $var['search_vieclam_title']; ?></button>
                  <button class="tablinks" onclick="openTab(event, 'xkld')"><?php echo $var['search_company_title']; ?></button>
               </div>
               <div id="vieclam" class="tabcontent active">
                  <?php get_template_part( 'template-parts/vieclam', 'form' ); ?>
               </div>
               <div id="xkld" class="tabcontent">
                  <?php get_template_part( 'template-parts/company', 'form' ); ?>
               </div>
            </div>
            <?php if( have_posts() ):
               echo '<div class="section new-post">';
               echo '<ul>';

               query_posts('posts_per_page=3');
               while( have_posts() ): the_post(); ?>
                <li>
                   <a href="<?php the_permalink(); ?>">
                   <time datetime="<?php the_time( 'Y-m-d' );?>"><?php the_time( 'd.m.Y' ); ?></time>
                   <?php if( time() - strtotime(get_the_time('d.m.Y') ) < 604800): ?>
                   <span class="new">
                   <?php else: ?>
                   <span>
                   <?php endif; ?>
                   <?php the_title(); ?>
                   </span>
                   </a>
                </li>
                <?php
                   endwhile;
                   echo '</ul>';
                   echo '<p class="link"><a href="/post-list">';
                   echo $var['view_all'];
                   echo '</a></p>';
                   echo '</div>';
            endif; ?>
            <div class="section job">
               <div class="wrap">
                  <div class="section-title">
                      <span><?php echo $var['vieclam_new']; ?></span>
                  </div>
                   <?php
                        $tearn_visa = 'thuc-tap-sinh';
                        include 'template-parts/vieclam-home-visa-item.php';

                        $tearn_visa = 'ky-nang-dac-dinh-viet-nam';
                        include 'template-parts/vieclam-home-visa-item.php';

                        $tearn_visa = 'ky-nang-dac-dinh-nhat-ban';
                        include 'template-parts/vieclam-home-visa-item.php';
                    ?>
               </div>
            </div>
            <?php echo sougou_work_scenery_home(); ?>
            <?php echo info_home(); ?>
            </div>
            <!-- /main -->
        </div>
        <!-- /wrap -->
    </div>
<!-- /content -->
<?php get_footer(); ?>