<?php

class chatroom_Database_Manager {

    public function __construct() {
		
    }

    public function create_custom_tables() {
        global $wpdb;
        $table_name = $wpdb->prefix . "chatroom_message";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $sql ="CREATE TABLE IF NOT EXISTS $table_name (
			id bigint(20) NOT NULL AUTO_INCREMENT, 
			user_sender int(11) NOT NULL, 
			user_receiver int(11) NOT NULL, 
			message mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, 
			is_private tinyint(1) NOT NULL,
			is_buddypress tinyint(1) NOT NULL,
			is_commonroom tinyint(1) NOT NULL,
			bp_group_id int(11) NOT NULL,
			chat_read tinyint(1) NOT NULL, 
			chat_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
			PRIMARY KEY (id)
			) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8";

        dbDelta($sql);

        $wpdb->query("ALTER TABLE $wpdb->users 
			ADD COLUMN chatroom_status VARCHAR(50) NOT NULL AFTER display_name,
			ADD COLUMN chatroom_last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER chatroom_status");
    }

}

