<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

// Make sure user has permissions
if ( ! current_user_can( 'manage_options' ) ) {
    die( __( 'You cannot edit canonical attachments.', 'canonical-attachments' ) );
}
    
function can_attach_get_action() {
    if ( isset( $_GET['action'] ) && -1 != $_GET['action'] )
        return esc_attr($_GET['action']);
    if ( isset( $_GET['action2'] ) && -1 != $_GET['action2'] )
        return esc_attr($_GET['action2']); 
    return false;
}
$action = can_attach_get_action();

// Handling for different actions in the form..
if ($action){
    $url = '?page='.$_REQUEST['page'];
    switch( $action ) { 
        case 'edit_canonical':
            $id = $_GET['attachment'];
            if (!is_numeric($id)){exit();}
            check_admin_referer( 'conattach-edit-canonical');
            $title = get_the_title($id);
            $prev_canonical = get_post_meta( $id , 'canonical_url', true );
            $content = '<form method="post" action="'.$url.'&action=update_canonical&attachment='.$id.'"/>';
            $content .= "<br />Canonical:<input type='text' name='canonical_url' size='150' label='Canonical URL' value='$prev_canonical'/>";
            $content .= wp_nonce_field( 'conattach-single-update', '_wpnonce', true, false );
            $content .= "<input type='submit' value='Update Canonical' />";
            $content .= "<br />Enter the new canonical URL, including ".site_url().". If this is blank when you save, any existing canonicals will be removed!!";
            $content .= "</form>";
            can_attach_postbox( $id, 'Update Canonical for '.$title, $content );
            break;
        case 'update_canonical':
            $id = $_GET['attachment'];
            if (!is_numeric($id)){exit();} 
            check_admin_referer( 'conattach-single-update' );           
            if (isset($_POST['canonical_url'])){
                $new_canonical = $_POST['canonical_url'];
                $esc_new_canonical = esc_url($new_canonical);
                can_attach_update_single_canonical($id, $esc_new_canonical);
                echo "<script>window.location = '$url';</script>";
            }
            break;
        case 'remove_canonical':
            $id = $_GET['attachment'];
            if (!is_numeric($id)){exit();}  
            check_admin_referer( 'conattach-remove-canonical' );                 
            can_attach_update_single_canonical($id);
            break;                        
        case 'bulk_remove_canonical':
            check_admin_referer( 'bulk-media_page_canonical-attachments' );                 
            foreach($_GET['attachment'] as $id){
                if (!is_numeric($id)){exit();}
                can_attach_update_single_canonical($id);
            }
            break;
        case 'canonical_to_attachment':
            $id = $_GET['attachment'];
            if (!is_numeric($id)){exit();}
            check_admin_referer( 'conattach-link-canonical' );                 
            $title = get_the_title($id);
            $parent = wp_get_post_parent_id( $id );
            if ($parent != ''){
                $new_canonical = get_permalink( $parent);
                can_attach_update_single_canonical($id, $new_canonical);
            }else{
                can_attach_create_notice("Skipped Attachment $id - $title - does not have an attached post",'error');
            }
            break;            
        case 'bulk_link_parent':
            foreach($_GET['attachment'] as $id){
                if (!is_numeric($id)){exit();}
                check_admin_referer( 'bulk-media_page_canonical-attachments' );
                $title = get_the_title($id);
                $parent = wp_get_post_parent_id( $id );
                if ($parent != ''){
                    $new_canonical = get_permalink( $parent);
                    can_attach_update_single_canonical($id, $new_canonical);
                }else{
                    can_attach_create_notice("Skipped Attachment $id - $title - does not have an attached post",'error');
                }
            }
            break;
        case 'attach-post':
            if(!isset($_POST['media_id'])){exit();}
            check_admin_referer( 'conattach-attach-post' );
            $parent_id = $_POST['found_post_id'];
            $attach_id = (int) $_POST['media_id'];
            
            global $wpdb;
            $attached = $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_parent = %d WHERE post_type = 'attachment' AND ID IN ( %d )", $parent_id, $attach_id ) );
            
            if($attached){
                can_attach_create_notice('Media Attached to Post', $type="updated");
            }else{
                can_attach_create_notice('Attaching Media to Post Failed', $type="warning");
            }
            break;
        case 'detach-post':
            $id = $_GET['attachment'];
            if (!is_numeric($id)){exit();}  
            check_admin_referer( 'conattach-detach-post' );                 
            global $wpdb;
            $attached = $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_parent = %d WHERE post_type = 'attachment' AND ID IN ( %d )", '', $id ) );
            if($attached){
                can_attach_create_notice('Media Removed From Post', $type="updated");
            }else{
                can_attach_create_notice('Error Attempting to Detach from Post', $type="warning");
            }
            break;             
        default:
            echo "Action needs to be defined";
            break;
    }
    if($action != 'edit_canonical'){
        echo "<div class='notice notice-error is-dismissible'><h2>Processing, please wait!</h2></div>";
        echo "<script>setTimeout(function(){ window.location = '$url';}, 2500 );</script>";
    }
}

