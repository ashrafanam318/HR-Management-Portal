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
			<form action = "fp_manager.php" method = "post">
			
				<span>Information:</span><br></br>
				<input type = "radio" name = "info" value = "basicInfo" />basic info.<br/></br/>
				<input type = "radio" name = "info" value = "desig_perform" />designation & performance<br/></br/>
				<input type = "radio" name = "info" value = "salaryRec" />salary record<br/></br/>
				<input type = "radio" name = "info" value = "dependents" />dependents<br/></br/>
				<input type = "radio" name = "info" value = "projects" />projects<br/></br/>
				<input type = "radio" name = "info" value = "subordinates" />subordinates<br/></br/>
				<input type = "radio" name = "info" value = "changePass" />change password<br/></br/>
				<input type = "submit" value = "go" />
			
			</form><br/><br/>
			<form action = "department_overview.php" method = "post"><input type = "submit" name = "viewDept" value = "view department" /></form>
	</div>
	
	<div id = "d2">
	<br/><br/>
	<?php session_start();
		$theID = $_SESSION['theID'];
		if(isset($_POST['viewDept'])){
			//sql query to get the dept name, number of employees, number of projects and total funds provided..
			
			$run1 = "select count(*), d.name from employee e join department d on e.dept_no = d.dept_no where d.dept_no = (
					select dept_no from employee where id = '".$theID."')";
			$res1 = $conn->query($run1);
			$r1 = $res1->fetch_assoc();
			$run2 = "select count(*), sum(p.fund) from project p join department d on p.dept_no = d.dept_no where d.dept_no = (
					select dept_no from employee where id = '".$theID."')";
			$res2 = $conn->query($run2);
			$r2 = $res2->fetch_assoc();
			if($r1 && $r2){
	?>		
				<br/><br/>
				department summary...
				<table border = "1">
					<tr>
						<th>Department</th>
						<th>Number of Employees</th>
						<th>Number of Projects</th>
						<th>Total fund provided</th>
					</tr>
					<tr>
						<td><?php echo $r1['name'];?></td>
						<td><?php echo $r1['count(*)'];?></td>
						<td><?php echo $r2['count(*)'];?></td>
						<td><?php echo $r2['sum(p.fund)'];?></td>
					</tr>
				</table>
				<br/><br/><br/><br/>
				<form action = "department_overview.php" method = "post">
					<input type = "submit" name = "viewEmp" value = "view employees" />
					<input type = "submit" name = "viewProj" value = "view projects" />
				</form>
	<?php 
			}
		}
		else if(isset($_POST['viewProj'])){
			$res = $conn->query("select p.id, p.name as p_name, p.start_date, p.end_date, p.fund, d.name, count(*) from project p join department d
					on p.dept_no = d.dept_no join employee_work_project ewp on p.id = ewp.p_id 
					where p.dept_no = (select dept_no from employee where id = '".$theID."') group by p.id");
			if($res){
	?>			
				<table border = "1">
					<tr>
						<th>deparment</th>
						<th>Project ID</th>
						<th>Project Name</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Employees working</th>
						<th> Fund Amount</th>
					</tr>
	<?php			while($row = $res->fetch_assoc()){ ?>	
						<tr>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['id'];?></td>
							<td><?php echo $row['p_name'];?></td>
							<td><?php echo $row['start_date'];?></td>
							<td><?php echo $row['end_date'];?></td>
							<td><?php echo $row['count(*)'];?></td>
							<td><?php echo $row['fund'];?></td>
						</tr>
	<?php 			} ?>
				</table>
	<?php	} ?>	
		<br/><br/>
		<form action = "department_overview.php" method = "post">
			<input type = "submit" name = "startNewProj" value = "start a new project">
		</form>
	<?php }
		else if(isset($_POST['viewEmp'])){
			//sql query to view employees...
			$run = "select e.id as eID, e.name as eName, e.sex, d.name as 'department',
					ds.name as 'designation', ds.grade, e.super_id as 'sup_id' 
					from employee e join department d on e.dept_no = d.dept_no
					join designation ds on e.des_code = ds.code where d.dept_no =(select dept_no from employee where id = '".$theID."')";
			$res = $conn->query($run);
	?>		
		<table border = "1">
								<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Sex</th>
								<th>Department</th>
								<th>Designation</th>
								<th>Grade</th>
								<th>Supervisors' ID</th>
								</tr>
								<tbody>
				<?php			while($row = $res->fetch_assoc()){
				?>					<tr>
										<td><?php echo $row['eID'];?></td>
										<td><?php echo $row['eName'];?></td>
										<td><?php echo $row['sex'];?></td>
										<td><?php echo $row['department'];?></td>
										<td><?php echo $row['designation'];?></td>
										<td><?php echo $row['grade'];?></td>
										<td><?php echo $row['sup_id'];?></td>
									</tr>
									
				<?php			}
				?>
								</tbody>
		</table>
		<br/><br/>
		<form action = "department_overview.php" method = "post">
			select by employee ID:<input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
			<input type = "submit" name = "showDetEmp" value = "show detail" />
		</form><br/><br/><br/>
		show promotion candidates<br/><br/>
		<form action = "department_overview.php" method = "post">
		<?php $run2 = "select distinct d.name from employee e join designation d on e.des_code = d.code 
					where d.name != 'manager' and e.dept_no = (select dept_no from employee where id = '".$theID."')";
			$res2 = $conn->query($run2);
		?>
			<!--drop down list for designation-->
			<span>designation:</span>
			<select name = "desig">
				<option value = "">---</option>
		<?php	while($row = $res2->fetch_assoc()){	?>
					<option value = "<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
		<?php	} ?>
			</select>
			floor rate:<input type = "text" name = "per_rate" maxlength = "4" size = "5"/>
			<input type = "submit" name = "showCan" value = "generate" />
		</form>
	<?php }
		else if(isset($_POST['startNewProj'])){
	?>		
			<br/><br/><br/><br/>
			<form action = "department_overview.php" method = "post">
				project ID:<input type = "text" name = "projID" value = "" size = "10" maxlength = "10" />
				project name: <input type = "text" name = "projName" value = "" size = "10" maxlength = "45" /><br/><br/>
				start date:
				<span>year-</span>
					<select name = "psYear">
						<option value = "">---</option>
						<?php for($i = 2015; $i <= 2020; $i++){ ?>
						<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
						<?php } ?>
					</select>
				<span>month-</span>
					<select name = "psMonth">
						<option value = "">---</option>
						<?php for($i = 1; $i <= 12; $i++){ ?>
						<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
						<?php } ?>	
					</select>		
				<span>day-</span>
					<select name = "psDay">
						<option value = "">---</option>
						<?php for($i = 1; $i <= 31; $i++){ ?>
						<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
						<?php } ?>	
					</select><br/><br/>
				end date:
				<span>year-</span>
					<select name = "peYear">
						<option value = "">---</option>
						<?php for($i = 2015; $i <= 2050; $i++){ ?>
						<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
						<?php } ?>
					</select>
				<span>month-</span>
					<select name = "peMonth">
						<option value = "">---</option>
						<?php for($i = 1; $i <= 12; $i++){ ?>
						<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
						<?php } ?>	
					</select>		
				<span>day-</span>
					<select name = "peDay">
						<option value = "">---</option>
						<?php for($i = 1; $i <= 31; $i++){ ?>
						<option value = "<?php echo $i;?>"> <?php echo $i; ?> </option>
						<?php } ?>	
					</select><br/><br/>
				fund amount:<input type = "text" name = "projFund" value = "" size = "11" maxlength = "11" /><br/><br/>
				<input type = "submit" name = "saveProj" value = "start project" />
			</form>
			
	<?php	}
			else if(isset($_POST['saveProj'])){
				//sql query to save the project...
				$r1 = $conn->query("select dept_no from employee where id = '".$theID."'");
				$rw1 = $r1->fetch_assoc();
				$sDate = $_POST['psYear']."-".$_POST['psMonth']."-".$_POST['psDay'];
				$eDate = $_POST['peYear']."-".$_POST['peMonth']."-".$_POST['peDay'];
				$run = "insert into project(id, name, dept_no, start_date, end_date, fund)
						values('".$_POST['projID']."', '".$_POST['projName']."', '".$rw1['dept_no']."', '".$sDate."', '".$eDate."', '".$_POST['projFund']."')";
				$res = $conn->query($run);
				if($res)
					echo "new project added";
				else echo "ERROR";
			}
			else if(isset($_POST['showDetEmp'])){
				//sql query to show the detail info of the employee...
				$run = "select e.id as eID, e.name as eName, e.sex, e.birth_date, e.present_address, e.permanent_address, e.contact_no, d.name as 'department',
						ds.name as 'designation', e.ret_date, e.super_id, dap.net_per 
						from employee e join department d on e.dept_no = d.dept_no 
						join designation ds on e.des_code = ds.code 
						join designation_and_performance dap
						on e.id = dap.e_id where e.des_code = dap.des_code and id = '".$_POST['eID']."' 
						and d.dept_no = (select dept_no from employee where id = '".$theID."')";
				$res = $conn->query($run);
	?>			
				<table border = "1">
								<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Sex</th>
								<th>Birth Day</th>
								<th>Present Address</th>
								<th>Permanent Address</th>
								<th>Phone Number</th>
								<th>Department</th>
								<th>Designation</th>
								<th>Supervisor'ID</th>
								<th>Performance Rate</th>
								<th>Retirement Date</th>
								</tr>
								<tbody>
				<?php			while($row = $res->fetch_assoc()){
				?>					<tr>
										<td><?php echo $row['eID'];?></td>
										<td><?php echo $row['eName'];?></td>
										<td><?php echo $row['sex'];?></td>
										<td><?php echo $row['birth_date'];?></td>
										<td><?php echo $row['present_address'];?></td>
										<td><?php echo $row['permanent_address'];?></td>
										<td><?php echo $row['contact_no'];?></td>
										<td><?php echo $row['department'];?></td>
										<td><?php echo $row['designation'];?></td>
										<td><?php echo $row['super_id'];?></td>
										<td><?php echo $row['net_per'];?></td>
										<td><?php echo $row['ret_date'];?></td>
									</tr>
									
				<?php			}
				?>
							</tbody>
				</table>
				<br/><br/>
				<form action = "department_overview.php" method = "post">
					employee ID:<input type = "text" name = "eID" value = "" size = "10" maxlength = "10" />
					<input type = "submit" name = "showDetEmp" value = "show detail" />
				</form>
	<?php	}
			else if(isset($_POST['showCan'])){
				//sql query to show atmost 3 promotion candidates...
				$run = "select e.id, e.name, d.name as desig, dap.net_per from employee e join designation d on e.des_code = d.code
						join designation_and_performance dap on dap.e_id = e.id
						where e.des_code = ( select code from designation where name = '".$_POST['desig']."') and dap.net_per >= '".$_POST['per_rate']."'
						order by dap.net_per desc limit 3";
				$res = $conn->query($run);
	?>			
				<table border = "1">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Designation</th>
						<th>Performance Rate</th>
					</tr>
	<?php			while($row = $res->fetch_assoc()){ ?>
						<tr>
							<td><?php echo $row['id'];?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['desig'];?></td>
							<td><?php echo $row['net_per'];?></td>
						</tr>
	<?php			} ?>
					
				</table>
	<?php		}
	?> 
		
	
	</div>
	<div id = "d3"><form action = "mid_layer.php"><input type = "submit" name = "logout" value = "logout"></form></div>
</body>
</html>