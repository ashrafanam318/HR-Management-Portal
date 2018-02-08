<!doctype html>
<html>
	<head>
		<meta charset = "utf - 8" />
		<title>HR</title>
		<link rel = "stylesheet" href = "design.css" />
	</head>
	
	<body>
		
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
						<br/>
						<br/>
						<br/>
						<br/>
						<form action = "modifier.php" method = "post">
							
							<input type = "radio" name = "modify" value = "contactNo" /> update phone number<br/><br/>
							<input type = "radio" name = "modify" value = "preAddress" /> update present address<br/><br/>
							<input type = "radio" name = "modify" value = "qualific" /> add new qualification<br/><br/>
							<input type = "radio" name = "modify" value = "retDate" /> update retirement date<br/><br/>
							<input type = "radio" name = "modify" value = "desig" /> update designation<br/><br/>
							<input type = "radio" name = "modify" value = "supID" /> update supervisor<br/><br/>
							<input type = "radio" name = "modify" value = "penInfo" /> pension info<br/><br/>
							<input type = "radio" name = "modify" value = "depInfo" /> dependent info<br/><br/>
							<input type = "submit" name = "select" value = "select" />
							
						</form>

		</div>
		<div id = "d3"><form action = "mid_layer.php"><input type = "submit" name = "logout" value = "logout"></form></div>
	</body>
</html>