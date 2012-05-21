<?php

class Debugger {

	protected static $data;
	
	static function setErrorReporting($show) {
	
		ini_set('display_errors', $show);
		error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
	
	}
	
	static function debug($key, $element) {
		if (Config::$debug)
			self::$data[$key] = $element;
	}
	
	static function echoDebug() {
		if (Config::$debug && count(self::$data)) {
			echo '<div id="debug_data">';
			self::echoArray(self::$data);
			echo '</div>';
		}
	}
	
	protected static function echoArray(Array $arr) {
	
		echo '<table>';
		echo '<thead><td>Klucz</td><td>Wartość</td></thead>';
	
		foreach($arr as $key => $element) {
			echo "<tr><td>{$key}</td><td>";
			
			if (is_array($element))
				self::echoArray($element);
			else
				print_r($element);
			
			echo '</td></tr>';
		}
		
		echo '</table>';
	
	}

}