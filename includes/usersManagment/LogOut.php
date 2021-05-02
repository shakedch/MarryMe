<?php

	require_once('../../conection/init.php');
	//A function that delet seesion detailes 
	$session->logout();
	header('Location: ../../index.php');
	
?>