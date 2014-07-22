<?php
	include_once("utils.php");

	if(!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"]) {
		echo "<h3 style=\"text-align: center\"><i class=\"fa fa-exclamation-triangle\"></i> You don't have permissions to be in this page.</h3>";
		die();
	}

	$con = startDBConnection();

	$query = "SELECT * FROM $db_database.members ORDER BY id ASC";
	$result = mysqli_query($con, $query) or die('Error: '. $con->error);

	$members = array();
	while($row = mysqli_fetch_array($result)) {
		$entry = array();
		$entry["id"] = $row["id"];
		$entry["username"] = $row["username"];
		$entry["password"] = $row["password"];
		$entry["last_activity"] = $row["last_activity"];

		$members[] = $entry;
	}
	mysqli_free_result($result);
	closeDBConnection();

	echo "<h2>Members</h2><h3>Member list</h3>";
	echo "<table class=\"table table-hover table-striped\"><thead><td>ID</td><td>Username</td><td>Password</td><td>Last Activity</td></thead><tbody>";
	foreach($members as $current)
		echo "<tr><td>". $current["id"] ."</td><td>". $current["username"] ."</td><td>". $current["password"] ."</td><td>". $current["last_activity"] ."</td></tr>";
	echo "</tbody></table>";

	if(sizeof($members) < 1) echo "There are no members in the database.";
?>
<h3>Add a new member</h3>
<form name="register" action="util/register.php" method="post" onSubmit="document.register.password.value = $.md5(document.register.password.value)">
	<input name="username" type="text" placeholder="Nick">
	<input name="password" type="password" placeholder="Password">
	<input type="submit" value="Add">
</form>