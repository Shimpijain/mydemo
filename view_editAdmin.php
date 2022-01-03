<?php
include("connectioncode.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>View/Edit</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<script type="text/javascript">

function changesDone(obj1, obj2, obj3){
	document.viewForm.h1.value = obj1.value;
	document.viewForm.h2.value = obj2.value;
	document.viewForm.h3.value = obj3;
	document.viewForm.action = "updateCategory.php";
	document.viewForm.submit();
}
 
function delete_category(obj1){
	var agree = confirm('Are you absolutely sure you want to delete?');
	if(agree){
		document.viewForm.h1.value = obj1;
		document.viewForm.action = "deleteCategory.php";
		document.viewForm.submit();
		true;
	}
	else{
		false;
	}
}
</script>
</head>
<body>
<?php
$succMsg=$failMsg="";
 $succMsg = $_GET["succMsg"];
if($succMsg==null){
	$succMsg="";
}

$failMsg = $_GET["failMsg"];
if($failMsg==null){
	$failMsg="";
}

?>
<div class="main_contain">
	<a href="index.php">Home</a>
	<div class="main_common">
		<div class="login_div">
			<div align="center">
				<b><font face="calibiri" size="+2" color="#000099">View Admin</font></b><br><br><br><br>
				<div align="center">
					<B><font color="#FF0000" size=2.5><?php echo $failMsg;?></font></B>
					<B><font color="#347235" size=2.5><?php echo $succMsg;?></font></B>
					<br><br>
				</div>
				<form name="viewForm" action="view_editAdmin.php" method="post">
					<input type="hidden" name="h1" value="">
					<input type="hidden" name="h2" value="">
					<input type="hidden" name="h3" value="">					
					<table border=0>
					<?php
						$sql = "select * from newuser";
						$result=mysqli_query($conn,$sql);

						if(mysqli_num_rows($result)<0){
					?>
						<tr>
							<td align="center" valign="middle" colspan=4>
								<b><font size="3" face="Times New Roman">No Book category records are available.</font></b><br><br><br><br>
							</td>
						</tr>
					<?php		
						}
						else{
					?>
							<tr>
								<th align="center" valign="middle">
									<b><font face="Times New Roman" size="3">Book Category</font></b>
								</th>
							</tr>
					<?php		
							$i=1;
							while($row= mysqli_fetch_array($result)){
								$id = $row['id'];
								$email= $row['email'];
								$password = $row['password'];
					?>
								<tr>
									<td align="center" valign="middle">
										<input type="hidden" name="hideFilename<?php echo $i; ?>" value="<?php echo $name;?>">
										<input type="hidden" name="hideFilename<?php echo $i; ?>" value="<?php echo $email;?>">
										<input type="hidden" name="hideFilename<?php echo $i; ?>" value="<?php echo $password;?>">
										<input type="text" name="fn<?php echo $i; ?>" value="<?php echo $email;?>" size="20" maxlength="20" disabled>
										<input type="text" name="hc<?php echo $i; ?>" value="<?php echo $password;?>" size="20" maxlength="20"><br><br>										
									</td>									
									<td align="center" valign="middle">
										&nbsp;<input type="submit" name="done<?php echo $i; ?>" value="Update" onclick="changesDone(document.viewForm.hc<?php echo $i; ?>, document.viewForm.fn<?php echo $i; ?>,'<?php echo $id; ?>');"><br><br>
									</td>
									<td align="center" valign="middle">
										&nbsp;<input type="submit" name="delete<?php echo $i; ?>" value="Delete" onclick=" delete_category('<?php echo $id; ?>');"><br><br>
									</td>
								</tr>
					<?php		
								$i++;	
							}
						}
					?>
						
					</table>
				</form><br><br>
			</div>
		</div>
	</div>
</div>		
</body>
</html>
<?php
mysqli_close($conn);
?>