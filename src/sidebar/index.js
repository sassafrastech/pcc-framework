import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { TextControl } from '@wordpress/components';
import { withSelect, withDispatch } from '@wordpress/data';
import { __ } from '@wordpress/i18n';

let PluginMetaFields = ( props ) => {
	return (
		<>
			<TextControl
				value={ props.pcc_story_video_link }
				label={ __( 'Video Link', 'pcc-framework' ) }
			/>
		</>
	);
};

PluginMetaFields = withSelect( ( select ) => {
	return {
		pcc_story_video_link: select( 'core/editor' ).getEditedPostAttribute(
			'meta'
		).pcc_story_video_link,
	};
} )( PluginMetaFields );

PluginMetaFields = withDispatch( ( dispatch ) => {
	return {
		onChange: ( value ) => {
			dispatch( 'core/editor' ).editPost( {
				meta: { pcc_story_video_link: value },
			} );
		},
	};
} )( PluginMetaFields );

registerPlugin( 'pcc-story', {
	icon: 'microphone',
	render: () => {
		return (
			<>
				<PluginDocumentSettingPanel
					title={ __( 'Story Data', 'pcc-framework' ) }
				>
					<PluginMetaFields />
				</PluginDocumentSettingPanel>
			</>
		);
	},
} );
