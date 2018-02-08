<!doctype html>
<html>
	<head>
		<meta charset = "utf - 8"/>
	</head>
				
	<body>
		<?php
						session_start();
						
						$hostname = "localhost";
						$username = "root";
						$password = "";
						$databasename = "hr_dept";
										
						$conn = new mysqli($hostname, $username, $password, $databasename);
						
						if($conn->connect_error)die("Database connection failed" . $conn->connect_error);
				
						$redirect = false;
						if(isset($_POST['login'])){
					
						$id = $_POST['id'];
						$password = $_POST['password'];
					
					//sql queries and php code for authentication...
						$loginQuery = "SELECT * FROM employee WHERE id = '" . $id . "' and password = '" . $password . "'";
						
						$result = $conn->query($loginQuery);
						
						if($result->num_rows == 1) {
							$_SESSION["theID"]=$id;
							$redirect= true;
						}
						else {
							echo 'Login failed!';
						}
					//if valid user set $redirect = true
					
					if($redirect == true){
						$loginQuery = ("SELECT des_code FROM employee WHERE id = '" . $id."'");
						$result = $conn->query($loginQuery);
						$row= $result->fetch_assoc();
						$des_code = $row['des_code'];
						if($des_code == "a1")header('Location: fp_manager.php');
						else if($des_code == "e1")header('Location: fp_desk_assist.php');
						else if($des_code == "d4")header('Location: fp_desk_account.php');
						else header('Location: fp_nor_emp.php');
					}
					else header('Location: login.php');
				}
				else{
					header('Location: login.php');
					session_destroy();
				}
		?>
	</body>
</html>