( function( api ) {

	// Extends our custom "bloge" section.
	api.sectionConstructor['bloge'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
