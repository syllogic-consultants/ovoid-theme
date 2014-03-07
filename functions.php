<?php
function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}
 
function ovoid_manage_projectupdate_columns( $column, $post_id ) {
     global $post;
	 $ID = get_post_meta($post_id, "projectname" , true );
     $projectname = get_the_title($ID);
     echo $projectname; 
}
add_action( 'manage_projectupdate_posts_custom_column', 'ovoid_manage_projectupdate_columns', 10, 2 );

function ovoid_edit_projectupdate_columns( $columns ) {
    $columns = array(
		 'cb' => '<input type="checkbox" />',
        'projectname' => __( 'Project' )
    );
    return $columns;
} 

add_filter( 'manage_edit-projectupdate_columns', 'ovoid_edit_projectupdate_columns' ) ;


function ovid_add_meta_boxes() {
    remove_meta_box( 'slugdiv', 'projectupdate', 'normal' );
}
add_action( 'add_meta_boxes', 'ovid_add_meta_boxes' );

add_action('init', 'ovoid_rewrite');
function ovoid_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->add_permastruct('typename', 'typename/%year%/%postname%/', true, 1);
    add_rewrite_rule('typename/([0-9]{4})/(.+)/?$', 'index.php?typename=$matches[2]', 'top');
    $wp_rewrite->flush_rules(); // !!!
}
?>