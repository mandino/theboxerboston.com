<?php
/*
 * Plugin Name: Canonical Attachments
 * Description: Get better information from analytics and higher rankings by utilizing the canonical http header in htaccess to pass all authority to an html page url.  Plugin will create a file at /wp-content/uploads/.htaccess if it doesn't exist already.
 * Author: Jake Bohall -- @hivedigital, @jblifestyles
 * Author URI: http://www.hivedigital.com/
 * Version: 1.5
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

// run the install scripts upon plugin activation
register_activation_hook(__FILE__,'can_attach_plugin_install');

// Creates htaccess file on install...
function can_attach_plugin_install(){
    $directory = wp_upload_dir();
    $ht_access_file = $directory['basedir'] . '/.htaccess'; 
    $exists = file_get_contents($ht_access_file, true);
    $content = "### .htaccess file for managing attachment canonicals ###";
    if ($exists == FALSE){
        $f = fopen( $ht_access_file, 'w+' );
        fwrite( $f, $content );
        fclose( $f ); 
        can_attach_create_notice(".htaccess file created at $ht_access_file",'success');
    }else{
        can_attach_create_notice(".htaccess file already existed at $ht_access_file, so we didn't need to create one!",'warning');
    }
}

// Creates a settings link on the main plugins.php page
function plugin_add_settings_link( $links ) {
    $settings_link = '<a href="upload.php?page=canonical-attachments">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
      return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'plugin_add_settings_link' );

// run the deactive script when deactivated
register_deactivation_hook( __FILE__, 'can_attach_plugin_deactivate' );

// Generates notice on deactivation...
function can_attach_plugin_deactivate(){
    echo "<script>alert('htaccess file will not be deleted, and will continue to exist in /wp-content/uploads directory.  Any existing directives will remain in place unless they are removed from this file, or the file is deleted. Odds are, this file was created by the plugin, and is otherwise unnecessary')</script>";
} 

// Type options are  error, warning, success 
function can_attach_create_notice($message, $type="updated"){
    $notices = get_option('can_attach_admin_notices', array());
    $notice = array(
        'message' => $message
        ,'type' => $type
        );
    $notices[] = $notice;
    update_option('can_attach_admin_notices', $notices);
}

// Printing out any notices
add_action('admin_notices', 'can_attach_admin_notices');
function can_attach_admin_notices() {
  if ($notices= get_option('can_attach_admin_notices')) {
    foreach ($notices as $notice) {
        $type = $notice['type'];
        $message = $notice['message'];
        echo "<div class='notice notice-$type is-dismissible'><p>$message</p></div>";
    }
    delete_option('can_attach_admin_notices');
  }
}

// Adds field to media page for canonical URL entry for non-images
function can_attach_canonical_fields( $form_fields, $post ) {
    if ( !wp_attachment_is_image( $post->ID)){
        $form_fields['canonical-url'] = array(
            'label'         => 'Canonical URL'
            ,'input'         => 'text'
            ,'value'         => get_post_meta( $post->ID , 'canonical_url', true )
            ,'show_in_edit'  => true
            ,'show_in_modal' => true
            ,'helps'         => 'Add Canonical URL, including '.get_site_url()
        );
        return $form_fields;
    }
}
add_filter( 'attachment_fields_to_edit', 'can_attach_canonical_fields', 10, 2 );

// This processes the post back from the media pages
function can_attach_update_media_canonical($post, $attachment){
    if( isset( $attachment['canonical-url'] ) ) {
        $canonical = $attachment['canonical-url'];
        $id = $post['ID'];
        can_attach_update_single_canonical($id, $canonical);
    }
    return $post;
}
add_filter( 'attachment_fields_to_save', 'can_attach_update_media_canonical', 10, 2 );

// This function removes any canonical tags when a media file gets deleted
function can_attach_deleted_media_canonical_removal($post){
    can_attach_remove_from_htaccess($post);
    return $post;
}
add_filter( 'delete_attachment', 'can_attach_deleted_media_canonical_removal', 10, 2 );

// This function processes the update for a canonical
function can_attach_update_single_canonical($id, $canonical = ""){
    $filename = basename(get_attached_file($id));
    $fileurl = wp_get_attachment_url($id );
    //die("ID: $id --- filename: $filename --- canonical: $esc_canonical --- fileurl: $fileurl");
    if ( $canonical == ""){
        //die("EMPTY CANONICAL");
        can_attach_remove_from_htaccess($id);
        can_attach_create_notice("Any prior canonicals for <a href='$fileurl' target='_Blank'>$filename</a> have been cleared!",'warning');
        update_post_meta( $id, 'canonical_url', $canonical ); 
    }else{
        //$canonical = filter_var($canonical, FILTER_SANITIZE_URL);
        if(!filter_var($canonical, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) === false){
            $esc_canonical = esc_url($canonical);
            can_attach_remove_from_htaccess($id);
            can_attach_create_canonical( $id,$filename, $esc_canonical);
            can_attach_create_notice("Any prior canonicals for <a href='$fileurl' target='_Blank'>$filename</a> have been cleared! and .htaccess updated with canonical from <a href='$fileurl' target='_Blank'>$filename</a> to <a href='$canonical' target='_Blank'>$canonical</a>",'success'); 
            update_post_meta( $id, 'canonical_url', $esc_canonical ); 
        }else{
            can_attach_create_notice("ERROR: Canonical attempted for <a href='$fileurl' target='_Blank'>$filename</a> - <a href='$canonical' target='_Blank'>$canonical</a> was not a valid URL",'error'); 
        }
    }
    //die("ID: $id --- filename: $filename --- canonical: $esc_canonical --- fileurl: $fileurl");
}

// This creates the canonical tag in the htaccess file
function can_attach_create_canonical($id,$filename,$canonical){
    //die("ID: $id --- filename: $filename --- canonical: $canonical");
    $directory = wp_upload_dir();
    $ht_access_file = $directory['basedir'] . '/.htaccess'; 
    $header = "<Files \"$filename\">
Header add Link \"<$canonical>; rel=\\\"canonical\\\"\"
</Files>";
    insert_with_markers($ht_access_file, 'Canonical '.$id,$header);
}
 
// Removes the rel canonical if present in the .htaccess file already
function can_attach_remove_from_htaccess($id){
    $directory = wp_upload_dir();
    $ht_access_file = $directory['basedir'] . '/.htaccess'; 
    $oldfile = file_get_contents($ht_access_file, true);   
    $newfile = preg_replace('/(.|\n)# BEGIN Canonical '.$id.'(.*)# END Canonical '.$id.'/s', '',$oldfile); 
    //echo 'alert("'.$newfile.'")';
    //die ();
    if ( is_writeable( $ht_access_file ) ) {
        $f = fopen( $ht_access_file, 'w+' );
        fwrite( $f, $newfile );
        fclose( $f );
    }
}

// Adds Page to the Media Menu in Dashboard
function can_attach_canonical_attachments_menu() {
    add_media_page( 'Canonicals', 'Canonicals', 'manage_options', 'canonical-attachments/', 'canonical_attachments_plugin' );
    add_submenu_page( null, 'Edit .htaccess', 'Edit .htaccess', 'manage_options', 'htaccess-edits', 'can_attach_htaccess_edits' );
    //add_submenu_page( null, 'Attach Post', 'Attach Post', 'manage_options', 'can-attach-post', 'can_attach_attach_post' );    
}  
add_action( 'admin_menu', 'can_attach_canonical_attachments_menu' );

// Page to edit the media htaccess directly
function can_attach_htaccess_edits(){
    include ('templates/header.php');
    echo "<h3>Canonical Attachments</h3>";
    echo "<p>Use this to make direct edits to the uploads directory htaccess file. <strong>DON'T UNLESS YOU KNOW WHAT YOU ARE DOING!!</strong><br />Please note that <strong>edits here will not be reflected in the media library or on the canonical attachments page</strong> and must be managed manually!<br />It is <strong>strongly recommended</strong> that you add canonicals using the <a href='".network_admin_url( 'upload.php?page=canonical-attachments' )."'>bulk editor</a> or directly on the attachment within the libary and <strong>only use</strong> this if there are files manually added to the uploads directory (eg. via FTP).</p>";
    echo "<p>Adding a canonical should follow this format:<br />";
    echo "<textarea cols='100' rows='3'><Files \"example-file.pdf\">\nHeader add Link \"<http://www.your-site.com/canonical-url>; rel=\\\"canonical\\\"\"\n</Files></textarea>";
    include ('tools/htaccess-edits.php');
    include ('templates/footer.php');
}

// This is the main page for the plugin
function canonical_attachments_plugin() {
    include ('templates/header.php');
    echo "<h3>Canonical Attachments</h3>";
    echo "<p>This plugin allows you to add canonical tags to media files in your library. For advanced users, you can view and make direct edits to the .htaccess placed in your wp-content/uploads directly <a href='".network_admin_url( 'upload.php?page=htaccess-edits' )."'>here</a>.</p>";  
    include ('tools/bulk-editor.php');
    include ('templates/footer.php');
}

// This is just a function to push content out into divs...
function can_attach_postbox( $id, $title, $content ) {
    ?>
            <div id="<?php echo esc_attr( $id ); ?>" class="conattach">
                <h1><?php echo $title; ?></h1>
                <?php echo $content; ?>
            </div>
        <?php
}

function can_attach_style_columns() {
    $page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
    if($page != 'canonical-attachments'){
        return;     
    }else{ 
        echo '<style type="text/css">';
        echo '.wp-list-table .column-id { width: 5%; }';
        echo '.wp-list-table .column-post_title { width: 40%; }';
        echo '.wp-list-table .column-canonical { width: 30%; }';
        echo '.wp-list-table .column-post_parent { width: 25%; }';
        echo '</style>';
    }
} 
add_action( 'admin_head', 'can_attach_style_columns'); 

function can_attach_post_box(){
    //print_r($_POST);
    // Enqueue our scripts
    wp_enqueue_style('thickbox');
    wp_enqueue_script('thickbox'); // needed for find posts div
    wp_enqueue_script('media');
    wp_enqueue_script('wp-ajax-response');
    
    // Print the form for finding posts...
    echo '<form name="attach-to-post" method="post" action="?page=canonical-attachments&action=attach-post">';
    find_posts_div();
    echo wp_nonce_field( 'conattach-attach-post', '_wpnonce', true, false );
    echo '</form>';
}
add_filter('admin_footer','can_attach_post_box');
        
?>