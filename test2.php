<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Welcome New Page</title>
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
			protecting_page();
			if (logged_in()) {
				echo "<h1> Hello ".$user_data[frist_name]."</h1>";
				echo '<a href="logout.php">logout</a>';

			}
			else{
				echo '<a href="login.php">login</a>';
			}
		?>
		<h1>test2</h1>
		<a href="index.php">Home</a>

	</body>
</html>