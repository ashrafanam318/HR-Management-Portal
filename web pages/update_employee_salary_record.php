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
			<form action = "fp_desk_account.php" method = "post">
			
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
				<li><a href = "update_employee_salary_record.php">update employee salary record</a></li><br/>
			</ul>
	</div>
	
	<div id = "d2">
	<?php if(!isset($_POST['showRecord']) && !isset($_POST['upSalary'])){	
	?>		<br/><br/><br/><br/>
			<form action = "update_employee_salary_record.php" method = "post">
				<span>employee ID:</span> <input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
				
				<span>month:</span>
				<select name = "month">
					<option value = "">---</option>
					<?php for($i = 1; $i <= 12; $i++){ ?>
					<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
					<?php } ?>	
				</select>
				
				<span>year:</span>
				<select name = "year">
					<option value = "">---</option>
					<?php for($j = 2015; $j <= 2020; $j++){ ?>
					<option value = "<?php echo $j;?>"> <?php echo $j; ?> </option>
					<?php } ?>	
				</select>
				<input type = "submit" name = "showRecord" value = "show record"/>
			</form>
			
	<?php }
		else if(isset($_POST['showRecord'])){
			//sql query to retrieve leave & loan record of the employee for the given month & year..
			echo "Salary Breakdown...<br/><br/>";
							
							$run1 = "select ds.name, js.grade, js.salary_basic, js.salary_rent, js.salary_transport,
									js.salary_medical, js.salary_sustenance, 
									js.salary_basic+js.salary_rent+js.salary_transport+js.salary_medical+js.salary_sustenance
									as 'total' from employee e join designation ds on e.des_code = ds.code
									join job_scale js on js.grade = ds.grade where e.id = '".$_POST['eID']."'";
							$res1 = $conn->query($run1);
							if($res1){
	?>						
								<table border = "1">
									<tr>
										<th>Designation</th>
										<th>Grade</th>
										<th>Basic (TK)</th>
										<th>Rent (TK)</th>
										<th>Transport (TK)</th>
										<th>Medical (TK)</th>
										<th>Sustenance (TK)</th>
										<th>Total Amount (TK)</th>
									</tr>
					<?php				while($row = $res1->fetch_assoc()){
					?>						<tr>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['grade']; ?></td>
												<td><?php echo $row['salary_basic']; ?></td>
												<td><?php echo $row['salary_rent']; ?></td>
												<td><?php echo $row['salary_transport']; ?></td>
												<td><?php echo $row['salary_medical']; ?></td>
												<td><?php echo $row['salary_sustenance']; ?></td>
												<td><?php echo $row['total']; ?></td>
											</tr>
					<?php					}
					?>			</table>
				<?php		}else echo "Cannot get salary record";
		
									$run2 = "select count(*) as 'u_ab', e.name, e.id, round(count(*)*js.salary_basic/22, 0) as 'u_adj' 
											from employee e join unpaid_leave u on e.id = u.e_id 
											join designation ds on e.des_code = ds.code 
											join job_scale js on js.grade = ds.grade
											where e_id = '".$_POST['eID']."' and month = '".$_POST['month']."' and year = '".$_POST['year']."'";
									$run3 = "select type, start_date, end_date from paid_leave where e_id = '".$_POST['eID']."'";
									$run4 = "select round(amount/months_to_repay, 0) as 'loan_adj' from loan_taken where e_id = '".$_POST['eID']."'";
							
							$res2 = $conn->query($run2);
							$res3 = $conn->query($run3);
							$res4 = $conn->query($run4);
							$row2 = $res2->fetch_assoc();
							$row3 = $res3->fetch_assoc();
							$row4 = $res4->fetch_assoc();
							if($res2 && $res3 && $res3){
								
					?>			<br/><br/>leave and loan record...<br/><br/>
								<table border = "1">
									<tr>
										<th>ID</th>
										<th>Unpaid Leave (days)</th>
										<th><-adjustment (TK)</th>
										<th>Paid Leave Type</th>
										<th><-start date</th>
										<th><-end date</th>
										<th><-adjust from</th>
										<th>Loan Adjustment(TK)</th>
									</tr>
										<tr>
											<td><?php echo $_POST['eID'];?></td>
											<td><?php echo $row2['u_ab'];?></td>
											<td><?php echo $row2['u_adj'];?></td>
											<td><?php echo $row3['type'];?></td>
											<td><?php echo $row3['start_date'];?></td>
											<td><?php echo $row3['end_date'];?></td>
											 <?php if(strcmp("".$row3['type'], "other") == 0) echo "<td>unspecified</td>";
												  else if(strcmp("".$row3['type'], "earned") == 0)echo "<td>nill</td>";
												  else if(strcmp("".$row3['type'], "maternity") == 0 || strcmp("".$row3['type'], "illness") == 0)
													  echo "<td>transport</td>";
												  else echo "<td> - </td>";
											 ?> 
											<td><?php echo $row4['loan_adj'];?></td>
										</tr>
								</table>
	<?php					}else echo "could not get leave and loan record!";
	?>		<br/><br/><br/><br/>
			update salary information:<br/><br/>
			<form action = "update_employee_salary_record.php" method = "post">
				employee ID <input type = "text" name = "eID" value = "<?php echo $_POST['eID']; ?>" size = "10" maxlength = "10" />
				month: <input type = "text" name = "month" value = "<?php echo $_POST['month']; ?>" size = "2" maxlength = "2" />
				year: <input type = "text" name = "year" value = "<?php echo $_POST['year']; ?>" size = "4" maxlength = "4" /><br/><br/>
				leave adjustment: <input type = "text" name = "leaveAdj" value = "" maxlength = "11" size = "11" />
				loan adjustment: <input type = "text" name = "loanAdj" value = "" maxlength = "11" size = "11" />
				final amount: <input type = "text" name = "finAmount" value = "" maxlength = "11" size = "11" /><br/><br/>
				<input type = "submit" name = "upSalary" value = "update"/>
			</form>
	<?php }
		else if(isset($_POST['upSalary'])){
			//sql query to update the salary record with given info...
			$run = "insert into employee_salary_record(e_id, year, month, leave_adj, loan_adj, fin_amount) values('".$_POST['eID']."', '".$_POST['year']."', '".$_POST['month']."', '".$_POST['leaveAdj']."', '".$_POST['loanAdj']."', '".$_POST['finAmount']."')";
			$res = $conn->query($run);
			if($res)
				echo "salary record has been successfully updated.";
			else echo "ERROR";
		}
	?>
		
	</div>
	<div id = "d3"><form action = "mid_layer.php"><input type = "submit" name = "logout" value = "logout"></form></div>
</body>
</html>