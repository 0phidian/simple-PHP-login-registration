<?php
	
	session_start();
	if (isset($_SESSION['user_id']) and !empty($_SESSION['user_id'])) {
		echo $_SESSION['user_id'];
	}

?>

<form method="POST" action="login.php">
	Username: <input type="text" name="uname"/><br />
	Password: <input type="password" name="passwd"/>
	<input type="submit" />
</form>
<a href="logout.php">logout</a>