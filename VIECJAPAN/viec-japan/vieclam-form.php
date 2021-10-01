<?php
$s = $_GET['s'];
$recruit_cat = $_GET['recruit_cat'];
$recruit_tokuteigino_cat = $_GET['recruit_tokuteigino_cat'];
$visa_name = $_GET['visa'];
$pref_name = $_GET['pref_name'];
$salary = $_GET['salary'];
$tuision = $_GET['tuision-free'];
?>

<form method="get" id="searchform" action="<?php bloginfo('url'); ?>" onchange="OnChangeForm()">
	<div class="search-block-top">
        <label for="s" class="assistive-text">Tìm việc</label>

        <input style="float: none;" type="text" name="s" id="s" placeholder="Tìm kiếm" value="<?php if ($s) {
            echo $s;
        } ?>">
        <input type="hidden" name="post_type" value="vieclam">

        <?php
        $field_key = "field_5f06ce1606cb9";
        $field = get_field_object($field_key);

        if ($field) { ?>

            <span class="span-pref_name">
		<select name="pref_name" class="pref_name">
			<option value="">Địa điểm</option>
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
        $field_key = "field_5f587baec4be6";
        $field = get_field_object($field_key);

        if ($field) { ?>
            <span class="span-salary">
		<select name="salary" class="salary">
		<option value="">Mức lương</option>
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
        <input type="submit" value="Tìm kiếm"/>
    </div>

	<div class="visaSkills-block">
        <div class="title-item">
            <p class="text-ttl"><i class="fa fa-address-card" aria-hidden="true"></i>Tư cách lưu trú</p>
        </div>
        <ul class="list-skills">
            <?php
                $taxonomy_name = 'visa';
                $args = array(
                    'hide_empty' => 0,
                );
                $taxonomys = get_terms( $taxonomy_name, $args );
                if(!is_wp_error($taxonomys) && count($taxonomys)):
                    foreach($taxonomys as $taxonomy):
                        ?>
                        <li class="item-skill">
                            <label class="title-skill">
                                <input type="radio" name="visa" id="<?php echo $taxonomy->slug; ?>" onclick="OnChangeRadio(this)" onchange="OnChangeRadio(this)" value="<?php echo $taxonomy->slug; ?>"<?php if($visa_name == $taxonomy->slug || $taxonomy->slug == 'thuc-tap-sinh'){ ?>checked<?php } ?>>
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
            <p class="title"><i class="fa fa-briefcase"></i>Ngành nghề</p>

            <!-- Tách code cũ, chỉ cần trả dữ liệu lại -->
            <!-- =============================================== -->
            <span class="span-recruit_cat" id="recruit_cat">
                <select name="recruit_cat" class="recruit_cat">
                    <option value="">Ngành nghề</option>

                    <?php
                    $taxonomy_name = 'recruit_cat';
                    $args = array(
                        'hide_empty' => 0,
                    );
                    $taxonomys = get_terms( $taxonomy_name, $args );
                    if(!is_wp_error($taxonomys) && count($taxonomys)):
                        foreach($taxonomys as $taxonomy):
                            ?>
                            <option value="<?php echo $taxonomy->slug; ?>"<?php if($recruit_cat == $taxonomy->slug){ ?>selected<?php } ?>><?php echo $taxonomy->name; ?></option>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </span>

            <span class="span-recruit_cat" id="recruit_tokuteigino_cat" style="display: none;">
                <select name="recruit_tokuteigino_cat" class="recruit_cat"> 
                    <option value="">Ngành nghề</option>		

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
        <div class="item-career-search item-freeClass">
            <p class="title"><i class="fas fa-award" aria-hidden="true"></i>Ưu điểm</p>
            <label class="free-class">
                <?php
                $field_key = "field_5fb38be4720d2";
                $field = get_field_object($field_key);

                if ($field) { ?><?php
                    foreach ($field['choices'] as $k => $v) {
                        ?>
                        <input type="checkbox" name="tuision-free" value="<?php echo $k; ?>"
                               <?php if ($tuision == $k){ ?>checked="checked"<?php } ?>>
                        <span class="checkbox-field-text"><?php echo $v; ?></span>
                        <?php
                    }
                    ?>
                    <?php
                }
                ?>
            </label>
        </div>
    </div>
                    


</form>