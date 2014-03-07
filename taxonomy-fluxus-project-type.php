<?php
/**
 * Display projects filtered by type.
 *
 * Projects can be displayed either with horizontal or grid layout.
 * The template is picked using these rules:
 *
 *  1. If Project Type layout is specified in the project type options, then use the specified layout.
 *  2. If Project Type layout is specified in one of the project types ancestors, then inherit that layout.
 *  3. Look for pages with Horizontal Portfolio template, if found, use horizontal layout.
 *  4. Look for pages with Grid Portfolio template, if found, use grid layout.
 *  5. Use horizontal layout.
 */

global $wp_query;

$template = fluxus_project_type_layout( get_queried_object()->term_id );

$args = $wp_query->query_vars;
$args['orderby'] = 'menu_order ID';
$args['order'] = 'ASC DESC';
$args['posts_per_page'] = 3000;

fluxus_query_portfolio( $args );
//echo $template;
require_once dirname( __FILE__ ) . '/' . $template; 
?>