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

jQuery('.map_canvas').each(function (i,v) {
    if(i == 1)
    {
        jQuery(this).attr('id','map_canvas_2');
    }
});
jQuery('.property-listings').each(function (i,v) {
    if(i == 1)
    {
        jQuery(this).attr('id','property-listings-2');
    }
});
jQuery('.radios').each(function (i,v) {

    if(i == 0)
    {
        jQuery(this).attr('id','radios_1');

    }
    else{

        jQuery(this).attr('id','radios_2');
    }

});
jQuery('.btn-map').each(function (i,v) {

    if(i == 0)
    {
        jQuery(this).addClass('btn-map-1')

    }
    else{

        jQuery(this).addClass('btn-map-2')
    }

});
jQuery.post( ajaxurl,{data:{},action:"webkits_get_offices"},function(data) {
    data = JSON.parse(data);
    jQuery.each( data.office, function(i, marker) {
         jQuery('#input_office').append(jQuery('<option>').text(marker.name).attr('value', marker.office));

    })
    jQuery("#counted").html(data.totals.Found)
});

//jQuery('.listingSelection').addClass("hide");

jQuery('.list').click(function (event) {
    event.preventDefault();
    jQuery(this).parent().parent().siblings('.listingSelection').addClass("hide");
    jQuery(this).parent().parent().siblings('#listings-list').removeClass("hide");
    jQuery(this).parent().parent().siblings('.topadd').find('#listings_pagination').removeClass("hide");

    listing = "list";
    jQuery.post(ajaxurl, {view: "list", action: "webkits_change_view"});
    jQuery(this).parent().parent().siblings('#radios').hide();

});
jQuery('.grid').click(function (event) {
    event.preventDefault();

    jQuery(this).parent().parent().siblings('.listingSelection').addClass("hide");
    jQuery(this).parent().parent().siblings('#listings-grid').removeClass("hide");
    //jQuery('.listings-grid').removeClass("hide");
    jQuery(this).parent().parent().siblings('.topadd').find('#listings_pagination').removeClass("hide");
    listing = "grid";
    jQuery.post(ajaxurl, {view: "grid", action: "webkits_change_view"});
    jQuery(this).parent().parent().siblings('#radios').hide();

});

jQuery('.btn-table').click(function (event) {
    event.preventDefault();
    jQuery(this).parent().parent().siblings('.listingSelection').addClass("hide");
    jQuery(this).parent().parent().siblings('#listings-table').removeClass("hide");
    jQuery(this).parent().parent().siblings('.topadd').find('#listings_pagination').removeClass("hide");
    listing = "btn-table";
    jQuery.post(ajaxurl, {view: "table", action: "webkits_change_view"});
    jQuery(this).parent().parent().siblings('#radios').hide();
});

