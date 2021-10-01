<?php
/*
 * サムネイル
*/
add_theme_support('post-thumbnails');

/*
 * css,jsの読み込み
*/
if (!is_admin())
{
    function add_scripts()
    {
        wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
        wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/css/style.css', array(
            'parent-style'
        ));
        wp_enqueue_style('chosen-css', get_stylesheet_directory_uri() . '/css/chosen.min.css');
        wp_enqueue_script('chosen-proto-js', get_stylesheet_directory_uri() . '/js/chosen.proto.min.js');
        wp_enqueue_script('chosen-jquery-js', get_stylesheet_directory_uri() . '/js/chosen.jquery.min.js');
        wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js');
        wp_enqueue_style('slick', get_stylesheet_directory_uri() . '/slick/slick.css'); //cssファイルの場合
        wp_enqueue_style('slick-theme', get_stylesheet_directory_uri() . '/slick/slick-theme.css'); //cssファイルの場合
        wp_enqueue_script('slick.min', get_stylesheet_directory_uri() . '/slick/slick.min.js');
        wp_enqueue_script('sp-nav', get_stylesheet_directory_uri() . '/js/sp-nav.js');
        wp_enqueue_script('add', get_stylesheet_directory_uri() . '/js/app.js');
        wp_enqueue_script('fontawesome-js', get_stylesheet_directory_uri() . '/js/kit.fontawesome.js');
    }

    add_action('wp_enqueue_scripts', 'add_scripts');
}

/**
 * ファビコン設定
 */
//function xbc_favicon()
//{
//$fav = '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/assets/images/favicon.ico" />';
//echo $fav;
//}
//add_action('wp_head', 'xbc_favicon');

/**
 * サイトオプション
 */
if (function_exists('acf_add_options_page'))
{
    acf_add_options_page(array(
        'page_title' => 'Site Option',
        'menu_title' => 'Site Option',
        'menu_slug' => 'acf-settings',
        'capability' => 'manage_options',
    ));

    // acf_add_options_page(array(
    //     'page_title' => 'サイトオプション2',
    //     'menu_title' => 'サイトオプション2',
    //     'menu_slug'  => 'acf-settings2',
    //     'capability' => 'manage_options',
    // ));

}

/**
 * 投稿の紐付け
 * xkldが送り出し機関
 */

function get_post_nganh_nghe()
{
    $args = array(
		'post_type' => 'nganh-nghe', 
		'posts_per_page' => 3,
		'meta_query' => array(
			array(
				'key'     => 'show_nganh_nghe',
				'value'   => '"Show"',
				'compare' => 'LIKE'
			)
		)
    );
    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) { ?>
			
					<ul class="list-career">
						<?php while ($the_query->have_posts()) {
							$the_query->the_post();?>
						<li class="item-career">
							<?php 
								global $post;
								$categories = get_the_category($post->ID);
								foreach($categories as $cate) {
								$img = $cate->description;
								}
							?>
							<h2 class="title"><span class="icon"><img src="<?php echo $img; ?>"></span><?php the_title(); ?></h2>
							<div class="img-post">
								<img src="<?php echo get_the_post_thumbnail_url(); ?>"> 
							</div>
							<div class="excerpt"><?php echo $post->post_excerpt; ?></div>
							<div class="link-page">
								<a class="link-blog" href="<?php the_permalink(); ?>">Read more <i class="fa fa-chevron-right"></i></a>
							</div>
						</li>
					
						<?php } ?>
					</ul>
            
        <?php wp_reset_postdata();
    }

    wp_reset_query();
    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;
}
add_shortcode('get_post_nganh_nghe', 'get_post_nganh_nghe');


function vieclam_to_xkld_period_types()
{
    // Posts 2 Posts プラグインが有効化されてるかチェック
    if (!function_exists('p2p_register_connection_type')) return;

    // 求人案件に送り出し機関を表示
    p2p_register_connection_type(array(
        'name' => 'vieclam_to_xkld',
        'from' => 'xkld',
        'to' => 'vieclam'
    ));

    p2p_register_connection_type(array(
        'name' => 'vieclam_to_ho-tro-dang-ky',
        'from' => 'ho-tro-dang-ky',
        'to' => 'vieclam'
    ));

    // 求人案件と応募方法
    p2p_register_connection_type(array(
        'name' => 'vieclam_to_entry',
        'from' => 'entry',
        'to' => 'vieclam'
    ));
}
add_action('init', 'vieclam_to_xkld_period_types');

// ページと送り出し機関
// function recruit_to_page_types() {
//     // Posts 2 Posts プラグインが有効化されてるかチェック
//     if ( !function_exists( 'p2p_register_connection_type' ) )
//         return;
//     p2p_register_connection_type(
//         array(
//             'name' => 'recruit_to_page',
//             'from' => 'delivery_period',
//             'to' => 'page'
//         )
//     );
// }
// add_action( 'wp_loaded', 'recruit_to_page_types' );

// 人気記事出力用関数

function set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function get_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count=='') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return 0;
    }
    return $count;
}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
//add_action( 'wp_head', 'track_views');

// 並び替え条件パラメータを追加
function add_sort_query_vars( $public_query_vars )
{
    $public_query_vars[] = 'sort';

    return $public_query_vars;
}
add_filter('query_vars', 'add_sort_query_vars');

// 並び替え処理を設定
function change_posts_per_page($query)
{
    if ($query->is_search() || $query->is_archive())
    {
        if (!empty($_GET['sort']))
        {
            if ($_GET['sort'] == 'DATE_DESC')
            {
                $query->set('orderby', array (
                    'date' => 'DESC'
                ));
            }
            elseif ($_GET['sort'] == 'DATE_ASC')
            {
                $query->set('orderby', array (
                    'date' => 'ASC'
                ));
            }
            elseif ($_GET['sort'] == 'SALARY_DESC')
            {
                $query->set('key', '月給');
                $query->set('orderby', array(
                    'meta_value_num' => 'DESC',
                    // 'date' => 'DESC',

                ));
            }
            elseif ($_GET['sort'] == 'SALARY_ASC')
            {
                $query->set('key', '月給');
                $query->set('orderby', array(
                    'meta_value_num' => 'ASC',
                    // 'date' => 'ASC',

                ));
            }
            elseif ($_GET['sort'] == 'DEADLINE_DESC')
            {
                $query->set('key', '募集期限');
                $query->set('orderby', array(
                    'meta_value_num' => 'DESC',
                    // 'date' => 'DESC',

                ));
            }
            elseif ($_GET['sort'] == 'DEADLINE_ASC')
            {
                $query->set('key', '募集期限');
                $query->set('orderby', array(
                    'meta_value_num' => 'ASC',
                    // 'date' => 'ASC',

                ));
            }
        }
    }
}

add_action('pre_get_posts', 'change_posts_per_page');

/**
 * formにデフォルト値をユーザー管理プラグインから取得し入れ込む
 */
