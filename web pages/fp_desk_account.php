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
				<br/><br/>
				<?php
					session_start();
					
					$theID = $_SESSION["theID"];
					
					if(isset($_POST['info'])){
						
						$info = $_POST['info'];
						
						if($info == "basicInfo"){
							
							$randomVar= "select e.id as eID, e.name as eName, e.sex, e.birth_date, e.present_address, e.contact_no, d.name as 'department',
										ds.name as 'designation', e.ret_date, e.super_id as 'supervisor' 
										from employee e join department d on e.dept_no = d.dept_no 
										join designation ds on e.des_code = ds.code where e.id = '".$theID."'";
										
							$result1= $conn->query($randomVar);
				?>
							<table border = "1">
								<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Sex</th>
								<th>Birth Day</th>
								<th>Present Address</th>
								<th>Phone Number</th>
								<th>Department</th>
								<th>Designation</th>
								<th>Supervisor'ID</th>
								<th>Retirement Date</th>
								</tr>
								<tbody>
				<?php			while($row = $result1->fetch_assoc()){
				?>					<tr>
										<td><?php echo $row['eID'];?></td>
										<td><?php echo $row['eName'];?></td>
										<td><?php echo $row['sex'];?></td>
										<td><?php echo $row['birth_date'];?></td>
										<td><?php echo $row['present_address'];?></td>
										<td><?php echo $row['contact_no'];?></td>
										<td><?php echo $row['department'];?></td>
										<td><?php echo $row['designation'];?></td>
										<td><?php echo $row['supervisor'];?></td>
										<td><?php echo $row['ret_date'];?></td>
									</tr>
									
				<?php			}
				?>
							</tbody>
							</table>
							<br/><br/>
							
				<?php 		$run = "select * from employee_qualification where e_id = '".$theID."'";
							$res = $conn->query($run);
				?>			Qualification:
							<table border = "1">
								<tr>
									<th>Degree</th>
									<th>Grad. Year</th>
									<th>Result</th>
								</tr>
				<?php			while($row = $res->fetch_assoc()){
				?>					<tr>
										<td><?php echo $row['degree']; ?></td>
										<td><?php echo $row['grad_year']; ?></td>
										<td><?php echo $row['result']; ?></td>
									</tr>
				<?php			}
				?>			</table>
							
				<?php	}
						else if($info == "desig_perform"){
							
							$randomVar= "select ds.name, dp.start_date, dp.net_per 
										from employee e join designation_and_performance dp on e.id =dp.e_id 
										join designation ds on ds.code = dp.des_code where e.id='".$theID."'";
										
							$result2= $conn->query($randomVar);
				?>			
							<table border = "1">
								<tr>
								<th>Designation</th>
								<th>Appointment Date</th>
								<th>Performance Rate</th>
								</tr>
								<tbody>
				<?php			while($row = $result2->fetch_assoc()) {
				?>					<tr>
										<td><?php echo $row['name'];?></td>
										<td><?php echo $row['start_date'];?></td>
										<td><?php echo $row['net_per'];?></td>
									</tr>
									
				<?php			}
				?>
							</tbody>
							</table>
						
				<?php 	}
						else if($info == "salaryRec"){
							
							echo "Salary Breakdown...<br/><br/>";
							
							$run = "select ds.name, js.grade, js.salary_basic, js.salary_rent, js.salary_transport,
									js.salary_medical, js.salary_sustenance, 
									js.salary_basic+js.salary_rent+js.salary_transport+js.salary_medical+js.salary_sustenance
									as 'total' from employee e join designation ds on e.des_code = ds.code
									join job_scale js on js.grade = ds.grade where e.id = '".$theID."'";
							$res = $conn->query($run);
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
				<?php				while($row = $res->fetch_assoc()){
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
				?>			
							</table>
							
							<br/><br/><br/>
							View salary record by month...
							<br/><br/>
							<form action = "fp_desk_account.php" method = "post">
								
								<span>Month:</span>
								<select name = "month">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 12; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select>
								
								<span>Year:</span>
								<select name = "year">
									<option value = "">---</option>
									<?php for($j = 2015; $j <= 2020; $j++){ ?>
										<option value = "<?php echo $j;?>"> <?php echo $j; ?> </option>
									<?php } ?>	
								</select>
								
								<input type = "submit" name = "getSal" value = "get record"/>
							</form>
							
							<br/><br/><br/><br/>
							<!--link to entire salary recond-->
							<form action  = "fp_desk_account.php" method = "post">
								<input type = "submit" name = "fullSalRec" value = "view entire salary record" />
							</form>
				<?php 
						}
						else if($info == "dependents"){
							
							$randomVar= "select * from dependent where e_id='".$theID."'";
							$result2= $conn->query($randomVar);
				?>		
							<table border = "1">			
								<tr>
								<th>Name</th>
								<th>Sex</th>
								<th>Relation</th>
								</tr>
								<tbody>
				<?php			while($row = $result2->fetch_assoc()) {
				?>					<tr>
										<td><?php echo $row['name'];?></td>
										<td><?php echo $row['sex'];?></td>
										<td><?php echo $row['relation'];?></td>
									</tr>
									
				<?php			}
				?>
							</tbody>
							</table>
				<?php	}
						else if($info == "projects"){
							
							$randomVar= "select p.name as 'project', d.name as 'dept'
										from employee e join employee_work_project ewp on e.id = ewp.e_id
										join project p on ewp.p_id = p.id 
										join department d on d.dept_no = p.dept_no
										where e_id='".$theID."'";
										
							$result2= $conn->query($randomVar);
				?>			
							<table border = "1">			
								<tr>
								<th>Projects</th>
								<th>Department</th>
								</tr>
								<tbody>
				<?php			while($row = $result2->fetch_assoc()) {
				?>					<tr>
										<td><?php echo $row['project'];?></td>
										<td><?php echo $row['dept'];?></td>
									</tr>
									
				<?php			}
				?>
							</tbody>
							</table>
							
				<?php 	}
						else if($info == "changePass"){
				?>					
							<br/><br/><br/><br/><br/>
							<form action = "fp_desk_account.php" method = "post">
								type in new password:<input type = "text" name = "ePass" value = "" size = "10" maxlength = "30" />
								<input type = "submit" value = "change" name = "passChange" />
							</form>
								
				<?php	}
					
					}
					
					else if(isset($_POST['passChange'])){
						
						$run = "update employee set password = '".$_POST['ePass']."' where id = '".$theID."'";
						
						$res = $conn->query($run);
						
						if($res)echo "password changed successfully";
						
						else echo "ERROR ERROR ERROR"; 
						
					}
					
					else if(isset($_POST['getSal'])){
						
						$year = $_POST['year'];
						$month = $_POST['month'];
						$randomVar= "select * from employee_salary_record where e_id ='".$theID."' and month= '".$month."' and year ='".$year."'";
						$result2= $conn->query($randomVar);
				?>	
						<table border = "1">
								<tr>
								<th>Month</th>
								<th>Year</th>
								<th>Leave Adjustment</th>
								<th>Loan Adjustment</th>
								<th>Final Amount</th>
								</tr>
								<tbody>
				<?php			while($row = $result2->fetch_assoc()){
				?>					<tr>
										<td><?php echo $row['month'];?></td>
										<td><?php echo $row['year'];?></td>
										<td><?php echo $row['leave_adj'];?></td>
										<td><?php echo $row['loan_adj'];?></td>
										<td><?php echo $row['fin_amount'];?></td>
									</tr>
									
				<?php			}
				?>
							</tbody>
							</table>
							<br/><br/>
							<form action = "fp_desk_account.php" method = "post">
								
								<span>Month:</span>
								<select name = "month">
									<option value = "">---</option>
									<?php for($i = 1; $i <= 12; $i++){ ?>
										<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
									<?php } ?>	
								</select>
								
								<span>Year:</span>
								<select name = "year">
									<option value = "">---</option>
									<?php for($j = 2015; $j <= 2020; $j++){ ?>
										<option value = "<?php echo $j;?>"> <?php echo $j; ?> </option>
									<?php } ?>	
								</select>
								
								<input type = "submit" name = "getSal" value = "get record"/>
							</form>
				<?php	
					}
					
					else if(isset($_POST['fullSalRec'])){
						
						$randomVar= "select * from employee_salary_record where e_id ='".$theID."'";
						$result2= $conn->query($randomVar);
				?>	
						<table border = "1">
								<tr>
								<th>Month</th>
								<th>Year</th>
								<th>Leave Adjustment</th>
								<th>Loan Adjustment</th>
								<th>Final Amount</th>
								</tr>
								<tbody>
				<?php			while($row = $result2->fetch_assoc()){
				?>					<tr>
										<td><?php echo $row['month'];?></td>
										<td><?php echo $row['year'];?></td>
										<td><?php echo $row['leave_adj'];?></td>
										<td><?php echo $row['loan_adj'];?></td>
										<td><?php echo $row['fin_amount'];?></td>
									</tr>
									
				<?php			}
				?>
							</tbody>
							</table>
						
				<?php
					}	
					else echo "click a catagory!!!";
			?>
			
		</div>
		<div id = "d3"><form action = "mid_layer.php"><input type = "submit" name = "logout" value = "logout"></form></div>
	</body>
	
</html>