//jQuery('.btn-map').unbind('click');
jQuery('.btn-map-1').click(function (event) {
    event.preventDefault();
    jQuery(this).parent().parent().siblings('.listingSelection').addClass("hide");

    jQuery('#radios_1').show();
    //*'center': dlatlng,'styles':styler*//
    jQuery('#map_canvas_1').gmap({
        'zoom': mzoom,
        'center': dlatlng,
        'styles': styler
    }).bind('init', function (evt, map) {

        ////SIDE PANEL
        if(jQuery(window).width() > 500){
            jQuery('#map_canvas_1').gmap('addControl', 'radios_1', google.maps.ControlPosition.TOP_RIGHT);
        }

        jQuery('#radios_1').show();

        var tags = ['Homes', 'Carriage Trade', 'Commercial', 'Farm', 'Lot', 'Open House'];
        jQuery.each(tags, function (i, tag) {
            jQuery('#radios_1').append(('<label style="margin-right:5px;display:block;"><input type="checkbox" style="margin-right:3px" value="' + tag + '"/>' + tag + '</label>'));
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
                    jQuery('#map_canvas_1').gmap('addMarker', newM).click(function () {
                        jQuery('#map_canvas_1').gmap('openInfoWindow', {'content': marker.content.replace(/{{CHANGEURL}}/g, realurl)}, this);
                    });
                }
            });


            jQuery('#map_canvas_1').gmap('set', 'MarkerClusterer', new MarkerClusterer(jQuery('#map_canvas_1').gmap('get', 'map'), jQuery('#map_canvas_1').gmap('get', 'markers')));
            if(searched) {
                jQuery('#map_canvas_1').gmap('option', 'center', center);
                jQuery('#map_canvas_1').gmap('option', 'zoom', mzoom);
            }
            jQuery('#map_canvas_1').siblings('#map-loading').hide();


            jQuery('#radios_1 input:checkbox').click(function () {
                jQuery('#map_canvas_1').gmap('closeInfoWindow');
                jQuery('#map_canvas_1').gmap('set', 'bounds', null);
                var filters1 = [];
                jQuery('radios_1 input:checkbox:checked').each(function (i, checkbox) {
                    filters1.push(jQuery(checkbox).val());
                });
                if (filters1.length > 0) {
                    jQuery('#map_canvas_1').gmap('find', 'markers', {
                        'property': 'tags',
                        'value': filters1,
                        'operator': 'OR'
                    }, function (marker, found) {
                        if (found) {
                            jQuery('#map_canvas_1').gmap('addBounds', marker.position);
                        }
                        marker.setVisible(found);
                    });
                } else {
                    jQuery.each(jQuery('#map_canvas_1').gmap('get', 'markers'), function (i, marker) {
                        jQuery('#map_canvas_1').gmap('addBounds', marker.position);
                        marker.setVisible(true);
                    });
                }
                jQuery('#map_canvas_1').gmap('get', 'MarkerClusterer').setIgnoreHidden(true)
                jQuery('#map_canvas_1').gmap('get', 'MarkerClusterer').repaint()
            });


        },'json');

    });

    jQuery(this).parent().parent().siblings('#listings-map').removeClass("hide");
    jQuery('#property-listings #listings_pagination').addClass("hide");
    listing = "btn-map-1";
    jQuery.post(ajaxurl, {view: "map", action: "webkits_change_view"});

});
jQuery('.btn-map-2').click(function (event) {
    console.log(2);
    event.preventDefault();
    jQuery(this).parent().parent().siblings('.listingSelection').addClass("hide");

    jQuery('#radios_2').show();
    //*'center': dlatlng,'styles':styler*//
    jQuery('#map_canvas_2').gmap({
        'zoom': mzoom,
        'center': dlatlng,
        'styles': styler
    }).bind('init', function (evt1, map1) {

        ////SIDE PANEL
        if(jQuery(window).width() > 500){
            jQuery('#map_canvas_2').gmap('addControl', 'radios_2', google.maps.ControlPosition.TOP_RIGHT);
        }

        jQuery('#radios_2').show();

        var tags = ['Homes', 'Carriage Trade', 'Commercial', 'Farm', 'Lot', 'Open House'];
        jQuery.each(tags, function (i, tag) {
            jQuery('#radios_2').append(('<label style="margin-right:5px;display:block;"><input type="checkbox" style="margin-right:3px" value="' + tag + '"/>' + tag + '</label>'));
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
                    jQuery('#map_canvas_2').gmap('addMarker', newM).click(function () {
                        jQuery('#map_canvas_2').gmap('openInfoWindow', {'content': marker.content.replace(/{{CHANGEURL}}/g, realurl)}, this);
                    });
                }
            });


            jQuery('#map_canvas_2').gmap('set', 'MarkerClusterer', new MarkerClusterer(jQuery('#map_canvas_2').gmap('get', 'map'), jQuery('#map_canvas_2').gmap('get', 'markers')));
            if(searched) {
                jQuery('#map_canvas_2').gmap('option', 'center', center);
                jQuery('#map_canvas_2').gmap('option', 'zoom', mzoom);
            }
            jQuery('#map_canvas_2').siblings('#map-loading').hide();


            jQuery('#radios_2 input:checkbox').click(function () {
                jQuery('#map_canvas_2').gmap('closeInfoWindow');
                jQuery('#map_canvas_2').gmap('set', 'bounds', null);
                var filters2 = [];
                jQuery('#radios_2 input:checkbox:checked').each(function (i, checkbox) {
                    filters2.push(jQuery(checkbox).val());
                });
                if (filters2.length > 0) {
                    jQuery('#map_canvas_2').gmap('find', 'markers', {
                        'property': 'tags',
                        'value': filters2,
                        'operator': 'OR'
                    }, function (marker, found) {
                        if (found) {
                            jQuery('#map_canvas_2').gmap('addBounds', marker.position);
                        }
                        marker.setVisible(found);
                    });
                } else {
                    jQuery.each(jQuery('#map_canvas_2').gmap('get', 'markers'), function (i, marker) {
                        jQuery('#map_canvas_2').gmap('addBounds', marker.position);
                        marker.setVisible(true);
                    });
                }
                jQuery('#map_canvas_2').gmap('get', 'MarkerClusterer').setIgnoreHidden(true)
                jQuery('#map_canvas_2').gmap('get', 'MarkerClusterer').repaint()
            });


        },'json');

    });

    jQuery(this).parent().parent().siblings('#listings-map').removeClass("hide");
    jQuery('#property-listings-2 #listings_pagination').addClass("hide");
    listing = "btn-map-2";
    jQuery.post(ajaxurl, {view: "map", action: "webkits_change_view"});

});
jQuery("." + viewd).trigger('click');

jQuery('#clear').click(function (event) {
    event.preventDefault();
    jQuery('#clearForm').submit();
});

