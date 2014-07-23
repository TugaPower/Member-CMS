<?php include_once("utils.php") ?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Language" content="pt">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo WEBSITE_TITLE ?></title>
		<link href="favicon.ico" rel="shortcut icon">

		<!-- Main CSS file -->
		<link href="css/style.css" rel="stylesheet">

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Font Awesome -->
		<link href="css/font-awesome.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- jQuery (need to be loaded before the end of the page because some pages use it's functionality earlier) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="js/jquery.md5.js"></script>
		<script src="js/util.js"></script> <!-- Import our utility script -->
		<script type="application/javascript"> // Needs to be in a PHP capable page with a started session to be able to add an Admin page.
			function loadSidebar(current) {
				var tabs = [
					{ name:"Home", url:"home.php" },
					{ name:"Profile", url:"profile.php" },
					{ name:"Stats", url:"stats.php" }
					<?php if($_SESSION["isAdmin"]) echo ", { name:\"Administration\", url:\"admin.php\" }"?>
				];

				sidebar = document.getElementById("sidebar");
				sidebar.innerHTML = ""; // Clear the sidebar
				for(var i=0; i < tabs.length; i++) {
					var element = "<li ";
					if(current == tabs[i]["name"]) element += " class='active'";
					element += "><a onClick='" + "changePage(\"{0}\",\"{1}\")".format(tabs[i]["name"],tabs[i]["url"]) + "'>" + tabs[i]["name"] + "</a></li>";
					sidebar.innerHTML += element;
				}
			}
		</script>
	</head>
	<body>
	<?php include("includes/navbar.php") ?>
	<ul id="sidebar" class="nav nav-stacked"></ul>
	<div id="content"></div>
	<script src="js/bootstrap.min.js"></script>
	</body>
	</html>
<?php closeDBConnection(); // Close any started connection