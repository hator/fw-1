<?php

class ContactCommand extends Command {

	public function execute() {
	
		try {
		
			
		
		} catch (PDOException $e) {
			Logger::instance()->logMessage("Błąd PDO: {$e->getMessage()}", LOGGER_WARNING, 'HomeCommand');
		} catch (Exception $e) {
			$log .= "Wystąpił błąd: {$e->getMessage}\n";
		}
	
		$this->set('log', $log);
		$this->template = 'home';
	
	}

}