<?php

class ErrorCommand extends Command {

	public function execute() {
		$this->template = 'error';
	}
	
	public function setTitle($title) {
		$this->set('title', $title);
	}
	
	public function setMessage($msg) {
		$this->set('message', $msg);
	}

}