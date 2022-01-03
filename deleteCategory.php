<?php
	include("connectioncode.php");
?>
<?php
	$id=$_POST["h1"];
	$sql= "delete from newuser where id=\"$id\" ";	
	if(mysqli_query($conn,$sql))
	{
		$succMsg="Successfully deleted";
		header("Location:view_editAdmin.php?succMsg=$succMsg&failMsg=$failMsg");
	}
	else
	{
		$failMsg= "Updation Failure";
		header("Location:view_editAdmin.php?succMsg=$succMsg&failMsg=$failMsg");
	}
	mysqli_close($conn);
?>