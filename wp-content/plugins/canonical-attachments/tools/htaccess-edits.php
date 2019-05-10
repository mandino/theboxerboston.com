<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

// Make sure user has permissions
if ( !current_user_can('manage_options') )
    wp_die( __( 'You do not have permission to be here.' ) );
    
$directory = wp_upload_dir();
$ht_access_file = $directory['basedir'] . '/.htaccess'; 

if ( isset( $_POST['submithtaccess'] ) ) {
    if ( ! current_user_can( 'manage_options' ) ) {
        die( __( 'You cannot edit the .htaccess file.', 'canonical-attachments' ) );
    }
    check_admin_referer( 'conattach-htaccess' );

    if ( file_exists( $ht_access_file ) ) {
        $ht_access_new = stripslashes( $_POST['htaccessnew'] );
        if ( is_writeable( $ht_access_file ) ) {
            $f = fopen( $ht_access_file, 'w+' );
            fwrite( $f, $ht_access_new );
            fclose( $f );
            $msg = "File Updated! I hope you know what you were doing!!";
            $msg_type = "updated";
        }else{
            $msg = "Unable to update file. .htaccess file is not writeable!";
            $msg_type = "error";
        }
    }
}

if ( isset( $msg ) && ! empty( $msg ) ) {
    echo '<div id="message" style="width:94%;" class="'.$msg_type.' fade"><p>' . esc_html( $msg ) . '</p></div>';
}

$action_url = network_admin_url( 'upload.php?page=htaccess-edits' );

if ( ( isset( $_SERVER['SERVER_SOFTWARE'] ) && stristr( $_SERVER['SERVER_SOFTWARE'], 'nginx' ) === false ) && file_exists( $ht_access_file )) {
    $f = fopen( $ht_access_file, 'r' );
    $contentht = '';
    if ( filesize( $ht_access_file ) > 0 ) {
        $contentht = fread( $f, filesize( $ht_access_file ) );
    }
    $contentht = esc_textarea( $contentht ); 
    if ( ! is_writable( $ht_access_file ) ) {
        $content  = '<p><em>' . __( 'If your .htaccess were writable, you could edit it from here.', 'canonical-attachments' ) . '</em></p>';
        $content .= '<textarea class="large-text code" disabled="disabled" rows="15" name="robotsnew">' . $contentht . '</textarea><br/>';
    } else {
        $content  = '<form action="' . esc_url( $action_url ) . '" method="post" id="htaccessform">';
        $content .= wp_nonce_field( 'conattach-htaccess', '_wpnonce', true, false );
        $content .= '<p>' . __( 'Edit the content of your media directory .htaccess:', 'canonical-attachments' ) . '</p>';
        $content .= '<textarea class="large-text code" rows="30" name="htaccessnew">' . $contentht . '</textarea><br/>';
        $content .= '<div class="submit"><input class="button" type="submit" onclick="return confirm(\'DO NOT DO THIS UNLESS YOU KNOW WHAT YOU ARE DOING!!\')" name="submithtaccess" value="' . __( 'Save changes to .htaccess', 'canonical-attachments' ) . '" /></div>';
        $content .= '</form>';
    }
    can_attach_postbox( 'htaccess', 'Media Directory .htaccess', $content );
} elseif ( ( isset( $_SERVER['SERVER_SOFTWARE'] ) && stristr( $_SERVER['SERVER_SOFTWARE'], 'nginx' ) === false ) && ! file_exists( $ht_access_file ) ) {

    $content = '<p>' . __( 'If you had a .htaccess file and it was editable, you could edit it from here.', 'canonical-attachments' );
    can_attach_postbox( 'htaccess', 'Media Directory .htaccess', $content );
}
?>