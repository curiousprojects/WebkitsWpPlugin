<?php
/**
 * Plugin Name: WEBKITS Real Estate Api
 * Plugin URI: https://mywebkit.ca
 * Description: Search and Display Real Estate Listings
 * Version: 3.033
 * Author: Curious Projects
 **/

/*error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1); */

require 'includes/updater.php';
$MyUpdateChecker = PucFactory::buildUpdateChecker(
    'https://webkitadmin.com/plugin/metadata.json',
    __FILE__,
    'webkits'
);

//$dbHost = 'http://159.203.14.115/';
//$dbHost = 'http://webkitadmin.com/';
//$dbHost = 'http://webkitadmin.project:7700/';
if(strpos($_SERVER['HTTP_HOST'], 'project') !== false)
{
	$dbHost = 'http://webkitadmin.project:7700/';
}
else{
	$dbHost = 'http://webkitadmin.com/';
}

add_action('wp_loaded', 'webkits_override'); //Cache Flush
add_action('wp_enqueue_scripts', 'webkits_styles');  //CSS Files
add_action('wp_enqueue_scripts', 'webkits_js'); //JS Files
add_action('admin_menu', "webkits_options_menu"); //Options Menu - Webkits Options
add_action('init', 'webkits_listing_rewrite');  //Recreates the Link for SEO
add_action('wp_head', 'webkits_og_tags');  //Create OG Meta for SEO
add_action('mp_library', 'extendTemplates', 11, 1); //MOTOPRESS - add new Template

remove_action('wp_head', 'rel_canonical');

add_filter('pre_get_document_title', 'webkits_title', 20, 3);  //Session + Header Rewrite
add_filter('wpseo_title', 'webkits_title');  //WPSEO Override
add_filter('language_attributes', 'add_og_xml_ns');  //XML Include for OG
add_filter('language_attributes', 'add_fb_xml_ns'); //XML Include for FB
add_filter('frm_to_email', 'custom_set_email_value', 10, 4); // FORMIDABLE - TeamLead To Address
add_filter('frm_email_message', 'add_email_header', 10, 2); // FORMIDABLE - TeamLead Body

add_shortcode("listings", "webkits_listings_sc"); // LISTINGS SHORTCODE
/* section =    [listings, counter, listings-filtered,second-listings,map,full-search]
   filter  =    [openhouse, commercial, carriagetrade]
   from-city = City; filter by city
   onlyshow = agent | broker;
   maxprice = Number; maxprice
   postal = S1S,S1S,..; First 3 Letters of postal codes
   commerical = 1; Show commericals on no search
   lots = 1; show lots on no search */
add_shortcode("agents_page", "webkits_agents_shortcode"); //AGENTS SHORTCODE
/* section =    [agents,search] */
add_shortcode("agent", "webkits_agent_shortcode");  //AGENT DETAILS SHORTCODE
/* section =   [mini, name, bio, awards, social, testimonial, office, listings] */
add_shortcode("mainpage", "webkits_mainpage_shortcode"); // WIDGETS DETAILS SHORTCODE
/* section =   [search,openhouse,calculator,slider]
   class   =   ?
   type     = [random : lastest] - slider link*/
add_shortcode("seo", "webkits_seo_shortcode"); //SEO Shortcode
add_shortcode("details", "webkits_details_shortcode");  //LISTING DETAILS SHORTCODES
/* section =    [address, price, tags, pictures, remarks, BuildingInfo, FloorInfo
                thumbnails, gallery, image, MLS, Agent, Links, OpenHouse, calculator,
                map]
    col = Number; //Number of Coloumns for gallery section */


add_action('wp_ajax_nopriv_webkits_change_view', 'webkits_change_view'); // Save View for Listings
add_action('wp_ajax_webkits_change_view', 'webkits_change_view');
add_action('wp_ajax_nopriv_webkits_get_listing', 'webkits_get_listing');
add_action('wp_ajax_webkits_get_listing', 'webkits_get_listing');  // POST FOR LISTINGS ??
add_action('wp_ajax_nopriv_webkits_get_offices', 'webkits_get_offices'); // Get Offices
add_action('wp_ajax_webkits_get_offices', 'webkits_get_offices');  // Get Offices
add_action('wp_ajax_nopriv_webkits_get_slisting', 'webkits_get_slisting');  //Show's a Second Feed
add_action('wp_ajax_webkits_get_slisting', 'webkits_get_slisting'); //Show's a Second Feed

add_action('wp_ajax_nopriv_webkits_get_agent_listing', 'webkits_get_agent_listing');  // Get Agent's Listing
add_action('wp_ajax_webkits_get_agent_listing', 'webkits_get_agent_listing'); // Get Agent's Listing
add_action('wp_ajax_nopriv_webkits_get_agent', 'webkits_get_agent'); // Get Agent Detail
add_action('wp_ajax_webkits_get_agent', 'webkits_get_agent'); // Get Agent Detail
add_action('wp_ajax_webkits_accept_crea','webkits_accept_crea'); //Accept Crea
add_action('wp_ajax_nopriv_webkits_accept_crea','webkits_accept_crea'); //Accept Crea

add_action('wp_ajax_webkits_get_markers','webkits_get_markers'); //
add_action('wp_ajax_nopriv_webkits_get_markers','webkits_get_markers'); //Get Markers for Map with Search

function webkits_listing_rewrite() {
    global $wp, $wp_rewrite, $dbHost;
    $options = get_option('webkits');
    $page = $options['webkits_listing_page'];
    $wp->add_query_var('l');
    add_rewrite_rule('property/([0-9]+)/(.*)', 'index.php?page_id=' . $page . '&l=$matches[1]', 'top');
    $wp_rewrite->flush_rules(true);
}


/*AJAX*/
function webkits_get_slisting() {
    global $dbHost;
    $options = get_option('webkits');

    if (isset($options['webkits_site_type']) && $options['webkits_site_type'] == 'both') {
        $link = "listing/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
        $json_feed_url = $dbHost . $link;
        $json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));
        echo $json['body'];
    } else {
        if (!isset($options['webkits_ssite_type']) || $options['webkits_ssite_type'] == '')
            $options['webkits_ssite_type'] = $options['webkits_site_type'];
        if (!isset($options['webkits_slist_id']) || $options['webkits_slist_id'] == '')
            $options['webkits_slist_id'] = $options['webkits_list_id'];
        $link = "listing/" . $options['webkits_ssite_type'] . "/" . $options['webkits_slist_id'];
        $json_feed_url = $dbHost . $link;
        $json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));
        echo $json['body'];
    }
    die();
}

if (!isset($_POST['input_main']) && isset($_SESSION['webkit-search'])) {
    $_POST = $_SESSION['webkit-search'];
}

// AJAX
function webkits_get_markers() {
    global $dbHost;
    session_start();
    if (isset($_SESSION['webkit-search'])) {
        $_POST = $_SESSION['webkit-search'];
    }
    $options = get_option('webkits');
    $link = "ShowMarkers/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
    $json_feed_url = $dbHost . $link;
    $_POST['data'] = $_POST;
    $_POST['perpage'] = $listingPerPage;
    $json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));
    echo $json['body'];
    die();
}