function my_form_tag_filter($tag)
{
    if (!is_array($tag)) return $tag;

    //この中に各種ゆーざー情報が入ってくる。
    global $current_user;

    $email = $current_user->user_email;
    $u_name = $current_user->u_name;
    $u_tel = $current_user->tel;
    $u_login = $current_user->user_login;

    //formに設定されているnameが入ってくる
    $name = $tag['name'];

    if (strpos($email, 'facebook.com') !== false) {
        $email = '';
    }
    if (strpos($u_login, 'fb') !== false) {
        $u_name = $current_user->display_name;
    }

    if (isset($email))
    {
        if ($name == 'your-email') $tag['values'] = (array)$email;
    }

    if (isset($u_name))
    {
        if ($name == 'your-name') $tag['values'] = (array)$u_name;
    }

    if (isset($u_name))
    {
        if ($name == 'your-tel') $tag['values'] = (array)$u_tel;
    }

    return $tag;
}
add_filter('wpcf7_form_tag', 'my_form_tag_filter', 11);

// 遷移元の記事タイトルをcontactformに反映
function wpcf7_get_post_data($tag)
{
    if (!is_array($tag)) return $tag;
    $post_id = (isset($_GET['post_id']) && $_GET['post_id']) ? $_GET['post_id'] : false;

    if ($post_id)
    {
        if ($tag['name'] == 'post-title')
        {
            $title = get_the_title($post_id);
            $tag['values'] = array(
                $title
            );
        }
    }
    return $tag;
}
add_filter('wpcf7_form_tag', 'wpcf7_get_post_data', 11);

/*------ Page Slug Body Class------*/
function add_slug_body_class($classes)
{
    global $post;
    if (isset($post))
    {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter('body_class', 'add_slug_body_class');

//add logo
function config_custom_logo()
{
    add_theme_support('custom-logo');
}

add_action('after_setup_theme', 'config_custom_logo');

function sougou_setup_image_size()
{
    add_theme_support('html5', array(
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
        'caption'
    ));

    // 画像サイズの指定
    //add_image_size('recommend_thumb', 113, 70, true);
    add_image_size('job_thumb', 991, 734, true);
    add_image_size('top_new_job', 270, 200, true);
    add_image_size('single-image', 626, 392, true);
}
add_action('after_setup_theme', 'sougou_setup_image_size');

function sougou_slider_home()
{
    $slider_home = get_field('slider_home', 'option');

    if ($slider_home)
    {
        echo '<div class="session banner-home">';
        echo '<div class="slick-1">';
        foreach ($slider_home as $slider)
        {
            $slider_title = $slider['titile'];
            $slider_images = $slider['images'];
            $slider_images_sp = $slider['images_sp'];
            ?>
            <div class="item">
                <div class="wrap pc" style="background-image: url(<?php echo $slider_images; ?>)">
                    <div class="content-slider"><?php echo $slider_title ?></div>
                </div>
                <div class="wrap sp" style="background-image: url(<?php echo $slider_images_sp; ?>)">
                    <div class="content-slider"><?php echo $slider_title ?></div>
                </div>
            </div>
            <?php
        }
        echo '</div>';
        echo '</div>';
    }
}

function sougou_work_scenery_home()
{
    $var = commonVariables();
    ?>
    <div class="work_scenery">
        <div class="wrap">
            <div class="wrap-content">
                <div class="title"><?php echo $var['working_japan']; ?></div>
                <div class="content">
                    <div class="images">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/images/flat.jpg'; ?>">
                    </div>
                    <div class="content-text">
                        <p><?php echo $var['working_japan_note']; ?></p>
                    </div>
                </div>
                <p class="button button-blue"><a href="<?php echo home_url('/about'); ?>"><span><?php echo $var['view_detail']; ?></span></a></p>
            </div>
        </div>
    </div>
    <?php
}

function info_home()
{
    $args = array(
        'post_type' => 'thong-tin-huu-ich',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => '1'
    );
    $list = new WP_Query($args);
    $var = commonVariables();

    ?>
    <section class="info-block" style="margin-top: 100px;">
        <div class="wrap">
            <div class="wrap-content">
                <p class="info-title"><i class="fa fa-pen"></i><span><?php echo $var['useful_info']; ?></span></p>
                <p class="info-desc"><?php echo $var['useful_info_des']; ?></p>
                <div class="item-infoNews">
                    <?php if ( $list->have_posts() ) : while ( $list->have_posts() ) : $list->the_post(); ?>
                        <?php if( get_the_post_thumbnail() ) : ?>
                            <div class="content-image">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="content-text">
                            <h3 class="title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <?php
                            $content = get_the_content();
                            if( mb_strlen( $content ) > 250 ) {
                                $content = mb_substr( $content, 0, 250 ) ;
                                echo '<p class="excerpt">' . $content . ' ...' . '</p>';
                            } else {
                                echo '<p class="excerpt">' . $content . '</p>';
                            }
                            ?>
                            <p class="button button-blue"><a href="<?php the_permalink(); ?>"><span><?php echo $var['view_detail']; ?></span></a></p>
                        </div>
                    <?php
                    endwhile;
                    endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}

/* サイドバー
 * ---------------------------------------- */

register_sidebar(array(
    'name' => 'Languages ',
    'id' => 'language-widget',
    'description' => 'Multi Language',
    'before_widget' => '<div id="%1$s" class="%2$s language-widget"><div class="language-widget-inner">',
    'after_widget' => '</div></div>',
    'before_title' => '<h4 class="language-title"><span class="language-title-inner">',
    'after_title' => '</span></h4>'
));

register_sidebar(array(
    'name' => 'フッター ',
    'id' => 'footer-widget',
    'description' => 'フッター ',
    'before_widget' => '<div id="%1$s" class="%2$s side-widget"><div class="side-widget-inner">',
    'after_widget' => '</div></div>',
    'before_title' => '<h4 class="side-title"><span class="side-title-inner">',
    'after_title' => '</span></h4>'
));

register_sidebar(array(
    'name' => esc_html__('SP navi', 'xeory-base') ,
    'id' => 'sp_nav',
    'description' => esc_html__('Add widgets here.', 'xeory-base') ,
    'before_widget' => '<section id="%1$s" class="widget spnav-widget %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h3 class="widget-title spnav-widget-title">',
    'after_title' => '</h3>',
));

// Side nav toggle btn
add_action('xeory_append_site-branding', 'xeory_add_sidenav_btn');
function xeory_add_sidenav_btn()
{
    if (is_active_sidebar('sp_nav'))
    {
        ?>
        <span class="xeory-sp-nav-btn"></span>
        <?php
    }
}

add_action('wp_footer', 'xeory_add_sidenav');
function xeory_add_sidenav()
{
    get_template_part('template-parts/template', 'sp-nav-area');
}

//show button SNS
function sougou_social_buttons()
{
    $twitter_id = get_option('twitter_id');
    $facebook_page_url = get_option('facebook_page_url');
    ?>
    <ul class="social">
        <li class="facebook"><a target="_blank" href="<?php echo $facebook_page_url; ?>"><i class="fab fa-facebook-f"></i></a></li>
        <!-- <li class="twitter"><a target="_blank" href="https://twitter.com/<?php echo $twitter_id; ?>"><i class="fab fa-twitter"></i></a></li> -->

    </ul>

    <?php
}

function sougou_verified_by()
{
    ?>
    <!-- <div class="verified">
    <span>verified by</span><span><img src="<?php echo get_stylesheet_directory_uri() . '/images/dadangky.png' ?>"></span>
  </div> -->
    <?php
}

function bzbsk_cat_w_date_is_single()
{
    $category = get_the_category(); //カテゴリの配列
    $date = get_the_time("j.n.Y"); //日付表示はY年n月j日のように変更可
    $modified = get_the_modified_date("j.n.Y"); //更新日
    $length = count($category);
    $num = 0;

    echo "<ul class=\"entry-meta\">
      <li class=\"cat\">";

    //その投稿が属しているカテゴリーの数だけループさせる
    foreach ($category as $cat)
    {
        echo '<a href="' . get_category_link($cat->cat_ID) . '">' . $cat->name . '</a>';
        $num++;

        if ($num !== $length)
        {
            echo '';
        }
    }

    echo "</li>
    <li class=\"date\"><time itemprop=\"datePublished\" datetime=\"" . get_the_time('c') . "\">" . $date . "</time></li>\n";

    if ($modified > $date)
    {
        echo "<li class=\"modified\">(Cập nhập：<time itemprop=\"dateModified\" datetime=\"" . get_the_modified_time('c') . "\">" . $modified . "</time>)</li>\n";
    }

    echo "</ul>";
}

function wpdocs_theme_add_editor_styles()
{
    add_editor_style('css/admin/editor-style.css');
}
add_action('admin_init', 'wpdocs_theme_add_editor_styles');

add_action('wp_footer', 'add_thanks_page');
function add_thanks_page($url)
{
    echo <<< EOD
<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
  location = $url . '/thanks/';
}, false );
</script>
EOD;
}

