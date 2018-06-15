
			if(lat != null) {
jQuery('#map_canvas').gmap({'zoom':zoom, 'center': lat+','+lon,'styles':styler}).bind('init', function(evt,map) {


			jQuery('#map_canvas').gmap('addMarker', { 'position': map.getCenter(), 'bounds': false})
			}	



		);
		jQuery('#map-loading').hide();


}