// AJAX
function webkits_get_listing() {
    global $dbHost;
    $options = get_option('webkits');
    $link = "listing/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
    $json_feed_url = $dbHost . $link;
    $json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));
    echo $json['body'];
    die();
}
// AJAX
function webkits_get_offices() {
    global $dbHost;
    $options = get_option('webkits');
    $link = "SnapShot/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
    $json_feed_url = $dbHost . $link;
    $json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));
    echo $json['body'];
    die();
}
// AJAX
function webkits_get_agent_listing() {
    global $dbHost;
    $options = get_option('webkits');
    $link = "listing/agent/" . $_POST['data'];
    $json_feed_url = $dbHost . $link;
    $json = wp_remote_post($json_feed_url, array("body" => array("p" => "")));
    echo $json['body'];
    die();
}
// AJAX
function webkits_get_agent() {
    global $dbHost;
    $options = get_option('webkits');
    $link = "agents/" . $options['webkits_list_id'];
    $json_feed_url = $dbHost . $link;
    $json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));
    echo $json['body'];
    die();
}

function webkits_accept_crea() {
    global $dbHost;
    session_start();
    echo($_SESSION['webkits-accept']);
    $options = get_option('webkits');
    if((isset($_POST['data']) && $_POST['data'] == 1 ) || (isset($options['webkits_agree_msg']) && $options['webkits_agree_msg'] == '0'))
    $_SESSION['webkits-accept'] = 1;
    echo($_SESSION['webkits-accept']);
    die();
}


//Filter
function webkits_title($title) {
    global $wp;
    global $dbHost;
    if (isset($wp->query_vars['l'])) {
        if ( !session_id() ) {
           session_start();
           if($_SESSION['listings']->ID == $wp->query_vars['l']) unset($_SESSION['listings']);
        }
        if (!isset($_SESSION['listings']) || $_SESSION['listings']->content->ListingKey != $wp->query_vars['l']) {
            $options = get_option('webkits');
            $link = "listing/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'] . "/" . $wp->query_vars['l'];
            $json_feed_url = $dbHost . $link;
            $args = array('timeout' => 120);
            $json_feed = wp_remote_get($json_feed_url, $args);
            $_SESSION['listings'] = json_decode($json_feed['body']);
            remove_all_actions('wpseo_head');
            remove_all_actions('wpseo_opengraph');
            $listing = $_SESSION['listings'];
            return strip_tags($listing->basic->UnparsedAddress . " - " . $listing->basic->City . " - " . $listing->basic->StateOrProvince . " &raquo; " . $listing->content->MLS . " &raquo; ") . get_bloginfo();

        }
    } else
        return get_the_title();
}

//ACTION
function webkits_og_tags() {
    global $wp;
    global $dbHost;
    $options = get_option('webkits');

    if (isset($_GET['l']) || isset($wp->query_vars['l'])) {

        $_GET['l'] = isset($_GET['l']) ? $_GET['l'] : $wp->query_vars['l'];

        if (isset($_GET['l']) && is_numeric($_GET['l'])) {
            if (!isset($_SESSION['listings']) || $_SESSION['listings']->content->ListingKey != $_GET['l']) {
                $options = get_option('webkits');
                $link = "listing/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'] . "/" . $_GET['l'];

                $json_feed_url = $dbHost . $link;
                $args = array('timeout' => 120);

                $json_feed = wp_remote_get($json_feed_url, $args);
                $_SESSION['listings'] = json_decode($json_feed['body']);

            }
                $listing = $_SESSION['listings'];
                ?>

                <meta property="og:title" id="ogtitle"
                      content="<?php echo $listing->basic->UnparsedAddress . ", " . $listing->basic->City . ' - $' . $listing->content->mprice ?>"/>
                <meta property="og:description" id="ogdescription" content="<?php echo $listing->content->Remarks; ?>"/>
                <meta property="og:type" content="website"/>
                <meta property="og:url" content="http://<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>"/>
                <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
                <meta property="og:image" id="ogimage"
                      content="https://webkitadmin.com/photos/image-<?php echo $listing->ID; ?>-1.jpg"/>
                <meta property="og:image:width" content="<?php echo $listing->content->imagewidth; ?>" />
                <meta property="og:image:height" content="<?php echo $listing->content->imageheight; ?>" />
                <?php

        }
    }
}
//FILTER
function add_og_xml_ns($content) {
    return ' xmlns:og="http://ogp.me/ns#" ' . $content;
}
//FILTER
function add_fb_xml_ns($content) {
    return ' xmlns:fb="https://www.facebook.com/2008/fbml" ' . $content;
}

$listing = [];
//FILTER
function custom_set_email_value($recipients, $values, $form_id, $args){
    global $listing;
    if($args['form']->form_key == 'teamlead') {
        session_start();
        $listing = $_SESSION['listings'];
        unset($_SESSION['listings']);
        $recipients =  $listing->content->Email;
    }
    return $recipients;
}
//FILTER
function add_email_header($message, $args) {
    global $listing;
    if($args['form']->form_key == 'teamlead') {
        $l = $listing->basic;
        if($args['plain_text'] != 1) {
            $email_header = '
           '.$l->UnparsedAddress.'
<br>
'.$l->City.'<br>
'.$l->StateOrProvince.' <br>
'.$l->PostalCode.'
<br>
'.substr($l->PostalCode,0,3).'
			<br>
'.$listing->info->ListingID.'
			<br>

'.$l->Type.'
		   <br>
teamrealty.ca

			';

        } else {
        $email_header = 'Street Address: '.$l->UnparsedAddress." \r\n ".'City: '.$l->City." \r\n ".'Province: '.$l->StateOrProvince." \r\n ".'Postal: '.$l->PostalCode.' - '.substr($l->PostalCode,0,3)." \r\n";
        $email_header .= "MLS: ".$listing->info->ListingID." \r\n ".'Property Type: '.$l->Type." \r\n\r\n\r\n";
        }
        $message = $email_header.$message;
    }
 return $message;
}


