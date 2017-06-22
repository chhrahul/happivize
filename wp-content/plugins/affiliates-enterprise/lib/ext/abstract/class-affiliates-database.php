<?php
	
/**
 * Copyright (c) "kento" Karim Rahimpur www.itthinx.com
 * 
 * This code is provided subject to the license granted.
 *
 * UNAUTHORIZED USE AND DISTRIBUTION IS PROHIBITED.
 *
 * See COPYRIGHT.txt and LICENSE.txt
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * This header and all notices must be kept intact.
 */

	
	
/**
 * Copyright (c) "kento" Karim Rahimpur www.itthinx.com
 * 
 * This code is provided subject to the license granted.
 *
 * UNAUTHORIZED USE AND DISTRIBUTION IS PROHIBITED.
 *
 * See COPYRIGHT.txt and LICENSE.txt
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * This header and all notices must be kept intact.
 */

	
 abstract class Affiliates_Database implements I_Affiliates_Database { private $implementation; private $host; private $database; private $user; private $password; public function __construct( $implementation, $IXAP0 = null, $database = null, $user = null, $IXAP1 = null ) { $this->implementation = $implementation; $this->host = $IXAP0; $this->database = $database; $this->user = $user; $this->password = $IXAP1; } public function create_tables( $charset = null, $IXAP2 = null ) { $charset_collate = ''; if ( ! empty( $charset ) ) { $charset_collate = "DEFAULT CHARACTER SET $charset"; } if ( ! empty( $IXAP2 ) ) { $charset_collate .= " COLLATE $IXAP2"; } $affiliates_attributes_table = $this->get_tablename( 'affiliates_attributes' ); if ( $this->get_value( "SHOW TABLES LIKE '" . $affiliates_attributes_table . "'" ) != $affiliates_attributes_table ) { $IXAP3 = "CREATE TABLE " . $affiliates_attributes_table . " (
				affiliate_id BIGINT(20) UNSIGNED NOT NULL,
				attr_key     VARCHAR(100) NOT NULL,
				attr_value   LONGTEXT DEFAULT NULL,
				PRIMARY KEY  (affiliate_id, attr_key),
				INDEX        aff_attr_akv (affiliate_id, attr_key, attr_value(100)),
				INDEX        aff_attr_ka (attr_key, affiliate_id),
				INDEX        aff_attr_kva (attr_key, attr_value(100), affiliate_id)
			) $charset_collate;"; $this->query( $IXAP3 ); } } public function drop_tables() { $affiliates_attributes_table = $this->get_tablename( 'affiliates_attributes' ); $IXAP3 = "DROP TABLE IF EXISTS " . $affiliates_attributes_table . ";"; $this->query( $IXAP3 ); } } 