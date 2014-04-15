<?php
/*
Plugin Name: WP Google Maps - Pro Add-on
Plugin URI: http://www.wpgmaps.com
Description: This is the Pro add-on for WP Google Maps. The Pro add-on enables you to add descriptions, pictures, links and custom icons to your markers as well as allows you to download your markers to a CSV file for quick editing and re-upload them when complete.
Version: 4.17
Author: WP Google Maps
Author URI: http://www.wpgmaps.com

 *
 * 4.17
 * There is now the option to hide the Category column
 * 
 * 4.16
 * Fixed an infowindow styling bug
 * 
 * 4.15
 * Added a check to see if the Google Maps API was already loaded to avoid duplicate loading
 * Fixed some SSL bugs
 * Added extra style support for the standard marker listing
 * Advanced marker list now updates with category drop down selection
 *
 * 4.14
 * Added a min-width to the DIV within the InfoWindow class to stop the scroll bars from appearing in IE10
 *
 * 4.13
 * Map mashups are now available by modifying the shortcode.
 * Added Category functionality.
 * Fixed a bug with the normal marker list layout
 * Added backwards compatibility for older versions of WordPress
 * Fixed a few small bugs
 * Replaced deprecated WordPress function calls
 * Added Spanish translation - Thank you Fernando!
 * Coming soon in 4.14: Map mashup via custom fields in post.
 *
 * 4.12
 * Fixed a small bug
 *
 * 4.11
 * Better localization support
 * Fixed a SSL bug
 * 
 * 4.10
 * Added Polygon functionality
 * Added Polyline functionality
 * You can now show your visitors location on the map
 * Markers can now be sorted by id,title,description or address
 * Added better support for jQuery versions
 * Plugin now works out the box with jQuery tabs
 * Added standards for the advanced marker list style
 * Added user access support for the visitor generated markers add-on
 * Adjusted the KML functionality to avoid caching
 * Fixed small bugs causing PHP warnings
 * Fixed a bug that stopped the advanced marker listing from working
 * 
 * 4.09
 * Fixed a bug that didnt allow for multiple clicks on the marker list to bring the view back to the map
 * 
 * 4.08
 * This version allows the plugin to update itself moving forward
 * 
 * 4.07
 * Fixed a bug that was causing a JavaScript error with DataTables
 * 
 * 4.06
 * Added troubleshooting support
 * Fixed a bug that was stopping the plugin from working on IIS servers
 * 
 * 4.05
 * Added support for one-page-style themes.
 * Fixed a firefox styling bug when using percentage width/height and set map alignment to 'none'
 * Added support for disabling mouse zooming and dragging
 * Added support for jQuery1.9+
 * 
 * 4.04
 * Fixed a centering bug - thank you Yannick!
 * Italian translation added
 * Fixed an IE9 display bug 
 * Fixed a compatibility bug between the VGm add-on and the Pro add-on
 * Fixed a bug with the VGM display option
 * Fixed a bug with importing markers whereby it always showed as an error even when importing correctly
 *
 * 4.03
 * Fixed a firefox styling bug that caused the Directions box to load on the right of the map instead of below.
 * Added support code for the new WP Google Maps Visitor Generated Markers plugin
 * Added the option for a more advanced way to list your markers below your maps
 * Added responsive size functionality
 * Added support for Fusion Tables
 *
 * 4.02
 * Fixed the bug that caused the directions box to show above the map by default
 * Fixed the bug whereby an address was already hard-coded into the "To" field of the directions box
 * Fixed the bug that caused the traffic layer to show by default
 *
 * 4.01
 * Added the functionality to list your markers below the map
 * Added more advanced directions functionality
 * Fixed small bugs
 * Fixed a bug that caused a fatal error when trying to activate the plugin on some hosts.
 *
 * 4.0
 * Plugin now supports multiple maps on one page
 * Bicycle directions now added
 * Walking directions now added
 * "Avoid tolls" now added to the directions functionality
 * "Avoid highways" now added to directions functionality
 * New setting: open links in a new window
 * Added functionality to reset the default marker image if required.
 *
 * 3.12
 * Fixed the bug that told users they had an outdated plugin when in fact they never
 *
 * 3.11
 * Fixed the bug that was causing both the bicycle layer and traffic layer to show all the time
 * 
 * 3.10
 * Added the bicycle layer
 * Added the traffic layer
 * Fixed the bug that was not allowing users to overwrite existing data when uploading a CSV file
 *
 * 3.9
 * Added support for KML/GeoRSS layers.
 * Fixed the directions box styling error in Firefox.
 * Fixed the bug whereby users couldnt change the default location without adding a marker first.
 * When the "Directions" link is clicked on, the "From" field is automatically highlighted for the user.
 * Added additional settings
 *
 * 3.8
 * Markers now automatically close when you click on another marker.
 * Russian localization added
 * The "To" field in the directions box now shows the address and not the GPS co-ords.
 *
 * 3.7
 * Added support for localization
 *
 * 3.6
 * Fixed the bug that caused slow loading times with sites that contain a high number of maps and markers
 *
 * 3.5
 * Fixed the bug where sometimes the short code wasnt working for home pages
 *
 * 3.4
 * Added functionality for 'Titles' for each marker
 *
 * 3.3
 * Added functionality for WordPress MU
 *
 * 3.2
 * Fixed a bug where in IE the zoom checkbox was showing
 * Fixed the bug where the map wasnt saving correctly in some instances

 * 3.1
 * Fixed redirect problem
 * Fixed bug that never created the default map on some systems

 * 3.0
 * Added Map Alignment functionality
 * Added Map Type functionality
 * Started using the Geocoding API Version 3  instead of Version 2 - quicker results!
 * Fixed bug that didnt import animation data for CSV files
 * Fixed zoom bug

 * 2.1
 * Fixed a few bugs with the jQuery script
 * Fixed the shortcode bug where the map wasnt displaying when two or more short codes were one the post/page
 * Fixed a bug that wouldnt save the icon on editing a marker in some instances
 *
 * 
 *
*/


global $wpgmza_pro_version;
global $wpgmza_pro_string;
$wpgmza_pro_version = "4.17";
$wpgmza_pro_string = "pro";

global $wpgmza_p;
global $wpgmza_t;
$wpgmza_p = true;
$wpgmza_t = "pro";

global $wpgmza_count;
$wpgmza_count = 0;

global $wpgmza_post_nonce;
$wpgmza_post_nonce = md5(time());

include ("wp-google-maps-pro_polygons.php");
include ("wp-google-maps-pro_polylines.php");
include ("wp-google-maps-pro_categories.php");

add_action('admin_head', 'wpgmaps_upload_csv');
add_action('init', 'wpgmza_register_pro_version');


function wpgmaps_pro_activate() { 
    wpgmza_cURL_response_pro("activate");
}
function wpgmaps_pro_deactivate() { wpgmza_cURL_response_pro("deactivate"); }




function wpgmza_register_pro_version() {
    global $wpgmza_pro_version;
    global $wpgmza_pro_string;
    global $wpgmza_t;
    if (!get_option('WPGMZA_PRO')) {
        add_option('WPGMZA_PRO',array("version" => $wpgmza_pro_version, "version_string" => $wpgmza_t));
    } else {
        update_option('WPGMZA_PRO',array("version" => $wpgmza_pro_version, "version_string" => $wpgmza_t));
    }
}