if (!current_user_can('manage_options'))
{
    show_admin_bar(false);
}

function my_post_count_queries($query)
{
    if (!is_admin() && $query->is_main_query())
    {
        if (is_search())
        {
            $query->set('posts_per_page', -1);
        }
    }
}
add_action('pre_get_posts', 'my_post_count_queries');

// Remove Parent Category from Child Category URL
add_filter('term_link', 'devvn_no_category_parents', 1000, 3);
function devvn_no_category_parents($url, $term, $taxonomy) {
    if($taxonomy == 'category'){
        $term_nicename = $term->slug;
        $url = trailingslashit(get_option( 'home' )) . user_trailingslashit( $term_nicename, 'category' );
    }
    return $url;
}

// Rewrite url mới
function devvn_no_category_parents_rewrite_rules($flash = false) {
    $terms = get_terms( array(
        'taxonomy' => 'category',
        'post_type' => 'post',
        'hide_empty' => false,
    ));
    if($terms && !is_wp_error($terms)){
        foreach ($terms as $term){
            $term_slug = $term->slug;
            add_rewrite_rule($term_slug.'/?$', 'index.php?category_name='.$term_slug,'top');
            add_rewrite_rule($term_slug.'/page/([0-9]{1,})/?$', 'index.php?category_name='.$term_slug.'&paged=$matches[1]','top');
            add_rewrite_rule($term_slug.'/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?category_name='.$term_slug.'&feed=$matches[1]','top');
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_no_category_parents_rewrite_rules');

/*Sửa lỗi khi tạo mới category bị 404*/
function devvn_new_category_edit_success() {
    devvn_no_category_parents_rewrite_rules(true);
}
add_action('created_category','devvn_new_category_edit_success');
add_action('edited_category','devvn_new_category_edit_success');
add_action('delete_category','devvn_new_category_edit_success');

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    }
    return $title;
});

if (!is_admin() || !is_page('wp-admin') || !is_page('wp-login')) {
    function redirect_url_search () {
        $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (strpos( $current_url, '/jp' )) {
            $new_url = str_replace('/jp', '', $current_url);
            //die($new_url);
            return wp_redirect($new_url);
            exit();
        }
        else {
            $new_url = $current_url;
            return $new_url;
        }
        return;
    }
    add_action('template_redirect','redirect_url_search');
}

/* Định nghĩa các biến dùng chung */

class commonObjects {
    function _contructor($post_ID) {
        $this->post_ID = $post_ID;
    }

    // Ngành nghề
    public static function get_occupations($post_ID) {
        if (get_the_terms( $post_ID, 'recruit_cat' )) $occupations = get_the_terms( $post_ID, 'recruit_cat' );
        if (get_the_terms( $post_ID, 'recruit_tokuteigino_cat' )) $occupations = get_the_terms( $post_ID, 'recruit_tokuteigino_cat' );
        return $occupations;
    }

    // Visa kỹ năng
    public static function get_visa($post_ID) {
        if (get_the_terms( $post_ID, 'visa' )) $visa_s = get_the_terms( $post_ID, 'visa' );
        return $visa_s;
    }

    // Địa điểm làm việc
    public static function get_areas($post_ID) {
        if (get_post_meta($post_ID, '勤務地', true)) $area_s = get_post_meta($post_ID, '勤務地', true);
        return $area_s;
    }
}

