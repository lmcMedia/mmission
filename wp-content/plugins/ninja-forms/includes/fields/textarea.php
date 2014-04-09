<?php
add_action('init', 'ninja_forms_register_field_textarea');

function ninja_forms_register_field_textarea(){
	$args = array(
		'name' => 'Textarea',
		'sidebar' => 'template_fields',		
		'edit_function' => '',
		'edit_options' => array(
			array(
				'type' => 'textarea',
				'name' => 'default_value',
				'label' => __('Default Value', 'ninja-forms'),
				'width' => 'wide',
				'class' => 'widefat',
			),
			array(
				'type' => 'checkbox',
				'name' => 'textarea_rte',
				'label' => __('Show Rich Text Editor?', 'ninja-forms'),
			),
		),
		'display_function' => 'ninja_forms_field_textarea_display',
		'save_function' => '',
		'group' => 'standard_fields',	
		'edit_label' => true,
		'edit_label_pos' => true,
		'edit_req' => true,
		'edit_custom_class' => true,
		'edit_help' => true,
		'edit_meta' => false,
		'edit_conditional' => true,
		'conditional' => array(
			'value' => array(
				'type' => 'textarea',
			),
		),
	);
	
	ninja_forms_register_field('_textarea', $args);
}

function ninja_forms_field_textarea_display($field_id, $data){
	if(isset($data['default_value'])){
		$default_value = $data['default_value'];
	}else{
		$default_value = '';
	}

	if(isset($data['textarea_rte'])){
		$textarea_rte = $data['textarea_rte'];
	}else{
		$textarea_rte = 0;
	}

	$field_class = ninja_forms_get_field_class( $field_id );

	if($textarea_rte == 1){
		wp_editor( $default_value, 'ninja_forms_field_'.$field_id );
	}else{
		?>
		<textarea  placeholder="250 words max" name="ninja_forms_field_<?php echo $field_id;?>" id="ninja_forms_field_<?php echo $field_id;?>" class="<?php echo $field_class;?>" rel="<?php echo $field_id;?>"><?php echo $default_value;?></textarea>
		<?php
	}
}