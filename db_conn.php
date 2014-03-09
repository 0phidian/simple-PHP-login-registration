<?php

	$mysql_host = 'localhost';
	$mysql_uname = 'monty';
	$mysql_passwd = '';

	if(!@mysql_connect($mysql_host, $mysql_uname, $mysql_passwd) || !@mysql_select_db('blog')){
		die("Connection failed.");
	}

?>