function wpgmza_pro_menu() {
    global $wpgmza_pro_version;
    global $wpgmza_p_version;
    global $wpgmza_post_nonce;
    global $wpgmza_tblname_maps;
    global $wpdb;
    

    

    if (!wpgmaps_check_permissions()) { wpgmaps_permission_warning(); }

    if ($_GET['action'] == "edit") {

    }
    else if ($_GET['action'] == "new") {


        $def_data = get_option("WPGMZA_SETTINGS");

        $data['map_default_starting_lat'] = $map_start_lat;
        $data['map_default_starting_lng'] = $map_start_lng;
        $data['map_default_height'] = $map_height;
        $data['map_default_width'] = $map_width;
        $data['map_default_zoom'] = $map_start_zoom;
        $data['map_default_type'] = $type;
        $data['map_default_alignment'] = $alignment;
        $data['map_default_order_markers_by'] = $order_markers_by;
        $data['map_default_order_markers_choice'] = $order_markers_choice;
        $data['map_default_show_user_location'] = $show_user_location;
        $data['map_default_directions'] = $directions_enabled;
        $data['map_default_bicycle'] = $bicycle_enabled;
        $data['map_default_traffic'] = $traffic_enabled;
        $data['map_default_dbox'] = $dbox;
        $data['map_default_dbox_width'] = $dbox_width;
        $data['map_default_marker'] = $map_default_marker;

        if (isset($def_data['map_default_height'])) {
            $wpgmza_height = $def_data['map_default_height'];
        } else {
            $wpgmza_height = "400";
        }
        if (isset($def_data['map_default_width'])) {
            $wpgmza_width = $def_data['map_default_width'];
        } else {
            $wpgmza_width = "600";
        }
        if (isset($def_data['map_default_marker'])) {
            $wpgmza_def_marker = $def_data['map_default_marker'];
        } else {
            $wpgmza_def_marker = "0";
        }
        if (isset($def_data['map_default_alignment'])) {
            $wpgmza_def_alignment = $def_data['map_default_alignment'];
        } else {
            $wpgmza_def_alignment = "0";
        }
        if (isset($def_data['map_default_order_markers_by'])) {
            $wpgmza_def_order_markers_by = $def_data['map_default_order_markers_by'];
        } else {
            $wpgmza_def_order_markers_by = "0";
        }
        if (isset($def_data['map_default_order_markers_choice'])) {
            $wpgmza_def_order_markers_choice = $def_data['map_default_order_markers_choice'];
        } else {
            $wpgmza_def_order_markers_choice = "0";
        }
        if (isset($def_data['map_default_show_user_location'])) {
            $wpgmza_def_show_user_location = $def_data['map_default_show_user_location'];
        } else {
            $wpgmza_def_show_user_location = "0";
        }
        if (isset($def_data['map_default_directions'])) {
            $wpgmza_def_directions = $def_data['map_default_directions'];
        } else {
            $wpgmza_def_directions = "0";
        }
        if (isset($def_data['map_default_bicycle'])) {
            $wpgmza_def_bicycle = $def_data['map_default_bicycle'];
        } else {
            $wpgmza_def_bicycle = "0";
        }
        if (isset($def_data['map_default_traffic'])) {
            $wpgmza_def_traffic = $def_data['map_default_traffic'];
        } else {
            $wpgmza_def_traffic = "0";
        }
        if (isset($def_data['map_default_dbox'])) {
            $wpgmza_def_dbox = $def_data['map_default_dbox'];
        } else {
            $wpgmza_def_dbox = "0";
        }
        if (isset($def_data['map_default_dbox_wdith'])) {
            $wpgmza_def_dbox_width = $def_data['map_default_dbox_width'];
        } else {
            $wpgmza_def_dbox_width = "500";
        }
        if (isset($def_data['map_default_listmarkers'])) {
            $wpgmza_def_listmarkers = $def_data['map_default_listmarkers'];
        } else {
            $wpgmza_def_listmarkers = "0";
        }
        if (isset($def_data['map_default_listmarkers_advanced'])) {
            $wpgmza_def_listmarkers_advanced = $def_data['map_default_listmarkers_advanced'];
        } else {
            $wpgmza_def_listmarkers_advanced = "0";
        }
        if (isset($def_data['map_default_filterbycat'])) {
            $wpgmza_def_filterbycat = $def_data['map_default_filterbycat'];
        } else {
            $wpgmza_def_filterbycat = "0";
        }
        if (isset($def_data['map_default_type'])) {
            $wpgmza_def_type = $def_data['map_default_type'];
        } else {
            $wpgmza_def_type = "1";
        }

        if (isset($def_data['map_default_zoom'])) {
            $start_zoom = $def_data['map_default_zoom'];
        } else {
            $start_zoom = 5;
        }
        
        if (isset($def_data['map_default_ugm_access'])) {
            $ugm_access = $def_data['map_default_ugm_access'];
        } else {
            $ugm_access = 0;
        }
        
        if (isset($def_data['map_default_starting_lat']) && isset($def_data['map_default_starting_lng'])) {
            $wpgmza_lat = $def_data['map_default_starting_lat'];
            $wpgmza_lng = $def_data['map_default_starting_lng'];
        } else {
            $wpgmza_lat = "51.5081290";
            $wpgmza_lng = "-0.1280050";
        }


        $wpdb->insert( $wpgmza_tblname_maps, array(
            "map_title" => "New Map",
            "map_start_lat" => "$wpgmza_lat",
            "map_start_lng" => "$wpgmza_lng",
            "map_width" => "$wpgmza_width",
            "map_height" => "$wpgmza_height",
            "map_start_location" => "$wpgmza_lat,$wpgmza_lng",
            "map_start_zoom" => "$start_zoom",
            "default_marker" => "$wpgmza_def_marker",
            "alignment" => "$wpgmza_def_alignment",
            "styling_enabled" => "0",
            "styling_json" => "",
            "active" => "0",
            "directions_enabled" => "$wpgmza_def_directions",
            "type" => "$wpgmza_def_type",
            "kml" => "",
            "fusion" => "",
            "map_width_type" => "px",
            "map_height_type" => "px",
            "fusion" => "",
            "mass_marker_support" => "0",
            "ugm_enabled" => "0",
            "ugm_access" => "$ugm_access",
            "bicycle" => "$wpgmza_def_bicycle",
            "traffic" => "$wpgmza_def_traffic",
            "dbox" => "$wpgmza_def_dbox",
            "dbox_width" => "$wpgmza_def_dbox_width",
            "listmarkers" => "$wpgmza_def_listmarkers",
            "listmarkers_advanced" => "$wpgmza_def_listmarkers_advanced",
            "filterbycat" => "$wpgmza_def_filterbycat",
            "order_markers_by" => "$wpgmza_def_order_markers_by",
            "order_markers_choice" => "$wpgmza_def_order_markers_choice",
            "show_user_location" => "$wpgmza_def_show_user_location"

            )
        );
        $lastid = $wpdb->insert_id;
        $_GET['map_id'] = $lastid;
        //wp_redirect( admin_url('admin.php?page=wp-google-maps-menu&action=edit&map_id='.$lastid) );
        //$wpdb->print_errors();
        
        echo "<script>window.location = \"".get_option('siteurl')."/wp-admin/admin.php?page=wp-google-maps-menu&action=edit&map_id=".$lastid."\"</script>";
    }


    if (isset($_GET['map_id'])) {

        $res = wpgmza_get_map_data($_GET['map_id']);
        if (function_exists(wpgmza_register_gold_version)) { $addon_text = __("including Pro &amp; Gold add-ons","wp-google-maps"); } else { $addon_text = __("including Pro add-on","wp-google-maps"); }
        if (!$res->map_id || $res->map_id == "") { $wpgmza_data['map_id'] = 1; }
        if (!$res->default_marker || $res->default_marker == "" || $res->default_marker == "0") { $display_marker = "<img src=\"".wpgmaps_get_plugin_url()."/images/marker.png\" />"; } else { $display_marker = "<img src=\"".$res->default_marker."\" />"; }
        if ($res->map_start_zoom) { $wpgmza_zoom[intval($res->map_start_zoom)] = "SELECTED"; } else { $wpgmza_zoom[8] = "SELECTED"; }
        if ($res->type) { $wpgmza_map_type[intval($res->type)] = "SELECTED"; } else { $wpgmza_map_type[1] = "SELECTED"; }
        if ($res->alignment) { $wpgmza_map_align[intval($res->alignment)] = "SELECTED"; } else { $wpgmza_map_align[1] = "SELECTED"; }
        if ($res->directions_enabled) { $wpgmza_directions[intval($res->directions_enabled)] = "SELECTED"; } else { $wpgmza_directions[2] = "SELECTED"; }
        if ($res->bicycle) { $wpgmza_bicycle[intval($res->bicycle)] = "SELECTED"; } else { $wpgmza_bicycle[2] = "SELECTED"; }
        if ($res->traffic) { $wpgmza_traffic[intval($res->traffic)] = "SELECTED"; } else { $wpgmza_traffic[2] = "SELECTED"; }
        if ($res->dbox != "1") { $wpgmza_dbox[intval($res->dbox)] = "SELECTED"; } else { $wpgmza_dbox[1] = "SELECTED"; }

        if ($res->order_markers_by) { $wpgmza_map_order_markers_by[intval($res->order_markers_by)] = "SELECTED"; } else { $wpgmza_map_order_markers_by[1] = "SELECTED"; }
        if ($res->order_markers_choice) { $wpgmza_map_order_markers_choice[intval($res->order_markers_choice)] = "SELECTED"; } else { $wpgmza_map_order_markers_choice[2] = "SELECTED"; }

        if ($res->show_user_location) { $wpgmza_show_user_location[intval($res->show_user_location)] = "SELECTED"; } else { $wpgmza_show_user_location[2] = "SELECTED"; }
        
        
       if (stripslashes($res->map_width_type) == "%") { $wpgmza_map_width_type_percentage = "SELECTED"; } else { $wpgmza_map_width_type_px = "SELECTED"; }
       if (stripslashes($res->map_height_type) == "%") { $wpgmza_map_height_type_percentage = "SELECTED"; } else { $wpgmza_map_height_type_px = "SELECTED"; }


        if ($res->listmarkers == "1") { $listmarkers_checked = "CHECKED"; } else { }
        if ($res->filterbycat == "1") { $listfilters_checked = "CHECKED"; } else { }
        if ($res->listmarkers_advanced == "1") { $listmarkers_advanced_checked = "CHECKED"; } else { }


        $wpgmza_csv = "<a href=\"".wpgmaps_get_plugin_url()."/csv.php\" title=\"".__("Download this as a CSV file","wp-google-maps")."\">".__("Download this data as a CSV file","wp-google-maps")."</a>";

    }
    echo "
       <div class='wrap'>
    
    
    
    
    
    
            <h1>WP Google Maps <small>($addon_text)</small></h1>
            <div class='wide'>
                    ".wpgmza_version_check()."
                    <h2>".__("Create your Map","wp-google-maps")."</h2>
                    $version_message
    
    <form action='' method='post' id='wpgmaps_options' name='wpgmza_map_form'>

        <div id=\"wpgmaps_tabs\">
                <ul>
                        <li><a href=\"#tabs-1\">General Settings</a></li>
                        <li><a href=\"#tabs-2\">Advanced Settings</a></li>
                </ul>
                <div id=\"tabs-1\">

                     
            
                    <p></p>

                        <input type='hidden' name='http_referer' value='".$_SERVER['PHP_SELF']."' />
                        <input type='hidden' name='wpgmza_id' id='wpgmza_id' value='".$res->id."' />
                        <input id='wpgmza_start_location' name='wpgmza_start_location' type='hidden' size='40' maxlength='100' value='".$res->map_start_location."' />
                        <select id='wpgmza_start_zoom' name='wpgmza_start_zoom' style=\"display:none;\">
                            <option value=\"1\" ".$wpgmza_zoom[1].">1</option>
                            <option value=\"2\" ".$wpgmza_zoom[2].">2</option>
                            <option value=\"3\" ".$wpgmza_zoom[3].">3</option>
                            <option value=\"4\" ".$wpgmza_zoom[4].">4</option>
                            <option value=\"5\" ".$wpgmza_zoom[5].">5</option>
                            <option value=\"6\" ".$wpgmza_zoom[6].">6</option>
                            <option value=\"7\" ".$wpgmza_zoom[7].">7</option>
                            <option value=\"8\" ".$wpgmza_zoom[8].">8</option>
                            <option value=\"9\" ".$wpgmza_zoom[9].">9</option>
                            <option value=\"10\" ".$wpgmza_zoom[10].">10</option>
                            <option value=\"11\" ".$wpgmza_zoom[11].">11</option>
                            <option value=\"12\" ".$wpgmza_zoom[12].">12</option>
                            <option value=\"13\" ".$wpgmza_zoom[13].">13</option>
                            <option value=\"14\" ".$wpgmza_zoom[14].">14</option>
                            <option value=\"15\" ".$wpgmza_zoom[15].">15</option>
                            <option value=\"16\" ".$wpgmza_zoom[16].">16</option>
                            <option value=\"17\" ".$wpgmza_zoom[17].">17</option>
                            <option value=\"18\" ".$wpgmza_zoom[18].">18</option>
                            <option value=\"19\" ".$wpgmza_zoom[19].">19</option>
                            <option value=\"20\" ".$wpgmza_zoom[20].">20</option>
                            <option value=\"21\" ".$wpgmza_zoom[21].">21</option>
                        </select>

                    <table class='form-table'>
                        <tr>
                            <td>".__("Short code","wp-google-maps").":</td>
                            <td><input type='text' readonly name='shortcode' style='font-size:18px; text-align:center;' value='[wpgmza id=\"".$res->id."\"]' /> <small><i>".__("copy this into your post or page to display the map","wp-google-maps")."</i></td>
                        </tr>
                        <tr>
                            <td>".__("Map Name","wp-google-maps").":</td>
                            <td><input id='wpgmza_title' name='wpgmza_title' class='regular-text' type='text' size='20' maxlength='50' value='".$res->map_title."' /></td>
                        </tr>
                        <tr>
                             <td>".__("Map Dimensions","wp-google-maps").":</td>
                             <td>
                                ".__("Width","wp-google-maps").": <input id='wpgmza_width' name='wpgmza_width' type='text' size='4' maxlength='4' class='small-text' value='".$res->map_width."' />
                                 <select id='wpgmza_map_width_type' name='wpgmza_map_width_type'>
                                    <option value=\"px\" $wpgmza_map_width_type_px>px</option>
                                    <option value=\"%\" $wpgmza_map_width_type_percentage>%</option>
                                 </select>

                                &nbsp; &nbsp; &nbsp; &nbsp; 
                                ".__("Height","wp-google-maps").": <input id='wpgmza_height' name='wpgmza_height' type='text' size='4' maxlength='4' class='small-text' value='".$res->map_height."' />
                                 <select id='wpgmza_map_height_type' name='wpgmza_map_height_type'>
                                    <option value=\"px\" $wpgmza_map_height_type_px>px</option>
                                    <option value=\"%\" $wpgmza_map_height_type_percentage>%</option>
                                 </select>

                            </td>
                        </tr>

                    </table>
                    
            
            
                </div>
                <div id=\"tabs-2\">
                    <table class='form-table' id='wpgmaps_advanced_options'>
                        <tr>
                            <td>".__("Default Marker Image","wp-google-maps").":</td>
                            <td><span id=\"wpgmza_mm\">$display_marker</span> <input id=\"upload_default_marker\" name=\"upload_default_marker\" type='hidden' size='35' class='regular-text' maxlength='700' value='".$res->default_marker."' ".$wpgmza_act."/> <input id=\"upload_default_marker_btn\" type=\"button\" value=\"".__("Upload Image","wp-google-maps")."\" $wpgmza_act /> <a href=\"javascript:void(0);\" onClick=\"document.forms['wpgmza_map_form'].upload_default_marker.value = ''; var span = document.getElementById('wpgmza_mm'); while( span.firstChild ) { span.removeChild( span.firstChild ); } span.appendChild( document.createTextNode('')); return false;\" title=\"Reset to default\">-reset-</a> &nbsp; &nbsp; <small><i>".__("Get great map markers <a href='http://mapicons.nicolasmollet.com/' target='_BLANK' title='Great Google Map Markers'>here</a>","wp-google-maps")."</i></small></td>
                        </tr>

                        <tr>
                            <td>".__("Map type","wp-google-maps").":</td>
                            <td><select id='wpgmza_map_type' name='wpgmza_map_type' class='postform'>
                                <option value=\"1\" ".$wpgmza_map_type[1].">".__("Roadmap","wp-google-maps")."</option>
                                <option value=\"2\" ".$wpgmza_map_type[2].">".__("Satellite","wp-google-maps")."</option>
                                <option value=\"3\" ".$wpgmza_map_type[3].">".__("Hybrid","wp-google-maps")."</option>
                                <option value=\"4\" ".$wpgmza_map_type[4].">".__("Terrain","wp-google-maps")."</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                             <td>".__("List all Markers","wp-google-maps").":</td>
                             <td>
                                <input id='wpgmza_listmarkers' name='wpgmza_listmarkers' type='checkbox' value='1' $listmarkers_checked /> ".__("List all markers below the map","wp-google-maps")."
                                <br /><input id='wpgmza_listmarkers_advanced' name='wpgmza_listmarkers_advanced' type='checkbox' value='1' $listmarkers_advanced_checked /> ".__("Select this for the advanced listing functionality","wp-google-maps")."

                            </td>
                        </tr>
                        <tr>
                             <td>".__("Filter by Category","wp-google-maps").":</td>
                             <td>
                                <input id='wpgmza_filterbycat' name='wpgmza_filterbycat' type='checkbox' value='1' $listfilters_checked /> ".__("Allow users to filter by category?","wp-google-maps")."

                            </td>
                        </tr>
                        <tr>
                             <td>".__("Order markers by","wp-google-maps").":</td>
                             <td>
                                <select id='wpgmza_order_markers_by' name='wpgmza_order_markers_by' class='postform'>
                                    <option value=\"1\" ".$wpgmza_map_order_markers_by[1].">".__("ID","wp-google-maps")."</option>
                                    <option value=\"2\" ".$wpgmza_map_order_markers_by[2].">".__("Title","wp-google-maps")."</option>
                                    <option value=\"3\" ".$wpgmza_map_order_markers_by[3].">".__("Address","wp-google-maps")."</option>
                                    <option value=\"4\" ".$wpgmza_map_order_markers_by[4].">".__("Description","wp-google-maps")."</option>
                                    <option value=\"5\" ".$wpgmza_map_order_markers_by[5].">".__("Category","wp-google-maps")."</option>
                                </select>
                                <select id='wpgmza_order_markers_choice' name='wpgmza_order_markers_choice' class='postform'>
                                    <option value=\"1\" ".$wpgmza_map_order_markers_choice[1].">".__("Ascending","wp-google-maps")."</option>
                                    <option value=\"2\" ".$wpgmza_map_order_markers_choice[2].">".__("Descending","wp-google-maps")."</option>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td>".__("Map Alignment","wp-google-maps").":</td>
                            <td><select id='wpgmza_map_align' name='wpgmza_map_align' class='postform'>
                                <option value=\"1\" ".$wpgmza_map_align[1].">".__("Left","wp-google-maps")."</option>
                                <option value=\"2\" ".$wpgmza_map_align[2].">".__("Center","wp-google-maps")."</option>
                                <option value=\"3\" ".$wpgmza_map_align[3].">".__("Right","wp-google-maps")."</option>
                                <option value=\"4\" ".$wpgmza_map_align[4].">".__("None","wp-google-maps")."</option>
                            </select>
                            </td>
                        </tr>

                        <tr>
                            <td>".__("Show User's Location?","wp-google-maps").":</td>
                            <td><select id='wpgmza_show_user_location' name='wpgmza_show_user_location' class='postform'>
                                <option value=\"1\" ".$wpgmza_show_user_location[1].">".__("Yes","wp-google-maps")."</option>
                                <option value=\"2\" ".$wpgmza_show_user_location[2].">".__("No","wp-google-maps")."</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td>".__("Enable Directions?","wp-google-maps").":</td>
                            <td><select id='wpgmza_directions' name='wpgmza_directions' class='postform'>
                                <option value=\"1\" ".$wpgmza_directions[1].">".__("Yes","wp-google-maps")."</option>
                                <option value=\"2\" ".$wpgmza_directions[2].">".__("No","wp-google-maps")."</option>
                            </select>
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            ".__("Directions Box Open by Default?","wp-google-maps").":
                            <select id='wpgmza_dbox' name='wpgmza_dbox' class='postform'>
                                <option value=\"1\" ".$wpgmza_dbox[1].">".__("No","wp-google-maps")."</option>
                                <option value=\"2\" ".$wpgmza_dbox[2].">".__("Yes, on the left","wp-google-maps")."</option>
                                <option value=\"3\" ".$wpgmza_dbox[3].">".__("Yes, on the right","wp-google-maps")."</option>
                                <option value=\"4\" ".$wpgmza_dbox[4].">".__("Yes, above","wp-google-maps")."</option>
                                <option value=\"5\" ".$wpgmza_dbox[5].">".__("Yes, below","wp-google-maps")."</option>
                            </select>
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            ".__("Directions Box Width","wp-google-maps").":
                            <input id='wpgmza_dbox_width' name='wpgmza_dbox_width' type='text' size='4' maxlength='4' class='small-text' value='".$res->dbox_width."' /> px
                            </td>
                        </tr>
                        <tr>
                            <td>".__("Enable Bicycle Layer?","wp-google-maps").":</td>
                            <td><select id='wpgmza_bicycle' name='wpgmza_bicycle' class='postform'>
                                <option value=\"1\" ".$wpgmza_bicycle[1].">".__("Yes","wp-google-maps")."</option>
                                <option value=\"2\" ".$wpgmza_bicycle[2].">".__("No","wp-google-maps")."</option>
                            </select>
                            &nbsp; &nbsp; &nbsp; &nbsp;

                            ".__("Enable Traffic Layer?","wp-google-maps").":
                            <select id='wpgmza_traffic' name='wpgmza_traffic' class='postform'>
                                <option value=\"1\" ".$wpgmza_traffic[1].">".__("Yes","wp-google-maps")."</option>
                                <option value=\"2\" ".$wpgmza_traffic[2].">".__("No","wp-google-maps")."</option>
                            </select></td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td>".__("KML/GeoRSS URL","wp-google-maps").":</td>
                            <td>
                             <input id='wpgmza_kml' name='wpgmza_kml' type='text' size='100' maxlength='700' class='regular-text' value='".$res->kml."' /> <em><small>".__("The KML/GeoRSS layer will over-ride most of your map settings","wp-google-maps")."</small></em></td>
                            </td>
                        </tr>
                        <tr>
                            <td>".__("Fusion table ID","wp-google-maps").":</td>
                            <td>
                             <input id='wpgmza_fusion' name='wpgmza_fusion' type='text' size='20' maxlength='200' class='small-text' value='".$res->fusion."' /> <em><small>".__("Read data directly from your Fusion Table. For more information, see <a href='http://googlemapsmania.blogspot.com/2010/05/fusion-tables-google-maps-api.html'>http://googlemapsmania.blogspot.com/2010/05/fusion-tables-google-maps-api.html</a>","wp-google-maps")."</small></em></td>
                            </td>
                        </tr>
                        </table>
                            <div id=\"wpgmaps_save_reminder\" style=\"display:none;\"><span style=\"font-size:16px; color:#1C62B9;\">
                            ".__("Remember to save your map!","wp-google-maps")."
                            </span></div>

            
    
                </div>
            </div> <!-- end of tab2 -->       






                <p class='submit'><input type='submit' name='wpgmza_savemap' class='button-primary' value='".__("Save Map","wp-google-maps")." &raquo;' /></p>
                <p style=\"width:600px; color:#808080;\">
                    ".__("Tip: Use your mouse to change the layout of your map. When you have positioned the map to your desired location, press \"Save Map\" to keep your settings.","wp-google-maps")."</p>

                <div id=\"wpgmza_map\">&nbsp;</div>
                <a name=\"wpgmaps_marker\" /></a>

                <div id=\"wpgmaps_tabs_markers\">
                <ul>
                        <li><a href=\"#tabs-m-1\" class=\"tabs-m-1\">".__("Markers","wp-google-maps")."</a></li>
                        <li><a href=\"#tabs-m-2\" class=\"tabs-m-2\">".__("Polygons","wp-google-maps")."</a></li>
                        <li><a href=\"#tabs-m-3\" class=\"tabs-m-3\">".__("Polylines","wp-google-maps")."</a></li>
                </ul>
                <div id=\"tabs-m-1\">


                    <h2 style=\"padding-top:0; margin-top:0;\">".__("Add a marker","wp-google-maps")."</h2>
                    <input type=\"hidden\" name=\"wpgmza_edit_id\" id=\"wpgmza_edit_id\" value=\"\" />
                    <p>
                    <table>
                    <tr>
                        <td>".__("Title","wp-google-maps").": </td>
                        <td><input id='wpgmza_add_title' name='wpgmza_add_title' type='text' size='35' maxlength='200' value='' /> &nbsp;<br /></td>

                    </tr>
                    <tr>
                        <td>".__("Address/GPS","wp-google-maps").": </td>
                        <td><input id='wpgmza_add_address' name='wpgmza_add_address' type='text' size='35' maxlength='200' value='' /> &nbsp;<br /></td>

                    </tr>

                    <tr><td valign='top'>".__("Description","wp-google-maps").": </td>
                    <td><textarea id='wpgmza_add_desc' name='wpgmza_add_desc' ".$wpgmza_act." rows='3' cols='37'></textarea>  &nbsp;<br /></td></tr>
                    <tr><td>".__("Pic URL","wp-google-maps").": </td>
                    <td><input id='wpgmza_add_pic' name=\"wpgmza_add_pic\" type='text' size='35' maxlength='700' value='' ".$wpgmza_act."/> <input id=\"upload_image_button\" type=\"button\" value=\"".__("Upload Image","wp-google-maps")."\" $wpgmza_act /> &nbsp; <small><i>(".__("Or paste image URL","wp-google-maps").")</i></small><br /></td></tr>
                    <tr><td>".__("Link URL","wp-google-maps").": </td>
                        <td><input id='wpgmza_link_url' name='wpgmza_link_url' type='text' size='35' maxlength='700' value='' ".$wpgmza_act." /><small><i> ".__("Format: http://www.domain.com","wp-google-maps")."</i></small><br /></td></tr>
                    <tr><td>".__("Custom Marker","wp-google-maps").": </td>
                    <td><span id=\"wpgmza_cmm\"></span><input id='wpgmza_add_custom_marker' name=\"wpgmza_add_custom_marker\" type='hidden' size='35' maxlength='700' value='' ".$wpgmza_act."/> <input id=\"upload_custom_marker_button\" type=\"button\" value=\"".__("Upload Image","wp-google-maps")."\" $wpgmza_act /> &nbsp; <small><i>(".__("ignore if you want to use the default marker","wp-google-maps").")</i></small><br /></td></tr>
                    <tr>
                        <td>".__("Category","wp-google-maps").": </td>
                        <td>
                            <select name=\"wpgmza_category\" id=\"wpgmza_category\">
                                ".wpgmza_pro_return_category_select_list()."
                        </td>
                    </tr>
                    <tr>
                        <td>".__("Animation","wp-google-maps").": </td>
                        <td>
                            <select name=\"wpgmza_animation\" id=\"wpgmza_animation\">
                                <option value=\"0\">".__("None","wp-google-maps")."</option>
                                <option value=\"1\">".__("Bounce","wp-google-maps")."</option>
                                <option value=\"2\">".__("Drop","wp-google-maps")."</option>
                        </td>
                    </tr>
                    <tr>
                        <td>".__("InfoWindow open by default","wp-google-maps").": </td>
                        <td>
                            <select name=\"wpgmza_infoopen\" id=\"wpgmza_infoopen\">
                                <option value=\"0\">".__("No","wp-google-maps")."</option>
                                <option value=\"1\">".__("Yes","wp-google-maps")."</option>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <span id=\"wpgmza_addmarker_div\"><input type=\"button\" id='wpgmza_addmarker' class='button-primary' value='".__("Add Marker","wp-google-maps")."' /></span> <span id=\"wpgmza_addmarker_loading\" style=\"display:none;\">".__("Adding","wp-google-maps")."...</span>
                            <span id=\"wpgmza_editmarker_div\" style=\"display:none;\"><input type=\"button\" id='wpgmza_editmarker' class='button-primary' value='".__("Save Marker","wp-google-maps")."' /></span><span id=\"wpgmza_editmarker_loading\" style=\"display:none;\">".__("Saving","wp-google-maps")."...</span>
                        </td>
                    </tr>
                    </table>
                    <h2 style=\"padding-top:0; margin-top:0;\">".__("Your Markers","wp-google-maps")."</h2>
                    <div id=\"wpgmza_marker_holder\">
                        ".wpgmza_return_marker_list($_GET['map_id'])."
                    </div>
                </div>
                <div id=\"tabs-m-2\">
                        <h2 style=\"padding-top:0; margin-top:0;\">".__("Add a Polygon","wp-google-maps")."</h2>
                        <span id=\"wpgmza_addpolygon_div\"><a href='".get_option('siteurl')."/wp-admin/admin.php?page=wp-google-maps-menu&action=add_poly&map_id=".$_GET['map_id']."' id='wpgmza_addpoly' class='button-primary' value='".__("Add a New Polygon","wp-google-maps")."' />".__("Add a New Polygon","wp-google-maps")."</a></span>
                        <div id=\"wpgmza_poly_holder\">".wpgmza_return_polygon_list($_GET['map_id'])."</div>
                </div>
                <div id=\"tabs-m-3\">
                        <h2 style=\"padding-top:0; margin-top:0;\">".__("Add a Polyline","wp-google-maps")."</h2>
                        <span id=\"wpgmza_addpolyline_div\"><a href='".get_option('siteurl')."/wp-admin/admin.php?page=wp-google-maps-menu&action=add_polyline&map_id=".$_GET['map_id']."' id='wpgmza_addpolyline' class='button-primary' value='".__("Add a New Polyline","wp-google-maps")."' />".__("Add a New Polyline","wp-google-maps")."</a></span>
                        <div id=\"wpgmza_polyline_holder\">".wpgmza_return_polyline_list($_GET['map_id'])."</div>
                </div>
            </div>
                <p>$wpgmza_act_msg</p>
            </form>

            

            ".wpgmza_return_pro_add_ons()." 
            <p><br /><br />".__("WP Google Maps encourages you to make use of the amazing icons created by Nicolas Mollet's Maps Icons Collection","wp-google-maps")." <a href='http://mapicons.nicolasmollet.com'>http://mapicons.nicolasmollet.com/</a> ".__("and to credit him when doing so.","wp-google-maps")."</p>


            </div>
        </div>
    ";

}
function wpgmaps_action_callback_pro() {
        global $wpdb;
        global $wpgmza_tblname;
        global $wpgmza_tblname_poly;
        $check = check_ajax_referer( 'wpgmza', 'security' );
        $table_name = $wpdb->prefix . "wpgmza";
        
        if ($check == 1) {

            if ($_POST['action'] == "add_marker") {
                  $ins_array = array( 'map_id' => $_POST['map_id'], 'title' => $_POST['title'], 'address' => $_POST['address'], 'description' => $_POST['desc'], 'pic' => $_POST['pic'], 'icon' => $_POST['icon'], 'link' => $_POST['link'], 'lat' => $_POST['lat'], 'lng' => $_POST['lng'], 'anim' => $_POST['anim'], 'category' => $_POST['category'], 'infoopen' => $_POST['infoopen'] );

                  $rows_affected = $wpdb->insert( $table_name, $ins_array );
                   wpgmaps_update_xml_file($_POST['map_id']);
                   echo wpgmza_return_marker_list($_POST['map_id']);
            }
            

            if ($_POST['action'] == "edit_marker") {
                  $desc = $_POST['desc'];
                  $link = $_POST['link'];
                  $pic = $_POST['pic'];
                  $icon = $_POST['icon'];
                  $anim = $_POST['anim'];
                  $category = $_POST['category'];
                  $infoopen = $_POST['infoopen'];
                  $cur_id = intval($_POST['edit_id']);
                  $rows_affected = $wpdb->query("UPDATE $table_name SET `title` = '".$_POST['title']."', `address` = '".$_POST['address']."', `description` = '$desc', `link` = '$link', `icon` = '$icon', `pic` = '$pic', `lat` = '".$_POST['lat']."', `lng` = '".$_POST['lng']."', `anim` = '$anim', `category` = '$category', `infoopen` = '$infoopen' WHERE `id`  = '$cur_id'");
                  wpgmaps_update_xml_file($_POST['map_id']);
                  echo wpgmza_return_marker_list($_POST['map_id']);
           }

            if ($_POST['action'] == "delete_marker") {
                $marker_id = $_POST['marker_id'];
                $wpdb->query(
                        "
                        DELETE FROM $wpgmza_tblname
                        WHERE `id` = '$marker_id'
                        LIMIT 1
                        "
                );
                wpgmaps_update_xml_file($_POST['map_id']);
                echo wpgmza_return_marker_list($_POST['map_id']);

            }
            if ($_POST['action'] == "delete_poly") {
                $poly_id = $_POST['poly_id'];
                
                $wpdb->query(
                        "
                        DELETE FROM $wpgmza_tblname_poly
                        WHERE `id` = '$poly_id'
                        LIMIT 1
                        "
                );
                
                echo wpgmza_return_polygon_list($_POST['map_id']);

            }
        }

        die(); // this is required to return a proper result

}
function wpgmza_return_pro_add_ons() {
    if (function_exists(wpgmza_register_gold_version)) { $wpgmza_ret .= wpgmza_gold_addon_display(); } else { $wpgmza_ret  .= ""; }
    if (function_exists(wpgmza_register_ugm_version)) { $wpgmza_ret .= wpgmza_ugm_addon_display_mapspage(); } else { $wpgmza_ret  .= ""; }
    return $wpgmza_ret;
}


