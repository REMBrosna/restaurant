 <?php 
    //include connection for SITEURL
    include('config/constant.php');
    //Destoy the session  
    session_destroy(); // Unset user session
    //redirect to login page 
    header("location:".$SITEURL.'login.php');
 ?>