<?php
add_action('init', 'ninja_forms_register_field_list');

function ninja_forms_register_field_list(){
	$args = array(
		'name' => 'List',
		'edit_function' => 'ninja_forms_field_list_edit',
		'edit_options' => array(
			array(
				'type' => 'select',
				'name' => 'list_type',
				'label' => 'List Type',
				'width' => 'wide',
				'class' => 'widefat',
				'options' => array(
					array('name' => 'Dropdown', 'value' => 'dropdown'),
					array('name' => 'Radio', 'value' => 'radio'),
					array('name' => 'Checkboxes', 'value' => 'checkbox'),
					array('name' => 'Multi-Select', 'value' => 'multi'),
				),
			),
		),
		'display_function' => 'ninja_forms_field_list_display',		
		'group' => 'standard_fields',	
		'edit_label' => true,
		'edit_label_pos' => true,
		'edit_req' => true,
		'edit_custom_class' => true,
		'edit_help' => true,
		'edit_meta' => false,
		'sidebar' => 'template_fields',
		'edit_conditional' => true,
		'conditional' => array(
			'action' => array(
				'show' => array(
					'name' => 'Show This',
					'js_function' => 'show',
					'output' => 'hide',
				),				
				'hide' => array(
					'name' => 'Hide This',
					'js_function' => 'hide',
					'output' => 'hide',
				),				
				'change_value' => array(
					'name' => 'Selected Value',
					'js_function' => 'change_value',
					'output' => 'list',
				),				
				'add_value' => array(
					'name' => 'Add Value',
					'js_function' => 'add_value',
					'output' => 'ninja_forms_field_list_add_value',
				),
				'remove_value' => array(
					'name' => 'Remove Value',
					'js_function' => 'remove_value',
					'output' => 'list',
				),
			),
			'value' => array(
				'type' => 'list',
			),
		),
		'type_dropdown_function' => 'ninja_forms_field_list_type_dropdown',
	);
	
	ninja_forms_register_field('_list', $args);
	add_filter( 'ninja_forms_field_wrap_class', 'ninja_forms_field_filter_list_wrap_class', 10, 2 );
	add_action('ninja_forms_display_after_opening_field_wrap', 'ninja_forms_display_list_type', 10, 2);
}

function ninja_forms_display_list_type( $field_id, $data ){
	$field_row = ninja_forms_get_field_by_id( $field_id );
	$field_type = $field_row['type'];
	if( $field_type == '_list' ){
		$list_type = $data['list_type'];
		?>
		<input type="hidden" id="ninja_forms_field_<?php echo $field_id;?>_list_type" value="<?php echo $list_type;?>">
		<?php
	}
}

function ninja_forms_field_list_add_value( $field_id, $x, $conditional, $name, $id, $current = '', $field_data = '' ){
	if( isset( $current['value']['value'] ) ){
		$current_value = $current['value']['value'];
	}else{
		$current_value = '';
	}	
	if( isset( $current['value']['label'] ) ){
		$current_label = $current['value']['label'];
	}else{
		$current_label = '';
	}

	if( isset( $field_data['list_show_value'] ) ){
		$list_show_value = $field_data['list_show_value'];
	}else{
		$list_show_value = 0;
	}

	?>
	Label
	<input type="text" name="<?php echo $name;?>[label]" id="<?php echo $id;?>" class="" value="<?php echo $current_label;?>">
	<?php
	if( $list_show_value == 1 ){
		?>
		Value
		<input type="text" name="<?php echo $name;?>[value]" id="<?php echo $id;?>" class="ninja-forms-field-<?php echo $field_id;?>-list-option-value" value="<?php echo $current_value;?>">
		<?php
	}else{
		?>
		<input type="hidden" name="<?php echo $name;?>[value]" value="_ninja_forms_no_value">
		<?php
	}
}

