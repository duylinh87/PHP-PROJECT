<?php get_header(); ?>
<div id="content">
<div class="wrap">
    <?php bzb_breadcrumb(); ?>
<?php

$var = commonVariables();
$post_type = $_GET['post_type'];
if ( $post_type == 'vieclam') {    
    if ($_GET['recruit_cat']) {
        $recruit_cat = $_GET['recruit_cat'];
        $taxonomy = 'recruit_cat';
    }
    if ($_GET['recruit_tokuteigino_cat']) {        
        $recruit_cat = $_GET['recruit_tokuteigino_cat'];
        $taxonomy = 'recruit_tokuteigino_cat';
    }
    
    $visa = $_GET['visa'];
    $pref_name = $_GET['pref_name'];
    $salary = $_GET['salary'];
    $salary_type = $_GET['salary_type'];
    $hourly_salary = $_GET['hourly_salary'];
    $daily_salary = $_GET['daily_salary'];
    $monthly_salary = $_GET['monthly_salary'];

    ?>
    <div class="search-wrap">
        <p class="sp search-change search-close"><?php echo $var['search_result']; ?></p>
        <?php get_template_part( 'template-parts/vieclam', 'form' ); ?>
    </div>
    <?php
    //tax_query用

    if($visa){
        $taxquerysp[] = array(
            'taxonomy'=>'visa',
            'terms'=> $visa,           
            'field'=>'slug',
            'operator'=>'AND'
        );      
    }
    
    if($recruit_cat){
        $taxquerysp[] = array(
            'taxonomy'=> $taxonomy,
            'terms'=> $recruit_cat,       
            //'terms' => get_term_children($term->term_id, $term->taxonomy),
            'include_children'=>false,
            'field'=>'slug',          
            'hierarchical'=>1,       
            'operator'=>'AND'
        );    
        $taxquerysp['relation'] = 'AND';
    }   

    if($pref_name) {
        $metaquerysp[] = array(
            'key'=>'勤務地',
            'value'=> $pref_name,
            'compare'=>'LIKE',        
        );
    }

    if ($salary && ($visa == '' || $visa == 'thuc-tap-sinh')) {
        $salary_high = (int)$salary + 4999999.99;
        $metaquerysp[] = array(
            'key'=>'月給',
            'value'=>array( $salary, $salary_high ),
            'compare'=>'BETWEEN',
            'type' => 'NUMERIC'
        );
    }
    else {
        if($hourly_salary != '' && $salary_type == 1 && $visa != 'thuc-tap-sinh'){
            $metaquerysp[] = array(
                'key'=>'salary_hourly_salary',
                'value'=>$hourly_salary,
                'compare'=>'>=',
                'type' => 'UNSIGNED'
            );
        }

        if($daily_salary != '' && $salary_type == 2 && $visa != 'thuc-tap-sinh'){
            $metaquerysp[] = array(
                'key'=>'salary_daily_salary',
                'value'=>$daily_salary,
                'compare'=>'>=',
                'type' => 'UNSIGNED'
            );
        }

        if($monthly_salary != '' && $salary_type == 3 && $visa != 'thuc-tap-sinh'){
            $metaquerysp[] = array(
                'key'=>'salary_monthly_salary',
                'value'=>$monthly_salary,
                'compare'=>'>=',
                'type' => 'UNSIGNED'
            );
        }
    }

    $date = date('Y/m/d');
    $metaquerysp[] = array(
            'key'=>'募集期限',
            'value'=> $date,
            'compare' => '>=',
            'type' => 'DATE'
        );
        $s = $_GET['s'];
    ?>   
    <?php
        if ($salary && ($visa == '' || $visa == 'thuc-tap-sinh')) {
            $field_key = "field_5f587baec4be6";
            $field = get_field_object($field_key);
            $salary_param = $field['choices'][ $salary ] . '/' . $var['month'];
        }
        else {
            if ($hourly_salary && $salary_type == 1 && $visa != 'thuc-tap-sinh') {
                $field = get_field_object( 'field_61079d9a24026' );
                $salary_param = $field['choices'][ $hourly_salary ];
                $salary_param_type = $var['hour'];
            }
            if ($daily_salary && $salary_type == 2 && $visa != 'thuc-tap-sinh') {
                $field = get_field_object( 'field_61079de924027' );
                $salary_param = $field['choices'][ $daily_salary ];
                $salary_param_type = $var['day'];
            }
            if ($monthly_salary && $salary_type == 3 && $visa != 'thuc-tap-sinh') {
                $field = get_field_object( 'field_61079ea224028' );
                $salary_param = $field['choices'][ $monthly_salary ];
                $salary_param_type = $var['day'];
            }
            $salary_param = $salary_param . '/' . $salary_param_type;
        }
    ?>

    <!-- 検索条件を表示 -->
    <div class="parameter">
        <div class="parameter-inner clearfix">
            <?php if($s){ ?><p class="p1"><?php echo $var['search'] . ': ' . $s; ?><br></p><?php } ?>
            <?php if($recruit_cat){ ?><p class="p2"><?php echo $var['occupation'] . ': ' . get_term_by('slug',$recruit_cat,$taxonomy)->name; ?></p><?php } ?>
            <?php if($pref_name){ ?><p class="p3"><?php echo $var['area'] . ': ' . $pref_name; ?><br></p><?php } ?>
            <?php echo '<p class="p4">' .$var['salary'] . ': ' . $salary_param . '</p>'; ?>
            <?php if($visa){ ?><p class="p4"><?php echo $var['visa_type'] . ': ' . get_term_by('slug',$visa,"visa")->name; ?></p><?php } ?>
        </div>

        <?php
        //$paged = get_query_var('paged') ? get_query_var('paged') : 1;
        if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
        elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
        else { $paged = 1; }
        $posts_per_page = 10;
        $args = array(
            'post_type' => $post_type,
            'tax_query' => $taxquerysp,
            'meta_query' => $metaquerysp,
            's' => $s,
            "paged" => $paged,       
            'posts_per_page' => $posts_per_page
        );
        $wp_query = new WP_Query( $args );
        ?>

        <?php
        //件数表示
        $all_num = $wp_query->found_posts; //検索ヒット数
       
        $current_page = get_query_var('paged'); //現在何ページ目か
        $current_last = $posts_per_page * $current_page; //現在のページの最後
        $current_first = $current_last - $posts_per_page + 1; //現在のページの最初
        if( $all_num < $current_last ){ //最終ページ用の調整
            $exceed_num = $current_last - $all_num;
            $current_last = $current_last - $exceed_num;
        }
        ?>
        <div class="parameter-inner-2 clearfix">
            <?php if( $all_num == 0 ){ ?>
            <p class="result-num"><?php echo $var['no_job_found'] . ' ' . $var['matching_found']; ?></p>
            <?php }else{ ?>
            <p class="result-num"><span><?php echo $all_num; ?></span><?php echo $var['search_result_from'] . ' ' . $current_first . '〜' . $current_last; ?></p>
            <?php } ?>

            <!-- ソート -->
            <?php get_template_part( 'template-parts/vieclam', 'sort' ); ?>
        </div>
    </div>

    <?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
        <?php get_template_part( 'template-parts/vieclam', 'loop' ); ?>
    <?php endwhile; else : ?>
    <?php endif;
    if(function_exists('wp_pagenavi')):
       wp_pagenavi(array('query'=>$wp_query)); 
    endif;
    wp_reset_postdata();
    }