function commonVariables () {
    global $sitepress;
    $current_language = $sitepress->get_current_language();

    if ($current_language == 'ja') {
        $var['area'] = '勤務地から探す';
        $var['address'] = '住所';
        $var['ranking'] = 'ランキング';
        $var['ranking_note'] = 'ベトナム海外労働者派遣協会より公表されたランキングです';
        $var['person'] = '人';
        $var['year'] = '年';
        $var['year_lower'] = '年';
        $var['time'] = '研修期間';
        $var['age'] = '歳';
        $var['age_lower'] = '歳';
        $var['gender'] = '性別';
        $var['qualification'] = '資格';
        $var['japanese_level'] = '日本語能力';
        $var['other_conditions'] = 'その他の条件';
        $var['from'] = 'から';
        $var['to'] = 'まで';
        $var['hour'] = '時';
        $var['day'] = '日';
        $var['month'] = '月';
        $var['photo'] = 'ギャラリー';
        $var['login'] = 'ログイン';
        $var['register'] = '新規登録';
        $var['all'] = '全て';
        $var['faq'] = 'FAQ';
        $var['please_contact'] = 'お問い合わせ';
        $var['vieclam'] = '求人案件';
        $var['visa_type'] = '在留資格';
        $var['visa_tts'] = '技能実習';
        $var['visa_tgVN'] = '特定技能（ベトナム在住者向け）';
        $var['visa_tgJP'] = '特定技能（日本在住者向け）';
        $var['occupation'] = '職種から探す';
        $var['salary'] = '給与から探す';
        $var['choose_salary'] = '給料を選ぶ';

        $var['view_all'] = '全て見る';
        $var['view_more'] = 'もっと見る';
        $var['view_detail'] = '詳しく見る';
        $var['deadline'] = '募集期限';
        $var['favorite'] = 'お気に入り';
        $var['sort_select'] = '条件で並び替え';
        $var['sort_new'] = '新着順';
        $var['sort_old'] = '投稿が古い順';

        $var['vieclam_title'] = '求人名';
        $var['vieclam_realted_title'] = '関連の求人';
        $var['vieclam_views_title'] = 'よく見られてる求人';
        $var['vieclam_new'] = '新着求人';
        $var['vieclam_sort_new'] = '新着順';
        $var['vieclam_sort_old'] = '投稿が古い順';
        $var['vieclam_sort_salary_high'] = '給料が高い順';
        $var['vieclam_sort_salary_low'] = '給料が低い順';
        $var['vieclam_sort_deadline_near'] = '応募期限が短い順';
        $var['vieclam_sort_deadline_far'] = '応募期限が長い順';
        $var['vieclam_expired'] = '募集期限が終了しました';
        $var['vieclam_apply'] = '応募する';
        $var['vieclam_apply_note'] = '応募については、担当者にご連絡ください';

        $var['vieclam_company'] = '送出機関名';
        $var['vieclam_info'] = '求人情報';
        $var['vieclam_des'] = '仕事内容';
        $var['vieclam_required'] = '募集要項';
        $var['vieclam_salary_tax_included'] = '(税込)';
        $var['vieclam_salary_base'] = '基本月給(残業除く)';
        $var['vieclam_salary_increase_bonus'] = '昇給・ボーナス';
        $var['vieclam_salary_increase'] = '昇給';
        $var['vieclam_salary_bonus'] = 'ボーナス';
        $var['vieclam_money_saved'] = '3年間で貯金できる目安金額';
        $var['vieclam_welfare_insurance'] = '待遇・福利厚生';
        $var['vieclam_insurance'] = '福利厚生';
        $var['vieclam_workby'] = '交通手段';
        $var['vieclam_workingtime'] = '労働時間';
        $var['vieclam_holyday'] = '年間休日';
        $var['vieclam_other'] = 'その他の条件';
        $var['vieclam_schedule'] = '参加日程';
        $var['vieclam_interview'] = '面接日程';
        $var['vieclam_interview_form'] = '面接方法';
        $var['vieclam_registration_deadline'] = '登録期限';
        $var['vieclam_start_work'] = '就業開始予定日';
        $var['vieclam_applicants'] = '募集人数';

        $var['vieclam_apply_method'] = '応募方法';
        $var['vieclam_apply_contact_note'] = '応募受付後の連絡';
        $var['vieclam_recruit_schedule'] = '採用プロセス';
        $var['vieclam_recruit_form'] = '採用フォーム';
        $var['vieclam_apply_q'] = 'この求人期限が終了';
        $var['vieclam_apply_a'] = 'この求人について「気になる点がある」「もっと詳しく知りたい」という場合は、下記のフォームよりお問い合わせください。弊社担当者よりご返信いたします。';

        $var['concierge_title'] = 'ご連絡ください';
        $var['concierge_subtitle'] = '経験のある担当者に';
        $var['concierge_note01'] = '日本企業で活躍していた経験者に';
        $var['concierge_note02'] = '求人についてあなたの疑問を答える';
        $var['concierge_link'] = 'コンシェルジュに相談する';

        $var['company_profile_year'] = '送出実績';
        $var['company_overview'] = '概要';
        $var['company_performance'] = '実績';
        $var['company_cost'] = '費用について ';
        $var['company_equipment'] = '施設・設備';

        $var['company_info'] = '基本情報';
        $var['company_office'] = '所在地';
        $var['company_branch'] = 'ベトナム国内拠点';
        $var['company_representative'] = '代表名';
        $var['company_establishment_year'] = '設立年';
        $var['company_employees'] = '総従業員数';
        $var['company_japanese_teachers'] = '日本人教師数';
        $var['company_educational_policy'] = '教育方針';
        $var['company_people_number'] = '送出実績';
        $var['company_sending_area'] = '送り出した技能実習生の日本国内の地域';
        $var['company_branch'] = 'ベトナム国内拠点';
        $var['company_capacity'] = '収容人数';
        $var['company_education_center'] = '教育センター';
        $var['company_job_intro'] = '職集紹介';
        $var['company_base_system'] = 'フォロー体制';
        $var['company_list_base'] = '拠点一覧';
        $var['company_highlight'] = '会社の印象';
        $var['company_few_words'] = '一言';
        $var['company_vieclam_recruiting'] = '現在募集中の求人';
        $var['company_vieclam_recruiting_note'] = '公開';
        $var['company_vieclam_recruiting_num'] = '記事';
        $var['company'] = '社名';
        $var['company_xkld'] = '送出機関';
        $var['company_htdk'] = '登録支援機関';
        $var['company_xkld_heading'] = '送出機関';
        $var['company_xkld_name'] = '送出機関名';
        $var['company_htdk_heading'] = '登録支援機関一覧';
        $var['company_htdk_name'] = '登録支援機関名';
        $var['company_xkld_contact'] = '送出機関の連絡先';
        $var['company_xkld_contact_note'] = 'この送出機関について「気になる点がある」「もっと詳しく知りたい」という場合は、下記のフォームよりお問い合わせください。弊社担当者よりご返信いたします。';
        $var['company_htdk_contact'] = '登録支援機関連絡先';
        $var['company_htdk_contact_note'] = 'この登録支援機関について「気になる点がある」「もっと詳しく知りたい」という場合は、下記のフォームよりお問い合わせください。弊社担当者よりご返信いたします。';
        $var['company_registration_number'] = '登録番号';
        $var['company_establishment_date'] = '登録日付';
        $var['company_support_language'] = 'サポート言語';
        $var['company_pic'] = '担当者（ベトナム語）';
        $var['company_pic_email'] = '担当者のメール（ベトナム語）';
        $var['company_management_policy'] = '管理方針';
        $var['company_registration_number'] = '登録番号';
        $var['company_supported'] = 'サポート';

        $var['working_japan'] = '日本で働く制度について';
        $var['working_japan_note'] = '外国人が日本で働くためには、在留資格を取得することが最も重要です。近年、日本に留学する外国人の数は急増しています。在留資格を取得している外国人は、主に「技能実習」または「特定技能」です。技能実習、または特定技能の制度、資格、一般的な情報などについて、説明します。';
        $var['labor_policy'] = '日本での労働制度';
        $var['labor_policy_note'] = '日本政府によって設立された国際的な人材育成プロジェクトです。人材が高度な技術を吸収し、その国の発展をリードしたい才能を訓練するのを助けることを目的としています。 2017年11月から「技能訓練法」が実施され、外国人労働者制度で実施され始めた。 ';

        $var['useful_info'] = 'お役立ち情報';
        $var['useful_info_des'] = '技能実習・特定技能の在留資格の人に、送出機関の選択、貯金する方法などの有用な情報を与える';

        // Search
        $var['search'] = '探す';
        $var['search_keyword'] = 'キーワード';
        $var['search_vieclam_title'] = '求人案件から探す';
        $var['search_company_title'] = '送出機関・登録支援機関から探す';
        $var['change_search'] = '検索条件変更';
        $var['search_result'] = '検索結果';
        $var['search_result_from'] = 'から検索結果';
        $var['no_found'] = '見つかりませんでした';
        $var['matching_found'] = '検索条件と合っている記事を見つかりました。';
        $var['no_job_found'] = '仕事が見つかりませんでした。';


        $var['user_page'] = 'ユーザーページ';
        $var['favourite_job'] = 'お気に入りの求人';
        $var['no_favourite_job'] = 'お気に入りの求人がありません。';
        $var['favourite_company'] = 'お気に入りの送出機関・登録支援機関';
        $var['no_favourite_company'] = 'お気に入りの送出機関・登録支援機関がありません。';
        $var['out_group'] = 'グループから出る';
    }
    else {
        $var['area'] = 'Địa điểm';
        $var['address'] = 'Địa chỉ';
        $var['ranking'] = 'Xếp hạng';
        $var['ranking_note'] = 'Bảng xếp hạng do Hiệp hội phái cử lao động Việt Nam ở nước ngoài (VAMAS) công bố';
        $var['person'] = 'người';
        $var['year'] = 'Năm';
        $var['year_lower'] = 'năm';
        $var['time'] = 'Thời gian';
        $var['age'] = 'Tuổi';
        $var['age_lower'] = 'Tuổi';
        $var['gender'] = 'Giới tính';
        $var['qualification'] = 'Trình độ';
        $var['japanese_level'] = 'Trình độ tiếng Nhật';
        $var['other_conditions'] = 'Yêu cầu khác';
        $var['from'] = 'Từ';
        $var['to'] = 'đến';
        $var['hour'] = 'giờ';
        $var['day'] = 'ngày';
        $var['month'] = 'tháng';
        $var['photo'] = 'Hình ảnh';
        $var['login'] = 'Đăng nhập';
        $var['register'] = 'Đăng ký';
        $var['all'] = 'Tất cả';
        $var['faq'] = 'Hỏi đáp';
        $var['please_contact'] = 'Xin vui lòng liên hệ với chúng tôi';
        $var['vieclam'] = 'Đơn hàng';
        $var['visa_type'] = 'Tư cách lưu trú';
        $var['visa_tts'] = 'Thực tập sinh';
        $var['visa_tgVN'] = 'Kỹ năng đặc định (Việt Nam)';
        $var['visa_tgJP'] = 'Kỹ năng đặc định (Nhật Bản)';
        $var['occupation'] = 'Ngành nghề';
        $var['salary'] = 'Mức lương';
        $var['choose_salary'] = 'Chọn lương';

        $var['view_all'] = 'Xem tất cả';
        $var['view_more'] = 'Xem thêm';
        $var['view_detail'] = 'Xem chi tiết';
        $var['deadline'] = 'Hạn nộp hồ sơ';
        $var['favorite'] = 'Yêu thích';
        $var['sort_select'] = 'Sắp xếp theo điều kiện';
        $var['sort_new'] = 'Sắp xếp theo mới nhất';
        $var['sort_old'] = 'Sắp xếp theo cũ nhất';

        $var['vieclam_title'] = 'Đơn hàng tuyển dụng';
        $var['vieclam_realted_title'] = 'Những đơn hàng cùng ngành nghề';
        $var['vieclam_views_title'] = 'Những đơn hàng xem nhiều';
        $var['vieclam_new'] = 'Đơn hàng mới';
        $var['vieclam_sort_new'] = 'Đơn hàng mới nhất';
        $var['vieclam_sort_old'] = 'Đơn hàng cũ';
        $var['vieclam_sort_salary_high'] = 'Đơn hàng có mức lương cao';
        $var['vieclam_sort_salary_low'] = 'Đơn hàng có mức lương thấp';
        $var['vieclam_sort_deadline_near'] = 'Đơn hàng gần đến hạn nộp hồ sơ';
        $var['vieclam_sort_deadline_far'] = 'Đơn hàng còn hạn nộp hồ sơ dài';
        $var['vieclam_expired'] = 'Công việc này đã hết hạn';
        $var['vieclam_apply'] = 'Ứng tuyển';
        $var['vieclam_apply_note'] = 'Về việc tuyển dụng, vui lòng liên hệ với nhân viên của chúng tôi về thông tin tuyển dụng chi tiết sau';

        $var['vieclam_company'] = 'Đơn hàng tuyển dụng công ty phái cử';
        $var['vieclam_info'] = 'Thông tin đơn hàng';
        $var['vieclam_des'] = 'Nội dung công việc';
        $var['vieclam_required'] = 'Yêu cầu ứng tuyển';
        $var['vieclam_salary_tax_included'] = '(Đã bao gồm thuế)';
        $var['vieclam_salary_base'] = 'Lương cơ bản (chưa có tăng ca)';
        $var['vieclam_salary_increase_bonus'] = 'Tăng lương, thưởng';
        $var['vieclam_salary_increase'] = 'Tăng lương';
        $var['vieclam_salary_bonus'] = 'Thưởng';
        $var['vieclam_money_saved'] = 'Số tiền tích lũy sau 3 năm';
        $var['vieclam_welfare_insurance'] = 'Phúc lợi, bảo hiểm';
        $var['vieclam_insurance'] = 'Bảo hiểm';
        $var['vieclam_workby'] = 'Hình thức di chuyển';
        $var['vieclam_workingtime'] = 'Thời gian làm việc';
        $var['vieclam_holyday'] = 'Ngày nghỉ trong năm';
        $var['vieclam_other'] = 'Ngoài ra';
        $var['vieclam_schedule'] = 'Lịch trình tham gia';
        $var['vieclam_interview'] = 'Phỏng vấn';
        $var['vieclam_interview_form'] = 'Hình thức phỏng vấn';
        $var['vieclam_registration_deadline'] = 'Thời hạn đăng ký';
        $var['vieclam_start_work'] = 'Xuất cảnh dự kiến';
        $var['vieclam_applicants'] = 'Số người ứng tuyển';

        $var['vieclam_apply_method'] = 'Phương pháp ứng tuyển';
        $var['vieclam_apply_contact_note'] = 'Thông tin liên lạc sau khi ứng tuyển';
        $var['vieclam_recruit_schedule'] = 'Quy trình tuyển dụng';
        $var['vieclam_recruit_form'] = 'Hình thức tuyển dụng';
        $var['vieclam_apply_q'] = 'Bạn có khúc mắc trong quá trình ứng tuyển';
        $var['vieclam_apply_a'] = 'Nếu bạn có bất kỳ mối quan tâm về công việc này hoặc muốn biết thêm thông tin, xin vui lòng liên hệ với chúng tôi bằng cách sử dụng mẫu dưới đây. Nhân viên của chúng tôi sẽ trả lời.';

        $var['concierge_title'] = 'Hãy liên hệ với chúng tôi';
        $var['concierge_subtitle'] = 'Với những chuyên viên dày dặn kinh nghiệm';
        $var['concierge_note01'] = 'Những chuyên viên với nhiều năm học tập và làm việc tại Nhật cũng như làm việc tại các';
        $var['concierge_note02'] = 'sẽ tư vấn vấn tận tình những vấn đề mà bạn đang băn khoăn về đơn hàng và';
        $var['concierge_link'] = 'Kết nối với chuyên viên';

        $var['company_profile_year'] = 'Hồ sơ năm';
        $var['company_overview'] = 'Khái quát';
        $var['company_performance'] = 'Thành tích';
        $var['company_cost'] = 'Chi phí';
        $var['company_equipment'] = 'Cơ sở thiết bị';

        $var['company_info'] = 'Thông tin cơ bản';
        $var['company_office'] = 'Trụ sở chính';
        $var['company_branch'] = 'Chi nhánh tại Việt Nam';
        $var['company_representative'] = 'Người đại diện';
        $var['company_establishment_year'] = 'Năm thành lập';
        $var['company_employees'] = 'Số lượng nhân viên';
        $var['company_japanese_teachers'] = 'Số lượng giáo viên người Nhật';
        $var['company_educational_policy'] = 'Phương châm giáo dục';
        $var['company_people_number'] = 'Số lượng TTS xuất cảnh từ công ty XKLĐ';
        $var['company_sending_area'] = 'Khu vực ở Nhật Bản của thực tập sinh đã xuất cảnh';
        $var['company_branch'] = 'Chi nhánh tại Việt Nam';
        $var['company_capacity'] = 'Sức chứa';
        $var['company_education_center'] = 'Có các trung tâm giáo dục hay không';
        $var['company_job_intro'] = 'Giới thiệu ngành nghề';
        $var['company_base_system'] = 'Hệ thống theo dõi tại Nhật Bản';
        $var['company_list_base'] = 'Danh sách chi nhánh';
        $var['company_highlight'] = 'Những điểm nổi bật của công ty XKLĐ';
        $var['company_few_words'] = 'Đôi lời về…';
        $var['company_vieclam_recruiting'] = 'Đơn hàng đang tuyển dụng';
        $var['company_vieclam_recruiting_note'] = 'Hiện tại đã đăng';
        $var['company_vieclam_recruiting_num'] = 'bài';
        $var['company'] = 'Công ty';
        $var['company_xkld'] = 'Công ty XKLĐ';
        $var['company_htdk'] = 'Tổ chức hỗ trợ đăng ký';
        $var['company_xkld_heading'] = 'Danh sách công ty XKLĐ';
        $var['company_xkld_name'] = 'Tên công ty XKLĐ';
        $var['company_htdk_heading'] = 'Danh sách tổ chức hỗ trợ đăng ký';
        $var['company_htdk_name'] = 'Tên tổ chức hỗ trợ đăng ký';
        $var['company_xkld_contact'] = 'Thông tin liên hệ Công ty XKLĐ';
        $var['company_xkld_contact_note'] = 'Nếu bạn có bất kỳ câu hỏi nào về Công ty XKLĐ này hoặc muốn biết thêm thông tin chi tiết, vui lòng liên hệ với chúng tôi bằng cách sử dụng biểu mẫu bên dưới đây. Nhân viên của chúng tôi sẽ giải đáp các thắc mắc của bạn.';
        $var['company_htdk_contact'] = 'Thông tin liên hệ Tổ chức hỗ trợ đăng ký';
        $var['company_htdk_contact_note'] = 'Nếu bạn có bất kỳ câu hỏi nào về Tổ chức hỗ trợ đăng ký này hoặc muốn biết thêm thông tin chi tiết, vui lòng liên hệ với chúng tôi bằng cách sử dụng biểu mẫu bên dưới đây. Nhân viên của chúng tôi sẽ giải đáp các thắc mắc của bạn.';
        $var['company_registration_number'] = 'Số đăng ký';
        $var['company_establishment_date'] = 'Ngày đăng ký';
        $var['company_support_language'] = 'Ngôn ngữ hỗ trợ';
        $var['company_pic'] = 'Người phụ trách (nói Tiếng Việt)';
        $var['company_pic_email'] = 'E-mail người phụ trách (nói Tiếng Việt)';
        $var['company_management_policy'] = 'Phương châm quản lý';
        $var['company_registration_number'] = 'Số đăng ký';
        $var['company_supported'] = 'Đã hỗ trợ';

        $var['working_japan'] = 'Tư cách làm việc tại Nhật Bản';
        $var['working_japan_note'] = 'Để làm việc tại Nhật Bản đối với người nước ngoài thì việc được cấp tư cách lưu trú là điều quan trọng nhất. Những năm gần đây, người nước ngoài đến Nhật Bản làm việc không ngừng tăng vọt. Người nước ngoài làm việc với tư cách lưu trú chủ yếu là "Thực tập sinh kỹ năng" hoặc "Kỹ năng đặc định". Chúng tôi sẽ tóm tắt nội dung, chế độ cũng như giải thích cơ bản về từ cách lưu trú đối với thực tập sinh và kỹ năng đặc định đến các ứng viên có mong muốn làm việc tại Nhật Bản.';
        $var['labor_policy'] = 'Chế độ lao động tại Nhật Bản';
        $var['labor_policy_note'] = 'Đây là một dự án phát triển nguồn nhân lực quốc tế do chính phủ Nhật Bản thành lập. Với mục đích giúp nguồn nhân lực tiếp thu công nghệ trình độ cao và đào tạo nhân tài mong muốn dẫn dắt sự phát triển của đất nước đó. Từ tháng 11 năm 2017 "phương pháp đào tạo kỹ năng" được thi hành và bắt đầu triển khai với chế độ lao động người nước ngoài.';

        $var['useful_info'] = 'Thông tin hữu ích';
        $var['useful_info_des'] = 'Cung cấp thông tin hữu ích cho các thực tập sinh kỹ năng và những người đi Nhật theo diện kỹ năng đặc định, chẳng hạn như cách lựa chọn công ty phái cử, đơn hàng và thông tin về cuộc sống tại Nhật Bản.';

        // Search
        $var['search'] = 'Tìm kiếm';
        $var['search_keyword'] = 'Từ khóa';
        $var['search_vieclam_title'] = 'Tìm kiếm đơn hàng';
        $var['search_company_title'] = 'Tìm kiếm các tổ chức hỗ trợ';
        $var['change_search'] = 'Thay đổi điều kiện tìm kiếm';
        $var['search_result'] = 'Kết quả tìm kiếm';
        $var['search_result_from'] = 'Hiển thị kết quả từ';
        $var['no_found'] = 'Không tìm thấy';
        $var['matching_found'] = 'phù hợp với tiêu chí của bạn.';
        $var['no_job_found'] = 'Không tìm thấy công việc';


        $var['user_page'] = 'Trang cá nhân';
        $var['favourite_job'] = 'Công việc yêu thích';
        $var['no_favourite_job'] = 'Không có Công việc yêu thích nào';
        $var['favourite_company'] = 'Công ty XKLĐ, Tổ chức hỗ trợ đăng ký yêu thích';
        $var['no_favourite_company'] = 'Không có công ty XKLĐ, tổ chức hỗ trợ đăng ký yêu thích nào';
        $var['out_group'] = 'Ra khỏi nhóm';

    }
    return $var;
}

