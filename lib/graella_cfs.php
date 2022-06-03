<?php 
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Graella',
		'menu_title'	=> 'Graella',
		'menu_slug' 	=> 'graella',
		'capability'	=> 'edit_posts',
		'redirect'		=> true,
        'icon_url'      => 'dashicons-calendar-alt',
        'position'      => 16
	));
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Graella',
		'menu_title'	=> 'Graella',
		'menu_slug' 	=> 'graella-graella',
		'capability'	=> 'edit_posts',
        'parent_slug'   => 'graella'
	));
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Opcions',
		'menu_title'	=> 'Opcions',
		'menu_slug' 	=> 'graella-opcions',
		'capability'	=> 'edit_posts',
        'parent_slug'   => 'graella'
	));
}
if( function_exists('acf_add_local_field_group') ):
    $setmana = setmana();
    $fields= array();
    foreach($setmana as $dia){
        $fields[] = array(
            'key' => "field_623f639ce4084${dia}",
            'label' => $dia,
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'top',
            'endpoint' => 0,
        );
        $fields[] = array(
            'key' => "field_623f63b9e4085${dia}",
            'label' => 'Programació',
            'name' => $dia,
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'collapsed' => '',
            'min' => 0,
            'max' => 0,
            'layout' => 'table',
            'button_label' => '',
            'sub_fields' => array(
                array(
                    'key' => 'field_623f63f2e4086',
                    'label' => 'Hora',
                    'name' => 'hora',
                    'type' => 'text',
                    'instructions' => 'Hora	d\'inici del programa amb format hh:mm (p.ex. 12:30)',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_623f6440e4087',
                    'label' => 'Programa',
                    'name' => 'programa',
                    'type' => 'post_object',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => array(
                        0 => 'programa',
                    ),
                    'taxonomy' => '',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'return_format' => '',
                    'ui' => 1,
                ),
                array(
					'key' => 'field_624c8697c1560',
					'label' => 'Directe',
					'name' => 'directe',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '100%',
						'class' => '',
						'id' => '',
					),
					'message' => 'Directe',
					'default_value' => 0,
					'ui' => 0,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),
            ),
        );
    }
    acf_add_local_field_group(array(
        'key' => 'group_623f637a8ec98',
        'title' => 'Graella',
        'fields' => $fields,
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'graella-graella',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
    acf_add_local_field_group(array(
        'key' => 'group_6240349c53137',
        'title' => 'Opcions',
        'fields' => array(
            array(
                'key' => 'field_624034a17864e',
                'label' => 'Pàgina de programació',
                'name' => 'pagina_de_programacio',
                'type' => 'post_object',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array(
                    0 => 'page',
                ),
                'taxonomy' => '',
                'allow_null' => 0,
                'multiple' => 0,
                'return_format' => 'object',
                'ui' => 1,
            ),
            array(
                'key' => 'field_259635b59834f',
                'label' => 'Instruccions per sentir online',
                'name' => 'sentir_online',
                'type' => 'post_object',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array(
                    0 => 'page',
                ),
                'taxonomy' => '',
                'allow_null' => 0,
                'multiple' => 0,
                'return_format' => 'object',
                'ui' => 1,
            ),
            array(
                'key' => 'field_629a4a1be7683',
                'label' => 'Url de l\'streaming',
                'name' => 'streaming_url',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
            array(
                'key' => 'field_629a4a29e7684',
                'label' => 'Url de l\'streaming en playlist',
                'name' => 'streaming_url_playlist',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'graella-opcions',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
    
    
endif;		
?>
