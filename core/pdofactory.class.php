<?php

class PDOFactory {

	static $pdo;
	
	public static function instance() {

		if (!self::$pdo) {
			self::$pdo = new PDO(Config::$db_dsn, Config::$db_username, Config::$db_password);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
			
		return self::$pdo;
	
	}

}