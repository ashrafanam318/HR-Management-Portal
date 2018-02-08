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
		<br/>
		<br/>
		<br/>
		<?php if( !(isset($_POST['setULeaveDate']) || isset($_POST['setPLeaveDate'])) && !isset($_POST['setLeave'])){	
		?>	
				<form action = "leave_management.php" method = "post">
					type:<br/><br/>
					<input type = "radio" name = "leave_type" value = "paid"/>paid
					<input type = "radio" name = "leave_type" value = "unpaid"/>unpaid<br/><br/>
					<input type = "submit" name = "setLeave" value = "select" />
				</form>
		<?php	}
		
		
			if(isset($_POST['setLeave'])){
				$leaveType = $_POST['leave_type'];
				if($leaveType == "unpaid"){
		?>			
					<form action = "leave_management.php" method = "post">
						ID:<input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
						
						Date:
						<span> year-</span>
								<select name = "year">
									<option value = "">---</option>
									<?php for($i = 2015; $i <= 2020; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>
								</select>
						<span>month-</span>
								<select name = "month">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 12; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select>
								
						<span>day-</span>
								<select name = "day">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 31; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select>
						
						<input type = "submit" name = "setULeaveDate" value = "save" />
					</form>
		<?php	}else if($leaveType == "paid"){
		?>
					<form action = "leave_management.php" method = "post">
						ID:<input type = "text" name = "eID" value = "" size = "10" maxlength = "10" /><br/><br/>
						type:
						<select name = "leaveType">
							<option value = "maternity">maternity</option>
							<option value = "earned">earned</option>
							<option value = "illness">illness</option>
							<option value = "illness">other</option>
						</select><br/><br/>
						start date:<br/><br/>
						<span>year-</span>
								<select name = "sYear">
									<option value = "">---</option>
									<?php for($i = 2015; $i <= 2020; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>
								</select>
								
						<span>month-</span>
								<select name = "sMonth">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 12; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select>
								
						<span>day-</span>
								<select name = "sDay">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 31; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select><br/><br/>
								
						end date:<br/><br/>
						<span>year-</span>
								<select name = "eYear">
									<option value = "">---</option>
									<?php for($i = 2015; $i <= 2050; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>
								</select>
								
						<span>month-</span>
								<select name = "eMonth">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 12; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select>
								
						<span>day-</span>
								<select name = "eDay">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 31; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select><br/><br/>
								
						<input type = "submit" name = "setPLeaveDate" value = "save" />
					</form>
		<?php	}
			}
			if(isset($_POST['setULeaveDate'])){
				
				//sql query to to save unpaid leave record
				$run = "insert into unpaid_leave(e_id, year, month, day) values('".$_POST['eID']."', '".$_POST['year']."', '".$_POST['month']."', '".$_POST['day']."')";
				$res = $conn->query($run);
				if($res)
					echo "unpaid leave record successfully saved!";
				else "ERROR";
			
			}else if(isset($_POST['setPLeaveDate'])){
				$sDate = $_POST['sYear']."-".$_POST['sMonth']."-".$_POST['sDay'];
				$eDate = $_POST['eYear']."-".$_POST['eMonth']."-".$_POST['eDay'];
				//echo $sDate."  ".$eDate;
				//sql query to to save paid leave record
				$run = "insert into paid_leave(e_id, type, start_date, end_date) values('".$_POST['eID']."', '".$_POST['leaveType']."', '".$sDate."', '".$eDate."')";
				$res = $conn->query($run);
				if($res)
					echo "paid leave record successfully saved!";
				else echo "ERROR";
			}
		?>
	</div>
	<div id = "d3"><form action = "mid_layer.php"><input type = "submit" name = "logout" value = "logout"></form></div>
</body>
</html>