/* Thêm cột dữ liệu vào Đơn hàng tuyển dụng */

function post_columns_head($defaults)
{
    global $post;
    if ($post->post_type=='vieclam') {
        $defaults['post_occupation'] = 'Occupation';
        $defaults['post_company'] = 'Company';
        $defaults['post_visa'] = 'Visa';
        $defaults['post_location'] = 'Location';
        $defaults['post_deadline'] = 'Deadline';
        $defaults['post_startwwork'] = 'Start date of work';
        $defaults['post_salary'] = 'Salary';
        $defaults['post_workingtime'] = 'Working time';
        $defaults['post_applicants'] = 'Number of applicants';
        $defaults['post_views'] = 'Views';
    }
    return $defaults;
}
add_filter('manage_posts_columns', 'post_columns_head');

function post_columns_content($column_name, $post_ID)
{
    global $post;

    $occupation_s = commonObjects::get_occupations($post_ID);
    $visa_s = commonObjects::get_visa($post_ID);
    $area_s = commonObjects::get_areas($post_ID);

    if ($column_name == 'post_occupation') {
        if ($occupation_s) {
            foreach($occupation_s as $occupation){
                echo $occupation->name;
            }
            if (next($occupation_s)) echo ', ';
        }
    }

    if ($column_name == 'post_company')
    {
        $connected = new WP_Query(array(
            'connected_type' => 'vieclam_to_xkld',
            'connected_items' => $post,
            'nopaging' => true
        ));
        while ($connected->have_posts()) : $connected->the_post();
            ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php
        endwhile;
    }
    if ($column_name == 'post_visa') {
        foreach($visa_s as $visa){
            echo $visa->name;
        }
    }

    if ($column_name == 'post_location') {
        foreach($area_s as $area){
            echo $area;
        }
    }

    if ($column_name == 'post_deadline')
    {
        if (get_post_meta($post_ID, '募集期限', true))
        {
            $deadline = get_post_meta($post_ID, '募集期限', true);
            $deadline_format = date("d/m/Y", strtotime($deadline));
            echo $deadline_format;
        }
    }

    if ($column_name == 'post_startwwork')
    {
        $startwwork = get_field('就業開始予定日', $post_ID);
        if ($startwwork != '')
        {
            echo $startwwork;
        }
    }
    if ($column_name == 'post_salary')
    {
        $salary = get_field_object( '月給', $post_ID );
        if ($salary != '')
        {
            $value = $salary['value'];
            $label = $salary['choices'][ $value ];
            echo esc_html($label);
        }
    }

    if ($column_name == 'post_workingtime')
    {
        $workingtime = get_field('労働時間', $post_ID);
        if ($workingtime != '')
        {
            echo $workingtime;
        }
    }
    if ($column_name == 'post_applicants')
    {
        $applicants = get_field('募集人数', $post_ID);
        if ($applicants != '')
        {
            echo $applicants;
        }
    }

    if ($column_name == 'post_views')
    {
        echo get_post_views(get_the_ID());
    }
}
add_action('manage_posts_custom_column', 'post_columns_content', 10, 2);

