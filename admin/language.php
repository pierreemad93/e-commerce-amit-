<?php
	header('Cache-control: private'); // IE 6 FIX
	if(isSet($_GET['lang']))
	{
		$lang = $_GET['lang'];
		// register the session and set the cookie
		$_SESSION['lang'] = $lang;
	}
	else if(isSet($_SESSION['lang']))
	{
		$lang = $_SESSION['lang'];
	}
	else
	{
		$lang = 'en';
	}
	switch ($lang) {
		case 'en':
		$lang_file = 'en.php';
		break;

		case 'ar':
		$lang_file = 'ar.php';
		break;

		default:
		$lang_file = 'en.php';

	}

	include_once 'resources/lang/'.$lang_file;
?>