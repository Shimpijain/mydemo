<?php
	include("connectioncode.php");
?>
<?php
	$succMsg=$failMsg="";
	$password=$_POST["h1"];
	$id=$_POST["h3"];
	$email = $_POST["h2"];
	$sql= "update newuser set email=\"$email\", password=\"$password\" where id=\"$id\"";	
	if(mysqli_query($conn,$sql))
	{
		$succMsg="Successfully updated";
		header("Location:view_editAdmin.php?succMsg=$succMsg&failMsg=$failMsg");
	}
	else
	{
		$failMsg= "Updation Failure";
		header("Location:view_editAdmin.php?succMsg=$succMsg&failMsg=$failMsg");
	}
	mysqli_close($conn);
?>