<?php
	require 'db_conn.php';

	session_start();

	if(isset($_POST['uname']) && isset($_POST['passwd']) && $_POST['uname'] != null && $_POST['passwd'] != null){
		$uname = $_POST['uname'];
		if ($query = mysql_query("SELECT username, password, salt FROM users WHERE username='".mysql_real_escape_string($uname)."'")) {
			if(mysql_num_rows($query) == 0){
				echo "incorrect username/password";
			}else{
				while ($queryrow = mysql_fetch_assoc($query)){
					$passwd = hash('sha256', $queryrow['salt'].$_POST['passwd']);
					$username = $queryrow['username'];
					$password = $queryrow['password'];
					if ($uname == $username and $passwd == $password) {
						$_SESSION['user_id'] = $uname;
						header('Location: index.php');
					}else{
						echo "incorrect username/password";
					}
				}
			}
		}

	}

?>