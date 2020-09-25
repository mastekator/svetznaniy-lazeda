<?php

Redux::setSection( Lezada_Redux::$opt_name, array(
	'title'      => esc_html__( 'Custom CSS', 'lezada' ),
	'id'         => 'section_custom_css',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'custom_css',
			'type'    => 'ace_editor',
			'mode'    => 'css',
			'options' => array( 'minLines' => 20 )
		)
	)
) );
