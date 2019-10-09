const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { TextareaControl, TextControl } = wp.components;

registerBlockType( 'pcc/event-data', {
	title: 'Event Data',
	icon: 'calendar-alt',
	category: 'common',

	attributes: {

		venueName: {
			type: 'string',
			source: 'meta',
			meta: 'pcc_event_venue',
		},
		venueAddress: {
			type: 'string',
			source: 'meta',
			meta: 'pcc_event_venue_address',
		},
		registrationUrl: {
			type: 'string',
			source: 'meta',
			meta: 'pcc_event_registration_url',
		},
	},

	edit( { className, setAttributes, attributes } ) {
		function updateVenueName( venueName ) {
			setAttributes( { venueName } );
		}

		function updateVenueAddress( venueAddress ) {
			setAttributes( { venueAddress } );
		}

		function updateRegistrationUrl( registrationUrl ) {
			setAttributes( { registrationUrl } );
		}

		return (
			<div className={ className }>
				<TextControl
					label={ __( 'Venue', 'pcc-framework' ) }
					value={ attributes.venueName }
					onChange={ updateVenueName }
				/>
				<TextareaControl
					label={ __( 'Venue Address', 'pcc-framework' ) }
					value={ attributes.venueAddress }
					onChange={ updateVenueAddress }
				/>
				<TextControl
					label={ __( 'Registration Link', 'pcc-framework' ) }
					value={ attributes.registrationUrl }
					onChange={ updateRegistrationUrl }
				/>
			</div>
		);
	},

	save() {
		return null;
	},
} );
