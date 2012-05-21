<?php

class FileLogSaver extends LogSaver {

	protected $logFile;

	public function __construct() {
	
		$this->logFile = @fopen(Config::$log_file, 'a');
		
		if (!is_resource($this->logFile))
			throw new RuntimeException('Nie udało się otworzyć/utworzyć pliku logów!');
	
	}

	public function logMessage($msg, $logLevel, $strLogLevel, $module = null) {
	
		$datetime = date('c');
		$msg = $this->removeSpecialChars($msg);
		
		$logLine = "{$datetime}\t{$strLogLevel}\t{$msg}\t{$module}\n";
		fwrite($this->logFile, $logLine);
	
	}
	
	protected function removeSpecialChars($string) {
	
		return str_replace("\t", '    ', str_replace("\r\n", ' ', $string));
	
	}
	
	public function __destruct() {
		if (is_resource($this->logFile))
			fclose($this->logFile);
	}

}