( function( wp ) {
	/**
	 * Registers a new block provided a unique name and an object defining its behavior.
	 * @see https://github.com/WordPress/gutenberg/tree/master/blocks#api
	 */
	var registerBlockType = wp.blocks.registerBlockType;

	/**
	 * Retrieves the translation of text.
	 * @see https://github.com/WordPress/gutenberg/tree/master/i18n#api
	 */
	var __ = wp.i18n.__;

	/**
	 * Every block starts by registering a new block type definition.
	 * @see https://wordpress.org/gutenberg/handbook/block-api/
	 */
	registerBlockType( 'groups/groups-member-block', {
		/**
		 * This is the display title for your block, which can be translated with `i18n` functions.
		 * The block inserter will show this name.
		 */
		title: __( 'Groups Member Block', 'groups' ),

		/**
		 * Blocks are grouped into categories to help users browse and discover them.
		 * The categories provided by core are `common`, `embed`, `formatting`, `layout` and `widgets`.
		 */
		category: 'widgets',

		/**
		 * Optional block extended support features.
		 */
		supports: {
			// Removes support for an HTML mode.
			html: false,
		},
		attributes  : {
			group: {
                type: 'string',
                default: 'Registered'
            },
            content : {
				type : 'string'
			}
		},

		/**
		 * The edit function describes the structure of your block in the context of the editor.
		 * This represents what the editor will render when the block is used.
		 * @see https://wordpress.org/gutenberg/handbook/block-edit-save/#edit
		 *
		 * @param {Object} [props] Properties passed from the editor.
		 * @return {Element}       Element to render.
		 */
		edit: function( props ) {
			var group = props.attributes.group;
			fields = [
				wp.element.createElement(
						wp.components.ServerSideRender,
						{
							block : 'groups/groups-member-block',
							attributes : props.attributes
						}
					),
					wp.element.createElement(
							wp.editor.InspectorControls, {key: "inspector"},														
							wp.element.createElement(
									wp.components.TextControl,
									{
										label :  __( 'Group' ),
										value : group,
										onChange : function( value ) {
											props.setAttributes( {
												group : value
											} );
										},
										placeholder : 'Group name'
									}
								)
					)
							
	];
			if ( props.isSelected ) {
				// Add the editable content as RichText field.
				fields.push(
					wp.element.createElement(
						wp.editor.RichText,
						{
							format : 'string',
							className : props.className,
							onChange : function( value ) {
								props.setAttributes( { content : value } );
							},
							value : props.attributes.content,
							placeholder : 'Content to be locked'
						}
					)
				);
				
			}
			return fields;
		},

		/**
		 * The save function defines the way in which the different attributes should be combined
		 * into the final markup, which is then serialized by Gutenberg into `post_content`.
		 * @see https://wordpress.org/gutenberg/handbook/block-edit-save/#save
		 *
		 * @return {Element}       Element to render.
		 */
		save : function( props ) {
			return null;
		}
	} );
} )(
	window.wp
);

