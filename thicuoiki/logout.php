<?php
	session_start();
	$_SESSION['username'] = '';
	header('location: index.php');
 ?>