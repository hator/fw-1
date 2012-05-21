<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

class Config {

	static $default_command = 'home';
	static $base_adress = 'http://localhost/fw/';
	
	static $db_dsn = 'mysql:host=localhost;dbname=fw';
	static $db_username = 'root';
	static $db_password = '';
	
	static $log_level = '10';
	static $log_saver = 'FileLogSaver';
	static $log_file = 'test.log';
	
	static $debug = true;
	static $mod_rewrite = true;

}