<?php
$s = $_GET['s'];
$recruit_cat = $_GET['recruit_cat'];
$recruit_tokuteigino_cat = $_GET['recruit_tokuteigino_cat'];
$visa_name = $_GET['visa'];
$pref_name = $_GET['pref_name'];
$salary = $_GET['salary'];
$salary_type = $_GET['salary_type'];
$hourly_salary = $_GET['hourly_salary'];
$daily_salary = $_GET['daily_salary'];
$monthly_salary = $_GET['monthly_salary'];

$var = commonVariables();
?>

<form method="get" id="searchform" class="search-vieclam" action="<?php echo esc_url( get_post_type_archive_link( 'vieclam' ) ); ?>">
	<div class="search-block-top">
        <label for="s" class="assistive-text">Tìm việc</label>

        <input style="float: none;" type="text" name="s" id="s" placeholder="<?php echo $var['search']; ?>" value="<?php if ($s) {
            echo $s;
        } ?>">
        <input type="hidden" name="post_type" value="vieclam">

        <?php
        $field_key = "field_5f06ce1606cb9";
        $field = get_field_object($field_key);

        if ($field) { ?>
            <span class="span-pref_name">
                <select name="pref_name" class="pref_name">
                    <option value=""><?php echo $var['area']; ?></option>
                    <?php
                    foreach ($field['choices'] as $k => $v) {
                        ?>
                        <option value="<?php echo $k; ?>"
                                <?php if ($pref_name == $k){ ?>selected<?php } ?>><?php echo $v; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </span>
            <?php
        }
        ?>

        <?php
        if (get_field_object('field_5f587baec4be6')) { $field = get_field_object('field_5f587baec4be6'); ?>
            <span id="span-salary" class="span-salary" <?php if ($visa_name == '' || $visa_name == 'thuc-tap-sinh') echo 'style="display: inline-block;"'; else echo 'style="display: none;"'?>>
                <select name="salary" class="salary">
                    <option value=""><?php echo $var['salary']; ?></option>
                    <?php
                    foreach ($field['choices'] as $k => $v) {
                        ?>
                        <option value="<?php echo $k; ?>" <?php if ($salary == $k){ ?>selected<?php } ?>><?php echo $v; ?></option>
                        <?php
                    }
                    ?>
                </select>
	        </span>
        <?php
        }
        ?>

    <?php
        if (get_field_object('field_61079cde24025')) { $field = get_field_object('field_61079cde24025'); ?>
            <span id="span-salary-type" class="span-salary span-salary-type" <?php if ($visa_name == 'ky-nang-dac-dinh-viet-nam' || $visa_name == 'ky-nang-dac-dinh-nhat-ban') echo 'style="display: inline-block;"'; else echo 'style="display: none;"'?>>
                <select name="salary_type" class="salary salary-type" onchange="OnChangeSalaryType(this)">
                    <option value=""><?php echo $var['choose_salary']; ?></option>
                    <?php
                    foreach ($field['choices'] as $k => $v) {
                        ?>
                        <option value="<?php echo $k; ?>" <?php if ($salary_type == $k){ ?>selected<?php } ?>><?php echo $v; ?></option>
                        <?php
                    }
                    ?>
                </select>
	        </span>
        <?php
        }
        ?>

        <?php
        if (get_field_object('field_61079d9a24026')) { $field = get_field_object('field_61079d9a24026'); ?>
            <span id="span-hourly-salary" class="span-salary salary-tg" <?php if ($salary_type == 1 && $visa_name != 'thuc-tap-sinh') echo 'style="display: inline-block;"'; else echo 'style="display: none;"'?>>
                <select name="hourly_salary" class="salary">
                    <option value=""><?php echo $var['salary']; ?></option>
                    <?php
                    foreach ($field['choices'] as $k => $v) {
                        ?>
                        <option value="<?php echo $k; ?>" <?php if ($hourly_salary == $k){ ?>selected<?php } ?>><?php echo $v; ?></option>
                        <?php
                    }
                    ?>
                </select>
	        </span>
        <?php
        }
        ?>

        <?php
        if (get_field_object('field_61079de924027')) { $field = get_field_object('field_61079de924027'); ?>
            <span id="span-daily-salary" class="span-salary salary-tg" <?php if ($salary_type == 2 && $visa_name != 'thuc-tap-sinh') echo 'style="display: inline-block;"'; else echo 'style="display: none;"'?>>
                <select name="daily_salary" class="salary">
                    <option value=""><?php echo $var['salary']; ?></option>
                    <?php
                    foreach ($field['choices'] as $k => $v) {
                        ?>
                        <option value="<?php echo $k; ?>" <?php if ($daily_salary == $k){ ?>selected<?php } ?>><?php echo $v; ?></option>
                        <?php
                    }
                    ?>
                </select>
	        </span>
        <?php
        }
        ?>
        
        <?php
        if (get_field_object('field_61079ea224028')) { $field = get_field_object('field_61079ea224028'); ?>
            <span id="span-monthly-salary" class="span-salary salary-tg" <?php if ($salary_type == 3 && $visa_name != 'thuc-tap-sinh') echo 'style="display: inline-block;"'; else echo 'style="display: none;"'?>>
                <select name="monthly_salary" class="salary">
                    <option value=""><?php echo $var['salary']; ?></option>
                    <?php
                    foreach ($field['choices'] as $k => $v) {
                        ?>
                        <option value="<?php echo $k; ?>" <?php if ($monthly_salary == $k){ ?>selected<?php } ?>><?php echo $v; ?></option>
                        <?php
                    }
                    ?>
                </select>
	        </span>
        <?php
        }
        ?>
        <input type="submit" value="<?php echo $var['search']; ?>"/>
    </div>

	<div class="visaSkills-block">
        <div class="title-item">
            <p class="text-ttl"><i class="fa fa-address-card" aria-hidden="true"></i><?php echo $var['visa_type']; ?></p>
        </div>
        <ul class="list-skills">
            <?php
                $taxonomy_name = 'visa';
                $args = array(
                    'hide_empty' => 0,
                    'order' => 'DESC',
                    //'exclude_from_search' =>false;
                );
                $taxonomys = get_terms( $taxonomy_name, $args );
                
                if(!is_wp_error($taxonomys) && count($taxonomys)):
                    foreach($taxonomys as $taxonomy):
                        ?>
                        <li class="item-skill">
                            <label class="title-skill">
								<input type="radio" name="visa" id="<?php echo $taxonomy->slug; ?>" onclick="OnChangeVisa(this)" value="<?php echo $taxonomy->slug; ?>"<?php if($visa_name == $taxonomy->slug){ ?>checked<?php } ?>>
                                <span class="radio-field-text"><?php echo $taxonomy->name; ?></span>
                            </label>
                        </li>
                        <?php
                    endforeach;
                endif;
            ?>
        </ul>
	</div>
                    
    <div class="career-search-bottom">
        <div class="item-career-search item-career">
            <p class="title"><i class="fa fa-briefcase"></i><?php echo $var['occupation']; ?></p>

            <!-- Tách code cũ, chỉ cần trả dữ liệu lại -->
            <!-- =============================================== -->
            <span class="span-recruit_cat" id="recruit_cat">
                <select name="recruit_cat" class="recruit_cat">
                    <option value=""><?php echo $var['all']; ?></option>
                    <?php
                    $taxonomy_name = 'recruit_cat';
                    $args = array(
                        'hide_empty' => 0,
                        'parent' => 0
                    );
                    $taxonomys = get_terms( $taxonomy_name, $args );
                    if(!is_wp_error($taxonomys) && count($taxonomys)):
                        foreach($taxonomys as $taxonomy):                            
                            ?>                            
                            <option value="<?php echo $taxonomy->slug; ?>"<?php if($recruit_cat == $taxonomy->slug){ ?>selected<?php } ?>><?php echo $taxonomy->name; ?>
                                <?php
                                $subrgs = array(
                                'hierarchical' => 1,
                                'show_option_none' => '',
                                'hide_empty' => 0,
                                'parent' => $taxonomy->term_id,
                                'taxonomy' => 'recruit_cat'
                                );
                                $subjobs = get_categories($subrgs);
                                foreach ($subjobs as $subjob):
                                    ?>
                                        <option value="<?php echo $subjob->slug; ?>"<?php if($recruit_cat == $subjob->slug){ ?>selected<?php } ?>><?php echo '- ' . $subjob->name; ?></option>
                                    <?php
                                endforeach;
                                ?>  
                            </option>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </span>

            <span class="span-recruit_cat" id="recruit_tokuteigino_cat" style="display: none;">
                <select name="recruit_tokuteigino_cat" class="recruit_cat"> 
                    <option value=""><?php echo $var['all']; ?></option>

                    <?php
                    $taxonomy_name = 'recruit_tokuteigino_cat';
                    $args = array(
                        'hide_empty' => 0, 
                    ); 
                    $taxonomys = get_terms( $taxonomy_name, $args );
                    if(!is_wp_error($taxonomys) && count($taxonomys)):
                        foreach($taxonomys as $taxonomy):
                            ?>
                            <option value="<?php echo $taxonomy->slug; ?>"<?php if($recruit_tokuteigino_cat == $taxonomy->slug){ ?>selected<?php } ?>><?php echo $taxonomy->name; ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </span>
            <!-- end Tách code cũ, chỉ cần trả dữ liệu lại -->
            <!-- =============================================== -->
        </div>

    </div>  
</form>