function my_login_redirect() {
    global $redirect_to, $pagenow, $typenow, $post;
    //print_r($pagenow);die();
    if ($GLOBALS['pagenow'] !== 'wp-login.php' || $pagenow !== 'wp-login.php') {
        if (!isset($_GET['redirect_to'])) {
            $redirect_to = home_url('/mypage');
        }
        else{
            //session_start();
            $xkld_name = $_GET['xkld_name'];
            if ($xkld_name) {
                $redirect_to = $_GET['redirect_to'].'&xkld_name='.$xkld_name;
            }
            else {
                $redirect_to = $_GET['redirect_to'];
            }
        }
    }
    else {
        $redirect_to = admin_url();
    }
}
add_action( 'login_form', 'my_login_redirect');

function _my_redirect_to($url, $service, $context)
{
    $redirect_to = home_url();
    return $redirect_to;

}
add_filter('gianism_redirect_to', '_my_redirect_to', 10, 3);

/* Xuất thông tin Đơn hàng tuyển dụng ra file excel */

function admin_post_list_add_export_button( $which ) {
    global $typenow;
    if ( 'vieclam'=== $typenow && 'top'=== $which ) {
        ?>
        <input type="submit" name="export_all_posts" class="button button-primary" value="<?php _e('Export All to Excel File'); ?>"/>
        <?php
    }
}
add_action('manage_posts_extra_tablenav', 'admin_post_list_add_export_button', 20, 1);