//ANALYTICS FUNCTION
function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
//SHORTCODE
function webkits_details_shortcode($atts, $content = null) {
    global $wp;
    $options = get_option('webkits');
    $_GET['l'] = $wp->query_vars['l'];

    //if(isset($_GET['ac']) && $_GET['ac'] == 0) unset($_SESSION['webkits-accept']);

    if (!isset($_GET['l']) || !is_numeric($_GET['l'])) {
        if (!current_user_can('manage_options'))
            die();
        else {

            $listing = new stdClass();
            $listing->content->address = '<span style="display:block;margin-bottom:0px;">777 King Street</span><small>Ottawa, Ontario V0E1V3</small>';
            $listing->latitude = 45.4215;
            $listing->longitude = -75.6972;
            $listing->content->tags = ' <div  class="col-md-12"><h2><span class="label label-info" style="">5 Bedroom</span>          <span class="label label-info">2 Bathroom</span>      </h2><h3>          <span class="label label-info label-sm label-warning">Garage</span>      </h3></div>';
            $listing->content->price = '$1,000,000';
            $listing->content->MLS = 'MLS&reg; 1337';
            $listing->content->Remarks = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
            $listing->content->BuildingInfo = '<table class="table table-hover table-bordered"><tbody><tr><td>
          <strong> Bathroom Total</strong> </td> <td class="text-right"> 2       </td></tr>           <tr><td>
          <strong> Bedrooms Total</strong></td><td class="text-right">  5     </td></tr>           <tr>
        <td><strong> Year Built</strong></td><td class="text-right"> 1968        </td>
      </tr>           <tr> <td><strong> Flooring Type</strong> </td>
        <td class="text-right">  Hardwood, Carpeted, Linoleum        </td></tr>           <tr>
        <td> <strong> Half Bathrooms Total</strong> </td> <td class="text-right"> 0     </td></tr>           <tr><td><strong> Heating Type</strong></td>
        <td class="text-right">
          Forced air      </td>
      </tr>               <tr>
            <td>
              <strong> Heating Fuel</strong>
            </td>
            <td class="text-right">
              Natural gas     </td>
          </tr>           <tr>
        <td>
          <strong> Type</strong>
        </td>
        <td class="text-right">
          House       </td>
      </tr>


            <tr>
        <td>
          <strong> Utility Water</strong>
        </td>
        <td class="text-right">
          Municipal Water       </td>
      </tr>


  </tbody>
</table>';

            $listing->content->OpenHouse = "<span class='openhousebanner'>Open House: 01/01/1970 2:00:00 PM to 01/01/1970 4:00:00 PM
</span> ";
            $listing->content->image = '<img class="img-responsive" src="https://webkitadmin.com/assets/images/no-photo.png" />';
            $listing->content->FloorInfo = "<table class='table table-striped table-bordered grid2'>
  <tbody>
<tr><td>Living room</td><td>Main level</td><td>24 ft ,2 in x 15 ft</td></tr><tr><td>Dining room</td><td>Main level</td><td>15 ft x 12 ft ,10 in</td></tr><tr><td>Kitchen</td><td>Main level</td><td>19 ft x 10 ft ,10 in</td></tr><tr><td>Family room</td><td>Main level</td><td>16 ft ,9 in x 14 ft ,8 in</td></tr><tr><td>Den</td><td>Main level</td><td>11 ft ,8 in x 11 ft ,7 in</td></tr><tr><td>Laundry room</td><td>Main level</td><td>11 ft ,7 in x 7 ft ,1 in</td></tr><tr><td>Partial bathroom</td><td>Main level</td><td>8 ft ,2 in x 5 ft</td></tr><tr><td>Foyer</td><td>Main level</td><td>9 ft ,8 in x 8 ft ,6 in</td></tr><tr><td>Eating area</td><td>Main level</td><td>13 ft ,3 in x 10 ft ,6 in</td></tr><tr><td>Master bedroom</td><td>Second level</td><td>20 ft ,9 in x 14 ft ,3 in</td></tr><tr><td>Bedroom 2</td><td>Second level</td><td>13 ft ,11 in x 9 ft ,9 in</td></tr><tr><td>Bedroom 3</td><td>Second level</td><td>13 ft x 11 ft ,3 in</td></tr><tr><td>Bedroom 4</td><td>Second level</td><td>14 ft ,7 in x 10 ft ,7 in</td></tr><tr><td>Full bathroom</td><td>Second level</td><td>9 ft ,9 in x 8 ft ,10 in</td></tr><tr><td>Family room</td><td>Second level</td><td>24 ft x 14 ft ,10 in</td></tr><tr><td>Games room</td><td>Second level</td><td>14 ft ,10 in x 12 ft ,11 in</td></tr><tr><td>5pc Ensuite bath</td><td>Second level</td><td>17 ft x 13 ft ,7 in</td></tr><tr><td>Other</td><td>Second level</td><td>6 ft x 3 ft ,10 in</td></tr><tr><td>Bedroom</td><td>Basement</td><td>22 ft ,9 in x 13 ft</td></tr><tr><td>Recreation room</td><td>Basement</td><td>35 ft ,10 in x 15 ft ,2 in</td></tr><tr><td>3pc Bathroom</td><td>Basement</td><td>9 ft x 5 ft ,3 in</td></tr></tbody></table>";
        }

    } else {
        $listing = $_SESSION['listings'];
    }

    $args = (shortcode_atts(array(
        'section' => "address",
        'col' => "2",
        'crea-popup' => 1
    ), $atts));


    ob_start();

    //echo "<pre>";print_r($listing->content->FloorInfo);die;
    switch ($args['section']) {
        case 'address':
            if (isset($_SESSION['listings'])) {
                add_filter('the_title', 'some_callback');
                if (!function_exists('some_callback')) {
                    function some_callback($data)
                    {
                        $listing = $_SESSION['listings'];
                        return $listing->content->address . " &raquo; " . $listing->content->MLS;
                    }
                }
            }
            echo $listing->content->address;
            if(isset($options['webkits_crea_clientid']) && $options['webkits_crea_clientid'] != ''  ) {
                if(!isset($_SESSION['guid'])) $_SESSION['guid'] = gen_uuid();
               $analytics = "http://analytics.crea.ca/LogEvents.svc/LogEvents?ListingID={$listing->ID}&DestinationID={$options['webkits_crea_clientid']}&EventType=view&UUID={$_SESSION['guid']}&IP={$_SERVER['REMOTE_ADDR']}";
                $json = wp_remote_get($analytics, array());
            }


            if($args['crea-popup'] == 0 || (isset($_SESSION['webkits-accept']) && $_SESSION['webkits-accept'] == 1)) break;
            include('inc/agreement.php');
            break;
        case 'price':
            echo '<p class="price">$' . number_format( (float) $listing->content->mprice ) . '</p>';
            break;
        case 'tags':
            echo $listing->content->tags;
            break;
        case 'pictures':
            echo $listing->content->pictures;
            break;
        case 'remarks':
            echo $listing->content->Remarks;
            break;
        case 'BuildingInfo':
            echo $listing->content->BuildingInfo;
            break;
        case 'FloorInfo':
            echo $listing->content->FloorInfo;
            break;
        case 'thumbnails':
            echo $listing->content->thumbnails;
            break;
        case 'gallery':
            echo str_replace("#row#", (12 / $args['col']), $listing->content->gallery);
            break;
        case 'image':
            echo $listing->content->image;
            break;
        case 'MLS':
            echo $listing->content->MLS;
            break;
        case 'Agent':
            echo $listing->content->Agent;
            break;
        case 'Links':
            echo $listing->content->Links;
            break;
        case 'OpenHouse':
            echo $listing->content->OpenHouse;
            break;
        case "calculator":
            wp_enqueue_script('calculator', plugin_dir_url(__FILE__) . 'public/js/mortgage.js', '', '', true);
            require("includes/details_mortgage.php");
            break;

        case 'map':
            wp_enqueue_style('map', plugin_dir_url(__FILE__) . ('public/css/map.css'));
            wp_enqueue_script('mpce-gma-google-maps-api', 'http://maps.google.com/maps/api/js?key=AIzaSyDZ9XDDXc0IBIOPhc3Hw1TaXJEDR2LpU3k', '', '', true);
            wp_enqueue_script('gmap', plugin_dir_url(__FILE__) . 'public/js/map.js', array('jquery'), '', true);
            wp_enqueue_script('singlemap', plugin_dir_url(__FILE__) . 'public/js/singlemap.js', array('jquery'), '', true);
            $options['webkits_map_zoom'] = isset($options['webkits_map_zoom']) ? $options['webkits_map_zoom'] : 10;
            if ($options['webkits_map_style'] != '') {
                echo "<script>zoom = " . $options['webkits_map_zoom'] . ";lon = " . $listing->longitude . ";lat = " . $listing->latitude . ";styler = " . str_replace('\"', '"', $options['webkits_map_style']) . "</script>";
            } else {
                echo "<script>zoom = " . $options['webkits_map_zoom'] . ";lon = " . $listing->longitude . ";lat = " . $listing->latitude . ";styler = '';</script>";
            }
            echo "<script>single = true;</script>";
            echo "<script>noCluster = true;</script>";
            require("includes/listing_map.php");

            break;


    }

    $content = ob_get_clean();

    return $content;
}


