<?php

class Controller {

	protected $cmdName;
	protected $cmd;
	
	public function __construct(Request $request) {
	
		$this->cmdName = $request->getCmdName();
	
	}
	
	public function dispatch() {
	
		try {
		
			$className = ucfirst($this->cmdName) .'Command';
		
			if (!include_once CMD. $this->cmdName. 'command.class.php')
				throw new RuntimeException("Nie udało się załadować pliku obsługi żądania: {$className}");
				
			$this->cmd = new $className($this);
			$this->cmd->execute();
			echo $this->cmd->display();
		
		} catch (Exception $e) {
			
			Logger::instance()->logMessage("Błąd wykonywania żądania: {$e->getMessage()}", LOGGER_ERROR, 'Core');
			
			require_once "cmd/errorcommand.class.php";
			$ecmd = new ErrorCommand($this);
			
			$ecmd->setMessage($e->getMessage());
			$ecmd->execute();
			echo $ecmd->display();
			
		}
	
	}
	
	public function getCommandName() {
		return $this->cmdName;
	}

}