function func_export_all_posts()
{
    if (isset($_GET['export_all_posts']))
    {
        $arg = array(
            'post_type' => 'vieclam',
            'post_status' => 'publish',
            'posts_per_page' => - 1
        );

        $posts = get_posts($arg);
        $today = date('d-m-Y');

        if ($posts)
        {
            include_once('inc/xlsxwriter.class.php');

            $fileLocation = 'vieclam_'.$today.'.xlsx';
            $header = array(
                'Title'=>'string',
                'Date'=>'string',
                'Occupation'=>'string',
                'Occupation Parent'=>'string',
                'Company'=>'string',
                'Visa'=>'string',
                'Location'=>'string',
                'Deadline'=>'string',
                'Start date of work'=>'string',
                'Salary'=>'string',
                'Working time'=>'string',
                'Number of applicants'=>'string',
                'Views'=>'string',
                'Link'=>'string'
            );

            foreach($posts as $post) {
                $vieclam_title = $post->post_title;
                $vieclam_date = date("d/m/Y", strtotime($post->post_date));
                $vieclam_link = get_the_permalink($post->ID);

                $occupation_s = commonObjects::get_occupations($post->ID);

                if ( $occupation_s ) {
                    foreach($occupation_s as $occupation){
                        $vieclam_occupation = $occupation->name;

                        $parent = get_term( $occupation->parent, $occupation->taxonomy );

                        if ($parent) {
                            $vieclam_occupation_parent = $parent->name;
                        }
                        if (!$occupation->parent) {
                            $vieclam_occupation_parent = $vieclam_occupation;
                        }
                    }
                }

                $connected = new WP_Query(array(
                    'connected_type' => 'vieclam_to_xkld',
                    'connected_items' => $post,
                    'nopaging' => true,
                    'suppress_filters' => false
                ));
                while ($connected->have_posts()) : $connected->the_post();
                    ?><?php $vieclam_company = get_the_title(); ?><?php
                endwhile;
                wp_reset_postdata();

                $visa_s = commonObjects::get_visa($post->ID);
                if ($visa_s) {
                    foreach($visa_s as $visa){
                        $vieclam_visa =  $visa->name;
                    }
                }

                /*
                $area_s = commonObjects::get_areas($post->ID);

                if (!empty($area_s)) {
                    foreach($area_s as $area){
                        $vieclam_area = $area;
                    }
                }
                */

                $vieclam_area = '';

                if (get_post_meta($post->ID, '募集期限', true))
                {
                    $deadline = get_post_meta($post->ID, '募集期限', true);
                    $vieclam_deadline = date("d/m/Y", strtotime($deadline));
                }

                if (get_field('就業開始予定日', $post->ID))
                {
                    $vieclam_startwwork = get_field('就業開始予定日', $post->ID);
                }

                if (get_field_object( '月給', $post->ID ))
                {
                    $salary_object = get_field_object( '月給', $post->ID );
                    $value = $salary_object['value'];
                    $label = $salary_object['choices'][ $value ];
                    $vieclam_salary =  esc_html($label);
                }

                if (get_field('労働時間', $post->ID))
                {
                    $vieclam_workingtime = get_field('労働時間', $post->ID);
                }
                if (get_field('募集人数', $post->ID))
                {
                    $vieclam_applicants = get_field('募集人数', $post->ID);
                }

                $vieclam_views = get_post_meta(get_the_ID(), 'post_views_count', true);

                $rows[] = array($vieclam_title, $vieclam_date, $vieclam_occupation,  $vieclam_occupation_parent, $vieclam_company, $vieclam_visa, $vieclam_area, $vieclam_deadline, $vieclam_startwwork, $vieclam_salary, $vieclam_workingtime, $vieclam_applicants, $vieclam_views, $vieclam_link);
            }

            $writer = new XLSXWriter();
            $writer->writeSheetHeader('Sheet1', $header);
            foreach($rows as $row){
                $writer->writeSheetRow('Sheet1', $row);
            }
            $writer->writeToFile($fileLocation);

            header('Content-Description: File Transfer');
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header("Content-Disposition: attachment; filename=" . basename($fileLocation));
            header("Content-Transfer-Encoding: binary");
            header("Expires: 0");
            header("Pragma: public");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header('Content-Length: ' . filesize($fileLocation));

            ob_clean();
            flush();
            readfile($fileLocation);
            unlink($fileLocation);
            exit();
        }
    }
}

add_action('init', 'func_export_all_posts');

/* Lấy thông tin thành viên đăng nhập qua Facebook, google */
function track_user_login (){
    if( $login_amount = get_user_meta( get_current_user_id(), 'login_amount', true ) ){
        update_user_meta( get_current_user_id(), 'login_amount', ++$login_amount );
    } else {
        update_user_meta( get_current_user_id(), 'login_amount', 1 );
    }
}
add_action( 'init', 'track_user_login' );

