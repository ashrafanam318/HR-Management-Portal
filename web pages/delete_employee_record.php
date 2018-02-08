<!doctype html>
<html>
<head>
	<meta charset = "utf - 8"/>
	<title>HR</title>
	<link rel = "stylesheet" href = "design.css"/>
</head>
<body>
	<?php
		
			$hostname = "localhost";
			$username = "root";
			$password = "";
			$databasename = "hr_dept";
							
			$conn = new mysqli($hostname, $username, $password, $databasename);
			
			if($conn->connect_error)die("Database connection failed" . $conn->connect_error);
		
		?>
	<div id = "d1">
			<form action = "fp_desk_assist.php" method = "post">
			
				<span>Information:</span><br></br>
				<input type = "radio" name = "info" value = "basicInfo" />basic info.<br></br>
				<input type = "radio" name = "info" value = "desig_perform" />designation & performance<br></br>
				<input type = "radio" name = "info" value = "salaryRec" />salary record<br></br>
				<input type = "radio" name = "info" value = "dependents" />dependents<br></br>
				<input type = "radio" name = "info" value = "projects" />projects<br></br>
				<input type = "radio" name = "info" value = "changePass" />change password<br/></br/><br/>
				<input type = "submit" value = "go" /><br/><br/>
			
			</form>
			
			<br/><br/>
			<span>Task area</span>
			<ul>
				<li><a href = "add_new_employee.php">add new employee info</a></li><br/>
				<li><a href = "modify_employee_info.php">modify employee info</a></li><br/>
				<li><a href = "leave_management.php">leave management</a></li><br/>
				<li><a href = "loan_management.php">loan management</</a></li><br/>
				<li><a href = "delete_employee_record.php">delete employee record</a></li><br/>
			</ul>
	</div>
	
	<div id = "d2">
		<br/><br/><br/><br/><br/><br/>
		<?php if(!isset($_POST['delEmpRecord'])){
		?>		
				<form action = "" method = "post">
					ID:<input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
					<input type = "submit" name = "delEmpRecord" value = "delete" />
				</form>
		<?php }
		
		
			if(isset($_POST['delEmpRecord'])){
				//sql query to delete employee record
				$res = $conn->query("delete from employee where id = ".$_POST['eID']);
				if($res)
					echo "employee record successfully!";
				else echo "ERROR";
			}
		?>
	</div>
	<div id = "d3"><form action = "mid_layer.php"><input type = "submit" name = "logout" value = "logout"></form></div>
</body>
</html>