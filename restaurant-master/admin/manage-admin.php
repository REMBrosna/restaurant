<?php include('partial/menu.php') ?>
    <!-- Menu Sessions Starts -->
    <div class="main-content">
        <div class="wrapper">
    <!-- Menu Sessions Ends -->
    <h1>Manage Admin</h1>
    <br/>  
    <?php 
        if (isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        } 
        if (isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        } 
        if (isset($_SESSION['edit']))
        {
            echo $_SESSION['edit'];
            unset($_SESSION['edit']);
        } 
        if (isset($_SESSION['user-not-found']))
        {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        } 
        if (isset($_SESSION['pwd-not-match']))
        {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        } 
        if (isset($_SESSION['change-pwd']))
        {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        } 
    ?>
     <br/> <br/> 
    <!-- Main Contain Session Ends -->
    <!-- Button to Add Admin  -->
    <a href="add-admin.php" class="btn btn-primary"> Add Admin </a>
    </br></br></br>
       <table class="table">
           <tr>
               <th>No</th>
               <th>FullName</th>
               <th>Username</th>
               <th>Password</th>
           </tr>

           <?php
           //Query to get all data
           $sql = "SELECT * FROM tbl_admin";
            //Execute the Query
           $res = mysqli_query($conn, $sql);
           //Check whether the query is Execute or not
         
           if ($res)
           {
            //Count Rows to check whether we data in database or not 
            $count = mysqli_num_rows($res);
             $sn =1;
            //Check number of rows
            if ($count>0){
                //we have data in database
                while ($rows=mysqli_fetch_assoc($res))
                {
                    //Using loop to get all the data from database
                    //And while loop will run as long as we have data in database

                    //Get individual data
                    $id = $rows['id'];
                    $fullname = $rows['full_name'];
                    $username = $rows['username'];
                    $password = $rows['password'];
                    //Display the value in our table
            ?>
        <tr>
            <td><?php echo $sn++ ?></td>
            <td><?php echo $fullname; ?></td>
            <td><?php echo $username; ?></td>
            <td><?php echo $password; ?></td>

            <td>
            <a href="<?php echo $SITEURL; ?>admin/edit-password.php?id=<?php echo $id;?>">
            <input class="btn btn-primary btn-md" type="submit" value="Change Password">
            </a>

            <a href="<?php echo $SITEURL; ?>admin/edit-admin.php?id=<?php echo $id;?>">
                <input class="btn btn-primary btn-md" type="submit" value="Edit">
            </a>

            <a href="<?php echo $SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>">
                <input class="btn btn-danger btn-md" type="submit" value="Delete">
            </a>     
            </td>   
        </tr>
            <?php 
                }
            }
        }
        ?>  
    </table>
    </div>
    </div>
     <!-- Footer  Session Starts -->
     <?php include('partial/footer.php') ?>
     <!-- Footer Session Ends -->
</body>
</html>
 
