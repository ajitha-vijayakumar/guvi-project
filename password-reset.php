<!DOCTYPE html>
<?php require_once("config.php");
if(isset($_SESSION["login_sess"])) 
{
  header("location:account.php"); 
}
?>
<html>
<head>
<title> Password Reset - Techno Smarter</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"> 
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
	<div class="row">
		 <div class="col-sm-4">
		</div>
		<div class="col-sm-4">
      <?php
            if(isset($_GET['token']))
            {
          $token= $_GET['token'];
          }
   //form for submit 
    if(isset($_POST['sub_set'])){
       extract($_POST);
            if($password ==''){
                $error[] = 'Please enter the password.';
            }
            if($passwordConfirm ==''){
                $error[] = 'Please confirm the password.';
            }
            if($password != $passwordConfirm){
                $error[] = 'Passwords do not match.';
            }
            if(strlen($password)<5){ // min 
            $error[] = 'The password is 6 characters long.';
        }
         if(strlen($password)>50){ // Max 
            $error[] = 'Password: Max length 50 Characters Not allowed';
        }
        $fetchresultok = mysqli_query($dbc, "SELECT email FROM pass_reset WHERE token='$token'");
    if($res = mysqli_fetch_array($fetchresultok))
{
  $email= $res['email']; 
}
            if(isset($email) != '' ) {
            $emailtok=$email;
            }
            else 
              { 
             $error[] = 'Link has been expired or something missing ';
              $hide=1;
              }
if(!isset($error)){
    $options = array("cost"=>4);
    $password = password_hash($password,PASSWORD_BCRYPT,$options);
    $resultresetpass= mysqli_query($dbc, "UPDATE users SET password='$password' WHERE email='$emailtok'"); 
    if($resultresetpass) 
    { 
           $success="<div class='successmsg'><span style='font-size:100px;'>&#9989;</span> <br> Your password has been updated successfully.. <br> <a href='login.php' style='color:#fff;'>Login here... </a> </div>";

          $resultdel = mysqli_query($dbc, "DELETE FROM pass_reset WHERE token='$token'");
          $hide=1;
    }
} 
    }
    ?>
    <div class="login_form">
		<form action="" method="POST">
  <div class="form-group">
  <img src="https://www.camsmkce.in/App_Themes/pictures/mkce%20logo.jpg" alt="GUVI PROJECT" style="width:200px" class="logo img-fluid"> <br>
    <?php 
if(isset($error)){
        foreach($error as $error){
            echo '<div class="errmsg">'.$error.'</div><br>';
        }
    }
    if(isset($success)){
    echo $success;
  }
              ?>
<?php if(!isset($hide)){ ?>
    <label class="label_txt">Password </label>
      <input type="password" name="password" class="form-control" required>
  </div>
   <div class="form-group">
    <label class="label_txt">Confirm Password </label>
      <input type="password" name="passwordConfirm" class="form-control" required  >
  </div>
  <button type="submit" name="sub_set" class="btn btn-primary btn-group-lg form_btn">Reset Password</button>
  <?php } ?>
</form>
</div>
		</div>
		<div class="col-sm-4">
		</div>
	</div>
</div> 
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
