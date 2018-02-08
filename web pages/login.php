<!doctype html>
<html>
	<head>
		<meta charset = "utf - 8" />
		<title>HR</title>
		<link rel = "stylesheet" href = "design.css" />
	</head>
	<body class = "center">
		<?php
		?>
		<div class = "login">
			<form action = "mid_layer.php" method = "post">
				<span>ID:</span><br/>
				<input type = "text" name = "id" size = "20" maxlength = "10"/><br/><br/>
				
				<span>Password:</span><br/>
				<input type = "password" name = "password" size = "20" maxlength = "30"/><br/><br/>
				
				<input type = "submit" name = "login" value = "login" /><br></br>
			</form>
		</div>
	</body>
</html>