if ( !current_user_can('upload_files') )
    wp_die( __( 'You do not have permission to upload files.' ) );
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Can_Attach_Attachment_List_Table extends WP_List_Table {
    
    private $can_attach_no_canonicals_count;
    private $can_attach_no_attachments_count;
    private $can_attach_no_canonical_has_attachments_count;
    private $can_attach_attachments_count;
    
    function can_attach_get_all_attachments(){
        $orderby = (! empty( $_GET['orderby'])) ? $_GET['orderby'] : 'publish_date';
        // Validate orderby parameter
        if (!in_array($orderby, array('id','post_title','post_parent','publish_date'), true)){exit;}
        $order = (! empty( $_GET['order'])) ? $_GET['order'] : 'desc';
        // Validate order paramater
        if (!in_array($order, array('asc','desc'), true)){exit;}
        
        $args = array(
            'posts_per_page' => -1
            ,'post_type' => 'attachment'
            ,'post_status' => null
            ,'post_parent' => null
            ,'orderby' => $orderby
            ,'order' => $order  
            ,'post_mime_type' => array('application/doc','application/pdf')
        );
        
        $attachments = get_posts( $args );
        $no_canonicals = array(); 
        $no_attachments = array(); 
        $no_canonical_attachments = array();     

        foreach ($attachments as $key => $attachment){
            $attachment->canonical = get_post_meta( $attachment->ID , 'canonical_url', true);
            $attachment->url = wp_get_attachment_url( $attachment->ID);
            $attachment->attached_post_url = get_permalink( $attachment->post_parent);
            $attachment->attached_post_name = get_the_title( $attachment->post_parent);
        
            if (!$attachment->canonical){
                $no_canonicals[$key] = $attachment;
            }
            if (!$attachment->attached_post_url){
                $no_attachments[$key] = $attachment;
            }
            if (!$attachment->canonical && $attachment->attached_post_url){
                $no_canonical_attachments[$key] = $attachment;
            }
        }
        
        $this->can_attach_no_canonicals_count = count($no_canonicals);
        $this->can_attach_no_attachments_count = count($no_attachments);
        $this->can_attach_no_canonical_has_attachments_count = count($no_canonical_attachments);
        $this->can_attach_attachments_count = count($attachments);
    
        $filter = $_GET['filter'];
        switch($filter) { 
            case 'no-canonicals':
                return $no_canonicals;
                break;
            case 'no-attachments':
                return $no_attachments;
                break;
            case 'no-canonical-attachments':
                return $no_canonical_attachments;
                break;                
            default:
                return $attachments;
                break;
        }
    }

    function get_columns(){
        $columns = array(
            'cb'                => '<input type="checkbox" />'
            ,'ID'               => 'ID'
            ,'post_title'       => 'File'
            ,'url'              => 'Link'
            ,'canonical'        => 'Canonical'
            ,'post_parent'      => 'Attached Post'
           // ,'all'              => 'All'
        );
        return $columns;
    }
    
    function get_views(){
       $views = array();
       $current = ( !empty($_REQUEST['filter']) ? $_REQUEST['filter'] : 'all');

       //All link
       $class = ($current == 'all' ? ' class="current"' :'');
       $all_url = remove_query_arg('paged',remove_query_arg('filter'));
       $views['all'] = "<a href='{$all_url}' {$class} >All Attachments ({$this->can_attach_attachments_count})</a>";

       //No Canonical Has Attachments
       $no_canonical_attachments_url = remove_query_arg('paged',add_query_arg('filter','no-canonical-attachments'));
       $class = ($current == 'no-canonical-attachments' ? ' class="current"' :'');
       $views['no-canonical-attachments'] = "<a href='{$no_canonical_attachments_url}' {$class} >No Canonical Has Attachments ({$this->can_attach_no_canonical_has_attachments_count})</a>";

       //No Attachments
       $no_attachments_url = remove_query_arg('paged',add_query_arg('filter','no-attachments'));
       $class = ($current == 'no-attachments' ? ' class="current"' :'');
       $views['no-attachments'] = "<a href='{$no_attachments_url}' {$class} >No Attached Post ({$this->can_attach_no_attachments_count})</a>";
       
       //No Canonical Has Attachments
       $no_canonicals_url = remove_query_arg('paged',add_query_arg('filter','no-canonicals'));
       $class = ($current == 'no-canonicals' ? ' class="current"' :'');
       $views['no-canonicals'] = "<a href='{$no_canonicals_url}' {$class} >No Canonicals ({$this->can_attach_no_canonicals_count})</a>";

       return $views;
    }    

    function prepare_items() {
        $columns = $this->get_columns();
        $hidden = array('url');
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        $current_page = $this->get_pagenum();
        $per_page = 25;
        $this->items = $this->can_attach_get_all_attachments();
        $total_items = count($this->items);
        $this->items = array_slice($this->items,($current_page-1)*$per_page, $per_page);
                
        $this->set_pagination_args( array(
            'total_items' => $total_items
            ,'per_page'    => $per_page
          ) );
    }
    
    function get_sortable_columns() {
        $sortable_columns = array(
            'ID'                => array('id', false)
            ,'post_title'       => array('post_title', false)
            ,'url'              => array('url', false)
            ,'post_parent'      => array('post_parent', false)
           // ,'all'              => 'All'
        );
        return $sortable_columns;
    }

    function column_post_title($item) {
        $display = "<a href='".$item->url."' target='_Blank'>".$item->url."</a>";
        $edit_nonce = wp_create_nonce( 'conattach-edit-canonical' );
        $link_nonce = wp_create_nonce( 'conattach-link-canonical' );
        $remove_nonce = wp_create_nonce( 'conattach-remove-canonical' ); 
        $actions = array(
                'edit_media'                => sprintf('<a href="?page=%s&action=%s&attachment=%s&_wpnonce=%s">Edit Canonical</a>',$_REQUEST['page'],'edit_canonical',$item->ID, $edit_nonce)
                ,'link_to_attached_post'    => sprintf('<a onclick="return confirm(\'Canonical to Attached Post?\')" href="?page=%s&action=%s&attachment=%s&_wpnonce=%s">Canonical to Attached Post</a>',$_REQUEST['page'],'canonical_to_attachment',$item->ID, $link_nonce)
                ,'remove_canonical'         => sprintf('<a onclick="return confirm(\'Are you sure you want to remove this canonical?\')" href="?page=%s&action=%s&attachment=%s&_wpnonce=%s">Remove Canonical</a>',$_REQUEST['page'],'remove_canonical',$item->ID, $remove_nonce)
            );

        return sprintf('%1$s %2$s', $display, $this->row_actions($actions) );
    }
    
    function column_post_parent($item) {
        if ($item->attached_post_url){
            $display = "<a href='".$item->attached_post_url."' target='_Blank'>".$item->attached_post_name."</a>";
        }else{
            $display = "NONE ATTACHED";
        }        
        $attach_nonce = wp_create_nonce( 'conattach-attach-post' );
        $detach_nonce = wp_create_nonce( 'conattach-detach-post');
        
        $actions = array(
            'attach_to_post'                => sprintf('<a class="hide-if-no-js" onclick="findPosts.open(\'media_id\','.$item->ID.');return false;" href="?page=%s&action=%s&attachment=%s&_wpnonce=%s">Attach to Post</a>',$_REQUEST['page'],'attach-post',$item->ID, $attach_nonce),
            'detach_from_post'              => sprintf('<a onclick="return confirm(\'This does not remove the canonical, only unlinks the media file from the post!\')" href="?page=%s&action=%s&attachment=%s&_wpnonce=%s">Detach From Post</a>',$_REQUEST['page'],'detach-post',$item->ID, $detach_nonce)
        );
        
        return sprintf('%1$s %2$s', $display, $this->row_actions($actions) );            
    }
    
    function get_bulk_actions() {
        $actions = array(
            'bulk_remove_canonical'    => 'Remove Canonicals'
            ,'bulk_link_parent'    => 'Attach to Linked Post'
        );
        return $actions;
    }
    
    function column_cb($item) {
        return sprintf('<input type="checkbox" name="attachment[]" value="%s" />', $item->ID);    
    }
    
    function column_default( $item, $column_name ) {
      switch( $column_name ) { 
        case 'canonical':
            return "<a href='".$item->canonical."' target='_Blank'>".$item->canonical."</a>";
        case 'url':
            return "<a href='".$item->url."' target='_Blank'>".$item->url."</a>";
        case 'post_title':
            return $item->$column_name;
        case 'post_parent':
            return "<a href='".$item->attached_post_url."' target='_Blank'>".$item->attached_post_name."</a>";
        case 'all':
            return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
        default:
            return $item->$column_name;
      }
    }    
}
   
$myListTable = new Can_Attach_Attachment_List_Table();
echo '<div class="wrap"><h2>Media Files<h2>';
$myListTable->prepare_items();
$myListTable->views();
    echo '<form id="attachment-files" method="get">';
    echo '<input type="hidden" name="page" value="'.$_REQUEST['page'].'" />';
    $myListTable->display();
    echo '</form>';
echo '</div>';

?>    