function webkits_agent_shortcode($atts, $content = null) {
    global $dbHost;
    $options = get_option('webkits');
    if (!isset($_SESSION['agent']) || $_SESSION['agent']->agent->aid != $_GET['l']) {
        $options = get_option('webkits');
        $link = "agents/" . $options['webkits_list_id'] . "/" . $_GET['l'];
        $json_feed_url = $dbHost . $link;

        $args = array('timeout' => 120);

        $json_feed = wp_remote_post($json_feed_url, $args);

        $i = 1;

        $_SESSION['agent'] = json_decode($json_feed['body']);
    }

    $agent = $_SESSION['agent'];

    $args = (shortcode_atts(array(
        'section' => "mini",
    ), $atts));


    if ($args['section'] == "listings") {
        wp_enqueue_style('map', plugin_dir_url(__FILE__) . ('public/css/map.css'));
        wp_enqueue_script('mpce-gma-google-maps-api', 'http://maps.google.com/maps/api/js?key=AIzaSyDZ9XDDXc0IBIOPhc3Hw1TaXJEDR2LpU3k', '', '', true);
        wp_enqueue_script('gmap', plugin_dir_url(__FILE__) . 'public/js/map.js', array('jquery'), '', true);
        wp_enqueue_script('cluster', plugin_dir_url(__FILE__) . 'public/js/marker.js', array('jquery'), '', true);
        wp_enqueue_script('listings', plugin_dir_url(__FILE__) . 'public/js/listings.js', array('jquery'), '', true);
        wp_enqueue_script('masonary', plugin_dir_url(__FILE__) . 'public/js/masonry.min.js', array('jquery'), '', true);
    }

    ob_start();

    $newMini = str_replace('<a ', '<a target="_blank" ', $agent->agent->list);

    switch ($args['section']) {
        case 'mini':
            echo $newMini;
            break;
        case 'name':
            echo $agent->agent->name;
            break;
        case 'bio':
            echo $agent->agent->bio;
            break;
        case 'awards':
            echo $agent->agent->awards;
            break;
        case 'social':
            echo $agent->agent->social;
            break;
        case 'testimonial':
            echo $agent->agent->testimonial;
            break;
        case 'office':
            echo $agent->agent->officeInfo;
            break;
        case 'listings':
            //unset($_POST['search']);
            unset($_SESSION['webkit-search']);

            $listingPerPage = $options['webkits_listing_perpage'];
            $listingpage = get_post($options['webkits_listing_page'])->guid . "&l=";

            $hideAgent = isset($options['webkits_hide_agents']) ? $options['webkits_hide_agents'] : 0;
            $bcAgent = isset($options['webkits_bc_agent']) ? $options['webkits_bc_agent'] : 0;

            if (isset($_GET['listing-page']) && is_numeric($_GET['listing-page'])) {
                $_POST['offset'] = $listingPerPage * ($_GET['listing-page'] - 1);

                $CurrentPage = $_GET['listing-page'];
            } else $CurrentPage = 1;


            if (isset($_POST['search'])) {
                unset($_POST['search']);
                $CurrentPage = 1;
                $_POST['offset'] = 0;
                $_SESSION['webkit-search'] = $_POST;
                header('Location: '.$_SERVER['REQUEST_URI']);
            }

            $_POST['commercial'] = 1;
            $_POST['lots'] = 1;


            if (!isset($_POST['input_main']) && isset($_SESSION['webkit-search'])) $_POST = $_SESSION['webkit-search'];
            $link = "ShowListings/agent/" . $agent->agent->aid;
            $json_feed_url = $dbHost . $link;
            $_POST['data'] = $_POST;
            $_POST['perpage'] = $listingPerPage;

            $json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));
            $listings = json_decode($json['body']);

            $webkitsIgnore = true;
            require("inc/listing_page.php");
            break;
    }



    $content = ob_get_clean();

    return $content;

}

//ACTION - ADMIN MENU
function webkits_options_menu() {
    add_options_page("Webkits Management", "WebKits Options", "manage_options", "webkits-options", "webkits_options");
}
//OPTION MENU
function webkits_options() {
    if (!current_user_can('manage_options')) {
        wp_die("sorry");
    }
    if (isset($_POST['webkits_form_submitted'])) {
        $hidden_field = esc_html($_POST['webkits_form_submitted']);
        if ($hidden_field == 'Y') {
            $options['webkits_site_type'] = esc_html($_POST['webkits_site_type']);
            $options['webkits_list_id'] = esc_html(str_replace(",", "|", $_POST['webkits_list_id']));
            $options['webkits_crea_clientid'] = trim(esc_html($_POST['webkits_crea_clientid']));
            $options['webkits_ssite_type'] = esc_html($_POST['webkits_ssite_type']);
            $options['webkits_slist_id'] = esc_html(str_replace(",", "|", $_POST['webkits_slist_id']));
            $options['webkits_listing_page'] = esc_html($_POST['webkits_listing_page']);
            $options['webkits_listings_page'] = esc_html($_POST['webkits_listings_page']);
            $options['webkits_listing_perpage'] = esc_html($_POST['webkits_listing_perpage']);
            $options['webkits_hide_agents'] = esc_html($_POST['webkits_hide_agents']);
            $options['webkits_bc_agent'] = esc_html($_POST['webkits_bc_agent']);
            $options['webkits_agent_page'] = esc_html($_POST['webkits_agent_page']);
            $options['webkits_latlng'] = esc_html($_POST['webkits_latlng']);
            $options['last_updated'] = time();
            $options['webkits_map_style'] = $_POST['webkits_map_style'];
            $options['webkits_zerofall'] = $_POST['webkits_zerofall'];
            $options['webkits_map_zoom'] = $_POST['webkits_map_zoom'];
            $options['webkits_rss_feed'] = $_POST['webkits_rss_feed'];
            $options['webkits_map_zoom2'] = $_POST['webkits_map_zoom2'];
            $options['webkits_agree_msg'] = $_POST['webkits_agree_msg'];
            $options['webkits_feature_template'] = $_POST['webkits_feature_template'];
            $options['webkits_listing_default'] = $_POST['webkits_listing_default'];
            $options['webkits_officemlsid'] =  esc_html(str_replace(',','|',$_POST['webkits_officemlsid']));
            $options['webkits_agentid'] =  esc_html(str_replace(',','|',$_POST['webkits_agentid']));
            update_option('webkits', $options);

            if (isset($_POST['webkits_update_feed_now']) && $_POST['webkits_update_feed_now'] == 'Y') {
                function_name();
                $update_feed_now_result = 'success';
            }
        }

    }
    $options = get_option('webkits');
    if ($options != '') {
        $webkits_zerofall = $options['webkits_zerofall'];
        $webkits_site_type = $options['webkits_site_type'];
        $webkits_crea_clientid = isset($options['webkits_crea_clientid']) ? $options['webkits_crea_clientid'] : '';
        $webkits_list_id = str_replace("|", ",", $options['webkits_list_id']);
        $webkits_map_zoom = (isset($options['webkits_map_zoom'])) ? $options['webkits_map_zoom'] : 10;
        $webkits_map_zoom2 = (isset($options['webkits_map_zoom2'])) ? $options['webkits_map_zoom2'] : 10;
        $webkits_ssite_type = $options['webkits_ssite_type'];
        $webkits_slist_id = str_replace("|", ",", $options['webkits_slist_id']);
        $webkits_latlng = $options['webkits_latlng'];
        $webkits_listing_page = $options['webkits_listing_page'];
        $webkits_listings_page = $options['webkits_listings_page'];
        $webkits_rss_feed = isset($options['webkits_rss_feed']) ? $options['webkits_rss_feed'] : '';
        $webkits_hide_agents = (isset($options['webkits_hide_agents']) && $options['webkits_hide_agents'] == 1) ? 'checked' : "";
        $webkits_bc_agent = (isset($options['webkits_bc_agent']) && $options['webkits_bc_agent'] == 1) ? 'checked' : "";

        $webkits_listing_perpage = (isset($options['webkits_listing_perpage'])) ? $options['webkits_listing_perpage'] : 50;
        $webkits_agree_msg = (isset($options['webkits_agree_msg'])) ? $options['webkits_agree_msg'] : '1';
        $webkits_agent_page = $options['webkits_agent_page'];
        $webkits_map_style = (isset($options['webkits_map_style'])) ? str_replace('\"', '"', $options['webkits_map_style']) : '[]';
        $webkits_listing_default = (isset($options['webkits_listing_default'])) ? str_replace('\"', '"', $options['webkits_listing_default']) : "grid";
        $webkits_feature_template = str_replace('\"', '"', $options['webkits_feature_template']);
	    $webkits_officemlsid = (isset($options['webkits_officemlsid'])) ? str_replace('|',',',$options['webkits_officemlsid']) : '';
	    $webkits_agentid = (isset($options['webkits_agentid'])) ? str_replace('|',',',$options['webkits_agentid']) : '';
    }
    $pages = get_pages();
    require("includes/options-pages.php");
}

