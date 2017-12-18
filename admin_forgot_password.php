<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['change']))
{
   $email=$_POST['email'];
    $password=md5($_POST['password']);
$query=mysql_query("SELECT * FROM users WHERE email='$email'");
$num=mysql_fetch_array($query);
if($num>0)
{
$extra="admin_login.php";
mysql_query("update users set password='$password' where email='$email'");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Password Changed Successfully";
exit();
}
else
{
$extra="admin_forgotpassword.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Invalid email id";
exit();
}
}


?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Matrix Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" role="form" method="post" onSubmit="return valid();">
           
             
				 <div class="control-group normal_text"> <h3><img src="" alt="Login" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                        <p align="center" style="color:#F00; font-size:18px; font-weight:700;"><?php echo $_SESSION['error1']; ?></p>
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" placeholder="Email" name="email"  />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
 <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Password" name="password" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span style="margin-left:150px;">
                     <button type="submit" class="btn btn-success" name="change">Restore</button></span>
                </div>
            </form>
         
        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/matrix.login.js"></script> 
    </body>

</html>
