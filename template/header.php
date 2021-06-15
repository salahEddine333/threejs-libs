<?php

$url = explode("/", parse_url(trim($_SERVER["REQUEST_URI"], "/"), PHP_URL_PATH));
$parentDir = $url[count($url) - 2];
$path = isset($_SESSION["prv"]) || $parentDir != "project" ? "../styles/css/" : "styles/css/";

?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="<?=$path;?>all.min.css">
		<link rel="stylesheet" type="text/css" href="<?=$path;?>fontawesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?=$path;?>bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?=$path;?>main.css">
	</head>
	<body>









