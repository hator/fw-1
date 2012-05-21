<?php

class Request {

	protected $cmdName;
	static $params;

	public function __construct() {

		$this->route($_SERVER['QUERY_STRING']);
		Debugger::debug('PARAMS', $this->params);
	
	}
	
	protected function route($query) {
	
		if (!$query) {
			$this->cmdName = Config::$default_command;
		} else {
			$query = preg_replace('/\/$/', '', $query);
			$this->params = explode('/', $query);
			$this->cmdName = array_shift($this->params);
		}	
		
		if (@ include_once 'aliases.php') {
			if ($aliases[$this->cmdName])
				$this->cmdName = $aliases[$this->cmdName];
			unset($aliases);
		}
		
		$_GET = $this->params;
	
	}
	
	public function getCmdName() {
		return $this->cmdName;
	}
	
	static function createURL(Array $elements) {
		return Config::$base_adress . (Config::$mod_rewrite ? '' : '?') . implode ('/', $elements);
	}

}