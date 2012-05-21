<?php

abstract class LogSaver {

	abstract public function logMessage($msg, $logLevel, $strLogLevel, $module = null);

}