//ACTION
function webkits_override() {
    wp_cache_flush();
}

/*
function webkits_seo_shortcode($atts, $content = null) {
    global $dbHost;
    $options = get_option("webkits");
    $realurl = get_post($options['webkits_listings_page']);
    $args = (shortcode_atts(array(
        'section' => "search"
    ), $atts));
    ob_start();
    $link = "seo/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
    $json_feed_url = $dbHost . $link;
    $json = wp_remote_get($json_feed_url, array("body" => array("p" => $_POST)));
    $all = json_decode($json['body']);
    $show = '<meta name="robots" content="noindex, follow">';
    foreach ($all->listing as $s) $show .= "<a href='" . get_site_url() . $s->url . "' title='{$s->r}'>" . $s->r . "</a><br />";
    $realurl2 = get_post($options['webkits_listing_page']);
    echo $show;
    $content .= ob_get_clean();
    return $content;
}*/

//SHORTCODE
function webkits_mainpage_shortcode($atts, $content = null) {
    global $dbHost;
    if (!wp_script_is("slu", "enqueued")) {
        wp_enqueue_style('frame', plugin_dir_url(__FILE__) . ('public/css/horizontal.css'));

        wp_enqueue_script('slu', plugin_dir_url(__FILE__) . 'public/js/sly.min.js', array('jquery'), '', true);
        wp_enqueue_script('vendor', plugin_dir_url(__FILE__) . 'public/js/vendor.js', array('jquery'), '', true);
    } else $start = '';

	if(!wp_script_is("3dslide_js", "enqueued")){

		/*wp_deregister_script('jquery-core');
		wp_deregister_script('jquery-migrate');*/

		wp_enqueue_style('font_css', plugin_dir_url(__FILE__) . ('public/3D_Slider/css/font-awesome/css/font-awesome.css'));
		wp_enqueue_style('prphoto_css', plugin_dir_url(__FILE__) . ('public/3D_Slider/css/prettyPhoto.css'));
		wp_enqueue_style('flex_css', plugin_dir_url(__FILE__) . ('public/3D_Slider/css/flexslider.css'));
		wp_enqueue_style('3dslide_css', plugin_dir_url(__FILE__) . ('public/3D_Slider/css/style.css'));
		/*wp_enqueue_style('aud_360p', plugin_dir_url(__FILE__) . ('public/3D_Slider/js/audioplayer/360player.css'));
		wp_enqueue_style('aud_360pv', plugin_dir_url(__FILE__) . ('public/3D_Slider/js/audioplayer/360player-visualization.css'));*/

		//wp_enqueue_script('jquery-core', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/jquery.js', array('jquery'), '', true);

		wp_enqueue_script('modernizr', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/modernizr.custom.79639.js', array('jquery'), '2.0', true);
		wp_enqueue_script('prphoto_js', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/jquery.prettyPhoto.js', array('jquery'), '2.0', true);
		wp_enqueue_script('3dslide_js', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/all-functions.js', array('jquery'), '2.0', true);
		wp_enqueue_script('class_list', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/classList.js', array('jquery'), '2.0', true);
		wp_enqueue_script('bespoke', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/bespoke.js', array('jquery'), '2.0', true);
		wp_enqueue_script('flex_js', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/jquery.flexslider.js', array('jquery'), '2.0', true);
		/*wp_enqueue_script('aud_ber', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/audioplayer/script/berniecode-animator.js', array('jquery'), '', true);
		wp_enqueue_script('aud_sound', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/audioplayer/script/soundmanager2.js', array('jquery'), '', true);
		wp_enqueue_script('aud_mp3', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/audioplayer/mp3-player-button.js', array('jquery'), '', true);
		wp_enqueue_script('aud_360p', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/audioplayer/script/360player.js', array('jquery'), '', true);*/

		wp_enqueue_script('3d_custom', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/custom.js', array('jquery'), '1.0', true);

	}
    $scriptUrl = admin_url('admin-ajax.php');
    $options = get_option("webkits");
    $realurl = get_post($options['webkits_listings_page']);


    $args = (shortcode_atts(array(
        'section' => "search",
        'class' => 'main',
        'type' => 'latest'
    ), $atts));


    ob_start();

    switch ($args['section']) {
        case 'search':
            require("includes/main_search.php");
            break;
        case 'openhouse':
            require("includes/main_openhouse.php");
            break;
        case "calculator":
            wp_enqueue_script('calculator', plugin_dir_url(__FILE__) . 'public/js/mortgage.js', '', '', true);
            require("includes/details_mortgage.php");
            break;
        case 'slider':
            if ($args['type'] == 'random')
                $link = "slider/random/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
            else
                $link = "slider/latest/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];

            $json_feed_url = $dbHost. $link;

            $json = wp_remote_get($json_feed_url, array("body" => array("p" => $_POST)));
            $all = json_decode($json['body']);
            $show = '';
            foreach ($all->listing as $s) {
                $dom = new DOMDocument;
                $dom->loadHTML($s->listing);
                $img = null;
                $a = null;
                foreach ($dom->getElementsByTagName('img') as $node) {
                    $img[] = $dom->saveHTML($node);
                }
                foreach ($dom->getElementsByTagName('a') as $node) {
                    $link = $node->getAttribute('href');
                }
                foreach ($dom->getElementsByTagName('span') as $node) {
                    if ($node->getAttribute('class') == 'agentslider')
                        $agent = $dom->saveHTML($node);
                }

                $li = '
                <li class="list_item">' .
                    '<a href="' . $link . '" target="_parent">' .
                        '<div class="list_img" >' .
                            $img[0]  .
                        '</div>' .
                        '<h5 class="list_info">' .
                            '<p class="list_address list_street" >' .
                                $s->info->UnparsedAddress .
                            '</p>' .
                            '<p class="list_address list_city" >' .
                                $s->info->City .
                            '</p>' .
                            '<p class="list_price">' .
                                $s->info->ListPrice .
                            '</p>' .
                            '<p class="list_features">' .
                                '<label class="list_beds_lb" >Beds:</label><label class="list_beds">' . $s->info->Building->BedroomsTotal . "</label>" .
                                '<label class="list_baths_lb">Baths:</label><label class="list_baths">' . $s->info->Building->BathroomTotal . "</label>" .
                                '<label class="list_size_lb">Sq Ft:</label><label class="list_size">' . $s->info->Building->SizeInterior . "</label>" .
                            '</p>' .
                            '<p class="list_agent">' .
                                $agent .
                            '</p>' .
                        '</h5>' .
                    '</a>' .
                '</li>';
                $show .= $li;
            }
            $realurl2 = get_post($options['webkits_listing_page']);

            $show = str_replace("{{CHANGEURL}}", $realurl2->guid . "&l=", $show);

            require("includes/main_slider.php");
            break;
	    case 'carousel_slider':
		    if ($args['type'] == 'random')
			    $link = "slider/random/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
		    else
			    $link = "slider/latest/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];

		    $json_feed_url = $dbHost. $link;

		    $json = wp_remote_get($json_feed_url, array("body" => array("p" => $_POST)));
		    $all = json_decode($json['body']);

		    $show = '';
		    foreach ($all->listing as $s) {
			    $dom = new DOMDocument;
			    $dom->loadHTML($s->listing);
			    $img = null;
			    $a = null;
                //echo "<pre>";print_r($s);
			    foreach ($dom->getElementsByTagName('img') as $node) {
				    $img[] = $dom->saveHTML($node);
			    }
			    foreach ($dom->getElementsByTagName('a') as $node) {
				    $link = $node->getAttribute('href');
			    }
			    foreach ($dom->getElementsByTagName('span') as $node) {
				    if ($node->getAttribute('class') == 'agentslider')
					    $agent = $dom->saveHTML($node);
			    }

			    $section = '
			        <section>
                    <div class="ss-row gglass go-anim"><!-- greensea is the class for the color scheme(there are 19) go-anim is for slide up animation on roll over -->
                        
                        <div class="-hover-effect h-style img-block">
                            <a href="'.$link.'" >'.
                                $img[0].'
                                <div class="mask"><i class="icon-search"></i>
                                    <span class="img-rollover"></span>
                                </div>
                            </a>

                        </div>
                        <!--<div class="hover-effect h-style">
                            <a href="images/preview/01.jpg" rel="prettyPhotoImages[7]">
                                <img src="images/preview/01.jpg" class="clean-img">
                                <div class="mask"><i class="icon-search"></i>
                                    <span class="img-rollover"></span>
                                </div>
                            </a>
                        </div>-->
                        
                        <div class="ss-container">
                            <h3 class="content-title"><a href="'.$link.'">'.$s->info->UnparsedAddress.'</a></h3>
                            <div>'.wp_trim_words($s->info->PublicRemarks,40).'
                                <!--<a href="#" data-target=""> <strong>Read more</strong>  <i class="icon-long-arrow-right"></i></a>-->
                            </div>
                            
                            <!-- START INFO HOLDER -->
                            <div class="icon-soc-container">
                                <div class="share-btns detail-sec">
                                    <div class="empty-left time-holder "> <i class="fa fa-bed -icon-large"></i><span> ' . $s->info->Building->BedroomsTotal .'</span></div>
                                    <div class="empty-left user-holder"><i class="fa fa-bathtub -icon-large"></i><span> ' . $s->info->Building->BathroomTotal .'</span> </div>
                                    ';
			    /*if(!empty($s->info->Building->SizeInterior))
			    {
				    $section .= '<div class="empty-left user-holder"> <i class="fa fa-square icon-large"></i> '.$s->info->Building->SizeInterior.'</div>
                                ';
			    }*/
			    $section.= '
                            <!-- END INFO HOLDER -->
                            <div class="font-w-normal empty-left city-holder -time-holder"><span>&nbsp;&nbsp;' . $s->info->City .'</span></div>
                            <!-- START SHARE BUTTON -->
            <div class="empty-right">' . $s->info->ListPrice .'</div>
            
            <!-- END SHARE BUTTON -->
                        </div>
                    </div>
                </section>';

			    $show .= $section;
            }//die;


		    $realurl2 = get_post($options['webkits_listing_page']);

		    $show = str_replace("{{CHANGEURL}}", $realurl2->guid . "&l=", $show);

		    require("includes/new_main_slider.php");
		    break;
    }
    $content .= ob_get_clean();
    return $content;
}

//SHORTCODE
function webkits_agents_shortcode($atts, $content = null) {
    $args = (shortcode_atts(array(
        'section' => "agents",
        'filter' => ''
    ), $atts));

    if (!wp_script_is("agents", "enqueued")) {
        wp_enqueue_style('listnav', plugin_dir_url(__FILE__) . ('public/css/listnav.css'));
        wp_enqueue_script('listnav', plugin_dir_url(__FILE__) . 'public/js/jquery-listnav.js', array('jquery'), '', true);
        wp_enqueue_script('agents', plugin_dir_url(__FILE__) . 'public/js/agent.js', array('jquery'), '', true);
    }

    ##TEMPORARY
    $scriptUrl = admin_url('admin-ajax.php');
    $options = get_option("webkits");
    $realurl = get_post($options['webkits_agent_page']);
    ob_start();

    switch ($args['section']) {
        case 'agents':
            echo "<script> var realurl = '" . $realurl->guid . "&l=';
var agent = " . $options['webkits_list_id'] . ";
var ajaxurl = '" . $scriptUrl . "';
var filter = '" . $args['filter'] . "';
</script>";
            require("includes/agent_page.php");
            break;
        case 'search':
            require("includes/agent_search.php");
            break;
    }
    $content = ob_get_clean();
    return $content;
}
//ACTION
function webkits_styles() {
    wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . ('public/css/bootstrap.min.css'));
    wp_enqueue_style('bootstrap-theme', plugin_dir_url(__FILE__) . ('public/css/bootstrap-theme.min.css'));
    wp_enqueue_style('dd-theme', plugin_dir_url(__FILE__) . ('public/css/themesv1.1.css?v=1.2'));
    wp_enqueue_style('fa', ('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'));
}
//ACTION
function webkits_js() {
    wp_enqueue_script('bootstrapjs', plugin_dir_url(__FILE__) . 'public/js/bootstrap.min.js', array('jquery'), '', true);
}
//ACTION - MOTOPRESS
function extendTemplates($motopressCELibrary){
    $options['webkits_feature_template'] = " ";
    $options = get_option('webkits');
    if ($options['webkits_feature_template'] == null || $options['webkits_feature_template'] == "") $options['webkits_feature_template'] = "temp";
    $template = new MPCETemplate('webkits_listings', 'Listing Template', $options['webkits_feature_template'], 'plugins/webkits/product-page.png');
    $motopressCELibrary->addTemplate($template);
}
//AJAX
function webkits_change_view() {
    $_SESSION['webkits-view'] = $_POST['view'];
    die();
}

//PAGINATION
function renderNavigation($cntAround = 1, $cntPages = 1, $current = 1) {
    $out      = '';
    $isGap    = false;
    $cntPages = ceil($cntPages);
    $current--;
    for ($i = 0; $i < $cntPages; $i++) {
        $isGap = false;

        if ($cntAround >= 0 && $i > 0 && $i < $cntPages - 1 && abs($i - $current) > $cntAround) {
            $isGap = true;
            $i = ($i < $current ? $current - $cntAround : $cntPages - 1) - 1;
        }
        $lnk = ($isGap ? '<li><a href="#">...</a></li>' : ($i + 1));
        if ($i != $current && !$isGap) {
            $params = $_GET;
            unset($params["listing-page"]);
            $params["listing-page"] = $i + 1;
            $link                   = basename($_SERVER['PHP_SELF']) . '?' . http_build_query($params);
            $lnk                    = '<li><a href="' . $link . '">' . $lnk . '</a></li>';

        }
        if ($i == $current) {
            $lnk = '<li class="active"><a href="#">' . $lnk . '</a></li>';
        }
        $out .= $lnk;
    }
    return $out;
}
//SHORTCODE
function webkits_listings_sc($atts, $content = null) {
    global $dbHost;
    session_start();

    if (!wp_script_is("listings", "enqueued")) {

        wp_enqueue_style('map', plugin_dir_url(__FILE__) . ('public/css/map.css'));
        wp_enqueue_script('mpce-gma-google-maps-api', 'http://maps.google.com/maps/api/js?key=AIzaSyDZ9XDDXc0IBIOPhc3Hw1TaXJEDR2LpU3k', '', '', true);
        wp_enqueue_script('gmap', plugin_dir_url(__FILE__) . 'public/js/map.js', array('jquery'), '', true);
        wp_enqueue_script('cluster', plugin_dir_url(__FILE__) . 'public/js/marker.js', array('jquery'), '', true);
        wp_enqueue_script('listings', plugin_dir_url(__FILE__) . 'public/js/listings.js', array('jquery'), '', true);

        wp_enqueue_script('masonary', plugin_dir_url(__FILE__) . 'public/js/masonry.min.js', array('jquery'), '', true);
        wp_enqueue_script('search', plugin_dir_url(__FILE__) . 'public/js/search.js', array('jquery'), '', true);

    }

    foreach($_POST as $k => $v) {
        if(strpos($k, "wk-") !== false) {
            $_POST[str_replace("wk-", "", $k)] = $v;
            unset($_POST[$k]);
        }
    }

    $options = get_option("webkits");

    if (isset($_POST['clear']) && isset($_SESSION['webkit-search'])) {
        unset($_SESSION['webkit-search']);
        unset($_POST);
        header('Location: '.$_SERVER['REQUEST_URI']);

    }


    $realurl = get_post($options['webkits_listing_page']);

    $args = (shortcode_atts(array(
        'section' => "listings",
        'filter' => '',
        'show'    => 0,
        "all"   =>  1,
        "all_agent"   => 1,
    ), $atts));

    $check = "";
    $main  = '';
    if (isset($_POST['srch-term'])) {
        if ($_POST['srch-term'] == "openhouse") {
            $check = "checked='checked'";
        } else {
            $main = $_POST['srch-term'];
        }
    } elseif(isset($_POST['srch-term']) && $_POST['input_main']) {
        $main = $_POST['input_main'];
    }
    ob_start();

    switch ($args['section']) {
        case 'counter':
            require "includes/listing_counter.php";
            break;

        case 'listings-filtered':
            $listingPerPage = $options['webkits_listing_perpage'];
            $hideAgent      = isset($options['webkits_hide_agents']) ? $options['webkits_hide_agents'] : 0;

            $officeMlsId      = (isset($options['webkits_officemlsid'] ) && !empty($options['webkits_officemlsid']))? explode('|',$options['webkits_officemlsid']) : '';
	        $agentId      = (isset($options['webkits_agentid']) && !empty($options['webkits_agentid']))? explode('|',$options['webkits_agentid']) : '';

            if (isset($_GET['listing-page']) && is_numeric($_GET['listing-page'])) {
                $_POST['offset'] = $listingPerPage * ($_GET['listing-page'] - 1);

                $CurrentPage = $_GET['listing-page'];
            } else {
                $CurrentPage = 1;
            }
            if(isset($officeMlsId) && !empty($officeMlsId) && is_array($officeMlsId) && count($officeMlsId) > 0 && isset($args['all']) && ($args['all'] == false || $args['all'] == '0' || $args['all'] == 0))
            {
	               $_POST['officeMlsId'] = $officeMlsId;
            }
	        if(isset($agentId) && !empty($agentId) && is_array($agentId) && count($agentId) > 0 &&  isset($args['all_agent']) && ($args['all_agent'] == false || $args['all_agent'] == '0' || $args['all_agent'] == 0))
	        {
		           $_POST['AgentId'] = $agentId;
	        }


            //echo "<pre>";print_r($_POST);die;
            if(isset($args['filter'])) {
                switch ($args['filter']){
                    case 'openhouse':
                        $link   = "Show/OpenHouse/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
	                    if (isset($_POST['pressed'])) {
	                        unset($_POST['pressed']);

		                    $_POST['offset']           = 0;

		                    header('Location: '.$_SERVER['REQUEST_URI']);
		                    }
                    break;
                    case 'commercial':
                        $link   = "Show/Commercial/". $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
                    break;
                    case 'carriagetrade':
                        $link   = "Show/CarriageTrade/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
                    break;
                    default:
                        $link  = "Show/{$args['filter']}/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
                    break;
                }
            }

            $json_feed_url = $dbHost . $link;

            $_POST['data']    = $_POST;
            $_POST['perpage'] = $listingPerPage;

            $json     = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

            $listings = json_decode($json['body']);

            $allListings = json_decode($json['body']);

            require "inc/listing_page.php";
            break;
        case 'listings':

            $listingPerPage = $options['webkits_listing_perpage'];
            $listingpage    = get_post($options['webkits_listing_page'])->guid . "&l=";
            $hideAgent      = isset($options['webkits_hide_agents']) ? $options['webkits_hide_agents'] : 0;

            if (isset($_GET['listing-page']) && is_numeric($_GET['listing-page'])) {
                $_POST['offset'] = $listingPerPage * ($_GET['listing-page'] - 1);

                $CurrentPage = $_GET['listing-page'];
            } else {
                $CurrentPage = 1;
            }

            if (isset($_POST['srch-term'])) {
                if ($_POST['srch-term'] != "openhouse") {
                    $_POST['input_main'] = $_POST['srch-term'];
                }

            }

            if (isset($atts['from-city']) && $atts['from-city'] != '') {
                $_POST['from_city'] = $atts['from-city'];
            }

            if (isset($atts['onlyshow']) && $atts['onlyshow'] != '') {
                $_POST['onlyshow'] = $atts['onlyshow'];
            }
            if (isset($atts['maxprice'])) {
                $_POST['maxprice'] = $atts['maxprice'];
            }
            if (isset($atts['postal'])) {
                $_POST['postal'] = strtoupper($atts['postal']);
            }
            if (isset($atts['commercial']) && $atts['commercial'] == '1') {
                $_POST['commercial'] = 1;
            }
            if (isset($atts['lots']) && $atts['lots'] == '1') {
                $_POST['lots'] = 1;
            }
            if(isset($atts['retail']) && $atts['retail'] == '1'){
                $_POST['retail'] = 1;
            }
            if (isset($atts['condo']) && $atts['condo'] == 1)
            {
                $_POST['condo'] = 1;
                $_POST['condo_search'] = true;

            }

            if (isset($atts['address']) && $atts['address'] != '')
            {
                 $arraddress = explode('|',$atts['address']);

                    if(is_array($arraddress) && count($arraddress) > 0)
                    {
                        $_POST['address'] = $arraddress;
                    }

                /* if(strpos($atts['address'],',') != false)
                {
                    $address = explode(',',$atts['address']);

                    if(isset($address[0]))
                        $_POST['address'] = $address[0];

                    if(isset($address[1]))
                        $_POST['city'] = $address[1];

                    if(isset($address[2]))
                        $_POST['postalcode'] = $address[2];
                }
                else {
                    $_POST['address'] = $atts['address'];
                }*/
            }

            if (isset($_POST['pressed'])) {

                $search = $_POST['search'];
                unset($_POST['pressed']);
                $_POST['live-search'] = true;
                $CurrentPage               = 1;
                $_POST['offset']           = 0;
                $_SESSION['webkit-search'] = $_POST;

                header('Location: '.$_SERVER['REQUEST_URI']);
                //header('Location: '.$_SERVER['HTTP_HOST'].'/listings');

            }

            if (!isset($_POST['condo_search']) && !isset($_POST['input_main']) && isset($_SESSION['webkit-search'])) {
                $_POST = $_SESSION['webkit-search'];
            }

//FERNSIDE STREET,FINLAYSON CRESCENT,NOBLE CRESCENT,noble crescent//19663544
            $link = "ShowListings/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];

            if (isset($_POST['srch-term'])) {

                if ($_POST['srch-term'] == "openhouse") {
                    $link = "ShowOpenHouse/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
                }
            }

            $link = "ShowListings/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];

            $json_feed_url = $dbHost . $link;

            //return $json_feed_url;
            $_POST['data'] = $_POST;
            $_POST['perpage'] = $listingPerPage;
            //echo "<pre>";print_r($json_feed_url);die;
            $json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));
            //echo "<pre>";print_r($json);die;
            $listings = json_decode($json['body']);


            require "inc/listing_page.php";
            if(isset($search)) $_POST['search'] = $search;
            break;


        case 'second-listings':
            wp_enqueue_script('listings2', plugin_dir_url(__FILE__) . 'public/js/listings2.js', array('jquery'), '', true);
            if (isset($_POST['search'])) {


            $listingPerPage = $options['webkits_listing_perpage'];
            $listingpage    = get_post($options['webkits_listing_page'])->guid . "&l=";
            $hideAgent      = isset($options['webkits_hide_agents']) ? $options['webkits_hide_agents'] : 0;

            if (isset($_GET['listing-page']) && is_numeric($_GET['listing-page'])) {
                $_POST['offset'] = $listingPerPage * ($_GET['listing-page'] - 1);

                $CurrentPage = $_GET['listing-page'];
            } else {
                $CurrentPage = 1;
            }
            if (isset($_POST['srch-term'])) {
                if ($_POST['srch-term'] != "openhouses") {
                    $_POST['input_main'] = $_POST['srch-term'];
                }

            }
            if (isset($_POST['search'])) {
                unset($_POST['search']);
                $CurrentPage               = 1;
                $_POST['offset']           = 0;
                $_SESSION['webkit-search'] = $_POST;
                header('Location: '.$_SERVER['REQUEST_URI']);
            }

            //echo $_POST['offset'];
            if (!isset($_POST['input_main']) && isset($_SESSION['webkit-search'])) {
                $_POST = $_SESSION['webkit-search'];
            }

            $link = "ShowListings/" . $options['webkits_ssite_type'] . "/" . $options['webkits_slist_id'];

            if (isset($_POST['srch-term'])) {
                if ($_POST['srch-term'] == "openhouses") {
                    $link = "ShowOpenHouse/" . $options['webkits_ssite_type'] . "/" . $options['webkits_ssite_type'];
                }

            }

            $json_feed_url = $dbHost . $link;
            $_POST['data']    = $_POST;
            $_POST['perpage'] = $listingPerPage;
            $json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));
            $listings = json_decode($json['body']);
            include "inc/listing_page2.php";
          }
            break;


        case 'map':

            $listingPerPage = '4000';
            $listingpage    = get_post($options['webkits_listing_page'])->guid . "&l=";
            $hideAgent      = isset($options['webkits_hide_agents']) ? $options['webkits_hide_agents'] : 0;

            echo "<script>noCluster = false;</script>";
            require "includes/listing_map.php";
             if(isset($search)) $_POST['search'] = $search;
            break;
        case 'search':
            wp_enqueue_style('jquery-mob',plugin_dir_url(__FILE__) . ('public/css/ion.rangeSlider.css'));
            wp_enqueue_style('jquery-mob2',plugin_dir_url(__FILE__) . ('public/css/ion.rangeSlider.skinHTML5.css'));
            wp_enqueue_script('jquery-m',plugin_dir_url(__FILE__) . ('public/js/ion.rangeSlider.min.js'));
            if (!isset($_POST['input_main']) && isset($_SESSION['webkit-search'])) {
                $_POST = $_SESSION['webkit-search'];
            }

            if ($_POST['input_open_house'] == 1) {
                $check = "checked='checked'";
            }

            $link          = "GetOffices/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
            $json_feed_url = $dbHost . $link;

            $json    = wp_remote_post($json_feed_url, array());

            $offices = json_decode($json['body']);
            require "inc/listing_search.php";
            break;
        case 'full-search':
        wp_enqueue_style('jquery-mob',plugin_dir_url(__FILE__) . ('public/css/ion.rangeSlider.css'));
        wp_enqueue_style('jquery-mob2',plugin_dir_url(__FILE__) . ('public/css/ion.rangeSlider.skinHTML5.css'));
        wp_enqueue_script('jquery-m',plugin_dir_url(__FILE__) . ('public/js/ion.rangeSlider.min.js'));

            if (!isset($_POST['input_main']) && isset($_SESSION['webkit-search'])) {
                $_POST = $_SESSION['webkit-search'];
            }

            if ($_POST['input_open_house'] == 1) {
                $check = "checked='checked'";
            }

            $link          = "GetOffices/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];
            $json_feed_url = $dbHost . $link;

	        //file_put_contents('000.txt',$json_feed_url);
	        //error_reporting(E_ERROR | E_WARNING | E_PARSE);
	        //ini_set('display_errors', 1);
            /*$json    = wp_remote_post('http://inside.bulkbuyonly.com/api.php',
                                      array('area'=> 'Master','module'=>'GetFabricList','token'=>'.CL5xHL!3rHn1#bHkJ5w^M0VH~W7oC5s.')
            );
            WP_Error Object
            (
                [errors] => Array
                    (
                        [http_request_failed] => Array
                            (
                                [0] => cURL error 6: Could not resolve host: inside.bulkbuyonly.com
                            )

                    )

                [error_data] => Array
                    (
                    )

            )
            */

	        $json    = wp_remote_post($json_feed_url,array());
	        /*
	        WP_Error Object
            (
                [errors] => Array
                    (
                        [http_request_failed] => Array
                            (
                                [0] => cURL error 7: Failed to connect to webkitadmin.project port 7700: No route to host
                            )

                    )

                [error_data] => Array
                    (
                    )

            )
	        */

	        //file_put_contents('000.txt',print_r($json,true));exit;

            $offices = json_decode($json['body']);
            require "includes/listing_search.php";
            break;

    }

    $content = $start;
    $content .= ob_get_clean();

    return $content;
}
?>