function wpgmaps_tag_pro( $atts ) {
    global $wpgmza_current_map_id;
    global $wpgmza_current_mashup;
    global $wpgmza_mashup_ids;
    global $wpgmza_mashup_all;
    $wpgmza_current_mashup = false;
    extract( shortcode_atts( array(
        'id' => '1',
        'mashup' => false,
        'mashup_ids' => false,
        'parent_id' => '1'
    ), $atts ) );


    $wpgmza_mashup = $atts['mashup'];

    if ($wpgmza_mashup_ids == "ALL") {

    } else {
        $wpgmza_mashup_ids = explode(",",$atts['mashup_ids']);
    }

    $wpgmza_mashup_parent_id = $atts['parent_id'];

    if ($wpgmza_mashup) { $wpgmza_current_mashup = true; }

    if ($wpgmza_mashup) {
        $wpgmza_current_map_id = $wpgmza_mashup_parent_id;
        $res = wpgmza_get_map_data($wpgmza_mashup_parent_id);
    } else {
        $wpgmza_current_map_id = $atts['id'];
        $res = wpgmza_get_map_data($atts['id']);
    }



    $wpgmza_general_settings = get_option('WPGMZA_OTHER_SETTINGS');
    $hide_category_column = $wpgmza_general_settings['wpgmza_settings_markerlist_category'];
    
    
    $map_width_type = stripslashes($res->map_width_type);
    $map_height_type = stripslashes($res->map_height_type);
    if (!isset($map_width_type)) { $map_width_type == "px"; }
    if (!isset($map_height_type)) { $map_height_type == "px"; }
    if ($map_width_type == "%" && intval($res->map_width) > 100) { $res->map_width = 100; }
    if ($map_height_type == "%" && intval($res->map_height) > 100) { $res->map_height = 100; }
    $map_align = $res->alignment;
    if (!$map_align || $map_align == "" || $map_align == "1") { $map_align = "float:left;"; }
    else if ($map_align == "2") { $map_align = "margin-left:auto !important; margin-right:auto; !important; align:center;"; }
    else if ($map_align == "3") { $map_align = "float:right;"; }
    else if ($map_align == "4") { $map_align = "clear:both;"; }
    $map_style = "style=\"display:block; overflow:auto; width:".$res->map_width."".$map_width_type."; height:".$res->map_height."".$map_height_type."; $map_align\"";
    global $short_code_active;
    $short_code_active = true;
    global $wpgmza_short_code_array;
    $wpgmza_short_code_array[] = $wpgmza_current_map_id;
    $d_enabled = $res->directions_enabled;
    $filterbycat = $res->filterbycat;
    $map_width = $res->map_width;
    $map_width_type = $res->map_width_type;
    // for marker list
    $default_marker = $res->default_marker;
    $show_location = $res->show_user_location;
    if ($show_location == "1") {
        $use_location_from = "<span style=\"font-size:0.75em;\"><a href='javascript:void(0);' id='wpgmza_use_my_location_from' mid='$wpgmza_current_map_id' title='".__("Use my location","wp-google-maps")."'>".__("Use my location","wp-google-maps")."</a></span>";
        $use_location_to = "<span style=\"font-size:0.75em;\"><a href='javascript:void(0);' id='wpgmza_use_my_location_to' mid='$wpgmza_current_map_id' title='".__("Use my location","wp-google-maps")."'>".__("Use my location","wp-google-maps")."</a></span>";
    }
    if ($default_marker) { $default_marker = "<img src='".$default_marker."' />"; } else { $default_marker = "<img src='".wpgmaps_get_plugin_url()."/images/marker.png' />"; }
    $dbox_width = $res->dbox_width;
    $dbox_option = $res->dbox;
    if ($dbox_option == "1") { $dbox_style = "display:none;"; }
    else if ($dbox_option == "2") { $dbox_style = "float:left; width:".$dbox_width."px; padding-right:10px; display:block; overflow:auto;"; }
    else if ($dbox_option == "3") { $dbox_style = "float:right; width:".$dbox_width."px; padding-right:10px; display:block; overflow:auto;"; }
    else if ($dbox_option == "4") { $dbox_style = "float:none; width:".$dbox_width."px; padding-bottom:10px; display:block; overflow:auto; clear:both;"; }
    else if ($dbox_option == "5") { $dbox_style = "float:none; width:".$dbox_width."px; padding-top:10px; display:block; overflow:auto; clear:both;"; }
    else { $dbox_style = "display:none;"; }
    $wpgmza_marker_list_output = "";
    $wpgmza_marker_filter_output = "";
    // Filter by category
    if ($filterbycat == 1) {
        $wpgmza_marker_filter_output .= "<p style='text-align:left; margin-bottom:0px;'>".__("Filter by","wp-google-maps")."";
        $wpgmza_filter_dropdown = wpgmza_pro_return_category_select_list();
        $wpgmza_marker_filter_output .= "<select mid=\"".$wpgmza_current_map_id."\" name=\"wpgmza_filter_select\" id=\"wpgmza_filter_select\">";
        $wpgmza_marker_filter_output .= $wpgmza_filter_dropdown;
        $wpgmza_marker_filter_output .= "</select></p>";
    } 
    if ($hide_category_column) {
        $wpgmza_marker_filter_output .= "<style>.wpgmza_table_category { display: none; }</style>";
    }
    // GET LIST OF MARKERS

    if ($res->listmarkers == 1 && $res->listmarkers_advanced == 1) {
        if ($wpgmza_current_mashup) {
            $wpgmza_marker_list_output .= wpgmza_return_marker_list($wpgmza_mashup_parent_id,false,$map_width.$map_width_type,$wpgmza_current_mashup,$wpgmza_mashup_ids);
        } else {
            $wpgmza_marker_list_output .= wpgmza_return_marker_list($wpgmza_current_map_id,false,$map_width.$map_width_type,false);
        }
    }
    else if ($res->listmarkers == 1 && $res->listmarkers_advanced == 0) {

        global $wpdb;
        global $wpgmza_tblname;

        // marker sorting functionality
        if ($res->order_markers_by == 1) { $order_by = "id"; }
        else if ($res->order_markers_by == 2) { $order_by = "title"; }
        else if ($res->order_markers_by == 3) { $order_by = "address"; }
        else if ($res->order_markers_by == 4) { $order_by = "description"; }
        else if ($res->order_markers_by == 5) { $order_by = "category"; }
        else { $order_by = "id"; }
        if ($res->order_markers_choice == 1) { $order_choice = "ASC"; }
        else { $order_choice = "DESC"; }

        if ($wpgmza_current_mashup) {

            $wpgmza_cnt = 0;
            $sql_string1 = "";
            if ($wpgmza_mashup_ids[0] == "ALL") {
                $wpgmza_sql1 ="SELECT * FROM $wpgmza_tblname ORDER BY `$order_by` $order_choice";
            } else {
                $wpgmza_id_cnt = count($wpgmza_mashup_ids);
                foreach ($wpgmza_mashup_ids as $wpgmza_map_id) {
                    $wpgmza_cnt++;
                    if ($wpgmza_cnt == 1) { $sql_string1 .= "`map_id` = '$wpgmza_map_id' "; }
                    elseif ($wpgmza_cnt > 1 && $wpgmza_cnt < $wpgmza_id_cnt) { $sql_string1 .= "OR `map_id` = '$wpgmza_map_id' "; }
                    else { $sql_string1 .= "OR `map_id` = '$wpgmza_map_id' "; }

                }
                $wpgmza_sql1 ="SELECT * FROM $wpgmza_tblname WHERE $sql_string1 ORDER BY `$order_by` $order_choice";
            }
        } else {
            $wpgmza_sql1 ="SELECT * FROM $wpgmza_tblname WHERE `map_id` = '$wpgmza_current_map_id' ORDER BY `$order_by` $order_choice";
        }

        $results = $wpdb->get_results($wpgmza_sql1);


        $wpgmza_marker_list_output .= "
                <table id=\"wpgmza_marker_list\" class=\"wpgmza_marker_list_class\" cellspacing=\"0\" cellpadding=\"0\" style='width:".$map_width."".$map_width_type."'>
                <tbody>
        ";


        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
        $wpgmza_image_height = $wpgmza_settings['wpgmza_settings_image_height'];
        $wpgmza_image_width = $wpgmza_settings['wpgmza_settings_image_width'];
        if (!$wpgmza_image_height || !isset($wpgmza_image_height)) { $wpgmza_image_height = "100"; }
        if (!$wpgmza_image_width || !isset($wpgmza_image_width)) { $wpgmza_image_width = "100"; }
        foreach ( $results as $result ) {
            $wmcnt++;
            $img = $result->pic;
            $wpgmaps_id = $result->id;
            $link = $result->link;
            $icon = $result->icon;
            $wpgmaps_lat = $result->lat;
            $wpgmaps_lng = $result->lng;
            $wpgmaps_address = $result->address;

            if (!$img) { $pic = ""; } else {
                $wpgmza_use_timthumb = $wpgmza_settings['wpgmza_settings_use_timthumb'];
                if ($wpgmza_use_timthumb == "" || !isset($wpgmza_use_timthumb)) {
                    $pic = "<img src='".wpgmaps_get_plugin_url()."/timthumb.php?src=".$result->pic."&h=".$wpgmza_image_height."&w=".$wpgmza_image_width."&zc=1' title='' alt='' style=\"\" />";
                } else  {
                    $pic = "<img src='".$result->pic."' class='wpgmza_map_image' style=\"float:right; margin:5px; height:".$wpgmza_image_height."px; width:".$wpgmza_image_width.".px\" />";
                }
            }
            if (!$icon) { $icon = $default_marker; } else { $icon = "<img src='".$result->icon."' />"; }
            if ($d_enabled == "1") {
                $wpgmaps_dir_text = "<br /><a href=\"javascript:void(0);\" id=\"$wpgmza_current_map_id\" title=\""._("Get directions to","wp-google-maps")." ".$result->title."\" class=\"wpgmza_gd\" wpgm_addr_field=\"".$wpgmaps_address."\" gps=\"$wpgmaps_lat,$wpgmaps_lng\">".__("Directions","wp-google-maps")."</a>";
            }
            if ($result->description) {
                $wpgmaps_desc_text = "<br />".$result->description."";
            } else {
                $wpgmaps_desc_text = "";
            }
            if ($wmcnt%2) { $oddeven = "wpgmaps_odd"; } else { $oddeven = "wpgmaps_even"; }

            
            
            $wpgmza_marker_list_output .= "
                <tr id=\"wpgmza_marker_".$result->id."\" mid=\"".$result->id."\" mapid=\"".$result->map_id."\" class=\"wpgmaps_mlist_row $oddeven\">
                    <td height=\"40\" class=\"wpgmaps_mlist_marker\">".$icon."</td>
                    <td class=\"wpgmaps_mlist_pic\" style=\"width:".($wpgmza_image_width+20)."px;\">$pic</td>
                    <td  valign=\"top\" align=\"left\" class=\"wpgmaps_mlist_info\">
                        <strong><a href=\"javascript:openInfoWindow($wpgmaps_id);\" id=\"wpgmaps_marker_$wpgmaps_id\" title=\"".$result->title."\">".$result->title."</a></strong>
                        $wpgmaps_desc_text
                        $wpgmaps_dir_text
                    </td>

                </tr>";
        }
        $wpgmza_marker_list_output .= "</tbody></table>";

    } else { $wpgmza_marker_list_output = ""; }


    $dbox_div = "
        <div id=\"wpgmaps_directions_edit_".$wpgmza_current_map_id."\" style=\"$dbox_style\" class=\"wpgmaps_directions_outer_div\">
            <h2>".__("Get Directions","wp-google-maps")."</h2>
            <div id=\"wpgmaps_directions_editbox_".$wpgmza_current_map_id."\">
                <table>
                    <tr>
                        <td>".__("For","wp-google-maps").":</td><td>
                            <select id=\"wpgmza_dir_type_".$wpgmza_current_map_id."\" name=\"wpgmza_dir_type_".$wpgmza_current_map_id."\">
                            <option value=\"DRIVING\" selected=\"selected\">".__("Driving","wp-google-maps")."</option>
                            <option value=\"WALKING\">".__("Walking","wp-google-maps")."</option>
                            <option value=\"BICYCLING\">".__("Bicycling","wp-google-maps")."</option>
                            </select>
                            &nbsp;
                            <a href=\"javascript:void(0);\" mapid=\"".$wpgmza_current_map_id."\" id=\"wpgmza_show_options_".$wpgmza_current_map_id."\" onclick=\"wpgmza_show_options(".$wpgmza_current_map_id.");\" style=\"font-size:10px;\">".__("show options","wp-google-maps")."</a>
                            <a href=\"javascript:void(0);\" mapid=\"".$wpgmza_current_map_id."\" id=\"wpgmza_hide_options_".$wpgmza_current_map_id."\" onclick=\"wpgmza_hide_options(".$wpgmza_current_map_id.");\" style=\"font-size:10px; display:none;\">".__("hide options","wp-google-maps")."</a>
                        <div style=\"display:none\" id=\"wpgmza_options_box_".$wpgmza_current_map_id."\">
                            <input type=\"checkbox\" id=\"wpgmza_tolls_".$wpgmza_current_map_id."\" name=\"wpgmza_tolls_".$wpgmza_current_map_id."\" value=\"tolls\" /> ".__("Avoid Tolls","wp-google-maps")." <br />
                            <input type=\"checkbox\" id=\"wpgmza_highways_".$wpgmza_current_map_id."\" name=\"wpgmza_highways_".$wpgmza_current_map_id."\" value=\"highways\" /> ".__("Avoid Highways","wp-google-maps")."
                        </div>

                        </td>
                    </tr>
                    <tr><td>".__("From","wp-google-maps").":</td><td width='90%'><input type=\"text\" value=\"\" id=\"wpgmza_input_from_".$wpgmza_current_map_id."\" style='width:80%' /> $use_location_from</td><td></td></tr>
                    <tr><td>".__("To","wp-google-maps").":</td><td width='90%'><input type=\"text\" value=\"\" id=\"wpgmza_input_to_".$wpgmza_current_map_id."\" style='width:80%' /> $use_location_to</td><td></td></tr>
                    <tr>

                      <td>
                        </td><td>
                      <input onclick=\"javascript:void(0);\" class=\"wpgmaps_get_directions\" id=\"".$wpgmza_current_map_id."\" type=\"button\" value=\"".__("Go","wp-google-maps")."\"/>
                      </td>
                    </tr>
                </table>
            </div>


    ";


    if ($dbox_option == "5" || $dbox_option == "1" || !isset($dbox_option)) {

        if ($wpgmza_current_mashup) {
            $wpgmza_anchors = $wpgmza_mashup_ids;
        } else {
            $wpgmza_anchors = $wpgmza_current_map_id;
        }

        $ret_msg = "
            <style>
            .wpgmza_map img { max-width:none !important; }
            </style>
            ".wpgmaps_return_marker_anchors($wpgmza_anchors)."
            $wpgmza_marker_filter_output
            <div id=\"wpgmza_map_".$wpgmza_current_map_id."\" class='wpgmza_map' $map_style>&nbsp;</div>
            $wpgmza_marker_list_output
            <div id=\"display:block; width:100%;\">

                $dbox_div
                    <div id=\"wpgmaps_directions_notification_".$wpgmza_current_map_id."\" style=\"display:none;\">".__("Fetching directions...","wp-google-maps")."...</div>
                    <div id=\"wpgmaps_directions_reset_".$wpgmza_current_map_id."\" style=\"display:none;\"><a href='javascript:void(0)' onclick='wpgmza_reset_directions(".$wpgmza_current_map_id.");' id='wpgmaps_reset_directions' title='".__("Reset directions","wp-google-maps")."'>".__("Reset directions","wp-google-maps")."</a></div>
                    <div id=\"directions_panel_".$wpgmza_current_map_id."\"></div>
                </div>
            </div>

        ";
    } else {
        $ret_msg = "
            <style>
            .wpgmza_map img { max-width:none !important; }
            </style>

            <div id=\"display:block; width:100%; overflow:auto;\">

                $dbox_div
                    <div id=\"wpgmaps_directions_notification_".$wpgmza_current_map_id."\" style=\"display:none;\">".__("Fetching directions...","wp-google-maps")."...</div>
                    <div id=\"wpgmaps_directions_reset_".$wpgmza_current_map_id."\" style=\"display:none;\"><a href='javascript:void(0)' onclick='wpgmza_reset_directions(".$wpgmza_current_map_id.");' id='wpgmaps_reset_directions' title='".__("Reset directions","wp-google-maps")."'>".__("Reset directions","wp-google-maps")."</a></div>
                    <div id=\"directions_panel_".$wpgmza_current_map_id."\"></div>
                </div>
                $wpgmza_marker_filter_output
            <div id=\"wpgmza_map_".$wpgmza_current_map_id."\" class='wpgmza_map' $map_style>&nbsp;</div>
            $wpgmza_marker_list_output
            </div>

        ";

    }

    if (function_exists("wpgmza_register_ugm_version")) {
        $ugm_enabled = $res->ugm_enabled;
        if ($ugm_enabled == 1) {
            $ret_msg .= wpgmaps_ugm_user_form($wpgmza_current_map_id);
        }
    }


    return $ret_msg;
}

