<?php
	require 'db_conn.php';

	if(isset($_POST['uname']) && isset($_POST['passwd']) && $_POST['uname'] != null && $_POST['passwd'] != null){
		$uname = $_POST['uname'];
		$passwd = $_POST['passwd'];
		if($query = mysql_query("SELECT username FROM users WHERE username='".mysql_real_escape_string($uname)."'")){
			$query_row = mysql_fetch_assoc($query);
			$name = $query_row['username'];
			if($name == $uname){
				echo "Sorry username ".$uname." has been taken.";
			}else{
				$size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB);
				$salt = mcrypt_create_iv($size, MCRYPT_DEV_URANDOM);
				$hash = hash('sha256', $salt.$passwd);
				$reg_query = "INSERT INTO users(username, password, salt) VALUES ('".mysql_real_escape_string($uname)."','".mysql_real_escape_string($hash)."','".$salt."')";
				if($run_query = mysql_query($reg_query)){
					echo "Registration successful";
				}else{
					echo "Sorry, registration failed.";
				}
			}
		}
	}

?>

<form method="POST" action="register.php">
	Username: <input type="text" name="uname"/><br />
	Password: <input type="password" name="passwd"/>
	Confirm Password: <input type="password" id="confirmpass" />
	<input type="submit" />
</form>