<?php
session_start();
include("connectioncode.php");
?>
<?php
  function filtername($field)
  {
    $field=filter_var(trim($field),FILTER_SANITIZE_STRING);
    if(filter_var($field,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/"))))
    {
      return $field;
    }
    else
    {
      return FALSE;
    }
  }
  function filterString($field)
  {
    $field=filter_var(trim($field),FILTER_SANITIZE_STRING);
    if(!empty($field))
    {
      return $field;
    }
    else
    {
      return FALSE;
    }
  }

  $msgerr=$msg="";
   $fullname=$password=$confirmpassword=$email="";
   if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
        $email=test_input(trim($_POST["email"]));        
        $password = test_input($_POST["password"]);
        $confirmpassword = test_input($_POST["confirmpassword"]);     
        if ($password!=$confirmpassword)
        {
          $msgerr="Your password does not match";
        }
        else{  
          $dupsql="select * from newuser where email=\"$email\"";
          $vals = mysqli_query($conn, $dupsql);          
          if(mysqli_num_rows($vals)>0){
            $msgerr = "You are already registered. Please Sign in.";
          }
          else{
            $sql="insert into newuser(fullname,email,password)values(\"$fullname\",\"$email\",\"$password\")";
                      if(mysqli_query($conn,$sql))
                      {
                        while($row=mysqli_fetch_array($vals))
                        {
                          $fullname=$row["fullname"];
                          echo $fullname;
                        }
                        $_SESSION["loggedmail"]=$email;
                        $_SESSION["loggedname"]=$fullname;
                        $msg = "Registration successfully";
                        $fullname="";
                        $email="";                       
                        $password="";
                        $confirmpassword="";
                      header("Location:index.php"); 
                    }
                        
                      else
                      {
                        $msgerr = "Registration does not successfully";                        
                      }
          }  
                       
        }         
  }
  function test_input($data)
    {
      $data=trim($data);
      $data=stripcslashes($data);
      $data=htmlspecialchars($data);
      return $data; 
    }
?>

<!DOCTYPE html>
<html>
<head>
  <style>
    body
    {
      background:url(http://localhost/shimpiproject/book_images/4.jpeg);
      background-size: cover;
    }
    .signup
    {
      border-radius: 5px;
      background:White;
      padding: 20px;
      width: 420px;
      margin:auto;
      color: black;
      font-size: 16px;
      font-family: Verdana;
      margin-top: 100px;
      opacity: 0.6;
    }
    .signup h1
    {
      text-align: center;
      margin: 0;
      padding: 0;
      color: black;
    }
    .signup input[type=submit]
    {
      width: 100px;
      height: 40px;
      border:none;
      cursor: pointer;
      background-color: blur;
    }
    #fullname
    {
      width: 49%;
    }
    #email
    {
      width: 100%;
    }
    #username
    {
      width: 49%;
    }
    #password
    {
      width: 49.5;
    }
    #confrimpassword
    {
      width: 49%;
    }
    input[type=submit]:hover{
      background:lightblue;
      transition: 0.6s;
    }
    .error{
      color:red;
    }
    .success{
      color:green;
    }
  </style>
</head>
<body> 
  <center><a href="view_editAdmin.php?succMsg=$succMsg&failMsg=$failMsg" style="text-decoration: none; color: black; border: 2px solid black; font-size: 30px;">View_Edit_Delete</a></center>
    <div class="signup">
      <form method="POST">
        
          <table>
            <h1>Registration Here</h1>
            <span class="error"><?php echo $msgerr;?></span>
            <span class="error"><?php echo $msg;?></span>
            <hr>
              <tr>
                <th align="right">Email Id:</th>
                <td >
                  <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter your emall" required><br>
                </td>
              </tr>
              <tr>
                <th align="right">Password:</th>
                <td >
                  <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter your password" required>                
                </td>
              </tr>
              <tr>
                <th align="right">Confirm Password:</th>
                <td >
                  <input type="Password" name="confirmpassword" placeholder="Repeat Password" required><br>                
                </td>
              </tr>
              <tr>
                <th>&nbsp;</th>
                <td align="left">
                  <input type="submit" value="Submit">
                </td>
              </tr>
            </table>
      </form><br>
       <center><font> Already have a account?<a href="adminlogin.php" style="color: lightblue;text-decoration: none;"> SIgn in. </a></font></center>
    </div>
  </center>
</body>
</html>
<?php
  mysqli_close($conn);
?>