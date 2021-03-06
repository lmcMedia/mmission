<?php
function ninja_forms_edit_field($field_id){
	global $wpdb, $ninja_forms_fields;

	do_action( 'ninja_forms_edit_field_before_li', $field_id );
	do_action( 'ninja_forms_edit_field_li', $field_id );
	do_action( 'ninja_forms_edit_field_after_li', $field_id );

}

function ninja_forms_edit_field_el_output($field_id, $type, $label = '', $name = '', $value = '', $width = 'wide', $options = '', $class = '', $desc = ''){
	global $ninja_forms_fields;
	$field_row = ninja_forms_get_field_by_id($field_id);
	$field_type = $field_row['type'];
	$reg_field = $ninja_forms_fields[$field_type];

	$class = 'code ninja-forms-'.$field_type.'-'.$name.' '.$class;
	$id = 'ninja_forms_field_'.$field_id.'_'.$name;
	$name = 'ninja_forms_field_'.$field_id.'['.$name.']';

	if($type != 'rte'){
	?>
	<div class="description description-<?php echo $width;?> <?php echo $type;?>" id="<?php echo $name;?>_p">
		<span class="field-option">
			<?php
	}
			if($type != 'checkbox' AND $type != 'desc'){
			?>
			<label for="<?php echo $id;?>" id="<?php echo $id;?>_label">
				<?php _e( $label , 'ninja-forms'); ?></label><br/>
	<?php
			}
	switch($type){
		case 'text':
		?>
			<input type="text" class="<?php echo $class;?>" name="<?php echo $name;?>" id="<?php echo $id;?>" value="<?php echo $value;?>" />
		<?php
		break;
		case 'checkbox':
		?>
			<label for="<?php echo $id;?>" id="<?php echo $id;?>_label">
				<input type="hidden" value="0" name="<?php echo $name;?>">
				<input type="checkbox" value="1" name="<?php echo $name;?>" id="<?php echo $id;?>" class="<?php echo $class;?>" <?php checked($value, 1);?>>
				<?php _e( $label , 'ninja-forms'); ?>
			</label>
		<?php
		break;
		case 'select':
		?>
			<select id="<?php echo $id;?>" name="<?php echo $name;?>" class="<?php echo $class;?>">
				<?php
				if(is_array($options) AND !empty($options)){
					foreach($options as $opt){
						?>
						<option value="<?php echo $opt['value'];?>" <?php selected($opt['value'], $value); ?> ><?php _e( $opt['name'], 'ninja-forms'); ?></option>
						<?php
					}
				}
			?>
			</select>
		<?php
		break;
		case 'multi':
		?>
			<select multiple="multiple" id="<?php echo $id;?>" name="<?php echo $name;?>" class="<?php echo $class;?>">
				<?php
				if(is_array($options) AND !empty($options)){
					foreach($options as $opt){
						?>
						<option value="<?php echo $opt['value'];?>" <?php selected($opt['value'], $value); ?> ><?php _e( $opt['name'], 'ninja-forms'); ?></option>
						<?php
					}
				}
			?>
			</select>
		<?php
		break;
		case 'textarea':
		?>
			<textarea id="<?php echo $id;?>" name="<?php echo $name;?>" class="<?php echo $class;?>" rows="3" cols="20" ><?php echo $value;?></textarea>
		<?php
		break;
		case 'hidden':
		?>
			<input type="hidden" name="<?php echo $name;?>" value="<?php echo $value;?>">
		<?php
		break;
		case 'desc':
		?>
			<span class="desc"><label for="<?php echo $id;?>" id="<?php echo $id;?>_label"><?php _e($label, 'ninja-forms'); ?></label></span>
		<?php
		break;
		case 'rte':
			wp_editor( $value, $name );
		break;
	}
		if($type != 'rte'){
			if($desc != ''){
		?>
			<span class="description">
				<?php _e($desc, 'ninja-forms'); ?>
			</span>
		<?php
			}
		?>
		</span>

	</div>
	<?php
	}
}