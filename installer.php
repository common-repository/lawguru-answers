<?php
	require_once(ABSPATH . 'wp-admin/upgrade.php');

	global $wpdb;

	$cur_ver = get_option("lawguru_legal_advice_version");
	if($cur_ver == ''){
		add_option("lawguru_legal_advice_title", "Legal Advice From Lawguru.com");
		add_option("lawguru_legal_advice_allow_free", 1);
		add_option("lawguru_legal_advice_affiliate", "wordpress");

		$cur_ver = '1.2.0';
		add_option("lawguru_legal_advice_version", $cur_ver);
	}
?>