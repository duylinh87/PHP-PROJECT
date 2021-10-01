<?php $sort_val = get_query_var( 'sort', '' ); ?>
<?php
$sort_selected = $_GET['sort'];
$var = commonVariables();
?>
<div class="filter-vieclam">

	<select id="sort" name="sort" class="sort">
		<option value="<?php echo add_query_arg('sort', false); ?>" <?php if($sort_selected == ''): echo 'selected'; endif; ?>><?php echo $var['sort_select']; ?></option>
		<option value="<?php echo add_query_arg('sort', 'DATE_DESC'); ?>" <?php if($sort_selected == 'DATE_DESC'): echo 'selected'; endif; ?>><?php echo $var['vieclam_sort_new']; ?></option>
		<option value="<?php echo add_query_arg('sort', 'DATE_ASC'); ?>" <?php if($sort_selected == 'DATE_ASC'): echo 'selected'; endif; ?>><?php echo $var['vieclam_sort_old']; ?></option>
		<option value="<?php echo add_query_arg('sort', 'SALARY_DESC'); ?>" <?php if($sort_selected == 'SALARY_DESC'): echo 'selected'; endif; ?>><?php echo $var['vieclam_sort_salary_high']; ?></option>
		<option value="<?php echo add_query_arg('sort', 'SALARY_ASC'); ?>" <?php if($sort_selected == 'SALARY_ASC'): echo 'selected'; endif; ?>><?php echo $var['vieclam_sort_salary_low']; ?></option>
		<option value="<?php echo add_query_arg('sort', 'DEADLINE_ASC'); ?>" <?php if($sort_selected == 'DEADLINE_ASC'): echo 'selected'; endif; ?>><?php echo $var['vieclam_sort_deadline_near']; ?></option>
		<option value="<?php echo add_query_arg('sort', 'DEADLINE_DESC'); ?>" <?php if($sort_selected == 'DEADLINE_DESC'): echo 'selected'; endif; ?>><?php echo $var['vieclam_sort_deadline_far']; ?></option>
	</select>

</div>

