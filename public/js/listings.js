var offset = 0;
var found = 0;
var totaled = 0;

//var listing = "grid";
//TEMP
viewd = listing;

jQuery('.tooltip').tooltip('destroy')

/*jQuery(".select").slider({
    tooltip:"hide"
});*/
jQuery.post( ajaxurl,{data:{},action:"webkits_get_offices"},function(data) {
    data = JSON.parse(data);
    jQuery.each( data.office, function(i, marker) {
         jQuery('#input_office').append(jQuery('<option>').text(marker.name).attr('value', marker.office));
    
    })
    jQuery("#counted").html(data.totals.Found)
});

jQuery('.listingSelection').addClass("hide");

jQuery('#list').click(function (event) {
    event.preventDefault();
    jQuery('.listingSelection').addClass("hide");
    jQuery('#listings-list').removeClass("hide");
    jQuery('#listings_pagination').removeClass("hide");

    listing = "list";
    jQuery.post(ajaxurl, {view: "list", action: "webkits_change_view"});
    jQuery('#radios').hide();

});
jQuery('#grid').click(function (event) {
    event.preventDefault();
    jQuery('.listingSelection').addClass("hide");
    jQuery('#listings-grid').removeClass("hide");
    jQuery('#listings_pagination').removeClass("hide");
    listing = "grid";
    jQuery.post(ajaxurl, {view: "grid", action: "webkits_change_view"});
    jQuery('#radios').hide();

});

jQuery('#table').click(function (event) {
    event.preventDefault();
    jQuery('.listingSelection').addClass("hide");
    jQuery('#listings-table').removeClass("hide");
    jQuery('#listings_pagination').removeClass("hide");
    listing = "table";
    jQuery.post(ajaxurl, {view: "table", action: "webkits_change_view"});
    jQuery('#radios').hide();
});


jQuery('#map').click(function (event) {
    event.preventDefault();
    jQuery('.listingSelection').addClass("hide");

    jQuery('#radios').show();    
    //*'center': dlatlng,'styles':styler*//
    jQuery('#map_canvas').gmap({
        'zoom': mzoom,
        'center': dlatlng,
        'styles': styler
    }).bind('init', function (evt, map) {

        ////SIDE PANEL
        if(jQuery(window).width() > 500){
            jQuery('#map_canvas').gmap('addControl', 'radios', google.maps.ControlPosition.TOP_RIGHT);
        }

	    jQuery('#radios').show();

        var tags = ['Homes', 'Carriage Trade', 'Commercial', 'Farm', 'Lot', 'Open House'];
        jQuery.each(tags, function (i, tag) {
            jQuery('#radios').append(('<label style="margin-right:5px;display:block;"><input type="checkbox" style="margin-right:3px" value="' + tag + '"/>' + tag + '</label>'));
        });
        found = 0;
        jQuery.post(ajaxurl, {action: "webkits_get_markers"}, function (data) {
        jQuery.each(data.markers, function (i, marker) {
            if(searched && found == 0) 
               center =  new google.maps.LatLng(marker.latitude, marker.longitude)
            found = 1;
            if (marker.latitude != null) {
                newM = {
                    'position': new google.maps.LatLng(marker.latitude, marker.longitude),
                    'bounds': mbound,
                    'tags': [marker.type]
                };
                jQuery('#map_canvas').gmap('addMarker', newM).click(function () {
                    jQuery('#map_canvas').gmap('openInfoWindow', {'content': marker.content.replace(/{{CHANGEURL}}/g, realurl)}, this);
                });
            }
        });


        jQuery('#map_canvas').gmap('set', 'MarkerClusterer', new MarkerClusterer(jQuery('#map_canvas').gmap('get', 'map'), jQuery('#map_canvas').gmap('get', 'markers')));
        if(searched) {
            jQuery('#map_canvas').gmap('option', 'center', center);
            jQuery('#map_canvas').gmap('option', 'zoom', mzoom);
        }
        jQuery('#map-loading').hide();


        jQuery('#radios input:checkbox').click(function () {
            jQuery('#map_canvas').gmap('closeInfoWindow');
            jQuery('#map_canvas').gmap('set', 'bounds', null);
            var filters = [];
            jQuery('input:checkbox:checked').each(function (i, checkbox) {
                filters.push(jQuery(checkbox).val());
            });
            if (filters.length > 0) {
                jQuery('#map_canvas').gmap('find', 'markers', {
                    'property': 'tags',
                    'value': filters,
                    'operator': 'OR'
                }, function (marker, found) {
                    if (found) {
                        jQuery('#map_canvas').gmap('addBounds', marker.position);
                    }
                    marker.setVisible(found);
                });
            } else {
                jQuery.each(jQuery('#map_canvas').gmap('get', 'markers'), function (i, marker) {
                    jQuery('#map_canvas').gmap('addBounds', marker.position);
                    marker.setVisible(true);
                });
            }
            jQuery('#map_canvas').gmap('get', 'MarkerClusterer').setIgnoreHidden(true)
            jQuery('#map_canvas').gmap('get', 'MarkerClusterer').repaint()
        });
       

    },'json');

    });

    jQuery('#listings-map').removeClass("hide");
    jQuery('#listings_pagination').addClass("hide");
    listing = "map";
    jQuery.post(ajaxurl, {view: "map", action: "webkits_change_view"});

});

jQuery("#" + viewd).trigger('click');

jQuery('#clear').click(function (event) {
    event.preventDefault();
    jQuery('#clearForm').submit();
});

