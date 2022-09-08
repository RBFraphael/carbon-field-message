/**
 * External dependencies.
 */
 import { Component } from '@wordpress/element';

 class MessageField extends Component {
	 /**
	  * Render a message
	  *
	  * @return {Object}
	  */
	 render() {
		 const {
			 id,
			 name,
			 value,
			 field
		 } = this.props;
 
		 return (
			<div id={id} style={{marginTop:"16px",marginBottom:"16px"}}>
				{ field.content }
			</div>
		 );
	 }
 }
 
 export default MessageField;
 