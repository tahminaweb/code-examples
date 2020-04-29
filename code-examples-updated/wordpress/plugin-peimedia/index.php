
<?php
/*
Plugin Name: PEI API Integration
Description: Integrating 'Delighted' into PEI WordPress CMS .
Author: Tahmina Chowdhury
Version: 0.1
*/

add_action( 'cmb2_admin_init', 'pei_delighted_api_integration' );

function pei_delighted_api_integration() {
		$cmb_options = new_cmb2_box( array(
			'id'           => 'delighted-api',
			'title'        => 'Delighted API',
			'object_types' => array( 'options-page' ),
			'option_key'      => 'delighted_api', // The option key and admin menu page slug.
			'icon_url'        => 'dashicons-admin-generic', // Menu icon.
			'capability'      => 'edit_posts', // Capability required to view this options page.
			'position'        => 3, // Menu position.
			'save_button'     => 'Save',
		) );
	
	// Options fields IDs only need to be unique within this box. Prefix is not needed.
		$delighted_api_items_group_id = $cmb_options->add_field( array(
			'id' => 'delighted_api',
			'type' => 'group',
			'repeatable'  => false,
			'options'     => array(
				'group_title'   => 'Enter API Information',
				'add_button'    => 'Add another service',
				'remove_button' => 'Remove this service',
				'closed'        => false,  // Repeater fields closed by default as page would otherwise be very long.
				'sortable'      => true,
			),
		) );

		$cmb_options->add_group_field( $delighted_api_items_group_id, array(
			'name' => 'API ID',
			'id'   => 'api_id',
			'type' => 'text',
			'attributes' => array(
				'required' => 'required',
			),
		) );

		$cmb_options->add_group_field( $delighted_api_items_group_id, array(
			'name' => 'API Key',
			'desc' => 'please enter api key!',
			'id'   => 'api_key',
			'type' => 'text',
			'attributes' => array(
				'required' => 'required',
			),
		) );

}

?>
