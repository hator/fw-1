<?php

class UserSession {

	private $pdo;
	
	private $loggedIn;
	private $userID;
	
	private $phpSessionID;
	private $mySessionID;
	private $sessionTimeout = 600; // Max 10 minutes of idle
	private $sessionLifespan = 3600; // Max 1 hour of session

	public function __construct(PDO $pdo) {
	
		$this->pdo = $pdo;
		
		session_set_save_handler(
			array(&$this, 'open'),
			array(&$this, 'close'),
			array(&$this, 'read'),
			array(&$this, 'write'),
			array(&$this, 'destroy'),
			array(&$this, 'gc')
		);
		
		if ($_COOKIE['PHPSESSID']) {
		
			$this->phpSessionID = $_COOKIE['PHPSESSID'];
			$stmt = $this->pdo->prepare("SELECT id FROM session WHERE id_ascii='{$this->phpSessionID}' OR ((NOW() - last_action) <= {$this->sessionTimeout} OR last_action IS NULL)");
			$stmt->execute();
			
			if (!$stmt->rowCount()) {
				
				$this->pdo->prepare("DELETE FROM session WHERE id_ascii='{$this->phpSessionID}' OR (NOW() - last_action) > {$this->sessionLifespan}")->execute();
				$this->pdo->prepare("DELETE FROM session_variables WHERE session_id NOT IN (SELECT id FROM session)")->execute();
				unset($_COOKIE['PHPSESSID']);
				
			}
		
		}
		
		session_set_cookie_params($this->sessionLifespan);
		session_start();
	
	}
	
	public function updateTimestamp() {}
	public function logIn() {}
	public function logOut() {}
	
	public function isLoggedIn() {
		return $this->loggedIn;
	}
	
	public function getSessionID() {
		return $this->phpSessionID();
	}
	
	public function getUserID() {
		if ($this->userID)
			return $this->userID;
		else
			return false;
	}
	
	public function __set($key, $value) {
	
		try {
		
			$delete = $this->pdo->prepare("DELETE FROM session_variables WHERE `key`='{$key}'");
			$delete->execute();
		
			$value = base64_encode(serialize($value));
			$insert = $this->pdo->prepare("INSERT INTO session_variables SET `session_id`='{$this->mySessionID}', `key`='{$key}', `value`='{$value}'");
			$insert->execute();
			
			$this->updateTimestamp();
			return true;
			
		} catch (Exception $e) {
			Logger::instance()->logMessage("Błąd zapisywania danych sesji: {$e->getMessage()}", LOGGER_WARNING, 'UserSession');
			return false;
		}
	
	}
	
	public function __get($key) {
	
		try {
		
			$this->updateTimestamp();
		
			$select = $this->pdo->prepare("SELECT value FROM session_variables WHERE `session_id`='{$this->mySessionID}' AND `key`='{$key}'");
			$select->execute();
			
			if ($select->rowCount()) {
				$data = $select->fetch(PDO::FETCH_ASSOC);
				return unserialize(base64_decode($data['value']));
				
			} else {
				return false;
			}
			
		} catch (Exception $e) {
			Logger::instance()->logMessage("Błąd odczytywania danych sesji: {$e->getMessage()}", LOGGER_WARNING, 'UserSession');
			return false;
		}
	
	}
	
	private function open ($save_path, $session_id) {
		return true;
	}
	
	private function close() {
		return true;
	}
	
	private function destroy ($session_id) {
		$delete = $this->pdo->prepare("DELETE FROM session WHERE id_ascii='{$this->phpSessionID}'");
		$delete->execute();
		return true;
	}
	
	private function gc ($maxlifetime) {
		return true;
	}
	
	private function read ($session_id) {
	
		$this->phpSessionID = $session_id;
		$result = $this->pdo->prepare("SELECT id, logged_in, user_id FROM session WHERE id_ascii='{$this->phpSessionID}'");
		$result->execute();
		
		if ($result->rowCount()) {
			
			$sessionData = $result->fetch(PDO::FETCH_ASSOC);
			$this->mySessionID = $sessionData['id'];
			
			if ($sessionData['logged_in']) {
				$this->loggedIn = true;
				$this->userID = $sessionData['user_id'];
			} else
				$this->loggedIn = false;
			
		} else {
			
			$this->loggedIn = false;
			
			$insert = $this->pdo->prepare("INSERT INTO session SET id_ascii='{$this->phpSessionID}', logged_in=0, user_id=0, creation_time=NOW()");
			$insert->execute();
			
			$this->mySessionID = $this->pdo->lastInsertId();
			
		}
		
		return '';
	
	}
	
	
	private function write ($session_id, $session_data) {
		return true;
	}

}