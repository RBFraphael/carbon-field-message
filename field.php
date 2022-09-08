<?php
use Carbon_Fields\Carbon_Fields;
use Carbon_Field_Message\Message_Field;

define( 'Carbon_Field_Message\\DIR', __DIR__ );

Carbon_Fields::extend( Message_Field::class, function( $container ) {
	return new Message_Field( $container['arguments']['type'], $container['arguments']['name'], $container['arguments']['label'] );
} );