function ninja_forms_field_list_edit($field_id, $data){
	global $wpdb;
	if(isset($data['list_type'])){
		$list_type = $data['list_type'];
	}else{
		$list_type = '';
	}

	if(isset($data['list_show_value'])){
		$hidden = $data['list_show_value'];
	}else{
		$hidden = 0;
	}
	
	if(isset($data['multi_size'])){
		$multi_size = $data['multi_size'];
	}else{
		$multi_size = 5;
	}
	?>
	
	<p id="ninja_forms_field_<?php echo $field_id;?>_multi_size_p" class="description description-wide" style="<?php if($list_type != 'multi'){ echo 'display:none;';}?>">
		Multi-Select Box Size: <input type="text" id="" name="ninja_forms_field_<?php echo $field_id;?>[multi_size]" value="<?php echo $multi_size;?>">
	</p>
	<p class="description description-wide">
		<a href="#" id="ninja_forms_field_<?php echo $field_id;?>_collapse_options" name="" class="ninja-forms-field-collapse-options">Expand / Collapse Options</a>
	</p>
	<span id="ninja_forms_field_<?php echo $field_id;?>_list_span" class="ninja-forms-list-span" style="display: none;">
		<p class="description description-wide">
			Options: <a href="#" id="ninja_forms_field_<?php echo $field_id;?>_list_add_option" class="ninja-forms-field-add-list-option">Add New</a>
		</p>
		
		<p class="description description-wide">
			<input type="hidden" id="" name="ninja_forms_field_<?php echo $field_id;?>[list_show_value]" value="0">
			<label for="ninja_forms_field_<?php echo $field_id;?>_list_show_value"><input type="checkbox" value="1" id="ninja_forms_field_<?php echo $field_id;?>_list_show_value" name="ninja_forms_field_<?php echo $field_id;?>[list_show_value]" class="ninja-forms-field-list-show-value" <?php if(isset($data['list_show_value']) AND $data['list_show_value'] == 1){ echo "checked='checked'";}?>>
			Show option values </label>
		</p>
		<div id="ninja_forms_field_<?php echo $field_id;?>_list_options" class="ninja-forms-field-list-options description description-wide">	
			<input type="hidden" name="ninja_forms_field_<?php echo $field_id;?>[list][options]" value="">
			<?php
			if( isset( $data['list']['options'] ) AND is_array( $data['list']['options'] ) AND $data['list']['options'] != '' ){
				$x = 0;			
				foreach($data['list']['options'] as $option){
					ninja_forms_field_list_option_output($field_id, $x, $option, $hidden);
					$x++;
				}
			}
			?>
		
		</div>	
	</span>
	
	<?php
}

