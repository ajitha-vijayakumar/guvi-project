<?php require_once("config.php");
if(!isset($_SESSION["login_sess"])) 
{
    header("location:login.php"); 
}
  $email=$_SESSION["login_email"];

 ?> 
 <!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="style.css">
</head>
<body> <div class="sidebar">
      <div class="logo-details">
        <i class=""></i>
        <span class="logo_name">GUVI</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        
        <li>
          <a href="account.php">
            <i class="bx bx-user"></i>
            <span class="links_name">Back to Profile</span>
          </a>
        </li>
        
       
        <li>
          <a href="logout.php">
            <i class="bx bx-log-out"></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
    </div>
    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">User Profile</span>
        </div>
        
      </nav>
        <div class="home-content">

<div class="container">
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
           
     <form action="" method="POST">
  <div class="login_form">

  <img src="https://www.camsmkce.in/App_Themes/pictures/mkce%20logo.jpg" alt="GUVI PROJECT" style="width:200px" class="logo img-fluid"> <br>
 <?php
  if(isset($_POST['change_password'])){
 $currentPassword=$_POST['currentPassword']; 
  $password=$_POST['password'];  
 $passwordConfirm=$_POST['passwordConfirm']; 
$sql="SELECT password from users where email='$email'";
$res = mysqli_query($dbc,$sql);
      $res=mysqli_query($dbc,$sql);
        $row = mysqli_fetch_assoc($res);
       if(password_verify($currentPassword,$row['password'])){
if($passwordConfirm ==''){
            $error[] = 'Please confirm the password.';
        }
        if($password != $passwordConfirm){
            $error[] = 'Passwords do not match.';
        }
          if(strlen($password)<5){ // min 
            $error[] = 'The password is 6 characters long.';
        }
        
         if(strlen($password)>20){ // Max 
            $error[] = 'Password: Max length 20 Characters Not allowed';
        }
if(!isset($error))
{
      $options = array("cost"=>4);
    $password = password_hash($password,PASSWORD_BCRYPT,$options);

     $result = mysqli_query($dbc,"UPDATE users SET password='$password' WHERE email='$email'");
           if($result)
           {
       header("location:account.php?password_updated=1");
           }
           else 
           {
            $error[]='Something went wrong';
           }
}

        } 
        else 
        {
            $error[]='Current password does not match.'; 
        }   
    }
        if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
}
        ?> 
     <form method="post" enctype='multipart/form-data' action="">
          <div class="row">
            <div class="col"></div>
          
            <div class="col">
         </div>
          </div>

          <div class="form-group">
          <div class="row"> 
             <div class="col">
                <label>Current Password:- </label>
                <input type="password" name="currentPassword" class="form-control" required>
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row"> 
             <div class="col">
                 <label>New Password:- </label>
                <input type="password" name="password"  class="form-control" required>
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row">  
             <div class="col">
                 <label>Confirm New Password:-</label>
                <input type="password" name="passwordConfirm"  class="form-control" required>
            </div>
          </div>
      </div>
           <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
<button  class="btn btn-success" name="change_password">Change Password</button>
            </div>
           </div>
       </form>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
</div> 
</div>
</div> 
        </div>
      </section>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
