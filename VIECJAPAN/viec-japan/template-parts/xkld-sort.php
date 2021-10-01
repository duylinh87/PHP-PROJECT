<?php $sort_val = get_query_var( 'sort', '' ); ?>
<?php
$sort_selected = $_GET['sort'];
$var = commonVariables();
?>
<div class="filter-vieclam">
	<select id="sort" name="sort" class="sort">
		<option value="<?php echo add_query_arg('sort', false); ?>" <?php if($sort_selected == ''): echo 'selected'; endif; ?>><?php echo $var['sort_select']; ?></option>
		<option value="<?php echo add_query_arg('sort', 'DATE_DESC'); ?>" <?php if($sort_selected == 'DATE_DESC'): echo 'selected'; endif; ?>><?php echo $var['sort_new']; ?></option>
		<option value="<?php echo add_query_arg('sort', 'DATE_ASC'); ?>" <?php if($sort_selected == 'DATE_ASC'): echo 'selected'; endif; ?>><?php echo $var['sort_old']; ?></option>
	</select>
</div>

