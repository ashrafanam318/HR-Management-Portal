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
		<?php if(!(isset($_POST['saveLoan']) || isset($_POST['retDate']))){
		?>
				<form action = "loan_management.php" method = "post">
					ID:<input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
					<input type = "submit" name = "retDate" value = "show retirement date" />
				</form>
		<?php }
			 else if(isset($_POST['retDate'])){
				 
				//sql query to get the retirement date of the employee...
				echo "retirement info";
				$res = $conn->query("select id, ret_date from employee where id = ".$_POST['eID']);
		?>		
				<table border = 1>
					<tr>
						<th>ID</th>
						<th>Retirement Date</th>
					</tr>
		<?php		$row = $res->fetch_assoc(); ?>
					<tr>
						<td><?php echo $row['id']?></td>
						<td><?php echo $row['ret_date']?></td>
					</tr>
				</table>
				<br/><br/><br/>
				<form action = "loan_management.php" method = "post">
					ID:<input type = "text" name = "eID" value = "<?php echo $_POST['eID']; ?>" size = "10" maxlength = "10" />
					amount: <input type = "text" name = "amount" value = "" size = "15" />
					sanction date:
						<span>year-</span>
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
					time span: <input type = "text" name = "monthsToRepay" value = "" size = "8"/>month(s).
					<input type = "submit" name = "saveLoan" value = "save" />
				</form>
				
		<?php }
			 else if(isset($_POST['saveLoan'])){
				 
				 //sql query to save the loan record
				 $run = "insert into loan_taken(e_id, amount, sanc_date, months_to_repay) 
						values('".$_POST['eID']."', '".$_POST['amount']."', '".$_POST['year']."-".$_POST['month']."-".$_POST['day']."', '".$_POST['monthsToRepay']."')";
				$res = $conn->query($run);
				if($res)
				 echo "loan record saved successfully!";
				else "ERROR";
				 
			 }
		?>
	</div>
	
	<div id = "d3"><form action = "mid_layer.php"><input type = "submit" name = "logout" value = "logout"></form></div>

</body>

</html>