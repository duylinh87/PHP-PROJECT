<?php
$s = $_GET['s'];
$area_tag = $_GET['area_tag'];
$htdk_area_tag = $_GET['htdk_area_tag'];
$ranking = $_GET['ranking'];
$company_type = $_GET['company_type'];
?>

<form method="get" id="searchform" class="search-company-form" action="<?php bloginfo('url'); ?>">
    <div class="company-type">
        <?php
        $field = ['xkld'=>'Công ty XKLĐ', 'ho-tro-dang-ky'=>'Tổ chức hỗ trợ dăng ký'];        
        if( $field )
        {
            echo '<div class="company-type-ttl"><i class="fa fa-building"></i>';
            _e('[:vi]Công ty [:jp]社名');
            echo '</div>';
            echo '<ul class="list-company">';
            foreach($field as $k => $v):
                ?>
                <li class="item-company">
                    <label class="title-company">
                        <input type="radio" name="company_type" onclick="OnChangeCompany(this)" value="<?php echo $k; ?>"<?php if($k == 'xkld' || $company_type == $k){ ?>checked<?php } ?>>
                        <span class="radio-field-text"><?php echo _e($v); ?></span>
                    </label>
                </li>
            <?php
            endforeach;
            echo '</ul>';
        }
        ?>
    </div>   
	
    <label for="s" class="assistive-text">Cơ quan phái cử</label>
    <input style="float: none;" type="text" name="s" id="s" placeholder="<?php if($company_type == 'ho-tro-dang-ky') { echo _e('[:vi]Tìm kiếm Tổ chức hỗ trợ đăng ký [:jp]登録支援機関'); } else {echo _e('[:vi]Tìm kiếm Công ty XKLĐ [:jp]送り出し機関');;} ?>" value="<?php if($s){ echo $s; } ?>">
    <input type="hidden" id='post_type' name="post_type" value="xkld">

    <span class="span-area_tag span-select" id="span-area_tag">
        <select name="area_tag" class="area_tag">
        <option value=""><?php _e('[:vi]Địa điểm [:jp]勤務地から探す'); ?></option>
        <?php
        $taxonomy_name = 'area_tag';
        $taxonomys = get_terms($taxonomy_name,'hide_empty=0');
        if(!is_wp_error($taxonomys) && count($taxonomys)):
            foreach($taxonomys as $taxonomy):
                $tax_posts = get_posts(array('post_type' => get_post_type('xkld'), 'taxonomy' => $taxonomy_name, 'term' => $taxonomy->slug ) );
                // if($tax_posts):
                ?>
                <option value="<?php echo $taxonomy->slug; ?>"<?php if( $area_tag == $taxonomy->slug ){ ?>selected<?php } ?>><?php echo $taxonomy->name; ?></option>
                <?php
                // endif;
            endforeach;
        endif;
        ?>
        </select>
    </span>
    <span class="span-area_tag span-select" id="span-htdk_area_tag">
        <select name="htdk_area_tag" class="area_tag">
        <option value=""><?php _e('[:vi]Địa điểm [:jp]勤務地から探す'); ?></option>
        <?php
        $taxonomy_name = 'htdk_area_tag';
        $taxonomys = get_terms($taxonomy_name,'hide_empty=0');
        if(!is_wp_error($taxonomys) && count($taxonomys)):
            foreach($taxonomys as $taxonomy):
                $tax_posts = get_posts(array('post_type' => get_post_type('ho-tro-dang-ky'), 'taxonomy' => $taxonomy_name, 'term' => $taxonomy->slug ) );
                // if($tax_posts):
                ?>
                <option value="<?php echo $taxonomy->slug; ?>"<?php if( $htdk_area_tag == $taxonomy->slug ){ ?>selected<?php } ?>><?php echo $taxonomy->name; ?></option>
                <?php
                // endif;
            endforeach;
        endif;
        ?>
        </select>
    </span>
    <span class="span-ranking span-select" id="span-ranking">
        <select name="ranking" class="ranking">
            <option value=""><?php _e('[:vi]Xếp hạng [:jp]VAMASランキング'); ?></option>
            <?php
            $i = 1;
            while($i <= 6) { ?>
                <option value="<?php echo $i; ?>"<?php if( $ranking == $i ){ ?>selected<?php } ?>><?php echo $i; ?></option>
            <?php
            $i++;
            }
            ?>
        </select>
    </span>
    <input type="submit" value="<?php _e('[:vi]Tìm kiếm [:jp]探す'); ?>" />	  
</form>