?>
<?php 
// 送り出し機関検索結果
$post_type = $_GET['post_type'];
$company_type = $_GET['company_type'];
$area_tag = $_GET['area_tag']; 
$htdk_area_tag = $_GET['htdk_area_tag'];

if ( $post_type == 'xkld' || $post_type == 'ho-tro-dang-ky') {
    $s = $_GET['s'];      
      //echo home_url( add_query_arg( array( $_GET), $wp->request ) );
      esc_url( remove_query_arg( 'area_tag', home_url( add_query_arg( array( $_GET), $wp->request ) ) ) );
    
    $ranking = $_GET['ranking'];
    ?>

    <div class="search-wrap">
        <p class="sp search-change search-close"><?php echo $var['search_result']; ?></p>
        <?php get_template_part( 'template-parts/company', 'form' ); ?>
    </div>
    
    <?php
    //tax_query用
    if($post_type == 'xkld'){
        $taxquerysp[] = array(
            'taxonomy'=>'area_tag',
            'terms'=> $area_tag,
            'include_children'=>false,
            'field'=>'slug',
            'operator'=>'AND'
        );       
    }

    if($post_type == 'ho-tro-dang-ky'){
        $taxquerysp[] = array(
            'taxonomy'=>'htdk_area_tag',
            'terms'=> $htdk_area_tag,
            'include_children'=>false,
            'field'=>'slug',
            'operator'=>'AND'
        );       
    }

    if($ranking){
        $metaquerysp[] = array(
            'key'=>'ランキング',
            'value'=> $ranking,
            'compare'=>'LIKE',
        );

    }
    
    $field = ['xkld'=>$var['company_xkld'], 'ho-tro-dang-ky'=>$var['company_htdk']];
    $label_company = $field[$company_type];

    ?>
    <div class="parameter parameter-xkld">
        <div class="parameter-inner clearfix">
            <?php if($s){ ?><p class="p1"><?php echo $var['search_keyword'] . ': ' . $s; ?></p><?php } ?>
            <?php if($company_type){  ?><p class="p2"><?php echo $var['company'] . ': ' . $label_company; ?></p><?php } ?>
            <?php if($area_tag && $post_type == 'xkld'){ ?><p class="p3"><?php echo $var['area'] . ': ' . get_term_by('slug',$area_tag,"area_tag")->name; ?></p><?php } ?>
            <?php if($htdk_area_tag && $post_type == 'ho-tro-dang-ky'){ ?><p class="p3"><?php echo $var['area'] . ': ' . get_term_by('slug',$htdk_area_tag,"htdk_area_tag")->name; ?></p><?php } ?>
            <?php if($ranking){ ?><p class="p4"><?php echo $var['ranking'] . ': ' . $ranking; ?><br><?php } ?></p>
        </div>
    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $posts_per_page = 10;
    $args = array(
        'post_type' => $post_type,
        'tax_query' => $taxquerysp,
        'meta_query' => $metaquerysp,
        's' => $s,
        'paged' => $paged,
        'posts_per_page' => $posts_per_page,
    );
    $wp_query = new WP_Query( $args );
    
    ?>

     <?php
        //件数表示
        $all_num = $wp_query->found_posts; //検索ヒット数
        $current_page = get_query_var('paged'); //現在何ページ目か
        $current_last = $posts_per_page * $current_page; //現在のページの最後
        $current_first = $current_last - $posts_per_page + 1; //現在のページの最初
        if( $all_num < $current_last ){ //最終ページ用の調整
            $exceed_num = $current_last - $all_num;
            $current_last = $current_last - $exceed_num;
        }
     if ($post_type == 'xkld') $company =  $var['company_xkld'];
     if ($post_type == 'ho-tro-dang-ky') $company =  $var['company_htdk'];
     ?>
        <div class="parameter-inner-2 clearfix">
            <?php if( $all_num == 0 ){ ?>
            <p class="result-num"><?php  echo $var['no_search_result'] . $company . ' ' . $var['matching_found']; ?></p>
            <?php }else{ ?>
            <p class="result-num"><span><?php echo $all_num; ?></span><?php echo $var['search_result_from'] . ' ' . $current_first . '〜' . $current_last; ?></p>
            <?php } ?> 
        </div>
    </div>
    
    <?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>    
    <?php if($post_type == 'xkld') get_template_part( 'template-parts/xkld', 'loop' ); if($post_type == 'ho-tro-dang-ky') get_template_part( 'template-parts/ho-tro-dang-ky', 'loop' ); ?>
    <?php endwhile; else : ?>
    <?php endif;    
    if(function_exists('wp_pagenavi')):
        wp_pagenavi(array('query'=>$wp_query)); 

    endif;
    wp_reset_postdata();
    get_template_part('template-parts/block', 'concierge');
    }
    //echo esc_url( remove_query_arg( 'area_tag' ) );   
?>
</div>
</div>
<?php get_footer(); ?>






