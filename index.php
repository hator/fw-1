<?php

// Essential paths
define('STARTED', 1);
define('CORE', 'core/');
define('VIEWS', 'views/');
define('CMD', 'cmd/');
define('LIBS', 'libs/');
define('MEDIA', 'media/');

// Autoload handling
spl_autoload_extensions('.class.php, .php');
set_include_path(
	get_include_path().PATH_SEPARATOR.
	CORE.PATH_SEPARATOR.
	CMD.PATH_SEPARATOR.
	LIBS.PATH_SEPARATOR.
	LIBS.'log/'.PATH_SEPARATOR
);
spl_autoload_register();

Debugger::setErrorReporting(Config::$debug);

$session = new UserSession(PDOFactory::instance());

if ($session->c)
	$session->c++;
else
	$session->c = 1;

$logger = Logger::instance();
$logger->logMessage('Uruchomienie FW', LOGGER_DEBUG, 'Core');

$controller = new Controller(new Request());
$controller->dispatch();
