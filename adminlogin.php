<?php 
session_start();
include("connectioncode.php");
?>
<!DOCTYPE html>
<html>
<head>
	<style>
		.btn
		{
			background-color: lightblue;
		}
		.btn:hover
		{
			 background-color: grey;
		}
		input[type=submit] 
		{
			background-color: #ff9900;
		}
		input[type=submit]:hover 
		{
 		 	background-color: #cc7a00;
		}
		input[type=email], select 
		{
			border-color: lightblue;
		}
	</style>
</head>
<body>
	<?php
		$emailerr=$passerr=$err="";
		$email=$pass=$name="";
		if ($_SERVER["REQUEST_METHOD"]=="POST")
		{
			if (empty($_POST["email"]))
		 	{
				$emailerr="name is required";
			}
			else
			{
				$email=test_input($_POST["email"]);
			}
			
			if (empty($_POST["password"]))
		 	{
				$passerr="password is required";
			}
			else{
			 	$pass=test_input($_POST["password"]);
			}
			$sql = "select * from newuser where email=\"$email\" and password=\"$pass\"";
			$vals = mysqli_query($conn, $sql);
			$num = mysqli_num_rows($vals);
			if(mysqli_num_rows($vals)>0){
				//echo "success";
				while($row=mysqli_fetch_array($vals)){
					$name=$row["fullname"];
					echo $name;
				}
				$_SESSION["loggedmail"]=$email;
				$_SESSION["loggedname"]=$name;
				
				header("Location:index.php");	
			}
			else{
				$err = "Invalid Email/Password";
			}
			mysqli_close($conn);
		}

		function test_input($data)
		{
			$data=trim($data);
			$data=stripcslashes($data);
			$data=htmlspecialchars($data);
			return $data;
		}
	?>
	<div>
		<center>
			<form style="border: 1px solid #d0e1e1; width: 25%; height: 250px" action="" method="post">
				<span class="error"><?php echo $err;?></span>
				<table>
					<tr>
						<td><font style="font-size: 30px;margin-left: -10px ;face: Arial Rounded MT; color:orange; font-weight: bold; ">World Tv</font></td>
					</tr>
					<tr>
						<td><br><font style="font-size: 20px;margin-left: -10px" face="Arial Rounded MT">Email<span class="error">* <?php echo $emailerr; ?></span></font></td>
					</tr>
					<tr>
						<td>
							<input type="email" name="email" placeholder="Enter Your Email" style="width: 250px;margin-left: -10px" required >
						</td>
					</tr>
					<tr>
						<td><br><font style="font-size: 20px;margin-left: -10px" face="Arial Rounded MT">Password<span class="error">* <?php echo $passerr; ?></span></font></td>
					</tr>
					<tr>
						<td>
							<input type="password" name="password" placeholder="Enter Your Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and atleast 8 or more characters" style="width: 250px;margin-left: -10px" required >
						</td>
					</tr>
					<tr>
						<td><br>
							<input type="submit" name="" value="Login" style="width: 300px;margin-left: -10px;height: 30px; cursor: pointer;">
						</td>
					</tr>
				</table>
			</form><br><br>
			<form action="index.php">
				<font style="margin-left: 10px; font-size: 15px;">--------------- New To Account? ----------------</font><br><br>
				<button  style="width: 340px;height: 30px;cursor: pointer;" class="btn">Create Your  Account</button>
			</form>
		</center>
	</div>
</body>
</html>