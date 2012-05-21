<?php

	require_once VIEWS.'inc/top.php';

	echo '<h1>'. ($this->params['title'] ? $this->params['title'] : 'Wystąpił błąd') .'</h1>';
	echo "<h2>{$this->params['message']}</h2>";
	
	if ($this->params['message'])
		echo "<p></p>";
		
	require_once VIEWS.'inc/footer.php';