function wpgmaps_return_marker_anchors($mid) {
    global $wpdb;
    global $wpgmza_tblname;



    if (is_array($mid)) {
        $wpgmza_cnt = 0;
        $sql_string1 = "";

        if ($mid[0] == "ALL") {
            $results = $wpdb->get_results("
                SELECT *
                FROM $wpgmza_tblname
                ORDER BY `id` DESC
            ");
        } else {

            $wpgmza_id_cnt = count($mid);
            foreach ($mid as $wpgmza_map_id) {
                $wpgmza_cnt++;
                if ($wpgmza_cnt == 1) { $sql_string1 .= "`map_id` = '$wpgmza_map_id' "; }
                elseif ($wpgmza_cnt > 1 && $wpgmza_cnt < $wpgmza_id_cnt) { $sql_string1 .= "OR `map_id` = '$wpgmza_map_id' "; }
                else { $sql_string1 .= "OR `map_id` = '$wpgmza_map_id' "; }

            }
            $results = $wpdb->get_results("
                SELECT *
                FROM $wpgmza_tblname
                WHERE $sql_string1 ORDER BY `id` DESC
            ");
        }
    } else {
        $results = $wpdb->get_results("
            SELECT *
            FROM $wpgmza_tblname
            WHERE `map_id` = '$mid' ORDER BY `id` DESC
        ");
    }







    


    foreach ( $results as $result ) {
        $marker_id = $result->id;
        $wpmlist .= "<a name='marker".$marker_id."' ></a>";
    }
    return $wpmlist;
    
    
}
function wpgmza_return_all_map_ids() {
    global $wpdb;
    global $wpgmza_tblname_maps;
    $sql = "SELECT `id` FROM `".$wpgmza_tblname_maps."`";
    $results = $wpdb->get_results($sql);
    $tarr = array();
    foreach ($results as $result) {
        array_push($tarr,$result->id);
    }
    return $tarr;

}

function wpgmaps_user_javascript_pro() {


    global $short_code_active;
    global $wpgmza_count;
    $wpgmza_count++;
    if ($wpgmza_count >1) {  } else {
    global $wpgmza_current_map_id;
    global $wpgmza_short_code_array;
    global $wpgmza_current_mashup;
    global $wpgmza_mashup_ids;
    if ($short_code_active) {
        $ajax_nonce = wp_create_nonce("wpgmza");

        ?>


        <script type="text/javascript">
            if (typeof google === 'object' && typeof google.maps === 'object') { } else {
                var gmapsJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
                document.write(unescape("%3Cscript src='" + gmapsJsHost + "maps.google.com/maps/api/js?sensor=false' type='text/javascript'%3E%3C/script%3E"));
            }
        </script>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo wpgmaps_get_plugin_url(); ?>/css/data_table_front.css" />
        <script type="text/javascript" src="<?php echo wpgmaps_get_plugin_url(); ?>/js/jquery.dataTables.js"></script>
        <script type="text/javascript" >

        if ('undefined' == typeof window.jQuery) {
            <?php
                    foreach ($wpgmza_short_code_array as $wpgmza_cmd) {
                      $res = wpgmza_get_map_data($wpgmza_cmd);
            ?>
            document.getElementById('wpgmza_map_<?php echo $wpgmza_cmd; ?>').innerHTML = 'Error: In order for WP Google Maps to work, jQuery must be installed. A check was done and jQuery was not present. Please see the <a href="http://www.wpgmaps.com/documentation/troubleshooting/jquery-troubleshooting/" title="WP Google Maps - jQuery Troubleshooting">jQuery troubleshooting section of our site</a> for more information.';
            <?php } ?>
        } else {
            // all good.. continue...
        } 

        var user_location;

        jQuery(function() {
            
            

            jQuery(document).ready(function(){


                if (/1\.(0|1|2|3|4|5|6|7)\.(0|1|2|3|4|5|6|7|8|9)/.test(jQuery.fn.jquery)) {
                    <?php
                    foreach ($wpgmza_short_code_array as $wpgmza_cmd) {
                    ?>
                    document.getElementById('wpgmza_map_<?php echo $wpgmza_cmd; ?>').innerHTML = 'Error: Your version of jQuery is outdated. WP Google Maps requires jQuery version 1.7+ to function correctly. Go to Maps->Settings and check the box that allows you to over-ride your current jQuery to try eliminate this problem.';
                    <?php } ?>
                } else {
                
                
                    <?php
                        if (function_exists(wpgmaps_ugm_user_javascript)) {
                            wpgmaps_ugm_user_javascript();
                        } 
                    ?>


                    jQuery("body").on("click", ".wpgmaps_mlist_row", function() {
                        var wpgmza_markerid = jQuery(this).attr("mid");
                        var wpgmza_mapid = jQuery(this).attr("mapid");
                        openInfoWindow(wpgmza_markerid);
                        location.hash = "#marker" + wpgmza_markerid;
                    });
                    jQuery("body").on("change", "#wpgmza_filter_select", function() {
                        var selectedValue = jQuery(this).find(":selected").val();
                        var wpgmza_map_id = jQuery(this).attr("mid");
                        eval("InitMap_"+wpgmza_map_id+"("+selectedValue+")");
                        if (typeof eval("wpgmzaTable_"+wpgmza_map_id) == "object") { eval("wpgmzaTable_"+wpgmza_map_id).fnFilter( this.options[this.selectedIndex].text ); }



                    });
                    jQuery("body").on("click", "#wpgmza_use_my_location_from", function() {
                        var wpgmza_map_id = jQuery(this).attr("mid");
                        jQuery('#wpgmza_input_from_'+wpgmza_map_id).val('<?php _e("Getting your current location address...","wp-google-maps"); ?>');
                        
                        var geocoder = new google.maps.Geocoder();
                        geocoder.geocode({'latLng': user_location}, function(results, status) {
                          if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                              jQuery('#wpgmza_input_from_'+wpgmza_map_id).val(results[0].formatted_address);
                            }
                          }
                        });
                    });                    
                    jQuery("body").on("click", "#wpgmza_use_my_location_to", function() {
                        var wpgmza_map_id = jQuery(this).attr("mid");
                        jQuery('#wpgmza_input_to_'+wpgmza_map_id).val('<?php _e("Getting your current location address...","wp-google-maps"); ?>');
                        var geocoder = new google.maps.Geocoder();
                        geocoder.geocode({'latLng': user_location}, function(results, status) {
                          if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                              jQuery('#wpgmza_input_to_'+wpgmza_map_id).val(results[0].formatted_address);
                            }
                          }
                        });
                    });

                    jQuery('body').on('tabsshow', function(event, ui) {
                    <?php
                        foreach ($wpgmza_short_code_array as $wpgmza_cmd) {
                    ?>
                        InitMap_<?php echo $wpgmza_cmd; ?>('all');
                    <?php } ?>
                    });
             

            
            
            
            <?php
                    foreach ($wpgmza_short_code_array as $wpgmza_cmd) {
                        $res = wpgmza_get_map_data($wpgmza_cmd);

                        // marker sorting functionality
                        if ($res->order_markers_by == 1) { $order_by = 0; }
                        else if ($res->order_markers_by == 2) { $order_by = 1; }
                        else if ($res->order_markers_by == 3) { $order_by = 3; }
                        else if ($res->order_markers_by == 4) { $order_by = 4; }
                        else if ($res->order_markers_by == 5) { $order_by = 2; }
                        else { $order_by = 0; }
                        if ($res->order_markers_choice == 1) { $order_choice = "asc"; }
                        else { $order_choice = "desc"; }
            ?>
            function wpgmza_reinitialisetbl_<?php echo $wpgmza_cmd; ?>() {
                wpgmzaTable_<?php echo $wpgmza_cmd; ?>.fnClearTable( 0 );
                wpgmzaTable_<?php echo $wpgmza_cmd; ?> = jQuery('#wpgmza_table_<?php echo $wpgmza_cmd; ?>').dataTable({
                    "bProcessing": true,
                    "aaSorting": [[ <?php echo "$order_by";?>, "<?php echo $order_choice; ?>" ]]
                });
            }
            if (jQuery('#wpgmza_table_<?php echo $wpgmza_cmd; ?>').length > 0) {
                 wpgmzaTable_<?php echo $wpgmza_cmd; ?> = jQuery('#wpgmza_table_<?php echo $wpgmza_cmd; ?>').dataTable({
                    "bProcessing": true,
                    "aaSorting": [[ <?php echo "$order_by";?>, "<?php echo $order_choice; ?>" ]]
                 });
            }
            <?php
                        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");

                        $wpgmza_lat[$wpgmza_cmd] = $res->map_start_lat;
                        $wpgmza_lng[$wpgmza_cmd] = $res->map_start_lng;
                        $wpgmza_width[$wpgmza_cmd] = $res->map_width;
                        $wpgmza_height[$wpgmza_cmd] = $res->map_height;
                        $wpgmza_width_type[$wpgmza_cmd] = stripslashes($res->map_width_type);
                        $wpgmza_height_type[$wpgmza_cmd] = $res->map_height_type;
                        $wpgmza_map_type[$wpgmza_cmd] = $res->type;
                        $wpgmza_default_icon[$wpgmza_cmd] = $res->default_marker;
                        $wpgmza_directions[$wpgmza_cmd] = $res->directions_enabled;
                        $kml[$wpgmza_cmd] = $res->kml;
                        $fusion[$wpgmza_cmd] = $res->fusion;
                        $wpgmza_bicycle[$wpgmza_cmd] = $res->bicycle;
                        $wpgmza_traffic[$wpgmza_cmd] = $res->traffic;
                        $wpgmza_dbox[$wpgmza_cmd] = $res->dbox;
                        $wpgmza_dbox_width[$wpgmza_cmd] = $res->dbox_width;
                        $show_location[$wpgmza_cmd] = $res->show_user_location;

                        $wpgmza_listmarkers[$wpgmza_cmd] = $res->listmarkers;
                        $wpgmza_listmarkers_advanced[$wpgmza_cmd] = $res->listmarkers_advanced;
                        $wpgmza_filtercategory[$wpgmza_cmd] = $res->filterbycat;

                        if ($wpgmza_default_icon[$wpgmza_cmd] == "0") { $wpgmza_default_icon[$wpgmza_cmd] = ""; }
                        if (!$wpgmza_map_type[$wpgmza_cmd] || $wpgmza_map_type[$wpgmza_cmd] == "" || $wpgmza_map_type[$wpgmza_cmd] == "1") { $wpgmza_map_type[$wpgmza_cmd] = "ROADMAP"; }
                        else if ($wpgmza_map_type[$wpgmza_cmd] == "2") { $wpgmza_map_type[$wpgmza_cmd] = "SATELLITE"; }
                        else if ($wpgmza_map_type[$wpgmza_cmd] == "3") { $wpgmza_map_type[$wpgmza_cmd] = "HYBRID"; }
                        else if ($wpgmza_map_type[$wpgmza_cmd] == "4") { $wpgmza_map_type[$wpgmza_cmd] = "TERRAIN"; }
                        else { $wpgmza_map_type[$wpgmza_cmd] = "ROADMAP"; }
                        $start_zoom[$wpgmza_cmd] = $res->map_start_zoom;
                        if ($start_zoom[$wpgmza_cmd] < 1 || !$start_zoom[$wpgmza_cmd]) { $start_zoom[$wpgmza_cmd] = 5; }
                        if (!$wpgmza_lat[$wpgmza_cmd] || !$wpgmza_lng[$wpgmza_cmd]) { $wpgmza_lat[$wpgmza_cmd] = "51.5081290"; $wpgmza_lng[$wpgmza_cmd] = "-0.1280050"; }



            ?>
            jQuery("<?php echo "#wpgmza_map_".$wpgmza_cmd; ?>").css({
                height:'<?php echo $wpgmza_height[$wpgmza_cmd]; ?><?php echo $wpgmza_height_type[$wpgmza_cmd]; ?>',
                width:'<?php echo $wpgmza_width[$wpgmza_cmd]; ?><?php echo $wpgmza_width_type[$wpgmza_cmd]; ?>'

            });
            function InitMap_<?php echo $wpgmza_cmd; ?>(cat_id) {
                if ('undefined' == cat_id || cat_id == '' || !cat_id) { cat_id = 'all'; }
                var myLatLng = new google.maps.LatLng(<?php echo $wpgmza_lat[$wpgmza_cmd]; ?>,<?php echo $wpgmza_lng[$wpgmza_cmd]; ?>);
                MYMAP_<?php echo $wpgmza_cmd; ?>.init("<?php echo "#wpgmza_map_".$wpgmza_cmd; ?>", myLatLng, <?php echo $start_zoom[$wpgmza_cmd]; ?>);
                UniqueCode=Math.round(Math.random()*10000);
                <?php
                    if ($wpgmza_current_mashup && isset($wpgmza_mashup_ids)) {
                    if ($wpgmza_mashup_ids[0] == "ALL") { $wpgmza_mashup_ids = wpgmza_return_all_map_ids(); }
                    foreach ($wpgmza_mashup_ids as $wpgmza_mashup_id) { ?>
                MYMAP_<?php echo $wpgmza_cmd; ?>.placeMarkers('<?php echo wpgmaps_get_marker_url($wpgmza_mashup_id); ?>?u='+UniqueCode,<?php echo $wpgmza_mashup_id; ?>,cat_id);
                    <?php } ?>
                <?php } else { ?>
                MYMAP_<?php echo $wpgmza_cmd; ?>.placeMarkers('<?php echo wpgmaps_get_marker_url($wpgmza_cmd); ?>?u='+UniqueCode,<?php echo $wpgmza_cmd; ?>,cat_id);
                <?php } ?>
            };
            InitMap_<?php echo $wpgmza_cmd; ?>('all');

            <?php } // end foreach map loop ?>

        }
    });
});



            var directionsDisplay = [];
            var directionsService = [];

            <?php foreach ($wpgmza_short_code_array as $wpgmza_cmd) { ?>

            // general directions settings and variables
            directionsDisplay[<?php echo $wpgmza_cmd; ?>];
            directionsService[<?php echo $wpgmza_cmd; ?>] = new google.maps.DirectionsService();
            var currentDirections = null;
            var oldDirections = [];
            var new_gps;


            var MYMAP_<?php echo $wpgmza_cmd; ?> = {
                map: null,
                bounds: null,
                mc: null
            }
            MYMAP_<?php echo $wpgmza_cmd; ?>.init = function(selector, latLng, zoom) {


              var myOptions = {
                zoom:zoom,
                center: latLng,
                draggable: <?php if ($wpgmza_settings['wpgmza_settings_map_draggable'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                disableDoubleClickZoom: <?php if ($wpgmza_settings['wpgmza_settings_map_clickzoom'] == "yes") { echo "true"; } else { echo "false"; } ?>,
                scrollwheel: <?php if ($wpgmza_settings['wpgmza_settings_map_scroll'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                zoomControl: <?php if ($wpgmza_settings['wpgmza_settings_map_zoom'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                panControl: <?php if ($wpgmza_settings['wpgmza_settings_map_pan'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                mapTypeControl: <?php if ($wpgmza_settings['wpgmza_settings_map_type'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                streetViewControl: <?php if ($wpgmza_settings['wpgmza_settings_map_streetview'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                mapTypeId: google.maps.MapTypeId.<?php echo $wpgmza_map_type[$wpgmza_cmd]; ?>
              }


               this.map = new google.maps.Map(jQuery(selector)[0], myOptions);

               this.bounds = new google.maps.LatLngBounds();
                    directionsDisplay[<?php echo $wpgmza_cmd; ?>] = new google.maps.DirectionsRenderer({
                    'map': this.map,
                    'preserveViewport': true,
                    'draggable': true
                });
              directionsDisplay[<?php echo $wpgmza_cmd; ?>].setPanel(document.getElementById("directions_panel_<?php echo $wpgmza_cmd; ?>"));
              google.maps.event.addListener(directionsDisplay[<?php echo $wpgmza_cmd; ?>], 'directions_changed',
                function() {
                    if (currentDirections) {
                        oldDirections.push(currentDirections);

                    }
                    currentDirections = directionsDisplay[<?php echo $wpgmza_cmd; ?>].getDirections();
                    jQuery("#directions_panel_<?php echo $wpgmza_cmd; ?>").show();
                    jQuery("#wpgmaps_directions_notification_<?php echo $wpgmza_cmd; ?>").hide();
                    jQuery("#wpgmaps_directions_reset_<?php echo $wpgmza_cmd; ?>").show();
                });
                
                
                <?php
                // polygons

                //first check for map mashup
                if ($wpgmza_current_mashup && isset($wpgmza_mashup_ids)) {

                    foreach ($wpgmza_mashup_ids as $wpgmza_tmp_plg) {

                    $total_poly_array = wpgmza_return_polygon_id_array($wpgmza_tmp_plg);
                        if ($total_poly_array > 0) {
                        foreach ($total_poly_array as $poly_id) {
                            $polyoptions = wpgmza_return_poly_options($poly_id);
                            $linecolor = $polyoptions->linecolor;
                            $fillcolor = $polyoptions->fillcolor;
                            $fillopacity = $polyoptions->opacity;
                            if (!$linecolor) { $linecolor = "000000"; }
                            if (!$fillcolor) { $fillcolor = "66FF00"; }
                            if (!$fillopacity) { $fillopacity = "0.5"; }
                            $linecolor = "#".$linecolor;
                            $fillcolor = "#".$fillcolor;
                    ?>
                    var WPGM_PathData_<?php echo $poly_id; ?> = [
                        <?php
                        $poly_array = wpgmza_return_polygon_array($poly_id);

                        foreach ($poly_array as $single_poly) {
                            $poly_data_raw = str_replace(" ","",$single_poly);
                            $poly_data_raw = explode(",",$poly_data_raw);
                            $lat = $poly_data_raw[0];
                            $lng = $poly_data_raw[1];
                            ?>
                        new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),
                        <?php
                    }
                    ?>


                    ];
                    var WPGM_Path_<?php echo $poly_id; ?> = new google.maps.Polygon({
                        path: WPGM_PathData_<?php echo $poly_id; ?>,
                        strokeColor: "<?php echo $linecolor; ?>",
                        fillOpacity: "<?php echo $fillopacity; ?>",
                        fillColor: "<?php echo $fillcolor; ?>",
                        strokeWeight: 2
                    });

                    WPGM_Path_<?php echo $poly_id; ?>.setMap(this.map);
                    <?php } }


                    }

                } else {


                    $total_poly_array = wpgmza_return_polygon_id_array($wpgmza_cmd);
                    if ($total_poly_array > 0) {
                    foreach ($total_poly_array as $poly_id) {
                        $polyoptions = wpgmza_return_poly_options($poly_id);
                        $linecolor = $polyoptions->linecolor;
                        $fillcolor = $polyoptions->fillcolor;
                        $fillopacity = $polyoptions->opacity;
                        if (!$linecolor) { $linecolor = "000000"; }
                        if (!$fillcolor) { $fillcolor = "66FF00"; }
                        if (!$fillopacity) { $fillopacity = "0.5"; }
                        $linecolor = "#".$linecolor;
                        $fillcolor = "#".$fillcolor;
                ?>
                    var WPGM_PathData_<?php echo $poly_id; ?> = [
                        <?php
                        $poly_array = wpgmza_return_polygon_array($poly_id);

                        foreach ($poly_array as $single_poly) {
                            $poly_data_raw = str_replace(" ","",$single_poly);
                            $poly_data_raw = explode(",",$poly_data_raw);
                            $lat = $poly_data_raw[0];
                            $lng = $poly_data_raw[1];
                            ?>
                            new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),
                            <?php
                        }
                        ?>


                    ];
                    var WPGM_Path_<?php echo $poly_id; ?> = new google.maps.Polygon({
                      path: WPGM_PathData_<?php echo $poly_id; ?>,
                      strokeColor: "<?php echo $linecolor; ?>",
                      fillOpacity: "<?php echo $fillopacity; ?>",
                      fillColor: "<?php echo $fillcolor; ?>",
                      strokeWeight: 2
                    });

                    WPGM_Path_<?php echo $poly_id; ?>.setMap(this.map);
                    <?php } } } ?>



<?php
                // polylines

                //first check for map mashup
                if ($wpgmza_current_mashup && isset($wpgmza_mashup_ids)) {

                    foreach ($wpgmza_mashup_ids as $wpgmza_tmp_pl) {
                            $total_polyline_array = wpgmza_return_polyline_id_array($wpgmza_tmp_pl);
                            if ($total_polyline_array > 0) {
                            foreach ($total_polyline_array as $poly_id) {
                                $polyoptions = wpgmza_return_polyline_options($poly_id);
                                $linecolor = $polyoptions->linecolor;
                                $linethickness = $polyoptions->linethickness;
                                $fillopacity = $polyoptions->opacity;
                                if (!$linecolor) { $linecolor = "000000"; }
                                if (!$linethickness) { $linethickness = "4"; }
                                if (!$fillopacity) { $fillopacity = "0.5"; }
                                $linecolor = "#".$linecolor;
                        ?>
                        var WPGM_PathLineData_<?php echo $poly_id; ?> = [
                            <?php
                            $poly_array = wpgmza_return_polyline_array($poly_id);

                            foreach ($poly_array as $single_poly) {
                                $poly_data_raw = str_replace(" ","",$single_poly);
                                $poly_data_raw = explode(",",$poly_data_raw);
                                $lat = $poly_data_raw[0];
                                $lng = $poly_data_raw[1];
                                ?>
                            new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),
                            <?php
                        }
                        ?>
                        ];
                        var WPGM_PathLine_<?php echo $poly_id; ?> = new google.maps.Polyline({
                            path: WPGM_PathLineData_<?php echo $poly_id; ?>,
                            strokeColor: "<?php echo $linecolor; ?>",
                            strokeOpacity: "<?php echo $fillopacity; ?>",
                            strokeWeight: "<?php echo $linethickness; ?>"
                        });

                        WPGM_PathLine_<?php echo $poly_id; ?>.setMap(this.map);
                    <?php } } }

                } else {
                // no mashup, show only this maps polylines

                    $total_polyline_array = wpgmza_return_polyline_id_array($wpgmza_cmd);
                    if ($total_polyline_array > 0) {
                    foreach ($total_polyline_array as $poly_id) {
                        $polyoptions = wpgmza_return_polyline_options($poly_id);
                        $linecolor = $polyoptions->linecolor;
                        $linethickness = $polyoptions->linethickness;
                        $fillopacity = $polyoptions->opacity;
                        if (!$linecolor) { $linecolor = "000000"; }
                        if (!$linethickness) { $linethickness = "4"; }
                        if (!$fillopacity) { $fillopacity = "0.5"; }
                        $linecolor = "#".$linecolor;
                ?> 
                var WPGM_PathLineData_<?php echo $poly_id; ?> = [
                    <?php
                    $poly_array = wpgmza_return_polyline_array($poly_id);

                    foreach ($poly_array as $single_poly) {
                        $poly_data_raw = str_replace(" ","",$single_poly);
                        $poly_data_raw = explode(",",$poly_data_raw);
                        $lat = $poly_data_raw[0];
                        $lng = $poly_data_raw[1];
                        ?>
                        new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),            
                        <?php
                    }
                    ?>
                ];
                var WPGM_PathLine_<?php echo $poly_id; ?> = new google.maps.Polyline({
                  path: WPGM_PathLineData_<?php echo $poly_id; ?>,
                  strokeColor: "<?php echo $linecolor; ?>",
                  strokeOpacity: "<?php echo $fillopacity; ?>",
                  strokeWeight: "<?php echo $linethickness; ?>"
                });

                WPGM_PathLine_<?php echo $poly_id; ?>.setMap(this.map);
                <?php } } } ?>


                <?php if ($wpgmza_bicycle[$wpgmza_cmd] == "1") { ?>
                    var bikeLayer = new google.maps.BicyclingLayer();
                    bikeLayer.setMap(this.map);
                <?php } ?>
                <?php if ($wpgmza_traffic[$wpgmza_cmd] == "1") { ?>
                    var trafficLayer = new google.maps.TrafficLayer();
                    trafficLayer.setMap(this.map);
                <?php } ?>
                <?php if ($kml[$wpgmza_cmd] != "") { ?>
                    var georssLayer = new google.maps.KmlLayer('<?php echo $kml[$wpgmza_cmd]; ?>?tstamp=<?php echo time(); ?>');
                    georssLayer.setMap(this.map);
                <?php } ?>
                <?php if ($fusion[$wpgmza_cmd] != "") { ?>
                    var fusionlayer = new google.maps.FusionTablesLayer('<?php echo $fusion[$wpgmza_cmd]; ?>', {
                          suppressInfoWindows: false

                    });
                    fusionlayer.setMap(this.map);
                <?php } ?>
                    
                    
                
                    
                    
                    
            }
            
            
            
            var infoWindow = new google.maps.InfoWindow();
            <?php
                $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                $wpgmza_settings_infowindow_width = $wpgmza_settings['wpgmza_settings_infowindow_width'];
                if (!$wpgmza_settings_infowindow_width || !isset($wpgmza_settings_infowindow_width)) { $wpgmza_settings_infowindow_width = "200"; }
            ?>
            infoWindow.setOptions({maxWidth:<?php echo $wpgmza_settings_infowindow_width; ?>});

            google.maps.event.addDomListener(window, 'resize', function() {
                var myLatLng = new google.maps.LatLng(<?php echo $wpgmza_lat[$wpgmza_cmd]; ?>,<?php echo $wpgmza_lng[$wpgmza_cmd]; ?>);
                MYMAP_<?php echo $wpgmza_cmd; ?>.map.setCenter(myLatLng);
            });


            MYMAP_<?php echo $wpgmza_cmd; ?>.placeMarkers = function(filename,map_id,cat_id) {
                marker_array = [];
                if( Object.prototype.toString.call( map_id ) === '[object Array]' ) {
                    /* map mashup */

                    var length = map_id.length,
                        element = null;
                    for (var i = 0; i < length; i++) {
                        element = map_id[i];
                        console.log(element);
                    }



                } else {

                    jQuery.get(filename, function(xml){
                                jQuery(xml).find("marker").each(function(){
                                        var wpgmza_def_icon = '<?php echo $wpgmza_default_icon[$wpgmza_cmd]; ?>';
                                        var wpmgza_map_id = jQuery(this).find('map_id').text();
                                        var wpmgza_marker_id = jQuery(this).find('marker_id').text();

                                        if (wpmgza_map_id == map_id) {
                                            var wpmgza_title = jQuery(this).find('title').text();
                                            var wpmgza_address = jQuery(this).find('address').text();
                                            var wpmgza_show_address = jQuery(this).find('address').text();
                                            var wpmgza_mapicon = jQuery(this).find('icon').text();
                                            var wpmgza_image = jQuery(this).find('pic').text();
                                            var wpmgza_desc  = jQuery(this).find('desc').text();
                                            var wpmgza_linkd = jQuery(this).find('linkd').text();
                                            var wpmgza_anim  = jQuery(this).find('anim').text();
                                            var wpmgza_category  = jQuery(this).find('category').text();

                                            if (cat_id == 'all' || cat_id == wpmgza_category) {

                                                var wpmgza_infoopen  = jQuery(this).find('infoopen').text();
                                                if (wpmgza_title != "") {
                                                    wpmgza_title = wpmgza_title+'<br />';
                                                }


                                                if (wpmgza_image != "") {

                                                    <?php
                                                        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                                                        $wpgmza_image_height = $wpgmza_settings['wpgmza_settings_image_height'];
                                                        $wpgmza_image_width = $wpgmza_settings['wpgmza_settings_image_width'];
                                                        if (!$wpgmza_image_height || !isset($wpgmza_image_height)) { $wpgmza_image_height = "100"; }
                                                        if (!$wpgmza_image_width || !isset($wpgmza_image_width)) { $wpgmza_image_width = "100"; }

                                                        $wpgmza_use_timthumb = $wpgmza_settings['wpgmza_settings_use_timthumb'];
                                                        if ($wpgmza_use_timthumb == "" || !isset($wpgmza_use_timthumb)) { ?>
                                                                wpmgza_image = "<br /><img src=\"<?php echo wpgmaps_get_plugin_url(); ?>/timthumb.php?src="+wpmgza_image+"&h=<?php echo $wpgmza_image_height; ?>&w=<?php echo $wpgmza_image_width; ?>&zc=1\" title=\"\" alt=\"\" style=\"float:right; margin:5px;\" />";
                                                    <?php } else  { ?>
                                                                wpmgza_image = "<br /><img src=\""+wpmgza_image+"\" class=\"wpgmza_map_image\" style=\"float:right; margin:5px; height:<?php echo $wpgmza_image_height; ?>px; width:<?php echo $wpgmza_image_width; ?>px\" />";
                                                    <?php } ?>

                                                } else { wpmgza_image = "" }
                                                if (wpmgza_linkd != "") {
                                                    <?php
                                                        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                                                        $wpgmza_settings_infowindow_links = $wpgmza_settings['wpgmza_settings_infowindow_links'];
                                                        if ($wpgmza_settings_infowindow_links == "yes") { $wpgmza_settings_infowindow_links = "target='_BLANK'";  }
                                                    ?>

                                                    wpmgza_linkd = "<a href=\""+wpmgza_linkd+"\" <?php echo $wpgmza_settings_infowindow_links; ?> title=\"<?php _e("More details","wp-google-maps"); ?>\"><?php _e("More details","wp-google-maps"); ?></a><br />";
                                                }

                                                if (wpmgza_mapicon == "" || !wpmgza_mapicon) { if (wpgmza_def_icon != "") { wpmgza_mapicon = '<?php echo $wpgmza_default_icon[$wpgmza_cmd]; ?>'; } }


                                                var lat = jQuery(this).find('lat').text();
                                                var lng = jQuery(this).find('lng').text();
                                                var point = new google.maps.LatLng(parseFloat(lat),parseFloat(lng));
                                                MYMAP_<?php echo $wpgmza_cmd; ?>.bounds.extend(point);
                                                if (wpmgza_anim == "1") {
                                                    var marker = new google.maps.Marker({
                                                            position: point,
                                                            map: MYMAP_<?php echo $wpgmza_cmd; ?>.map,
                                                            icon: wpmgza_mapicon,
                                                            animation: google.maps.Animation.BOUNCE
                                                    });
                                                }
                                                else if (wpmgza_anim == "2") {
                                                    var marker = new google.maps.Marker({
                                                            position: point,
                                                            map: MYMAP_<?php echo $wpgmza_cmd; ?>.map,
                                                            icon: wpmgza_mapicon,
                                                            animation: google.maps.Animation.DROP
                                                    });
                                                }
                                                else {
                                                    var marker = new google.maps.Marker({
                                                            position: point,
                                                            map: MYMAP_<?php echo $wpgmza_cmd; ?>.map,
                                                            icon: wpmgza_mapicon
                                                    });
                                                }

                                                <?php
                                                        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                                                        $wpgmza_settings_infowindow_address = $wpgmza_settings['wpgmza_settings_infowindow_address'];
                                                        if ($wpgmza_settings_infowindow_address == "yes") {
                                                ?>
                                                wpmgza_show_address = "";
                                                <?php } ?>


                                                var html='<div class="wpgmza_markerbox">'
                                                    +wpmgza_image+
                                                    '<strong>'
                                                    +wpmgza_title+
                                                    '</strong>'+wpmgza_show_address+'<br /><span style="font-size:12px;">'
                                                    +wpmgza_desc+
                                                    '<br />'
                                                    +wpmgza_linkd+
                                                    ''+
                                                    <?php if ($wpgmza_directions[$wpgmza_cmd] == 1) { ?>
                                                    '<a href="javascript:void(0);" id="<?php echo $wpgmza_cmd; ?>" class="wpgmza_gd" wpgm_addr_field="'+wpmgza_address+'" gps="'+parseFloat(lat)+','+parseFloat(lng)+'"><?php _e("Get directions","wp-google-maps"); ?></a>'
                                                    <?php } else { ?>
                                                    ' '
                                                    <?php } ?>
                                                    +'</span></div>';

                                                if (wpmgza_infoopen == "1") {
                                                    //infoWindow.close();
                                                    infoWindow.setContent(html);
                                                    infoWindow.open(MYMAP_<?php echo $wpgmza_cmd; ?>.map, marker);
                                                }

                                                google.maps.event.addListener(marker, 'click', function(evt) {
                                                    infoWindow.close();
                                                    infoWindow.setOptions({maxWidth:<?php echo $wpgmza_settings_infowindow_width; ?>});
                                                    infoWindow.setContent(html);
                                                    infoWindow.open(MYMAP_<?php echo $wpgmza_cmd; ?>.map, marker);
                                                    //MYMAP.map.setCenter(this.position);
                                                });


                                                marker_array[wpmgza_marker_id] = marker;
                                            }

                                        }
                        });

                });
                }
                        <?php if ($show_location[$wpgmza_cmd] == "1") { ?>
                         
                        // Try HTML5 geolocation
                        if(navigator.geolocation) {
                          navigator.geolocation.getCurrentPosition(function(position) {
                            user_location = new google.maps.LatLng(position.coords.latitude,
                                                             position.coords.longitude);
                            
                            var marker = new google.maps.Marker({
                                    position: user_location,
                                    map: MYMAP_<?php echo $wpgmza_cmd; ?>.map,
                                    animation: google.maps.Animation.DROP
                            });     
                            google.maps.event.addListener(marker, 'click', function(evt) {
                                    infoWindow.close();
                                    infoWindow.setContent('<?php _e("My location","wp-google-maps"); ?>');
                                    infoWindow.open(MYMAP_<?php echo $wpgmza_cmd; ?>.map, marker);
                                    //MYMAP.map.setCenter(this.position);
                                });
                            marker_array[marker_array+1] = marker;
                          });


                          } else {
                          // Browser doesn't support Geolocation
                        }       

                        <?php } ?>


            }

            <?php } // end foreach map loop ?>


            function openInfoWindow(marker_id) {
                google.maps.event.trigger(marker_array[marker_id], 'click');
                //infoWindow.setContent("km away from you.");
                //infoWindow.open(MYMAP_<?php echo $wpgmza_cmd; ?>, marker_array[0]);
            }




            function calcRoute(start,end,mapid,travelmode,avoidtolls,avoidhighways) {
                var request = {
                    origin:start,
                    destination:end,
                    travelMode: google.maps.DirectionsTravelMode[travelmode],
                    avoidHighways: avoidhighways,
                    avoidTolls: avoidtolls,

                };

                directionsService[mapid].route(request, function(response, status) {
                  if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay[mapid].setDirections(response);
                  }
                });
              }
                function wpgmza_show_options(wpgmzamid) {

                      jQuery("#wpgmza_options_box_"+wpgmzamid).show();
                      jQuery("#wpgmza_show_options_"+wpgmzamid).hide();
                      jQuery("#wpgmza_hide_options_"+wpgmzamid).show();
                  }
                function wpgmza_hide_options(wpgmzamid) {
                      jQuery("#wpgmza_options_box_"+wpgmzamid).hide();
                      jQuery("#wpgmza_show_options_"+wpgmzamid).show();
                      jQuery("#wpgmza_hide_options_"+wpgmzamid).hide();
                  }
                function wpgmza_reset_directions(wpgmzamid) {

                    jQuery("#wpgmaps_directions_editbox_"+wpgmzamid).show();
                    jQuery("#directions_panel_"+wpgmzamid).hide();
                    jQuery("#wpgmaps_directions_notification_"+wpgmzamid).hide();
                    jQuery("#wpgmaps_directions_reset_"+wpgmzamid).hide();
                  }

                jQuery("body").on("click", ".wpgmza_gd", function() {
                    var wpgmzamid = jQuery(this).attr("id");
                    var end = jQuery(this).attr("wpgm_addr_field");
                    jQuery("#wpgmaps_directions_edit_"+wpgmzamid).show();
                    jQuery("#wpgmaps_directions_editbox_"+wpgmzamid).show();
                    jQuery("#wpgmza_input_to_"+wpgmzamid).val(end);
                    jQuery("#wpgmza_input_from_"+wpgmzamid).focus().select();

                });

                jQuery("body").on("click", ".wpgmaps_get_directions", function() {

                     var wpgmzamid = jQuery(this).attr("id");

                     var avoidtolls = jQuery('#wpgmza_tolls_'+wpgmzamid).is(':checked');
                     var avoidhighways = jQuery('#wpgmza_highways_'+wpgmzamid).is(':checked');


                     var wpgmza_dir_type = jQuery("#wpgmza_dir_type_"+wpgmzamid).val();
                     var wpgmaps_from = jQuery("#wpgmza_input_from_"+wpgmzamid).val();
                     var wpgmaps_to = jQuery("#wpgmza_input_to_"+wpgmzamid).val();
                     if (wpgmaps_from == "" || wpgmaps_to == "") { alert("<?php _e("Please fill out both the 'from' and 'to' fields","wp-google-maps"); ?>"); }
                     else { calcRoute(wpgmaps_from,wpgmaps_to,wpgmzamid,wpgmza_dir_type,avoidtolls,avoidhighways); jQuery("#wpgmaps_directions_editbox_"+wpgmzamid).hide("slow"); jQuery("#wpgmaps_directions_notification_"+wpgmzamid).show("slow");  }
                });


    </script>
<?php

        }
    }
}





function wpgmaps_admin_javascript_pro() {
    global $wpdb;
    global $wpgmza_tblname_maps;
    $ajax_nonce = wp_create_nonce("wpgmza");
    if (is_admin() && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "edit_marker") { wpgmaps_admin_edit_marker_javascript(); }
    else if (is_admin() && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "add_poly") { wpgmaps_admin_add_poly_javascript($_GET['map_id']); }
    else if (is_admin() && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "edit_poly") { wpgmaps_admin_edit_poly_javascript($_GET['map_id'],$_GET['poly_id']); }
    else if (is_admin() && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "add_polyline") { wpgmaps_admin_add_polyline_javascript($_GET['map_id']); }
    else if (is_admin() && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "edit_polyline") { wpgmaps_admin_edit_polyline_javascript($_GET['map_id'],$_GET['poly_id']); }
    else if (is_admin() && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "edit") {
        wpgmaps_update_xml_file($_GET['map_id']);
        $res = wpgmza_get_map_data($_GET['map_id']);
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");

        $wpgmza_lat = $res->map_start_lat;
        $wpgmza_lng = $res->map_start_lng;
        $wpgmza_width = $res->map_width;
        $wpgmza_height = $res->map_height;
        $wpgmza_width_type = stripslashes($res->map_width_type);
        $wpgmza_height_type = $res->map_height_type;
        $wpgmza_map_type = $res->type;
        $wpgmza_default_icon = $res->default_marker;
        $kml = $res->kml;
        $fusion = $res->fusion;
        $wpgmza_traffic = $res->traffic;
        $wpgmza_bicycle = $res->bicycle;
        $wpgmza_dbox = $res->dbox;
        $wpgmza_dbox_width = $res->dbox_width;


        if ($wpgmza_default_icon == "0") { $wpgmza_default_icon = ""; }
        if (!$wpgmza_map_type || $wpgmza_map_type == "" || $wpgmza_map_type == "1") { $wpgmza_map_type = "ROADMAP"; }
        else if ($wpgmza_map_type == "2") { $wpgmza_map_type = "SATELLITE"; }
        else if ($wpgmza_map_type == "3") { $wpgmza_map_type = "HYBRID"; }
        else if ($wpgmza_map_type == "4") { $wpgmza_map_type = "TERRAIN"; }
        else { $wpgmza_map_type = "ROADMAP"; }

        $start_zoom = $res->map_start_zoom;
        if ($start_zoom < 1 || !$start_zoom) {
            $start_zoom = 5;
        }
        if (!$wpgmza_lat || !$wpgmza_lng) {
            $wpgmza_lat = "51.5081290";
            $wpgmza_lng = "-0.1280050";
        }
        
        
        // marker sorting functionality
        if ($res->order_markers_by == 1) { $order_by = 0; }
        else if ($res->order_markers_by == 2) { $order_by = 2; }
        else if ($res->order_markers_by == 3) { $order_by = 4; }
        else if ($res->order_markers_by == 4) { $order_by = 5; }
        else if ($res->order_markers_by == 5) { $order_by = 3; }
        else { $order_by = 0; }
        if ($res->order_markers_choice == 1) { $order_choice = "asc"; }
        else { $order_choice = "desc"; }
        
    ?>
    <script type="text/javascript">
               var gmapsJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
               document.write(unescape("%3Cscript src='" + gmapsJsHost + "maps.google.com/maps/api/js?sensor=false' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.8.24/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo wpgmaps_get_plugin_url(); ?>/css/data_table.css" />
    <script type="text/javascript" src="<?php echo wpgmaps_get_plugin_url(); ?>/js/jquery.dataTables.js"></script>
    <script type="text/javascript" >

    


    jQuery(function() {

        
        

        var wpgmzaTable;

                jQuery(document).ready(function(){

                    

                    
                    
                    jQuery("#wpgmaps_show_advanced").click(function() {
                      jQuery("#wpgmaps_advanced_options").show();
                      jQuery("#wpgmaps_show_advanced").hide();
                      jQuery("#wpgmaps_hide_advanced").show();

                    });
                    jQuery("#wpgmaps_hide_advanced").click(function() {
                      jQuery("#wpgmaps_advanced_options").hide();
                      jQuery("#wpgmaps_show_advanced").show();
                      jQuery("#wpgmaps_hide_advanced").hide();

                    });



                    wpgmzaTable = jQuery('#wpgmza_table').dataTable({
                        "bProcessing": true,
                        "aaSorting": [[ <?php echo "$order_by";?>, "<?php echo $order_choice; ?>" ]]
                    });
                    function wpgmza_reinitialisetbl() {
                        wpgmzaTable.fnClearTable( 0 );
                        wpgmzaTable = jQuery('#wpgmza_table').dataTable({
                            "bProcessing": true,
                            "aaSorting": [[ <?php echo "$order_by";?>, "<?php echo $order_choice; ?>" ]]
                        });
                    }
                    function wpgmza_InitMap() {
                        var myLatLng = new google.maps.LatLng(<?php echo $wpgmza_lat; ?>,<?php echo $wpgmza_lng; ?>);
                        MYMAP.init('#wpgmza_map', myLatLng, <?php echo $start_zoom; ?>);
                        UniqueCode=Math.round(Math.random()*10000);
                        MYMAP.placeMarkers('<?php echo wpgmaps_get_marker_url($_GET['map_id']); ?>?u='+UniqueCode,<?php echo $_GET['map_id']; ?>);
                    }

                    jQuery("#wpgmza_map").css({
                        height:'<?php echo $wpgmza_height; ?><?php echo $wpgmza_height_type; ?>',
                        width:'<?php echo $wpgmza_width; ?><?php echo $wpgmza_width_type; ?>'

                    });
                    var geocoder = new google.maps.Geocoder();
                    wpgmza_InitMap();



                    jQuery("body").on("click", ".wpgmza_del_btn", function() {
                        var cur_id = jQuery(this).attr("id");
                        var wpgm_map_id = "0";
                        if (document.getElementsByName("wpgmza_id").length > 0) { wpgm_map_id = jQuery("#wpgmza_id").val(); }
                        var data = {
                                action: 'delete_marker',
                                security: '<?php echo $ajax_nonce; ?>',
                                map_id: wpgm_map_id,
                                marker_id: cur_id
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                                wpgmza_InitMap();
                                jQuery("#wpgmza_marker_holder").html(response);
                                wpgmza_reinitialisetbl();

                        });

                    });
                    jQuery("body").on("click", ".wpgmza_poly_del_btn", function() {
                        var cur_id = jQuery(this).attr("id");
                        var wpgm_map_id = "0";
                        if (document.getElementsByName("wpgmza_id").length > 0) { wpgm_map_id = jQuery("#wpgmza_id").val(); }
                        var data = {
                                action: 'delete_poly',
                                security: '<?php echo $ajax_nonce; ?>',
                                map_id: wpgm_map_id,
                                poly_id: cur_id
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                                wpgmza_InitMap();
                                jQuery("#wpgmza_poly_holder").html(response);
                                window.location.reload();

                        });

                    });



                    jQuery("body").on("click", ".wpgmza_edit_btn", function() {
                        var cur_id = jQuery(this).attr("id");

                        var wpgmza_edit_title = jQuery("#wpgmza_hid_marker_title_"+cur_id).val();
                        var wpgmza_edit_address = jQuery("#wpgmza_hid_marker_address_"+cur_id).val();
                        var wpgmza_edit_desc = jQuery("#wpgmza_hid_marker_desc_"+cur_id).val();
                        var wpgmza_edit_pic = jQuery("#wpgmza_hid_marker_pic_"+cur_id).val();
                        var wpgmza_edit_link = jQuery("#wpgmza_hid_marker_link_"+cur_id).val();
                        var wpgmza_edit_icon = jQuery("#wpgmza_hid_marker_icon_"+cur_id).val();
                        var wpgmza_edit_anim = jQuery("#wpgmza_hid_marker_anim_"+cur_id).val();
                        var wpgmza_edit_category = jQuery("#wpgmza_hid_marker_category_"+cur_id).val();
                        var wpgmza_edit_infoopen = jQuery("#wpgmza_hid_marker_infoopen_"+cur_id).val();
                        jQuery("#wpgmza_edit_id").val(cur_id);
                        jQuery("#wpgmza_add_title").val(wpgmza_edit_title);
                        jQuery("#wpgmza_add_address").val(wpgmza_edit_address);
                        jQuery("#wpgmza_add_desc").val(wpgmza_edit_desc);
                        jQuery("#wpgmza_add_pic").val(wpgmza_edit_pic);
                        jQuery("#wpgmza_link_url").val(wpgmza_edit_link);
                        jQuery("#wpgmza_animation").val(wpgmza_edit_anim);
                        jQuery("#wpgmza_category").val(wpgmza_edit_category);
                        jQuery("#wpgmza_infoopen").val(wpgmza_edit_infoopen);
                        jQuery("#wpgmza_add_custom_marker").val(wpgmza_edit_icon);
                        jQuery("#wpgmza_cmm").html("<img src='"+wpgmza_edit_icon+"' />");
                        jQuery("#wpgmza_addmarker_div").hide();
                        jQuery("#wpgmza_editmarker_div").show();


                    });

                    

                    jQuery("#wpgmza_addmarker").click(function(){
                        jQuery("#wpgmza_addmarker").hide();
                        jQuery("#wpgmza_addmarker_loading").show();

                        var wpgm_title = "";
                        var wpgm_address = "0";
                        var wpgm_desc = "0";
                        var wpgm_pic = "0";
                        var wpgm_link = "0";
                        var wpgm_icon = "0";
                        var wpgm_gps = "0";

                        var wpgm_anim = "0";
                        var wpgm_category = "0";
                        var wpgm_infoopen = "0";
                        var wpgm_map_id = "0";
                        if (document.getElementsByName("wpgmza_add_title").length > 0) { wpgm_title = jQuery("#wpgmza_add_title").val(); }
                        if (document.getElementsByName("wpgmza_add_address").length > 0) { wpgm_address = jQuery("#wpgmza_add_address").val(); }
                        if (document.getElementsByName("wpgmza_add_desc").length > 0) { wpgm_desc = jQuery("#wpgmza_add_desc").val(); }
                        if (document.getElementsByName("wpgmza_add_pic").length > 0) { wpgm_pic = jQuery("#wpgmza_add_pic").val(); }
                        if (document.getElementsByName("wpgmza_link_url").length > 0) { wpgm_link = jQuery("#wpgmza_link_url").val(); }
                        if (document.getElementsByName("wpgmza_add_custom_marker").length > 0) { wpgm_icon = jQuery("#wpgmza_add_custom_marker").val(); }
                        if (document.getElementsByName("wpgmza_animation").length > 0) { wpgm_anim = jQuery("#wpgmza_animation").val(); }
                        if (document.getElementsByName("wpgmza_category").length > 0) { wpgm_category = jQuery("#wpgmza_category").val(); }
                        if (document.getElementsByName("wpgmza_infoopen").length > 0) { wpgm_infoopen = jQuery("#wpgmza_infoopen").val(); }
                        if (document.getElementsByName("wpgmza_id").length > 0) { wpgm_map_id = jQuery("#wpgmza_id").val(); }

                        geocoder.geocode( { 'address': wpgm_address}, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                wpgm_gps = String(results[0].geometry.location);
                                var latlng1 = wpgm_gps.replace("(","");
                                var latlng2 = latlng1.replace(")","");
                                var latlngStr = latlng2.split(",",2);
                                var wpgm_lat = parseFloat(latlngStr[0]);
                                var wpgm_lng = parseFloat(latlngStr[1]);


                                var data = {
                                    action: 'add_marker',
                                    security: '<?php echo $ajax_nonce; ?>',
                                    map_id: wpgm_map_id,
                                    title: wpgm_title,
                                    address: wpgm_address,
                                    desc: wpgm_desc,
                                    link: wpgm_link,
                                    icon: wpgm_icon,
                                    pic: wpgm_pic,
                                    anim: wpgm_anim,
                                    category: wpgm_category,
                                    infoopen: wpgm_infoopen,
                                    lat: wpgm_lat,
                                    lng: wpgm_lng
                                };


                                jQuery.post(ajaxurl, data, function(response) {
                                        wpgmza_InitMap();
                                        jQuery("#wpgmza_marker_holder").html(response);
                                        jQuery("#wpgmza_addmarker").show();
                                        jQuery("#wpgmza_addmarker_loading").hide();

                                        jQuery("#wpgmza_add_title").val("");
                                        jQuery("#wpgmza_add_address").val("");
                                        jQuery("#wpgmza_add_desc").val("");
                                        jQuery("#wpgmza_add_pic").val("");
                                        jQuery("#wpgmza_link_url").val("");
                                        jQuery("#wpgmza_animation").val("None");
                                        jQuery("#wpgmza_category").val("Select");
                                        jQuery("#wpgmza_edit_id").val("");
                                        wpgmza_reinitialisetbl();
                                });

                            } else {
                                alert("<?php _e("Geocode was not successful for the following reason","wp-google-maps"); ?>: " + status);
                            }
                        });



                    });
                    jQuery("#wpgmza_editmarker").click(function(){

                        jQuery("#wpgmza_editmarker_div").hide();
                        jQuery("#wpgmza_editmarker_loading").show();


                        var wpgm_edit_id;
                        wpgm_edit_id = parseInt(jQuery("#wpgmza_edit_id").val());
                        var wpgm_title = "";
                        var wpgm_address = "0";
                        var wpgm_desc = "0";
                        var wpgm_pic = "0";
                        var wpgm_link = "0";
                        var wpgm_anim = "0";
                        var wpgm_category = "0";
                        var wpgm_infoopen = "0";
                        var wpgm_icon = "";
                        var wpgm_map_id = "0";
                        var wpgm_gps = "0";
                        if (document.getElementsByName("wpgmza_add_title").length > 0) { wpgm_title = jQuery("#wpgmza_add_title").val(); }
                        if (document.getElementsByName("wpgmza_add_address").length > 0) { wpgm_address = jQuery("#wpgmza_add_address").val(); }
                        if (document.getElementsByName("wpgmza_add_desc").length > 0) { wpgm_desc = jQuery("#wpgmza_add_desc").val(); }
                        if (document.getElementsByName("wpgmza_add_pic").length > 0) { wpgm_pic = jQuery("#wpgmza_add_pic").val(); }
                        if (document.getElementsByName("wpgmza_link_url").length > 0) { wpgm_link = jQuery("#wpgmza_link_url").val(); }
                        if (document.getElementsByName("wpgmza_animation").length > 0) { wpgm_anim = jQuery("#wpgmza_animation").val(); }
                        if (document.getElementsByName("wpgmza_category").length > 0) { wpgm_category = jQuery("#wpgmza_category").val(); }
                        if (document.getElementsByName("wpgmza_infoopen").length > 0) { wpgm_infoopen = jQuery("#wpgmza_infoopen").val(); }
                        if (document.getElementsByName("wpgmza_add_custom_marker").length > 0) { wpgm_icon = jQuery("#wpgmza_add_custom_marker").val(); }
                        if (document.getElementsByName("wpgmza_id").length > 0) { wpgm_map_id = jQuery("#wpgmza_id").val(); }

                        geocoder.geocode( { 'address': wpgm_address}, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                wpgm_gps = String(results[0].geometry.location);
                                var latlng1 = wpgm_gps.replace("(","");
                                var latlng2 = latlng1.replace(")","");
                                var latlngStr = latlng2.split(",",2);
                                var wpgm_lat = parseFloat(latlngStr[0]);
                                var wpgm_lng = parseFloat(latlngStr[1]);

                                var data = {
                                        action: 'edit_marker',
                                        security: '<?php echo $ajax_nonce; ?>',
                                        map_id: wpgm_map_id,
                                        edit_id: wpgm_edit_id,
                                        title: wpgm_title,
                                        address: wpgm_address,
                                        lat: wpgm_lat,
                                        lng: wpgm_lng,
                                        icon: wpgm_icon,
                                        desc: wpgm_desc,
                                        link: wpgm_link,
                                        pic: wpgm_pic,
                                        anim: wpgm_anim,
                                        category: wpgm_category,
                                        infoopen: wpgm_infoopen
                                };

                                jQuery.post(ajaxurl, data, function(response) {
                                    wpgmza_InitMap();
                                    jQuery("#wpgmza_marker_holder").html(response);
                                    jQuery("#wpgmza_addmarker_div").show();
                                    jQuery("#wpgmza_editmarker_loading").hide();
                                    jQuery("#wpgmza_add_title").val("");
                                    jQuery("#wpgmza_add_address").val("");
                                    jQuery("#wpgmza_add_desc").val("");
                                    jQuery("#wpgmza_add_pic").val("");
                                    jQuery("#wpgmza_link_url").val("");
                                    jQuery("#wpgmza_edit_id").val("");
                                    jQuery("#wpgmza_animation").val("None");
                                    jQuery("#wpgmza_category").val("Select");
                                    jQuery("#wpgmza_cmm").html("");
                                    wpgmza_reinitialisetbl();
                                });

                            } else {
                                alert("<?php _e("Geocode was not successful for the following reason","wp-google-maps"); ?>: " + status);
                            }
                        });





                    });
            });

            });

           

            var MYMAP = {
                map: null,
                bounds: null,
                mc: null
            }
            MYMAP.init = function(selector, latLng, zoom) {
              var myOptions = {
                zoom:zoom,

                center: latLng,
                scrollwheel: <?php if ($wpgmza_settings['wpgmza_settings_map_scroll'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                zoomControl: <?php if ($wpgmza_settings['wpgmza_settings_map_zoom'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                panControl: <?php if ($wpgmza_settings['wpgmza_settings_map_pan'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                mapTypeControl: <?php if ($wpgmza_settings['wpgmza_settings_map_type'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                streetViewControl: <?php if ($wpgmza_settings['wpgmza_settings_map_streetview'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                mapTypeId: google.maps.MapTypeId.<?php echo $wpgmza_map_type; ?>
              }
            this.map = new google.maps.Map(jQuery(selector)[0], myOptions);
            this.bounds = new google.maps.LatLngBounds();

            google.maps.event.addListener(MYMAP.map, 'zoom_changed', function() {
                zoomLevel = MYMAP.map.getZoom();
                jQuery("#wpgmza_start_zoom").val(zoomLevel);
            });
            <?php
                $total_poly_array = wpgmza_return_polygon_id_array($_GET['map_id']);
                if ($total_poly_array > 0) {
                foreach ($total_poly_array as $poly_id) {
                    $polyoptions = wpgmza_return_poly_options($poly_id);
                    $linecolor = $polyoptions->linecolor;
                    $fillcolor = $polyoptions->fillcolor;
                    $fillopacity = $polyoptions->opacity;
                    if (!$linecolor) { $linecolor = "000000"; }
                    if (!$fillcolor) { $fillcolor = "66FF00"; }
                    if (!$fillopacity) { $fillopacity = "0.5"; }
                    $linecolor = "#".$linecolor;
                    $fillcolor = "#".$fillcolor;
                    
            ?> 
            var WPGM_PathData_<?php echo $poly_id; ?> = [
                <?php
                $poly_array = wpgmza_return_polygon_array($poly_id);
                
                foreach ($poly_array as $single_poly) {
                    $poly_data_raw = str_replace(" ","",$single_poly);
                    $poly_data_raw = explode(",",$poly_data_raw);
                    $lat = $poly_data_raw[0];
                    $lng = $poly_data_raw[1];
                    ?>
                    new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),            
                    <?php
                }
                ?>
                
               
            ];
            var WPGM_Path_<?php echo $poly_id; ?> = new google.maps.Polygon({
              path: WPGM_PathData_<?php echo $poly_id; ?>,
              strokeColor: "<?php echo $linecolor; ?>",
              fillOpacity: "<?php echo $fillopacity; ?>",
              fillColor: "<?php echo $fillcolor; ?>",
              strokeWeight: 2
            });

            WPGM_Path_<?php echo $poly_id; ?>.setMap(this.map);
            <?php } } ?>



           
<?php
                // polylines
                    $total_polyline_array = wpgmza_return_polyline_id_array($_GET['map_id']);
                    if ($total_polyline_array > 0) {
                    foreach ($total_polyline_array as $poly_id) {
                        $polyoptions = wpgmza_return_polyline_options($poly_id);
                        $linecolor = $polyoptions->linecolor;
                        $fillopacity = $polyoptions->opacity;
                        $linethickness = $polyoptions->linethickness;
                        if (!$linecolor) { $linecolor = "000000"; }
                        if (!$linethickness) { $linethickness = "4"; }
                        if (!$fillopacity) { $fillopacity = "0.5"; }
                        $linecolor = "#".$linecolor;
                ?> 
                var WPGM_PathLineData_<?php echo $poly_id; ?> = [
                    <?php
                    $poly_array = wpgmza_return_polyline_array($poly_id);

                    foreach ($poly_array as $single_poly) {
                        $poly_data_raw = str_replace(" ","",$single_poly);
                        $poly_data_raw = explode(",",$poly_data_raw);
                        $lat = $poly_data_raw[0];
                        $lng = $poly_data_raw[1];
                        ?>
                        new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),            
                        <?php
                    }
                    ?>
                ];
                var WPGM_PathLine_<?php echo $poly_id; ?> = new google.maps.Polyline({
                  path: WPGM_PathLineData_<?php echo $poly_id; ?>,
                  strokeColor: "<?php echo $linecolor; ?>",
                  strokeOpacity: "<?php echo $fillopacity; ?>",
                  strokeWeight: "<?php echo $linethickness; ?>"
                  
                });

                WPGM_PathLine_<?php echo $poly_id; ?>.setMap(this.map);
                <?php } } ?>    


            google.maps.event.addListener(MYMAP.map, 'center_changed', function() {
                var location = MYMAP.map.getCenter();
                jQuery("#wpgmza_start_location").val(location.lat()+","+location.lng());
                jQuery("#wpgmaps_save_reminder").show();
            });

            <?php if ($wpgmza_bicycle == "1") { ?>
            var bikeLayer = new google.maps.BicyclingLayer();
            bikeLayer.setMap(this.map);
            <?php } ?>
            <?php if ($wpgmza_traffic == "1") { ?>
            var trafficLayer = new google.maps.TrafficLayer();
            trafficLayer.setMap(this.map);
            <?php } ?>


            <?php if ($kml != "") { ?>
            var georssLayer = new google.maps.KmlLayer('<?php echo $kml; ?>?tstamp=<?php echo time(); ?>');
            georssLayer.setMap(this.map);
            <?php } ?>
            <?php if ($fusion != "") { ?>
                var fusionlayer = new google.maps.FusionTablesLayer('<?php echo $fusion; ?>', {
                      suppressInfoWindows: false
                });
                fusionlayer.setMap(this.map);
            <?php } ?>


            } // end of map init

            var infoWindow = new google.maps.InfoWindow();
            <?php
                $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                $wpgmza_settings_infowindow_width = $wpgmza_settings['wpgmza_settings_infowindow_width'];
                if (!$wpgmza_settings_infowindow_width || !isset($wpgmza_settings_infowindow_width)) { $wpgmza_settings_infowindow_width = "200"; }
            ?>
            infoWindow.setOptions({maxWidth:<?php echo $wpgmza_settings_infowindow_width; ?>});

            google.maps.event.addDomListener(window, 'resize', function() {
                var myLatLng = new google.maps.LatLng(<?php echo $wpgmza_lat; ?>,<?php echo $wpgmza_lng; ?>);
                MYMAP.map.setCenter(myLatLng);
            });


            

            MYMAP.placeMarkers = function(filename,map_id) {
                marker_array = [];
                    jQuery.get(filename, function(xml){
                            jQuery(xml).find("marker").each(function(){
                                    var wpgmza_def_icon = '<?php echo $wpgmza_default_icon; ?>';
                                    var wpmgza_map_id = jQuery(this).find('map_id').text();

                                    if (wpmgza_map_id == map_id) {
                                        var wpmgza_title = jQuery(this).find('title').text();
                                        var wpmgza_show_address = jQuery(this).find('address').text();
                                        var wpmgza_address = jQuery(this).find('address').text();
                                        var wpmgza_mapicon = jQuery(this).find('icon').text();
                                        var wpmgza_image = jQuery(this).find('pic').text();
                                        var wpmgza_desc  = jQuery(this).find('desc').text();
                                        var wpmgza_anim  = jQuery(this).find('anim').text();
                                        var wpmgza_infoopen  = jQuery(this).find('infoopen').text();
                                        var wpmgza_linkd = jQuery(this).find('linkd').text();
                                        if (wpmgza_title != "") {
                                            wpmgza_title = wpmgza_title+'<br />';
                                        }
                                        if (wpmgza_image != "") {

                                    <?php
                                        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                                        $wpgmza_image_height = $wpgmza_settings['wpgmza_settings_image_height'];
                                        $wpgmza_image_width = $wpgmza_settings['wpgmza_settings_image_width'];
                                        if (!$wpgmza_image_height || !isset($wpgmza_image_height)) { $wpgmza_image_height = "100"; }
                                        if (!$wpgmza_image_width || !isset($wpgmza_image_width)) { $wpgmza_image_width = "100"; }

                                        $wpgmza_use_timthumb = $wpgmza_settings['wpgmza_settings_use_timthumb'];
                                        if ($wpgmza_use_timthumb == "" || !isset($wpgmza_use_timthumb)) { ?>
                                                wpmgza_image = "<br /><img src='<?php echo wpgmaps_get_plugin_url(); ?>/timthumb.php?src="+wpmgza_image+"&h=<?php echo $wpgmza_image_height; ?>&w=<?php echo $wpgmza_image_width; ?>&zc=1' title='' alt='' style=\"float:right; margin:5px;\" />";
                                    <?php } else  { ?>
                                                wpmgza_image = "<br /><img src='"+wpmgza_image+"' class='wpgmza_map_image' style=\"float:right; margin:5px; height:<?php echo $wpgmza_image_height; ?>px; width:<?php echo $wpgmza_image_width; ?>px\" />";
                                    <?php } ?>

                                            } else { wpmgza_image = "" }
                                        if (wpmgza_linkd != "") {
                                                <?php
                                                    $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                                                    $wpgmza_settings_infowindow_links = $wpgmza_settings['wpgmza_settings_infowindow_links'];
                                                    if ($wpgmza_settings_infowindow_links == "yes") { $wpgmza_settings_infowindow_links = "target='_BLANK'";  }
                                                ?>

                                                wpmgza_linkd = "<a href='"+wpmgza_linkd+"' <?php echo $wpgmza_settings_infowindow_links; ?> title='<?php _e("More details","wp-google-maps"); ?>'><?php _e("More details","wp-google-maps"); ?></a><br />";
                                            }
                                        if (wpmgza_mapicon == "" || !wpmgza_mapicon) { if (wpgmza_def_icon != "") { wpmgza_mapicon = '<?php echo $wpgmza_default_icon; ?>'; } }

                                        var lat = jQuery(this).find('lat').text();
                                        var lng = jQuery(this).find('lng').text();
                                        var point = new google.maps.LatLng(parseFloat(lat),parseFloat(lng));
                                        MYMAP.bounds.extend(point);
                                        if (wpmgza_anim == "1") {
                                        var marker = new google.maps.Marker({
                                                position: point,
                                                map: MYMAP.map,
                                                icon: wpmgza_mapicon,
                                                animation: google.maps.Animation.BOUNCE
                                        });
                                        }
                                        else if (wpmgza_anim == "2") {
                                            var marker = new google.maps.Marker({
                                                    position: point,
                                                    map: MYMAP.map,
                                                    icon: wpmgza_mapicon,
                                                    animation: google.maps.Animation.DROP
                                            });
                                        }
                                        else {
                                            var marker = new google.maps.Marker({
                                                    position: point,
                                                    map: MYMAP.map,
                                                    icon: wpmgza_mapicon
                                            });
                                        }
                                        //var html=''+wpmgza_image+'<strong>'+wpmgza_address+'</strong><br /><span style="font-size:12px;">'+wpmgza_desc+'<br />'+wpmgza_linkd+'</span>';
                                        <?php
                                                $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                                                $wpgmza_settings_infowindow_address = $wpgmza_settings['wpgmza_settings_infowindow_address'];
                                                if ($wpgmza_settings_infowindow_address == "yes") {
                                        ?>
                                        wpmgza_show_address = "";
                                        <?php } ?>


                                        var html='<div id="wpgmza_markerbox">'
                                                +wpmgza_image+
                                                '<strong>'
                                                +wpmgza_title+
                                                '</strong>'+wpmgza_show_address+'<br /><span style="font-size:12px;">'
                                                +wpmgza_desc+
                                                '<br />'
                                                +wpmgza_linkd+
                                                ''
                                                +'</span></div>';
                                        if (wpmgza_infoopen == "1") {

                                            infoWindow.setContent(html);
                                            infoWindow.open(MYMAP.map, marker);
                                        }

                                        google.maps.event.addListener(marker, 'click', function() {
                                                infoWindow.close();
                                                infoWindow.setContent(html);
                                                infoWindow.open(MYMAP.map, marker);

//                                                MYMAP.map.setCenter(this.position);
                                        });
                                        //MYMAP.map.fitBounds(MYMAP.bounds);

                                    }

                        });
                });
            }

        </script>
<?php
}

}


function wpgmaps_upload_csv() {
    if (!function_exists("wpgmaps_activate")) {
        echo "<div id='message' class='updated' style='padding:10px; '><span style='font-weight:bold; color:red;'>".__("WP Google Maps","wp-google-maps").":</span> ".__("Please ensure you have <strong>both</strong> the <strong>Basic</strong> and <strong>Pro</strong> versions of WP Google Maps installed and activated at the same time in order for the plugin to function correctly.","wp-google-maps")."<br /></div>";
    }
    
    
    if (isset($_POST['wpgmza_uploadcsv_btn'])) {

        if (is_uploaded_file($_FILES['wpgmza_csvfile']['tmp_name'])) {

        global $wpdb;
        global $wpgmza_tblname;
        $handle = fopen($_FILES['wpgmza_csvfile']['tmp_name'], "r");
        $header = fgetcsv($handle);

        unset ($wpgmza_errormsg);
        if ($header[0] != "id") { $wpgmza_errormsg = __("Header 1 should be 'id', not","wp-google-maps")." '$header[0]'<br />"; }
        if ($header[1] != "map_id") { $wpgmza_errormsg .= __("Header 2 should be 'map_id', not","wp-google-maps")." '$header[1]'<br />"; }
        if ($header[2] != "address") { $wpgmza_errormsg .= __("Header 3 should be 'address', not","wp-google-maps")." '$header[2]'<br />"; }
        if ($header[3] != "description") { $wpgmza_errormsg .= __("Header 4 should be 'description', not","wp-google-maps")." '$header[3]'<br />"; }
        if ($header[4] != "pic") { $wpgmza_errormsg .= __("Header 5 should be 'pic', not","wp-google-maps")." '$header[4]'<br />"; }
        if ($header[5] != "link") { $wpgmza_errormsg .= __("Header 6 should be 'link', not","wp-google-maps")." '$header[5]'<br />"; }
        if ($header[6] != "icon") { $wpgmza_errormsg .= __("Header 7 should be 'icon', not","wp-google-maps")." '$header[6]'<br />"; }
        if ($header[7] != "lat") { $wpgmza_errormsg .= __("Header 8 should be 'lat', not","wp-google-maps")." '$header[7]'<br />"; }
        if ($header[8] != "lng") { $wpgmza_errormsg .= __("Header 9 should be 'lng', not","wp-google-maps")." '$header[8]'<br />"; }
        if ($header[9] != "anim") { $wpgmza_errormsg .= __("Header 10 should be 'anim', not","wp-google-maps")." '$header[9]'<br />"; }
        if ($header[10] != "title") { $wpgmza_errormsg .= __("Header 11 should be 'title', not","wp-google-maps")." '$header[10]'<br />"; }
        if ($header[11] != "infoopen") { $wpgmza_errormsg .= __("Header 12 should be 'infoopen', not","wp-google-maps")." '$header[11]'<br />"; }
        if ($header[12] != "category") { $wpgmza_errormsg .= __("Header 13 should be 'category', not","wp-google-maps")." '$header[12]'<br />"; }
        if (isset($wpgmza_errormsg)) {
            echo "<div class='error below-h2'>".__("CSV import failed","wp-google-maps")."!<br /><br />$wpgmza_errormsg</div>";

        }
        else {
        while(! feof($handle)){
            if ($_POST['wpgmza_csvreplace'] == "Yes") { 
                $wpdb->query("TRUNCATE TABLE $wpgmza_tblname");
            }
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $ra = $wpdb->insert( $wpgmza_tblname, array(
                    $header[1] => $data[1],
                    $header[2] => $data[2],
                    $header[3] => $data[3],
                    $header[4] => $data[4],
                    $header[5] => $data[5],
                    $header[6] => $data[6],
                    $header[7] => $data[7],
                    $header[8] => $data[8],
                    $header[9] => $data[9],
                    $header[10] => $data[10],
                    $header[11] => $data[11],
                    $header[12] => $data[12]
                    )
                );
             }

        }
        fclose($handle);
        echo "<div class='error below-h2'>".__("Your CSV file has been successfully imported","wp-google-maps")."</div>";
        }
    }
    }

}

function wpgmza_cURL_response_pro($action) {
    if (function_exists('curl_version')) {
        global $wpgmza_pro_version;
        global $wpgmza_pro_string;
        $request_url = "http://www.wpgmaps.com/api/rec.php?action=$action&dom=".$_SERVER['HTTP_HOST']."&ver=".$wpgmza_pro_version.$wpgmza_pro_string;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
    }

}

function wpgmza_pro_advanced_menu() {
    $wpgmza_csv = "<a href=\"".wpgmaps_get_plugin_url()."/csv.php\" title=\"".__("Download ALL marker data to a CSV file","wp-google-maps")."\">".__("Download ALL marker data to a CSV file","wp-google-maps")."</a>";

    echo "
        <div class=\"wrap\"><div id=\"icon-tools\" class=\"icon32 icon32-posts-post\"><br></div><h2>".__("Advanced Options","wp-google-maps")."</h2>
        <div style=\"display:block; overflow:auto; background-color:#FFFBCC; padding:10px; border:1px solid #E6DB55; margin-top:35px; margin-bottom:5px;\">
            $wpgmza_csv
            <br /><br /><strong>- ".__("OR","wp-google-maps")." -<br /><br /></strong><form enctype=\"multipart/form-data\" method=\"POST\">
                ".__("Upload CSV File","wp-google-maps").": <input name=\"wpgmza_csvfile\" type=\"file\" /><br />
                <input name=\"wpgmza_security\" type=\"hidden\" value=\"$wpgmza_post_nonce\" /><br />
                ".__("Replace existing data with data in file","wp-google-maps").": <input name=\"wpgmza_csvreplace\" type=\"checkbox\" value=\"Yes\" /><br />
                <input type=\"submit\" name=\"wpgmza_uploadcsv_btn\" value=\"".__("Upload File","wp-google-maps")."\" />
            </form>
        </div>



    ";


}


function wpgmaps_settings_page_pro() {


    echo"<div class=\"wrap\"><div id=\"icon-edit\" class=\"icon32 icon32-posts-post\"><br></div><h2>".__("WP Google Map Settings","wp-google-maps")."</h2>";


    if (function_exists(wpgmza_register_pro_version)) {
        $pro_settings1 = wpgmaps_settings_page_sub('infowindow');
        $pro_settings2 = wpgmaps_settings_page_sub('mapsettings');
        $pro_settings3 = wpgmaps_settings_page_sub('ugm');
        global $wpgmza_version;
        if (floatval($wpgmza_version) < 5) {
            $prov_msg = "<div class='error below-h1'><p>Please update your BASIC version of this plugin for all of these settings to work.</p></div>";
        }
    }
    if (function_exists(wpgmza_register_ugm_version)) {
        $pro_settings3 = wpgmaps_settings_page_sub('ugm');
    }

    echo "

            <form action='' method='post' id='wpgmaps_options'>
                <p>$prov_msg</p>

                $pro_settings1
                $pro_settings2
                $pro_settings3

                <p class='submit'><input type='submit' name='wpgmza_save_settings' class='button-primary' value='".__("Save Settings","wp-google-maps")." &raquo;' /></p>


            </form>
    ";

    echo "</div>";






}
register_activation_hook( __FILE__, 'wpgmaps_pro_activate' );
register_deactivation_hook( __FILE__, 'wpgmaps_pro_deactivate' );


$wpgmaps_api_url = 'http://wpgmaps.com/apid/';
$wpgmaps_plugin_slug = basename(dirname(__FILE__));

// Take over the update check
add_filter('pre_set_site_transient_update_plugins', 'wpgmaps_check_for_plugin_update');

function wpgmaps_check_for_plugin_update($checked_data) {
	global $wpgmaps_api_url, $wpgmaps_plugin_slug, $wp_version;
	
	//Comment out these two lines during testing.
	if (empty($checked_data->checked))
		return $checked_data;
	
        
        
	$args = array(
		'slug' => $wpgmaps_plugin_slug,
		'version' => $checked_data->checked[$wpgmaps_plugin_slug .'/'. $wpgmaps_plugin_slug .'.php'],
	);
	$request_string = array(
			'body' => array(
				'action' => 'basic_check', 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);
	
	// Start checking for an update
	$raw_response = wp_remote_post($wpgmaps_api_url, $request_string);
        
        
	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
		$response = unserialize($raw_response['body']);
	
	if (is_object($response) && !empty($response)) // Feed the update data into WP updater
		$checked_data->response[$wpgmaps_plugin_slug .'/'. $wpgmaps_plugin_slug .'.php'] = $response;
	
	return $checked_data;
}



add_filter('plugins_api', 'wpgmaps_plugin_api_call', 10, 3);

function wpgmaps_plugin_api_call($def, $action, $args) {
	global $wpgmaps_plugin_slug, $wpgmaps_api_url, $wp_version;
	
	if (!isset($args->slug) || ($args->slug != $wpgmaps_plugin_slug))
		return false;
	
	// Get the current version
	$plugin_info = get_site_transient('update_plugins');
	$current_version = $plugin_info->checked[$wpgmaps_plugin_slug .'/'. $wpgmaps_plugin_slug .'.php'];
	$args->version = $current_version;
	
	$request_string = array(
			'body' => array(
				'action' => $action, 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);
	
	$request = wp_remote_post($wpgmaps_api_url, $request_string);
	
	if (is_wp_error($request)) {
		$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);
		
		if ($res === false)
			$res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
	}
	
	return $res;
}



function wpgmaps_settings_page_sub($section) {

    if ($section == "ugm") {
        if (function_exists(wpgmaps_ugm_settings_page)) { return wpgmaps_ugm_settings_page(); }
        else { return ""; }
    }

    if ($section == "mapsettings") {
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
        $wpgmza_settings_map_streetview = $wpgmza_settings['wpgmza_settings_map_streetview'];
        $wpgmza_settings_map_zoom = $wpgmza_settings['wpgmza_settings_map_zoom'];
        $wpgmza_settings_map_pan = $wpgmza_settings['wpgmza_settings_map_pan'];
        $wpgmza_settings_map_type = $wpgmza_settings['wpgmza_settings_map_type'];
        $wpgmza_settings_map_scroll = $wpgmza_settings['wpgmza_settings_map_scroll'];
        $wpgmza_settings_map_draggable = $wpgmza_settings['wpgmza_settings_map_draggable'];
        $wpgmza_settings_map_clickzoom = $wpgmza_settings['wpgmza_settings_map_clickzoom'];
        $wpgmza_force_jquery = $wpgmza_settings['wpgmza_settings_force_jquery'];
        $wpgmza_settings_markerlist_category = $wpgmza_settings['wpgmza_settings_markerlist_category'];
        
        if ($wpgmza_settings_map_streetview == "yes") { $wpgmza_streetview_checked = "checked='checked'"; }
        if ($wpgmza_settings_map_zoom == "yes") { $wpgmza_zoom_checked = "checked='checked'"; }
        if ($wpgmza_settings_map_pan == "yes") { $wpgmza_pan_checked = "checked='checked'"; }
        if ($wpgmza_settings_map_type == "yes") { $wpgmza_type_checked = "checked='checked'"; }
        if ($wpgmza_settings_map_scroll == "yes") { $wpgmza_scroll_checked = "checked='checked'"; }
        if ($wpgmza_settings_map_draggable == "yes") { $wpgmza_draggable_checked = "checked='checked'"; }
        if ($wpgmza_settings_map_clickzoom == "yes") { $wpgmza_clickzoom_checked = "checked='checked'"; }
        if ($wpgmza_force_jquery == "yes") { $wpgmza_force_jquery_checked = "checked='checked'"; }
        if ($wpgmza_settings_markerlist_category == "yes") { $wpgmza_hide_category_checked = "checked='checked'"; }
    


        return "
            <h3>".__("Map Settings","wp-google-maps")."</h3>
                <table class='form-table'>
                    <tr>
                         <td width='200' valign='top'>".__("General Map Settings","wp-google-maps").":</td>
                         <td>
                                <input name='wpgmza_settings_map_streetview' type='checkbox' id='wpgmza_settings_map_streetview' value='yes' $wpgmza_streetview_checked /> ".__("Disable StreetView","wp-google-maps")."<br />
                                <input name='wpgmza_settings_map_zoom' type='checkbox' id='wpgmza_settings_map_zoom' value='yes' $wpgmza_zoom_checked /> ".__("Disable Zoom Controls","wp-google-maps")."<br />
                                <input name='wpgmza_settings_map_pan' type='checkbox' id='wpgmza_settings_map_pan' value='yes' $wpgmza_pan_checked /> ".__("Disable Pan Controls","wp-google-maps")."<br />
                                <input name='wpgmza_settings_map_type' type='checkbox' id='wpgmza_settings_map_type' value='yes' $wpgmza_type_checked /> ".__("Disable Map Type Controls","wp-google-maps")."<br />
                                <input name='wpgmza_settings_map_scroll' type='checkbox' id='wpgmza_settings_map_scroll' value='yes' $wpgmza_scroll_checked /> ".__("Disable Mouse Wheel Zoom","wp-google-maps")."<br />
                                <input name='wpgmza_settings_map_draggable' type='checkbox' id='wpgmza_settings_map_draggable' value='yes' $wpgmza_draggable_checked /> ".__("Disable Mouse Dragging","wp-google-maps")."<br />
                                <input name='wpgmza_settings_map_clickzoom' type='checkbox' id='wpgmza_settings_map_clickzoom' value='yes' $wpgmza_clickzoom_checked /> ".__("Disable Mouse Double Click Zooming","wp-google-maps")."<br />
                        </td>
                    </tr>
                    <tr>
                         <td width='200' valign='top'>".__("Marker Listing Settings","wp-google-maps").":</td>
                         <td>
                                <input name='wpgmza_settings_markerlist_category' type='checkbox' id='wpgmza_settings_markerlist_category' value='yes' $wpgmza_hide_category_checked /> ".__("Hide the Category column","wp-google-maps")."<br />
                        </td>
                    </tr>
                    <tr>
                         <td width='200' valign='top'>".__("Troubleshooting Options","wp-google-maps").":</td>
                         <td>
                                <input name='wpgmza_settings_force_jquery' type='checkbox' id='wpgmza_settings_force_jquery' value='yes' $wpgmza_force_jquery_checked /> ".__("Over-ride current jQuery with version 1.8.3 (Tick this box if you are receiving jQuery related errors)")."<br />
                        </td>
                    </tr>
                    
                </table>
            ";




    }

    if ($section == "infowindow") {
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
        $wpgmza_set_img_width = $wpgmza_settings['wpgmza_settings_image_width'];
        $wpgmza_set_img_height = $wpgmza_settings['wpgmza_settings_image_height'];
        $wpgmza_set_use_timthumb = $wpgmza_settings['wpgmza_settings_use_timthumb'];
        $wpgmza_settings_infowindow_links = $wpgmza_settings['wpgmza_settings_infowindow_links'];
        $wpgmza_settings_infowindow_address = $wpgmza_settings['wpgmza_settings_infowindow_address'];

        $wpgmza_settings_infowindow_width = $wpgmza_settings['wpgmza_settings_infowindow_width'];

        if ($wpgmza_set_use_timthumb == "yes") { $wpgmza_timchecked = "checked='checked'"; }
        if (!isset($wpgmza_set_img_width) || $wpgmza_set_img_width == "") { $wpgmza_set_img_width = "100"; }
        if (!isset($wpgmza_set_img_height) || $wpgmza_set_img_height == "" ) { $wpgmza_set_img_height = "100"; }
        if (!isset($wpgmza_settings_infowindow_width) || $wpgmza_settings_infowindow_width == "") { $wpgmza_settings_infowindow_width = "200"; }
        if ($wpgmza_settings_infowindow_links == "yes") { $wpgmza_linkschecked = "checked='checked'"; }
        if ($wpgmza_settings_infowindow_address == "yes") { $wpgmza_addresschecked = "checked='checked'"; }

        return "
                <h3>".__("InfoWindow Settings","wp-google-maps")."</h3>
                <table class='form-table'>
                    <tr>
                         <td width='200'>".__("Default Image Width","wp-google-maps").":</td>
                         <td><input id='wpgmza_settings_image_width' name='wpgmza_settings_image_width' type='text' size='4' maxlength='4' value='$wpgmza_set_img_width' /> px </td>
                    </tr>
                    <tr>
                         <td>".__("Default Image Height","wp-google-maps").":</td>
                         <td><input id='wpgmza_settings_image_height' name='wpgmza_settings_image_height' type='text' size='4' maxlength='4' value='$wpgmza_set_img_height' /> px </td>
                    </tr>
                    <tr>
                         <td>".__("Image Thumbnails","wp-google-maps").":</td>
                         <td>
                                <input name='wpgmza_settings_use_timthumb' type='checkbox' id='wpgmza_settings_use_timthumb' value='yes' $wpgmza_timchecked /> ".__("Do not use TimThumb","wp-google-maps")." <em>
                                ".__("(Tick this if you are having problems viewing your thumbnail images)","wp-google-maps")."</em>
                        </td>
                    </tr>
                    <tr>
                         <td>".__("Max InfoWindow Width","wp-google-maps").":</td>
                         <td><input id='wpgmza_settings_infowindow_width' name='wpgmza_settings_infowindow_width' type='text' size='4' maxlength='4' value='$wpgmza_settings_infowindow_width' /> px <em>".__("(Minimum: 200px)","wp-google-maps")."</em></td>
                    </tr>
                    <tr>
                         <td>".__("Other settings","wp-google-maps").":</td>
                         <td>
                                <input name='wpgmza_settings_infowindow_links' type='checkbox' id='wpgmza_settings_infowindow_links' value='yes' $wpgmza_linkschecked /> ".__("Open links in a new window","wp-google-maps")." <em>
                                ".__("(Tick this if you want to open your links in a new window)","wp-google-maps")."</em>
                                <br /><input name='wpgmza_settings_infowindow_address' type='checkbox' id='wpgmza_settings_infowindow_address' value='yes' $wpgmza_addresschecked /> ".__("Hide the address field","wp-google-maps")."<br />
                        </td>
                    </tr>

                </table>
                <br /><br />
        ";


    }
}
function wpgmza_version_check() {
  global $wpgmza_version;
  $wpgmza_vc = floatval($wpgmza_version);
  if ($wpgmza_vc < 5.01) {
      echo "<div class='error below-h1'><big><Br />Please <a href=\"plugins.php\">update</a> your WP Google Maps (basic) version to 5.01     or newer in order to make use of the new functionality.<br /><br />
          Your version: $wpgmza_version<br /><Br /></big></div>";
  }

}
