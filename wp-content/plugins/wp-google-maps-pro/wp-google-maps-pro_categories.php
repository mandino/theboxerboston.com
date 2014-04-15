<?php
/*
Marker Category functionality for WP Google Maps Pro


*/


function wpgmaps_menu_category_layout() {


    if ($_GET['action'] == "") {

        if (function_exists('wpgmza_register_pro_version')) {
            echo"<div class=\"wrap\"><div id=\"icon-edit\" class=\"icon32 icon32-posts-post\"><br></div><h2>".__("Marker Categories","wp-google-maps")." <a href=\"admin.php?page=wp-google-maps-menu-categories&action=new\" class=\"add-new-h2\">".__("Add New Category","wp-google-maps")."</a></h2>";
            wpgmaps_list_categories();
        } else {
            echo"<div class=\"wrap\"><div id=\"icon-edit\" class=\"icon32 icon32-posts-post\"><br></div><h2>".__("Marker Categories","wp-google-maps")."</h2>";
            echo"<p><i><a href='http://www.wpgmaps.com/purchase-professional-version/?utm_source=plugin&utm_medium=link&utm_campaign=category' title='".__("Pro Version","wp-google-maps")."'>".__("Create marker categories","wp-google-maps")."</a> ".__("with the","wp-google-maps")." <a href='http://www.wpgmaps.com/purchase-professional-version/?utm_source=plugin&utm_medium=link&utm_campaign=category' title='Pro Version'>".__("Pro Version","wp-google-maps")."</a> ".__("of WP Google Maps for only","wp-google-maps")." <strong>$14.99!</strong></i></p>";


        }
        echo "</div>";
        echo"<br /><div style='float:right;'><a href='http://www.wpgmaps.com/documentation/troubleshooting/' title='WP Google Maps Troubleshooting Section'>".__("Problems with the plugin? See the troubleshooting manual.","wp-google-maps")."</a></div>";
    } else {

        if ($_GET['action'] == "new") {
            wpgmza_pro_category_new_layout();
        }
        if ($_GET['action'] == "edit") {
            wpgmza_pro_category_edit_layout($_GET['cat_id']);
        }

    }

}

