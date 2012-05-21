<?php

class View {

	protected $params = array();
	
	public function set($name, $value) {
        $this->params[$name] = $value;
    }

	public function fetch($templateName) {
	
        ob_start();
		
		if (!include_once(VIEWS. $templateName .'.php'))
			throw new RuntimeException("Nie udało się załadować pliku widoku: {$templateName}");
        
		$tmp = ob_get_contents();
        ob_end_clean();
        return $tmp;
        
    }
	
}

?>