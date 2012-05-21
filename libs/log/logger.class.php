<?php

define('LOGGER_DEBUG', 100);
define('LOGGER_INFO', 75);
define('LOGGER_NOTICE', 50);
define('LOGGER_WARNING', 25);
define('LOGGER_ERROR', 10);
define('LOGGER_CRITICAL', 5);

require_once LIBS.'log/logsaver.class.php';
require_once LIBS.'log/'. strtolower(Config::$log_saver) .'.class.php';

class Logger {

	static $instance;
	protected $logSaver;
	protected $logLevel;
	
	private function __construct() {
	
		$this->logSaver = new Config::$log_saver();
		$this->logLevel = Config::$log_level;
	
	}
	
	public static function instance() {
	
		if (!self::$instance)
			self::$instance = new Logger();
			
		return self::$instance;
	
	}
	
	public function logMessage($msg, $logLevel = LOGGER_INFO, $module = null) {
	
		if ($logLevel > $this->logLevel)
			return;
			
		$strLogLevel = $this->levelToString($logLevel);
		$this->logSaver->logMessage($msg, $logLevel, $strLogLevel, $module);
	
	}
	
	protected function levelToString($logLevel) {
	
		switch($logLevel) {
		
			case LOGGER_DEBUG:
				return 'LOGGER_DEBUG'; break;
				
			case LOGGER_INFO:
				return 'LOGGER_INFO'; break;
				
			case LOGGER_NOTICE:
				return 'LOGGER_NOTICE'; break;
				
			case LOGGER_WARNING:
				return 'LOGGER_WARNING'; break;
				
			case LOGGER_ERROR:
				return 'LOGGER_ERROR'; break;
				
			case LOGGER_CRITICAL:
				return 'LOGGER_CRITICAL'; break;
				
			default:
				return '[UNDEFINED]'; break;
		
		}
	
	}
	
}