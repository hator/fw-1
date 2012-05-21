<?php

class HomeCommand extends Command {

	public function execute() {
	
		try {
		
			$pdo = PDOFactory::instance();
			
			Debugger::debug(
				'Przykładowy URL',
				Request::createURL(array('contact', 'lubie-placki'))
			);
		
		} catch (PDOException $e) {
			Logger::instance()->logMessage("Błąd PDO: {$e->getMessage()}", LOGGER_WARNING, 'HomeCommand');
		} catch (Exception $e) {
			$log .= "Wystąpił błąd: {$e->getMessage}\n";
		}
	
		$this->set('log', $log);
		$this->template = 'home';
	
	}

}