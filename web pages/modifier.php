<!doctype html>
<html>
	<head>
		<meta charset = "utf - 8"/>
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
					if(isset($_POST['modify'])){
						$modify = $_POST['modify'];
						
						if($modify == "contactNo"){
				?>
							<br/><br/><br/>
							<form action  = "modifier.php" method = "post">
								employee ID: <input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
								new phone Number: <input type = "text" name = "newContact" value = "" size = "12" maxlength = "20" />
								<input type = "submit" name = "upContact" value = "update"/>
							<form>
				<?php	}
						else if($modify == "preAddress"){
				?>				
							<br/><br/><br/>
							<form action  = "modifier.php" method = "post">
								employee ID: <input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
								new address: <input type = "text" name = "newPreAddress" value = "" size = "20" maxlength = "80" />
								<input type = "submit" name = "upAddress" value = "update"/>
							<form>	
				<?php	}
						else if($modify == "qualific"){
				?>				
							<br/><br/><br/>
							<form action  = "modifier.php" method = "post">
								employee ID: <input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
								Degree Name: <input type = "text" name = "newDN" value = "" size = "10" maxlength = "30" />
								year: <input type = "text" name = "newDY" value = "" size = "10" maxlength = "5" />
								result: <input type = "text" name = "newDR" value = "" size = "10" maxlength = "20" />
								<input type = "submit" name = "upQualific" value = "update"/>
							<form>	
				<?php	}
						else if($modify == "retDate"){
				?>				
							<br/><br/><br/>
							<form action  = "modifier.php" method = "post">
								employee ID: <input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
								new retirement Date:
								<span>year-</span>
								<select name = "retYear">
									<option value = "">---</option>
									<?php for($i = 2015; $i <= 2050; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>
								</select>
								<span>month-</span>
								<select name = "retMonth">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 12; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select>
								
								<span>day-</span>
								<select name = "retDay">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 31; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select>
								<input type = "submit" name = "upRetDate" value = "update"/>
							<form>	
				<?php	}
						else if($modify == "desig"){
				?>				
							<br/><br/><br/>
							<form action  = "modifier.php" method = "post">
								employee ID: <input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
								new designation code: <input type = "text" name = "newDesig" value = "" size = "3" maxlength = "3" />
								appointment date:
								<span>year-</span>
								<select name = "apYear">
									<option value = "">---</option>
									<?php for($i = 2015; $i <= 2020; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>
								</select>
								<span>month-</span>
								<select name = "apMonth">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 12; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select>
								
								<span>day-</span>
								<select name = "apDay">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 31; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select>
								<input type = "submit" name = "upDesig" value = "update"/>
							<form>	
				<?php	}
						else if($modify == "supID"){
				?>				
							<br/><br/><br/>
							<form action  = "modifier.php" method = "post">
								employee ID: <input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
								new supervisor ID: <input type = "text" name = "newSupID" value = "" size = "10" maxlength = "10" />
								<input type = "submit" name = "upSupID" value = "update"/>
							<form>	
				<?php	}
						else if($modify == "penInfo"){
				?>				
							<br/><br/><br/>
							<form action  = "modifier.php" method = "post">
								employee ID: <input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
								amount: <input type = "text" name = "pension" value = "" size = "15" />
								<input type = "submit" name = "upPension" value = "update"/>
							<form>	
				<?php	}
						else if($modify == "depInfo"){
				?>			<br/><br/><br/>
							Dependent Information<br/><br/>
							<form action = "modifier.php" method = "post">
								<input type = "radio" name = "choice" value = "update"/>update
								<input type = "radio" name = "choice" value = "delete"/>delete<br/><br/>
								<input type = "submit" name = "dependent" value = "select"/>
							</form>
				<?php	}
				
					}
					
					
					if(isset($_POST['upContact'])){
						$res = $conn->query("update employee set contact_no = '".$_POST['newContact']."' where id = '".$_POST['eID']."'");
						if($res)echo "phone number updated successfully!";
						else echo "ERROR";
					}
					else if(isset($_POST['upAddress'])){
						$res = $conn->query("update employee set present_address = '".$_POST['newPreAddress']."' where id = '".$_POST['eID']."'");
						if($res)echo "present address updated successfully!";
						else echo "ERROR";
					}
					else if(isset($_POST['upQualific'])){
						$res = $conn->query("insert into employee_qualification values('".$_POST['eID']."', '".$_POST['newDN']."', '".$_POST['newDY']."', '".$_POST['newDR']."')");
						if($res)echo "qualification added successfully!";
						else echo "ERROR";
					}
					else if(isset($_POST['upRetDate'])){
						$res = $conn->query("update employee set ret_date = '".$_POST['retYear']."-".$_POST['retMonth']."-".$_POST['retDay']."' where id = '".$_POST['eID']."'");
						if($res)echo "retirement date updated successfully!";
						else echo "ERROR";
					}
					else if(isset($_POST['upDesig'])){
						$res = $conn->query("update employee set des_code = '".$_POST['newDesig']."' where id = '".$_POST['eID']."'");
						$res1 = $conn->query("insert into designation_and_performance(e_id, des_code, start_date) values('".$_POST['eID']."', '".$_POST['newDesig']."', '".$_POST['apYear']."-".$_POST['apMonth']."-".$_POST['apDay']."')");
						if($res && $res1)echo "designation updated successfully!";
						else echo "ERROR";
					}
					else if(isset($_POST['upSupID'])){
						$res = $conn->query("update employee set super_id = '".$_POST['newSupID']."' where id = '".$_POST['eID']."'");
						if($res)echo "supervisor updated successfully!";
						else echo "ERROR";
					}
					else if(isset($_POST['upPension'])){
						$res = $conn->query("update employee set pension = '".$_POST['pension']."' where id = '".$_POST['eID']."'");
						if($res)echo "pension updated successfully!";
						else echo "ERROR";
					}
					else if(isset($_POST['choice'])){
						$choice = $_POST['choice'];
						if($choice == "update"){
			?>				<br/><br/><br/>	
							add new depndent info:<br/><br/>
							<form action = "modifier.php" method = "post">
								employee ID: <input type = "text" name = "eID" value = "" size = "10" maxlength = "10"/><br/><br/>
								Name: <input type = "text" name = "depName" value = "" size = "10" maxlength = "45"/>
								Relation: <input type = "text" name = "depRel" value = "" size = "10" maxlength = "20"/>
								Sex: <select name = "dsex">
									<option value = "">---</option>
									<option value = "M">Male</option>
									<option value = "F">Female</option><br/><br/>
									<input type = "submit" name = "addDep" value = "update"/>
							<form><br/><br/><br/>
			<?php		}else{
			?>				<br/><br/><br/>	
							delete dependent info:<br/><br/>
							<form action = "modifier.php" method = "post">
								employee ID: <input type = "text" name = "eID" value = "" size = "10" maxlength = "10" /><br/><br/>
								dependent name <input type = "text" name = "depName" value = "" size = "10" maxlength = "45" />
								<input type = "submit" name = "delDep" value = "delete"/>
							<form>
			<?php		}
					}
					else if(isset($_POST['addDep'])){
						$res = $conn->Query("insert into dependent values('".$_POST['eID']."', '".$_POST['depName']."', '".$_POST['dsex']."', '".$_POST['depRel']."')");
						if($res)echo "dependent record updated successfully!";
						else echo "ERROR";
					}
					else if(isset($_POST['delDep'])){
						$res = $conn->query("delete from dependent where e_id = '".$_POST['eID']."' and name = '".$_POST['depName']."'");
						if($res)
							echo "dependent deleted successfully!";
						else "ERROR";
					}
				?>
			
		</div>
		<div id = "d3"><form action = "mid_layer.php"><input type = "submit" name = "logout" value = "logout"></form></div>	
	</body>
	
</html>