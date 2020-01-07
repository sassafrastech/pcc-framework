import { registerPlugin } from '@wordpress/plugins';
import { PluginSidebar, PluginSidebarMoreMenuItem } from '@wordpress/edit-post';
import { __ } from '@wordpress/i18n';
import { SelectControl } from '@wordpress/components';
import { withDispatch, withSelect } from '@wordpress/data';
import { Component, Fragment, compose } from '@wordpress/element';

class AuthorshipPlugin extends Component {
	render() {
		// Nested object destructuring.
		const {
			meta: {
				pcc_post_authors: postAuthors,
			} = {},
			updateMeta,
		} = this.props;

		const authors = [
			{
				value: '',
				label: 'Use default author',
			},
			{
				value: '1567',
				label: 'Danny Spitzberg',
			},
			{
				value: '742',
				label: 'Trebor Scholz',
			},
		];

		return (
			<Fragment>
				<PluginSidebarMoreMenuItem
					target="pcc-authorship-sidebar"
				>
					{ __( 'Authorship', 'pcc-framework' ) }
				</PluginSidebarMoreMenuItem>
				<PluginSidebar
					name="pcc-authorship-sidebar"
					title={ __( 'Authorship', 'pcc-framework' ) }
				>
					<SelectControl
						value={ postAuthors }
						options={ authors }
						onChange={ ( value ) => updateMeta( { pcc_post_authors: value || '' } ) }
					/>
				</PluginSidebar>
			</Fragment>
		);
	}
}

// Fetch the post meta.
const applyWithSelect = withSelect( ( select ) => {
	const { getEditedPostAttribute } = select( 'core/editor' );

	return {
		meta: getEditedPostAttribute( 'meta' ),
	};
} );

// Provide method to update post meta.
const applyWithDispatch = withDispatch( ( dispatch, { meta } ) => {
	const { editPost } = dispatch( 'core/editor' );

	return {
		updateMeta( newMeta ) {
			editPost( { meta: { ...meta, ...newMeta } } ); // Important: Old and new meta need to be merged in a non-mutating way!
		},
	};
} );

// Combine the higher-order components.
const render = compose( [
	applyWithSelect,
	applyWithDispatch,
] )( AuthorshipPlugin );

registerPlugin( 'pcc-sidebar', {
	icon: 'edit',
	render,
} );
