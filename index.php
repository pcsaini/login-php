<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style>
		body{
			color: #fff;
		}
		a{
			color: #f5f5f5;
			text-decoration: none;
		}
		a:hover{
			color: #fff;
		}
	</style>
</head>
<body>
	<?php
		include 'core/init.php';
		if (logged_in()) {
			echo "<h1> Hello ".$user_data['frist_name']."</h1>";
			echo '<a href="changepassword.php">Change Password</a><br>';
			echo '<a href="setting.php">Setting</a><br>';
			?>
			<a href="profile.php?username=<?php echo $user_data['username']?>">Profile</a><br>
			<?php
			echo '<a href="logout.php">logout</a>';

		}		
		else{
			echo '<a href="login.php">login</a>';
		}
	?>
	<h1>welcome</h1>

	<a href="test2.php">test2</a>
	
</body>
</html>