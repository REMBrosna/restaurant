<?php 
//Include connection
include('../config/constant.php');
//Check whether submit button clicked or not
if (isset($_POST['submit'])){
    //Get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    //Execute the Query
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 1)
    {
        //User variable and login success
        $_SESSION['login'] = "Login Successfully";
        $_SESSION['user'] = $username; //check whether the user is logged in or not and logout will unset it 
        //Redirec to home Dashboard
        header("location:".$SITEURL.'admin/');
    }
    else
    {
       //User not variable and login fail
       $_SESSION['login'] = "Login Failed";
       //Redirec to login page
       header("location:".$SITEURL.'admin/login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link href="../css/login.css" rel="stylesheet">
    </head>
    <body>
    <?php 
    
    if (isset($_SESSION['login']))
    {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    if (isset($_SESSION['no-login-message']))
    {
        echo $_SESSION['no-login-message'];
        unset($_SESSION['no-login-message ']);
    }
?>
<div class="container">
<h3>Login System</h3>
    <form action="" class="main-content" method="POST">
    <label class="text-white">Username</label>
    <div class="form-floating mb-3">
    <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com">
    <label for="floatingInput">Email address</label>
    </div>
    <label class="text-white">Password</label>
    <div class="form-floating">
    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
    <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
    <button type="submit" name="submit"  class="btn btn-primary">Submit</button>
  </div>
</form>
</div>
</body>
</html>