function user_logged_in() {
    if( is_user_logged_in() ) {
        global $current_user;
        get_currentuserinfo();
        $user = get_user_meta( $current_user->ID );
        $login_amount = get_user_meta( $current_user->ID, 'login_amount', true );

        if ($login_amount == 1) {
            if (isset($user['_wpg_google_account']) || isset($user['_wpg_facebook_id'])) {

                require('phpmailer/class.phpmailer.php');
                require('phpmailer/class.smtp.php');

                if (isset($user['_wpg_google_account']))
                {
                    $msg="Có thành viên đăng nhập mới từ Google";
                    $msg.='<p>Name: '.$user['nickname'][0].'</p>';
                    $msg.='<p>E-mail: '.$user['_wpg_google_account'][0].'</p>';
                }
                if (isset($user['_wpg_facebook_id']))
                {
                    $msg="Có thành viên đăng nhập mới từ Facebook";
                    $msg.='<p>Facebook Name: '.$user['nickname'][0].'</p>';
                    $msg.='<p>Facebook ID: '.$user['_wpg_facebook_id'][0].'</p>';
                }
                if (isset($user['_wpg_facebook_mail']))
                {
                    $msg.='<p>E-mail: '.$user['_wpg_facebook_mail'][0].'</p>';
                }

                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->CharSet = "utf-8";
                $mail->SMTPDebug = 0;
                $mail->SMTPAuth = TRUE;
                $mail->SMTPSecure = "tls";
                $mail->Port     = "587";
                $mail->Username = "viecjapan.vn@gmail.com";
                $mail->Password = "szxkahydmmpsjofc";
                $mail->Host     = "smtp.gmail.com";
                $mail->Mailer   = "smtp";
                $mail->Subject = "Thông báo thành viên đăng nhập mới";
                $mail->SetFrom("viecjapan@sougo-career-vietnam.com", "ViecJapan");
                $mail->AddReplyTo("viecjapan@sougo-career-vietnam.com", "ViecJapan");
                $mail->AddAddress("viecjapan@sougo-career-vietnam.com");
                $mail->WordWrap   = 80;
                $mail->MsgHTML($msg);
                $mail->IsHTML(true);
                $mail->Send();
            }
        }
    }
}
add_action( 'init', 'user_logged_in' );

function get_file_url( $file = __FILE__ ) {
    $file_path = str_replace( "\\", "/", str_replace( str_replace( "/", "\\", WP_CONTENT_DIR ), "", $file ) );
    if ( $file_path )
        return content_url( $file_path );
    return false;
}
function pippin_get_image_id($image_url) {
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
    return $attachment[0];
}
function get_url_image_vieclam ($filename) {
    $image_src = wp_upload_dir()['baseurl'] . '/2021/07/' . _wp_relative_upload_path( $filename );
    return $image_src;
}
function get_path_image_vieclam ($filename) {
    $image_src = wp_upload_dir()['basedir'] . '/2021/07/' . _wp_relative_upload_path( $filename );
    return $image_src;
}
function get_medium_size_image_vieclam () {
    global $_wp_additional_image_sizes;
    $auto_image_size = $_wp_additional_image_sizes['single-image']['width'] . 'x' . $_wp_additional_image_sizes['single-image']['height'];
    return $auto_image_size;
}
function get_small_size_image_vieclam () {
    global $_wp_additional_image_sizes;
    $auto_image_size = $_wp_additional_image_sizes['post-thumbnail-2nd']['width'] . 'x' . $_wp_additional_image_sizes['post-thumbnail-2nd']['height'];
    return $auto_image_size;
}

/* Chỉnh sửa CSS trong Đơn hàng tuyển dụng */
add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
    global $typenow;
    if ( 'vieclam'=== $typenow ) {
        echo '<style>
        table.fixed {
            table-layout: auto;
        }
        .fixed .column-date {
            width: 9%;
        }
        .fixed .column-post_visa {
            width: 6%;
        }  
        .fixed .column-post_salary {
            width: 7%;
        } 
        .fixed .column-post_holiday {
            width: 7%;
        }
        </style>';
    }
}

function get_company_type()
{
    $company_id = $_GET['c_id'];

    if ($company_id == 'xkld') $html = 'Công ty XKLĐ';
    if ($company_id == 'ho-tro-dang-ky') $html = 'Tổ chức hỗ trợ đăng ký';

    return  $html;
}
function custom_add_form_tag () {
    wpcf7_add_form_tag( 'company_type', 'get_company_type' );
}
add_action( 'wpcf7_init', 'custom_add_form_tag' );
add_shortcode("get_company_type", "get_company_type");

function my_custom_lang() {
    echo '<style>
    ul li.wpml-ls-menu-item {        
        margin: 0 !important;;
        opacity: 1 !important;;        
    }
    #tagsdiv-recruit_cat {
        display: none;
    }
    </style>';

    if (ICL_LANGUAGE_CODE == 'vi') {
        echo
        '<style> .wpml-ls-item-vi {display:none !important;}</style>';
    }
    if (ICL_LANGUAGE_CODE == 'ja') {
        echo '<style> .wpml-ls-item-ja {display:none !important;}</style>';
    }
}
add_action( 'wp_head', 'my_custom_lang');

function my_custom_css() {
    echo '<style>    
    #tagsdiv-recruit_cat, #tagsdiv-recruit_tokuteigino_cat, #job_catdiv, #tagsdiv-visa {
        display: none;
    }
    </style>';
}
add_action( 'admin_head', 'my_custom_css');

/*
function checktoradio(){
    echo '<script type="text/javascript">jQuery("#visachecklist input, .selectit input").each(function(){this.type="radio"});</script>';
}
*/

function action_show_field_vieclam() {
    echo '<script type="text/javascript">        
        jQuery(function($) { 
            $(function() {   
                $("#recruit_catdiv").css("display", "none"); 
                $("#recruit_tokuteigino_catdiv").css("display", "none");             
                $("#visa .acf-checkbox-list input").each(function() {
                    if(this.checked == "1" && this.value == "320") {
                        $("#p2p-to-vieclam_to_ho-tro-dang-ky").css("display", "none");
                        $("#p2p-to-vieclam_to_xkld").css("display", "block");                        
                    } 
                    if(this.checked == "1" && (this.value == "321" || this.value == "322")) {
                        $("#p2p-to-vieclam_to_xkld").css("display", "none");
                        $("#p2p-to-vieclam_to_ho-tro-dang-ky").css("display", "block");
                    }
                });
                $("#visa .acf-checkbox-list input").change(function() {
                    var val = $(this).val(),
                    $this = $(this);
                    if(val == "320"){
                        $("#p2p-to-vieclam_to_ho-tro-dang-ky").css("display", "none");
                        $("#p2p-to-vieclam_to_xkld").css("display", "block");                                             
                    } else{
                        $("#p2p-to-vieclam_to_xkld").css("display", "none");
                        $("#p2p-to-vieclam_to_ho-tro-dang-ky").css("display", "block");
                    }
                });
            });
        });
    </script>';
}
add_action('admin_footer', 'action_show_field_vieclam');

add_filter( 'aioseo_schema_disable', 'aioseo_disable_schema' );
function aioseo_disable_schema( $disabled ) {
    return true;
}

?>