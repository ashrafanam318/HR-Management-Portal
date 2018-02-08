<!doctype html>
<html>
	<head>
		<meta charset = "utf - 8" />
		<title>HR</title>
		<link rel = "stylesheet" href = "design.css" />
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
			<?php
				if(!isset($_POST['saveEmp'])){
			?>
						<br/>
						<form action = "add_new_employee.php" method = "post">							
							
							ID: <input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
							password: <input type = "text" name = "ePass" value = "" size = "10" maxlength = "30" /><br/><br/>
							Name: <input type = "text" name = "eName" value = "" size = "10" maxlength = "45" /><br/><br/>
							Birth Date:<br/><br/>
							<span>year-</span>
								<select name = "bYear">
									<option value = "">---</option>
									<?php for($i = 1940; $i <= 1998; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>
								</select>
							<span>month-</span>
								<select name = "bMonth">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 12; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select>
								
							<span>day-</span>
								<select name = "bDay">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 31; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select><br/><br/>
							Sex: <select name = "sex">
									<option value = "">---</option>
									<option value = "M">Male</option>
									<option value = "F">Female</option>
								</select><br/><br/>
							Phone Number: <input type = "text" name = "contactNo" value = "" size = "12" maxlength = "20" />
							Present Address: <input type = "text" name = "pre_add" value = "" size = "20" maxlength = "80" />						
							Permanent Address: <input type = "text" name = "per_add" value = "" size = "20" maxlength = "80" /><br/><br/>
							Qualification:<br/><br/>
										Degree 1:<p> </p>
										Name: <input type = "text" name = "d1n" value = "" size = "10" maxlength = "30" />	
										Graguation Year: <input type = "text" name = "d1y" value = "" size = "10" maxlength = "5" />	
										Result: <input type = "text" name = "d1r" value = "" size = "10" maxlength = "20" /><br/></br>
										Degree 2:<p> </p>
										Name: <input type = "text" name = "d2n" value = "" size = "10" maxlength = "30" />	
										Graguation Year: <input type = "text" name = "d2y" value = "" size = "10" maxlength = "5" />	
										Result: <input type = "text" name = "d2r" value = "" size = "10" maxlength = "20" /><br/></br>
							Department Number: <select name = "deptNo">
												<?php for($i = 1; $i <= 5; $i++){ ?>
													<option value = "<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php } ?>
												</select><br/><br/>					
							Date of Joining:<br/><br/>
							<span>year-</span>
								<select name = "jYear">
									<option value = "">---</option>
									<?php for($i = 2015; $i <= 2020; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>
								</select>
							<span>month-</span>
								<select name = "jMonth">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 12; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select>
								
							<span>day-</span>
								<select name = "jDay">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 31; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select><br/><br/>
							Date of Retirement:<br/><br/>
							<span>year-</span>
								<select name = "rYear">
									<option value = "">---</option>
									<?php for($i = 2015; $i <= 2050; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>
								</select>
							<span>month-</span>
								<select name = "rMonth">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 12; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select>
								
							<span>day-</span>
								<select name = "rDay">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 31; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select><br/><br/>
							Designation Code: <input type = "text" name = "dCode" size = "3" maxlength = "3" />
							Supervisor's ID: <input type = "text" name = "supID" value = "" size = "10" maxlength = "10" /><br/><br/>
							
								 
							<input type = "submit" name = "saveEmp" value = "save" />
							<input type = "reset" value = "reset" />
						
						</form>
				<?php }else{
							$id = $_POST['eID'];
							$pass = $_POST['ePass'];
							$name = $_POST['eName'];
							$bDate = $_POST['bYear']."-".$_POST['bMonth']."-".$_POST['bDay'];
							$sex = $_POST['sex'];
							$preAdd = $_POST['pre_add'];
							$perAdd = $_POST['per_add'];
							$contactNo = $_POST['contactNo'];
							$dept = $_POST['deptNo'];
							$dCode = $_POST['dCode'];
							$retDate = $_POST['rYear']."-".$_POST['rMonth']."-".$_POST['rDay'];
							$sid = $_POST['supID'];
							
							$run = "insert into employee(id, password, name, birth_date, sex, present_address, permanent_address, contact_no, dept_no, des_code, ret_date, super_id)
									values('".$id."','".$pass."','".$name."','".$bDate."','".$sex."','".$preAdd."','".$perAdd."','".$contactNo."','".$dept."','".$dCode."','".$retDate."','".$sid."')";
							$res = $conn->query($run);
							
							$d1n = $_POST['d1n'];
							$d1y = $_POST['d1y'];
							$d1r = $_POST['d1r'];
							$d2n = $_POST['d2n'];
							$d2y = $_POST['d2y'];
							$d2r = $_POST['d2r'];
							
							$run2 = "insert into employee_qualification values('".$id."', '".$d1n."', '".$d1y."', '".$d1r."'), ('".$id."', '".$d2n."', '".$d2y."', '".$d2r."')";
							$res2 = $conn->query($run2);
							
							$apDate = $_POST['jYear']."-".$_POST['jMonth']."-".$_POST['jDay'];
							$run3 = "insert into designation_and_performance(e_id, des_code, start_date) values('".$id."', '".$dCode."', '".$apDate."')";
							$res3 = $conn->query($run3);
							
							
							if($res && $res2 && $res3)echo "success";
							else echo "ERROR! some fields may still be empty!";
							
					   }
					?>
		</div>
		<div id = "d3"><form action = "mid_layer.php"><input type = "submit" name = "logout" value = "logout"></form></div>
	</body>
</html>