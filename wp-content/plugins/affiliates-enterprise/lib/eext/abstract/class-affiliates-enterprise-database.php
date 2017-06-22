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

	
 abstract class Affiliates_Enterprise_Database implements I_Affiliates_Enterprise_Database { private $implementation; private $host; private $database; private $user; private $password; protected $affiliates_db_impl; public function __construct( $implementation, $IXAP0 = null, $database = null, $user = null, $IXAP1 = null ) { $this->implementation = $implementation; $this->host = $IXAP0; $this->database = $database; $this->user = $user; $this->password = $IXAP1; } public function create_tables( $charset = null, $IXAP2 = null ) { $this->affiliates_db_impl->create_tables( $charset, $IXAP2 ); $charset_collate = ''; if ( ! empty( $charset ) ) { $charset_collate = "DEFAULT CHARACTER SET $charset"; } if ( ! empty( $IXAP2 ) ) { $charset_collate .= " COLLATE $IXAP2"; } $affiliates_relations_table = $this->get_tablename( 'affiliates_relations' ); if ( $this->get_value( "SHOW TABLES LIKE '" . $affiliates_relations_table . "'" ) != $affiliates_relations_table ) { $IXAP3 = "CREATE TABLE " . $affiliates_relations_table . " (
				from_affiliate_id bigint(20) unsigned NOT NULL,
				to_affiliate_id   bigint(20) unsigned NOT NULL,
				type              varchar(10) NOT NULL DEFAULT '" . AFFILIATES_RELATIONS_TYPE_REFERRAL . "',
				from_date         date NOT NULL,
				thru_date         date default NULL,
				status            varchar(10) NOT NULL DEFAULT '" . AFFILIATES_RELATIONS_STATUS_ACTIVE . "',
				PRIMARY KEY       (from_affiliate_id, to_affiliate_id, type, from_date),
				INDEX             aff_rel_ttsf (to_affiliate_id, type, status, from_date),
				INDEX             aff_rel_tf (to_affiliate_id, from_affiliate_id, type, status, from_date)
			) $charset_collate;"; $this->query( $IXAP3 ); } $IXAP4 = $this->get_tablename( 'campaigns' ); if ( $this->get_value( "SHOW TABLES LIKE '" . $IXAP4 . "'" ) != $IXAP4 ) { $IXAP3 = "CREATE TABLE " . $IXAP4 . " (
				campaign_id  BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				affiliate_id BIGINT(20) UNSIGNED NOT NULL,
				name         VARCHAR(100) DEFAULT NULL,
				description  LONGTEXT DEFAULT NULL,
				from_date    DATE DEFAULT NULL,
				thru_date    DATE DEFAULT NULL,
				type         VARCHAR(10) DEFAULT NULL,
				status       VARCHAR(10) DEFAULT NULL,
				PRIMARY KEY  (campaign_id),
				INDEX        aff_cmp_aid (affiliate_id)
				) $charset_collate;"; $this->query( $IXAP3 ); } } public function drop_tables() { $affiliates_relations_table = $this->get_tablename( 'affiliates_relations' ); $IXAP3 = "DROP TABLE IF EXISTS " . $affiliates_relations_table . ";"; $this->query( $IXAP3 ); $IXAP4 = $this->get_tablename( 'campaigns' ); $IXAP3 = "DROP TABLE IF EXISTS " . $IXAP4 . ";"; $this->query( $IXAP3 ); $this->affiliates_db_impl->drop_tables(); } } 