function ninja_forms_field_list_display($field_id, $data){
	global $wpdb, $ninja_forms_fields;

	if(isset($data['show_field'])){
		$show_field = $data['show_field'];		
	}else{
		$show_field = true;
	}

	$field_class = ninja_forms_get_field_class($field_id);
	$field_row = ninja_forms_get_field_by_id($field_id);

	$type = $field_row['type'];
	$type_name = $ninja_forms_fields[$type]['name'];
	
	$list_type = $data['list_type'];
	
	if(isset($data['list_show_value'])){
		$list_show_value = $data['list_show_value'];
	}else{
		$list_show_value = 0;
	}
	
	if( isset( $data['list']['options'] ) AND $data['list']['options'] != '' ){
		$options = $data['list']['options'];
	}else{
		$options = array();
	}
	
	if(isset($data['label_pos'])){
		$label_pos = $data['label_pos'];
	}else{
		$label_pos = 'left';
	}
	
	if(isset($data['label'])){
		$label = $data['label'];
	}else{
		$label = $type_name;
	}
	
	if(isset($data['multi_size']) OR $data['multi_size'] == ''){
		$multi_size = $data['multi_size'];
	}else{
		$multi_size = 5;
	}
	
	if(isset($data['default_value'])){
		$selected_value = $data['default_value'];
	}else{
		$selected_value = '';		
	}

	switch($list_type){
		case 'dropdown':
			?>
			<select name="ninja_forms_field_<?php echo $field_id;?>" id="ninja_forms_field_<?php echo $field_id;?>" class="<?php echo $field_class;?>" rel="<?php echo $field_id;?>">
				<?php
				if($label_pos == 'inside'){
					?>
					<option value=""><?php echo $label;?></option>
					<?php
				}
				foreach($options as $option){
				
					if(isset($option['value'])){
						$value = $option['value'];
					}else{
						$value = $option['label'];
					}				
					
					if(isset($option['label'])){
						$label = $option['label'];
					}else{
						$label = '';
					}					

					if(isset($option['display_style'])){
						$display_style = $option['display_style'];
					}else{
						$display_style = '';
					}
					
					$label = stripslashes($label);
					
					if($list_show_value == 0){
						$value = $label;
					}

					if($selected_value == $value){
						$selected = 'selected';
					}else if( $selected_value == '' AND isset( $option['selected'] ) AND $option['selected'] == 1 ){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
					<option value="<?php echo $value;?>" <?php echo $selected;?> style="<?php echo $display_style;?>"><?php echo $label;?></option>
				<?php
				}
				?>
			</select>
			<?php
			break;
		case 'radio':
			$x = 0;
			if( $label_pos == 'left' OR $label_pos == 'above' ){
				?><br /><?php

			}
			?><input type="hidden" name="ninja_forms_field_<?php echo $field_id;?>" value=""><span id="ninja_forms_field_<?php echo $field_id;?>_options_span"><ul><?php
			foreach($options as $option){

				if(isset($option['value'])){
					$value = $option['value'];
				}else{
					$value = $option['label'];
				}
				
				if(isset($option['label'])){
					$label = $option['label'];
				}else{
					$label = '';
				}
				
				if(isset($option['display_style'])){
					$display_style = $option['display_style'];
				}else{
					$display_style = '';
				}

				$label = stripslashes($label);
				
				if($list_show_value == 0){
					$value = $label;
				}
				
				if($selected_value == $value){
					$selected = 'checked';
				}else if( $selected_value == '' AND isset( $option['selected'] ) AND $option['selected'] == 1 ){
					$selected = 'checked';
				}else{
					$selected = '';
				}
				?><li><input id="ninja_forms_field_<?php echo $field_id;?>_<?php echo $x;?>" name="ninja_forms_field_<?php echo $field_id;?>" type="radio" class="<?php echo $field_class;?>" value="<?php echo $value;?>" <?php echo $selected;?> rel="<?php echo $field_id;?>" /><label id="ninja_forms_field_<?php echo $field_id;?>_<?php echo $x;?>_label" class="ninja-forms-field-<?php echo $field_id;?>-options" style="<?php echo $display_style;?>" for="ninja_forms_field_<?php echo $field_id;?>_<?php echo $x;?>"><?php echo $label;?></label></li><?php
				$x++;
			}
			?></ul></span><li style="display:none;" id="ninja_forms_field_<?php echo $field_id;?>_template"><label><input id="ninja_forms_field_<?php echo $field_id;?>_" name="" type="radio" class="<?php echo $field_class;?>" value="" rel="<?php echo $field_id;?>" /></label></li>
			<?php
			break;
		case 'checkbox':
			$x = 0;
			?><input type="hidden" name="ninja_forms_field_<?php echo $field_id;?>" value=""><span id="ninja_forms_field_<?php echo $field_id;?>_options_span"><ul><?php
			foreach($options as $option){
			
				if(isset($option['value'])){
					$value = $option['value'];
				}else{
					$value = $option['label'];
				}
				
				if(isset($option['label'])){
					$label = $option['label'];
				}else{
					$label = '';
				}
				
				if(isset($option['display_style'])){
					$display_style = $option['display_style'];
				}else{
					$display_style = '';
				}

				$label = stripslashes($label);
				
				if($list_show_value == 0){
					$value = $label;
				}

				if( isset( $option['selected'] ) AND $option['selected'] == 1 ){
					$checked = 'checked';
				}	

				if( is_array( $selected_value ) AND in_array($value, $selected_value) ){
					$checked = 'checked';
				}else if($selected_value == $value){
					$checked = 'checked';
				}else if( $selected_value == '' AND isset( $option['selected'] ) AND $option['selected'] == 1 ){
					$checked = 'checked';					
				}else{
					$checked = '';
				}
					
				?><li><label id="ninja_forms_field_<?php echo $field_id;?>_<?php echo $x;?>_label" class="ninja-forms-field-<?php echo $field_id;?>-options" style="<?php echo $display_style;?>"><input id="ninja_forms_field_<?php echo $field_id;?>_<?php echo $x;?>" name="ninja_forms_field_<?php echo $field_id;?>[]" type="checkbox" class="<?php echo $field_class;?> ninja_forms_field_<?php echo $field_id;?>" value="<?php echo $value;?>" <?php echo $checked;?> rel="<?php echo $field_id;?>"/><label for="ninja_forms_field_<?php echo $field_id;?>_<?php echo $x;?>"><?php echo $label;?></label></label></li><?php
				$x++;
			}
			?></ul></span><li style="display:none;" id="ninja_forms_field_<?php echo $field_id;?>_template"><label><input id="ninja_forms_field_<?php echo $field_id;?>_" name="" type="checkbox" class="<?php echo $field_class;?>" value="" rel="<?php echo $field_id;?>" /></label></li>
			<?php
			break;
		case 'multi':
			?>
			<select name="ninja_forms_field_<?php echo $field_id;?>[]" id="ninja_forms_field_<?php echo $field_id;?>" class="<?php echo $field_class;?>" multiple size="<?php echo $multi_size;?>" rel="<?php echo $field_id;?>" >
				<?php
				if($label_pos == 'inside'){
					?>
					<option value=""><?php echo $label;?></option>
					<?php
				}
				foreach($options as $option){
				
					if(isset($option['value'])){
						$value = $option['value'];
					}else{
						$value = $option['label'];
					}				
					
					if(isset($option['label'])){
						$label = $option['label'];
					}else{
						$label = '';
					}

					if(isset($option['display_style'])){
						$display_style = $option['display_style'];
					}else{
						$display_style = '';
					}
					
					$label = stripslashes($label);
					
					if($list_show_value == 0){
						$value = $label;
					}

					if(is_array($selected_value) AND in_array($value, $selected_value)){
						$selected = 'selected';
					}else if( $selected_value == '' AND isset( $option['selected'] ) AND $option['selected'] == 1 ){
						$selected = 'selected';
					}else{
						$selected = '';
					}

					if( $display_style == '' ){
					?>
					<option value="<?php echo $value;?>" <?php echo $selected;?>><?php echo $label;?></option>
					<?php
					}
				}
				?>
			</select>
			<select id="ninja_forms_field_<?php echo $field_id;?>_clone" style="display:none;" rel="<?php echo $field_id;?>" >
				<?php
				$x = 0;
				foreach($options as $option){
				
					if(isset($option['value'])){
						$value = $option['value'];
					}else{
						$value = $option['label'];
					}				
					
					if(isset($option['label'])){
						$label = $option['label'];
					}else{
						$label = '';
					}

					if(isset($option['display_style'])){
						$display_style = $option['display_style'];
					}else{
						$display_style = '';
					}
					
					$label = stripslashes($label);
					
					if($list_show_value == 0){
						$value = $label;
					}

					if(is_array($selected_value) AND in_array($value, $selected_value)){
						$selected = 'selected';
					}else{
						$selected = '';
					}

					if( $display_style != '' ){
					?>
					<option value="<?php echo $value;?>" title="<?php echo $x;?>" <?php echo $selected;?>><?php echo $label;?></option>
					<?php
					}
					$x++;
				}
				?>
			</select>
			<?php
			break;
	}
}

function ninja_forms_field_list_option_output($field_id, $x, $option = '', $hidden = ''){
	if($hidden == 1){
		$hidden = '';
	}else{
		$hidden = 'display:none';
	}
	if(is_array($option)){
		$label = $option['label'];
		$value = $option['value'];
		if( isset( $option['selected'] ) ){
			$selected = $option['selected'];
		}else{
			$selected = '';
		}
		$hide = '';
	}else{
		$label = '';
		$value = '';
		$selected = '';
		$hide = 'style="display:none;"';
	}
	if($selected == 1){
		$selected = "checked='checked'";
	}
	?>
	<div id="ninja_forms_field_<?php echo $field_id;?>_list_option_<?php echo $x;?>" class="ninja-forms-field-<?php echo $field_id;?>-list-option ninja-forms-field-list-option" <?php echo $hide;?>>
		<table class="list-options">
			<tr>
				<td>
					<a href="#" id="ninja_forms_field_<?php echo $field_id;?>_list_remove_option" class="ninja-forms-field-remove-list-option">X</a>
				</td>
				<td>
					Label: <input type="text" name="ninja_forms_field_<?php echo $field_id;?>[list][options][<?php echo $x;?>][label]" id="ninja_forms_field_<?php echo $field_id;?>_list_option_label" class="ninja-forms-field-list-option-label" value="<?php echo $label;?>">
				</td>
				<td>
					<span id="ninja_forms_field_<?php echo $field_id;?>_list_option_<?php echo $x;?>_value_span" name="" class="ninja-forms-field-<?php echo $field_id;?>-list-option-value" style="<?php echo $hidden;?>">Value: <input type="text" name="ninja_forms_field_<?php echo $field_id;?>[list][options][<?php echo $x;?>][value]" id="ninja_forms_field_<?php echo $field_id;?>_list_option_value" class="ninja-forms-field-list-option-value" value="<?php echo $value;?>"></span>
				</td>
				<td>
					<label for="ninja_forms_field_<?php echo $field_id;?>_options_<?php echo $x;?>_selected"><input type="hidden" value="0" name="ninja_forms_field_<?php echo $field_id;?>[list][options][<?php echo $x;?>][selected]"><input type="checkbox" value="1" name="ninja_forms_field_<?php echo $field_id;?>[list][options][<?php echo $x;?>][selected]" id="ninja_forms_field_<?php echo $field_id;?>_options_<?php echo $x;?>_selected" <?php echo $selected;?>> Selected</label>
				</td>
				<td>
					<span class="ninja-forms-drag">Drag</span>
				</td>
			</tr>
		</table>
		</div>
	
	<?php
}

function ninja_forms_field_list_type_dropdown( $selected = '' ){

	if( $selected == '_list-dropdown' ){
		$dropdown = 'selected="selected"';
	}else{
		$dropdown = '';
	}

	if( $selected == '_list-radio' ){
		$radio = 'selected="selected"';
	}else{
		$radio = '';
	}

	if( $selected == '_list-checkbox' ){
		$checkbox = 'selected="selected"';
	}else{
		$checkbox = '';
	}

	if( $selected == '_list-multi' ){
		$multi = 'selected="selected"';
	}else{
		$multi = '';
	}

	$output = '<option value="list" disabled>List</option>
	<option value="_list-dropdown" '.$dropdown.'>&nbsp;&nbsp;&nbsp;&nbsp;Dropdown</option>
	<option value="_list-radio" '.$radio.'>&nbsp;&nbsp;&nbsp;&nbsp;Radio Buttons</option>
	<option value="_list-checkbox" '.$checkbox.'>&nbsp;&nbsp;&nbsp;&nbsp;Checkboxes</option>
	<option value="_list-multi" '.$multi.'>&nbsp;&nbsp;&nbsp;&nbsp;Multi-Select</option>';
	return $output;
}

function ninja_forms_field_filter_list_wrap_class( $field_wrap_class, $field_id ){
	$field_row = ninja_forms_get_field_by_id( $field_id );
	$field_type = $field_row['type'];
	if( $field_type == '_list' ){
		$field_data = $field_row['data'];
		$list_type = $field_data['list_type'];
		$field_wrap_class = str_replace( 'list-wrap', 'list-'.$list_type.'-wrap', $field_wrap_class );
	}
	
	return $field_wrap_class;
}