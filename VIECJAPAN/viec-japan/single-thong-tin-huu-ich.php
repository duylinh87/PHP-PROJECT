<?php
/*Template Name: 技能実習生制度とは? */
get_header();
?>

    <div id="content" class="useful-information">
        <div class="wrap clearfix">
            <?php bzb_breadcrumb(); ?>
            <div id="main" <?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage">
                <article>
                    <header class="post-header">
                        <h1 class="post-title"><?php the_title(); ?></h1>
                    </header>

                    <section class="post-content">
                        <div class="about-site">
                            <div class="inner">
                                <?php if( get_the_post_thumbnail() ) : ?>
                                    <div class="post-thumbnail">
                                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                                        <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="post-header-meta">
                                    <?php bzb_social_buttons();?>
                                </div>
                                <div class="text_box">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>

                <div id="concierge-service">
                    <?php
                    if (get_field('insert_block_concierge')) {
                        get_template_part('template-parts/block', 'concierge');
                    }
                    ?>
                </div>
            </div><!-- /main -->
        </div><!-- /wrap -->
    </div><!-- /content -->

    <!--     <section id="box-salary">

            <div id="Salary-Calculator">
                <h2>Salary Calculator ViecJapan</h2>
                <form id="calculate">
                    <label for="principal" class="principal">
                        <span>
                            Yen
                        </span>
                        <input id="principal" type="text" placeholder="Monthly Salary" />
                    </label>

                    <label for="time">
                        <span>
                           Time
                        </span>
                        <input id="time" type="number" placeholder="period Years" />
                    </label>

                    <div class="btnSalary" ></div>
                </form>
                <div class="results hide">
                    <div class="monthly-payment">
                        <span>Monthly Salary</span>
                        <span id="Salary"></span>
                    </div>
                    <div class="monthly-payment">
                        <span>Income Tax</span>
                        <span id="income-tax">-13000 Yen</span>
                    </div>
                    <div class="total-interest">
                        <span>Heath Insurance</span>
                        <span id="heath-insurance">-13000 Yen</span>
                    </div>
                    <div class="total-amount">
                        <span>Total Amount</span>
                        <div id="total"></div>
                    </div>
                </div>
            </div>
        </section> -->
<?php get_footer(); ?>