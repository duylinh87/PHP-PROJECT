<?php
$s = $_GET['s'];
$area_tag = $_GET['area_tag'];
$htdk_area_tag = $_GET['htdk_area_tag'];
$ranking = $_GET['ranking'];
$company_type = $_GET['company_type'];
global $post_type;
$var = commonVariables();
?>

<form method="get" id="searchform" class="search-company-form" action="<?php bloginfo('url'); ?>">
    <div class="company-type">
        <?php
        $field = ['xkld'=>$var['company_xkld'], 'ho-tro-dang-ky'=>$var['company_htdk']];
        if( $field )
        {
            echo '<div class="company-type-ttl"><i class="fa fa-building"></i>';
            echo $var['company'];
            echo '</div>';
            echo '<ul class="list-company">';
            foreach($field as $k => $v):
                ?>
                <li class="item-company">
                    <label class="title-company">
                        <input type="radio" name="company_type" value="<?php echo $k; ?>"<?php if($k == 'xkld' || $company_type == $k || $post_type == $k){ ?>checked<?php } ?>>
                        <span class="radio-field-text"><?php echo _e($v); ?></span>
                    </label>
                </li>
            <?php
            endforeach;
            echo '</ul>';
        }
        ?>
    </div>   
	
    <label class="assistive-text">Cơ quan phái cử</label>
    <input type="text" id="s" name="s" placeholder="<?php if ($post_type == 'ho-tro-dang-ky') echo 'Tìm kiếm tổ chức hỗ trợ đăng ký'; else echo 'Tìm kiếm công ty XKLĐ'; ?>" value="<?php if($s){ echo $s; } ?>">
    <input type="hidden" id="post_type" name="post_type" value="<?php if ($post_type == 'ho-tro-dang-ky') echo 'ho-tro-dang-ky'; else echo 'xkld'; ?>">
    
    <span class="span-area_tag span-select" id="span-area_tag" <?php if ($post_type == 'ho-tro-dang-ky') echo 'style="display: none;"'; ?>>
        <select name="area_tag" id="area_tag" class="area_tag">
        <option value=""><?php echo $var['area']; ?></option>
        <?php
        $taxonomy_name = 'area_tag';
        $taxonomys = get_terms($taxonomy_name,'hide_empty=0');
        if(!is_wp_error($taxonomys) && count($taxonomys)):
            foreach($taxonomys as $taxonomy):
                ?>              
                <option value="<?php echo $taxonomy->slug; ?>"<?php if( $area_tag == $taxonomy->slug ){ ?>selected<?php } ?>><?php echo $taxonomy->name; ?></option>
                <?php               
             endforeach;
        endif;
        ?>
        </select>
    </span>

    <span class="span-area_tag span-select" id="span-htdk_area_tag" <?php if ($post_type == 'ho-tro-dang-ky') echo 'style="display: inline-block;"'; else echo 'style="display: none;"'?>>
        <select name="htdk_area_tag" class="area_tag">
        <option value=""><?php echo $var['area']; ?></option>
        <?php
        $taxonomy_name = 'htdk_area_tag';
        $taxonomys = get_terms($taxonomy_name,'hide_empty=0');
        if(!is_wp_error($taxonomys) && count($taxonomys)):
            foreach($taxonomys as $taxonomy): ?>                           
                <option value="<?php echo $taxonomy->slug; ?>"<?php if( $htdk_area_tag == $taxonomy->slug ){ ?>selected<?php } ?>><?php echo $taxonomy->name; ?></option>
                <?php              
            endforeach;
        endif;
        ?>
        </select>
    </span>

    <span class="span-ranking span-select" id="span-ranking" <?php if ($post_type == 'ho-tro-dang-ky') echo 'style="display: none;"'; ?>>
        <select name="ranking" class="ranking">
            <option value=""><?php echo $var['ranking']; ?></option>
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
    <input type="submit" value="<?php echo $var['search']; ?>" />
</form>