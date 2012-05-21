<?php

abstract class Command {

	protected $controller;
	protected $view;
	protected $template;
	
	public function __construct(Controller &$controller) {
	
		$this->controller = $controller;
		$this->view = new View();
		
	}
	
	public function display() {
		
		if (!$this->template)
			throw new RuntimeException("Nie podano szablonu do wykonania");
	
		$this->set('cmdName', $this->controller->getCommandName());
		return $this->view->fetch($this->template);
		
	}
    
	abstract public function execute();
	
	protected function set($name, $value) {
		$this->view->set($name, $value);
	}
	
}
