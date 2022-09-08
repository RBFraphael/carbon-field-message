<?php

namespace Carbon_Field_Message;

use Carbon_Fields\Field\Field;
use WP_Error;

class Message_Field extends Field {

	/**
	 * Context to query objects
	 *
	 * @var null|float
	 */
	protected $content = "";

	/**
	 * Used to detect error
	 * 
	 * @var null|string
	 */
	protected $error = null;

	/**
	 * Prepare the field type for use
	 * Called once per field type when activated
	 */
	public static function field_type_activated() {
		$dir = \Carbon_Field_Message\DIR . '/languages/';
		$locale = get_locale();
		$path = $dir . $locale . '.mo';
		load_textdomain( 'carbon-field-message', $path );
	}

	/**
	 * Enqueue scripts and styles in admin
	 * Called once per field type
	 */
	public static function admin_enqueue_scripts() {
		$root_uri = \Carbon_Fields\Carbon_Fields::directory_to_url( \Carbon_Field_Message\DIR );

		// Enqueue field styles.
		wp_enqueue_style(
			'carbon-field-message',
			$root_uri . '/build/bundle' . ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min' ) . '.css'
		);

		// Enqueue field scripts.
		wp_enqueue_script(
			'carbon-field-message',
			$root_uri . '/build/bundle' . ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min' ) . '.js',
			array( 'carbon-fields-core' )
		);
	}

	/**
	 * Load the field value from an input array based on its name
	 *
	 * @param array $input Array of field names and values.
	 */
	public function set_value_from_input( $input ) {
		parent::set_value_from_input( $input );

		$value = $this->get_value();
		if ( $value === '' ) {
			return;
		}

		$value = intval( $value );

		$this->set_value( $value );
	}

	/**
	 * Returns an array that holds the field data, suitable for JSON representation.
	 *
	 * @param bool $load  Should the value be loaded from the database or use the value from the current instance.
	 * @return array
	 */
	public function to_json( $load ) {
		$field_data = parent::to_json( $load );

		$field_data = array_merge($field_data, array(
			'content' => $this->content
		) );

		return $field_data;
	}

	/**
	 * Set field context to query objects
	 *
	 * @param  string	 $context
	 * @param  string	 $type
	 * @return self      $this
	 */
	function set_content( $content ) {
		$this->content = trim($content);
		return $this;
	}
}
