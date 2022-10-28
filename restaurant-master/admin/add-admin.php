<?php include('partial/menu.php') ?>
<style>
.table{
    margin: 20px;
}
.table tr td input{
    border-radius: 5px;
    border-style: none;
    padding: 10px;
    font-size: 15px;
} 
</style>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
    </div>
    <form action="" method="POST">
        <table class="table">
        <tr>
            <td class="col-1">Full Name :</td>
            <td>
                <input type="text" name="full_name" placeholder="Enter Your FullName">
            </td>
        </tr>
        <tr>
            <td>
                Username
            </td>
            <td>
                <input type="text" name="username" placeholder="Enter Your Username">
            </td>
        </tr>
        <tr>
            <td>
                Password
            </td>
            <td>
                <input type="password" name="password" placeholder="Enter Your Password">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn btn-primary">
            </td>
        </tr>
        </table>
    </form>
    <?php 
//Process the value from form and save it in database
//Check whether the submit button is clicked or not 

if (isset($_POST['submit']))
{
    //Buntton Clicked
    // Get the Data from form
    $fullname = $_POST['full_name'];
    $username= $_POST['username'];
    $password = md5($_POST['password']);
    //SQL Query to save the data into database
    $sql = "INSERT INTO tbl_admin SET 
        full_name = '$fullname',
        username = '$username',
        password = '$password'
    ";
    //Execute Query and Save Data in Database
    $res = mysqli_query($conn, $sql);

    //Check whether the Query is executed data is insert or not and display appropiate message
    if ($res == true)
    {
        $_SESSION['add'] = "<div class='success'>Admin added Successfully</div>";
        header("location:".$SITEURL.'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['add'] = "Failed to added Admin";
        header("location:".$SITEURL.'admin/add-admin.php');
    }
}

?>
</div>
<!-- Footer  Session Starts -->
<?php include('partial/footer.php') ?>
<!-- Footer Session Ends -->
