<?php
$url = explode("/", parse_url(trim($_SERVER["REQUEST_URI"], "/"), PHP_URL_PATH));
$parentDir = $url[count($url) - 2];
$path = isset($_SESSION["prv"]) || $parentDir != "project" ? "../styles/js/" : "styles/js/";
?>
		<script type="text/javascript" src="<?=$path;?>jquery.min.js"></script>
		<script type="text/javascript" src="<?=$path;?>fontawesome.min.js"></script>
		<script type="text/javascript" src="<?=$path;?>bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=$path;?>main.js"></script>
	</body>
</html>












