<?php include('partial/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Change Password</h1>
    <br/> <br/>
    <?php 
    if (isset($_GET['id'])){
        $id = $_GET['id'];
    }
    ?>

   <form action="" method="post">
       <table class="table">
            <tr>
                <td style="width: 200px;">Current Password:</td>
                <td>
                    <input type="password" name="current_password" placeholder="Current Password">
                </td>
            </tr>
            <tr>
                <td>New Password:</td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password">
                </td>
            </tr>
            <tr>
                <td>Comfirm Password:</td>
                <td>
                    <input type="password" name="comfirm_password" placeholder="Comfirm Password">
                </td>
            </tr>
            <tr>
                <td colspan="2" >
                    <input type="hidden" name="id" value="<?php echo $id ?>">  
                    <input type="submit" name="submit" value="Change Password" class="btn-primary">
                </td>
            </tr>
       </table>
   </form>
</div>
</div>
<?php 
    //Check wether the Submit Button is clicked or not
    if(isset($_POST['submit'])){
        //Get the Data from form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $comfirm_password = md5 ($_POST['comfirm_password']);
        //Check whether the user the current ID and Current Password Exists or Not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //Excecute the Query 
        $res = mysqli_query($conn, $sql);

        if ($res == true)
        {
            //Check whether data is avaible or not
            $count = mysqli_num_rows($res);
            
            if($count == 1){
                //User Exists and Password can be changed

                //Check whether the new password and comfirm match or not
        if ($new_password == $comfirm_password)
        {
            //Update the password
            $sql2 = "UPDATE tbl_admin SET 
                    password = '$new_password'
                    WHERE id=$id
                ";
            //Execute the Query
            $res2 = mysqli_query($conn,$sql2);
            
            //check whether query executed or not
        if($res2 == true)
            {
                //Display messgae Successfully
                $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";
                //Redirect to Manage admin page with Sucessfully message
                header("location:".$SITEURL.'admin/manage-admin.php');
            }
        else
            {
                //Redirect to Manage admin page with Error message
                $_SESSION['change-pwd'] = "<div class='error'>The password is incurrent</div>";
                    //Redirect to Manage admin page with Error message
                header("location:".$SITEURL.'admin/manage-admin.php');
            }
                }
        else
        {
                //Redirect to Manage admin page with Error message
                $_SESSION['pwd-not-match'] = "<div class='error'>The password incurrent</div>";
                //Redirect the User
                header("location:".$SITEURL.'admin/manage-admin.php');
        }
                    }
        else
        {
                //User does not exists set message and redirect
                $_SESSION['user-not-found'] = "<div class='error'>User not Found</div>";
                //Redirect the User
                header("location:".$SITEURL.'admin/manage-admin.php');
        }
                }
    }
?>


<!-- Footer  Session Starts -->
<?php include('partial/footer.php') ?>
<!-- Footer Session Ends -->