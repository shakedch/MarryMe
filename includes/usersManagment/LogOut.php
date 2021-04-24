<?php

	require_once('../../conection/init.php');
	
	$session->logout();
	header('Location: ../../index.php');
	
?>