<?php

/**
 * Trigger this file on plugin uninstall
 * 
 * @package plugin 
 */

if(!defined('WP_UNINSTALL_PLUGIN')){
    die;
}

// clear database storage
global $wpdb;
$wpdb->query("DELETE FROM wp_post WHERE post_type = 'manga'");
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");
