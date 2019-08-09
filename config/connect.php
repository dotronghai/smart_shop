<?php 
	$string = 'mysql:host=localhost;dbname=smart_shop';
	$conn = new PDO($string,'root','',[
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
	]);
?>