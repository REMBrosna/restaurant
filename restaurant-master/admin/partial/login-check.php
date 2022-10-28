<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<?php
    //Authorization - Access control
    //Check whether the user is logged or not 
    if (isset($_SESSION['user']))//if user session isn't set
    {
    //User is not logged in
    //Redirect to login page with message
 
    $_SESSION['no-login-message'] = '<div class="alert alert-primary d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
    <div>
      Please Access Login !
    </div>
  </div>';
    //Redirect to login page
    header("location:".$SITEURL.'admin/login.php');
    }
 
?>