function wpgmza_pro_category_new_layout() {

    echo "<div class='wrap'>";
    echo "  <h1>WP Google Maps</h1>";
    echo "  <div class='wide'>";
    echo "      <h2>".__("Add a Marker Category","wp-google-maps")."</h2>";
    echo "      <form action='admin.php?page=wp-google-maps-menu-categories' method='post' id='wpgmaps_add_marker_category'>";
    echo "          Category Name: <input type='text' name='wpgmaps_marker_category_name' id='wpgmaps_marker_category_name' value='' /><br />";
    echo "          <p class='submit'><input type='submit' name='wpgmza_save_marker_category' class='button-primary' value='".__("Save Category","wp-google-maps")." &raquo;' /></p>";
    echo "      </form>";
    echo "  </div>";
    echo "</div>";

}
function wpgmza_pro_category_edit_layout($cat_id) {

    global $wpdb;
    global $wpgmza_tblname_categories;
    $results = $wpdb->get_results("
	  SELECT *
	  FROM $wpgmza_tblname_categories
	  WHERE `id` = '$cat_id' LIMIT 1
    ");


    echo "<div class='wrap'>";
    echo "  <h1>WP Google Maps</h1>";
    echo "  <div class='wide'>";
    echo "      <h2>".__("Add a Marker Category","wp-google-maps")."</h2>";
    echo "      <form action='admin.php?page=wp-google-maps-menu-categories' method='post' id='wpgmaps_add_marker_category'>";
    echo "          <input type='hidden' name='wpgmaps_marker_category_id' id='wpgmaps_marker_category_id' value='".$results[0]->id."' />";
    echo "          Category Name: <input type='text' name='wpgmaps_marker_category_name' id='wpgmaps_marker_category_name' value='".$results[0]->category_name."' /><br />";
    echo "          <p class='submit'><input type='submit' name='wpgmza_edit_marker_category' class='button-primary' value='".__("Save Category","wp-google-maps")." &raquo;' /></p>";
    echo "      </form>";
    echo "  </div>";
    echo "</div>";

}
add_action('admin_head', 'wpgmaps_category_head');
function wpgmaps_category_head() {

    if ($_GET['page'] == "wp-google-maps-menu-categories" && isset($_POST['wpgmza_save_marker_category'])) {
        if (isset($_POST['wpgmza_save_marker_category'])){
            global $wpdb;
            global $wpgmza_tblname_categories;
            $wpgmaps_category_name = esc_attr($_POST['wpgmaps_marker_category_name']);


            $rows_affected = $wpdb->query( $wpdb->prepare(
                    "INSERT INTO $wpgmza_tblname_categories SET
                        category_name = %s,
                        active = %d,
                        category_icon = %s


                    ",
                    $wpgmaps_category_name,
                    0,
                    ''
                )
            );
            echo "<div class='updated'>";
            _e("Your category has been created.","wp-google-maps");
            echo "</div>";


        }

    }
    if ($_GET['page'] == "wp-google-maps-menu-categories" && isset($_POST['wpgmza_edit_marker_category'])) {
            global $wpdb;
            global $wpgmza_tblname_categories;
            $wpgmaps_cid = esc_attr($_POST['wpgmaps_marker_category_id']);
            $wpgmaps_category_name = esc_attr($_POST['wpgmaps_marker_category_name']);

            $rows_affected = $wpdb->query( $wpdb->prepare(
                "UPDATE $wpgmza_tblname_categories SET

                category_name = %s,
                active = %d,
                category_icon = %s
                WHERE
                id = %d",
                $wpgmaps_category_name,
                0,
                '',
                $wpgmaps_cid) );

            echo "<div class='updated'>";
            _e("Your category has been saved.","wp-google-maps");
            echo "</div>";
    }
}

function wpgmza_pro_return_category_select_list() {
    global $wpdb;
    global $wpgmza_tblname_categories;
    $results = $wpdb->get_results("
	SELECT *
	FROM `$wpgmza_tblname_categories`
        WHERE `active` = 0
        ORDER BY `id` DESC
	");
    $ret_msg = "";
    $ret_msg .= "<option value=\"0\">".__("Select","wp-google-maps")."</option>";
    foreach ( $results as $result ) {
        $ret_msg .= "<option value=\"".$result->id."\">".$result->category_name."</option>";
    }
    return $ret_msg;

}
function wpgmaps_list_categories() {
    global $wpdb;
    global $wpgmza_tblname_categories;

    $results = $wpdb->get_results("
	SELECT *
	FROM `$wpgmza_tblname_categories`
        WHERE `active` = 0
        ORDER BY `id` DESC
	");

    echo "<table class=\"wp-list-table widefat fixed \" cellspacing=\"0\">";
    echo "  <thead>";
	echo "      <tr>";
    echo "          <th scope='col' width='100px' id='id' class='manage-column column-id sortable desc' style=''><span>".__("ID","wp-google-maps")."</span></th>";
    echo "          <th scope='col' id='map_title' class='manage-column column-map_title sortable desc'  style=''><span>".__("Category","wp-google-maps")."</span></th>";
    echo "          <th scope='col' id='map_width' class='manage-column column-map_width' style=\"\">".__("Icon","wp-google-maps")."</th>";
    echo "      </tr>";
    echo "  </thead>";
    echo "<tbody id=\"the-list\" class='list:wp_list_text_link'>";

    foreach ( $results as $result ) {
        $trashlink = "| <a href=\"?page=wp-google-maps-menu-category&action=trash&cat_id=".$result->id."\" title=\"Trash\">".__("Trash","wp-google-maps")."</a>";

        echo "<tr id=\"record_".$result->id."\">";
        echo "  <td class='id column-id'>".$result->id."</td>";
        echo "  <td class='map_title column-map_title'><strong><big><a href=\"?page=wp-google-maps-menu-categories&action=edit&cat_id=".$result->id."\" title=\"".__("Edit","wp-google-maps")."\">".$result->category_name."</a></big></strong><br /><a href=\"?page=wp-google-maps-menu-categories&action=edit&cat_id=".$result->id."\" title=\"".__("Edit","wp-google-maps")."\">".__("Edit","wp-google-maps")."</a> $trashlink</td>";
        echo "  <td class='map_width column-map_width'>".$result->category_icon."</td>";
        echo "</tr>";
    }
    echo "</table>";
}
