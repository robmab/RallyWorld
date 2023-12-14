( function( api ) {

	// Extends our custom "fitness-hub" section.
	api.sectionConstructor['fitness-hub'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );