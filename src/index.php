<!DOCTYPE html>
<html>
<head>
	<?php
		include("utils.php");
		include("includes/head.php");
	?>
</head>
<body>
<?php
	include("includes/navbar.php");
	include("includes/sidebar.php");
?>
<div id="content"></div>
<?php
	include("includes/footer.php");
	closeDBConnection(); // Close any started connection
?>
</body>
</html>