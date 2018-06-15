<div class="clearfix"></div>

<div class="container-fluid">
    <div class="container-fluid container-pad">
        <div clas="row">
            <div class="item rounded dark">
                <div id="map_canvas" class="map rounded"></div>
            </div>
            <div id="radios" class="item gradient rounded shadow" style=""></div>
            <div class="progress" id="map-loading">
                <div class="progress-bar progress-bar-striped active" role="progressbar"
                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                
                </div>
                </div> 
        </div>
    </div>
</div>

<script type="text/javascript">

    if (typeof listing == 'undefined') listing = '';
    if (typeof listing2 == 'undefined') listing2 = '';

    realurl = '<?php echo get_post($options['webkits_listing_page'])->guid; ?>';

    listing = '<?php if (isset($_SESSION['webkits-view'])) echo $_SESSION['webkits-view']; else echo $options['webkits_listing_default']; ?>';

    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

    markers = <?php echo json_encode($listings->markers) . ";";?>
    <?php
    if ($options['webkits_map_style'] != '') {
        echo "var styler = " . str_replace('\"', '"', $options['webkits_map_style']) . ";
";
    } else {
        echo "var styler = '';   
";
    }

    if (!isset($options['webkits_latlng'])) {
        echo "var dlatlng ='45.420297,-75.692362';
";
    } else {   echo "var dlatlng ='{$options['webkits_latlng']}';
";
    }

    if (!isset($options['webkits_map_zoom2']) || $options['webkits_map_zoom2'] == 0) {
        echo "var mzoom = 6;
        var mbound = true;
";
    } else {
        echo "var mzoom ={$options['webkits_map_zoom2']};
        var mbound = false;
";
    }
    ?>
    if (typeof single === 'undefined') 
    jQuery(document).ready(function () {

        //*'center': dlatlng,'styles':styler*//
        map = jQuery('#map_canvas').gmap({
            'zoom': mzoom,
            'center': dlatlng,
            'styles': styler
        }).bind('init', function (evt, map) {

            jQuery.post(ajaxurl, {action: "webkits_get_markers"}, function (data) {

            ////SIDE 
            jQuery.each(data.markers, function (i, marker) {
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
            if(!noCluster) jQuery('#map_canvas').gmap('set', 'MarkerClusterer', new MarkerClusterer(jQuery('#map_canvas').gmap('get', 'map'), jQuery('#map_canvas').gmap('get', 'markers')));
            jQuery('#map-loading').hide();
        },'json');
        
           


        });
        // body...
    });
</script>