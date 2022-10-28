<?php include('partial/menu.php') ?>
<div class="main-content">
   <div class="wrapper">
   <h1>Manage Category</h1>
   <br/><br/>

   <?php 
       if (isset($_SESSION['add']))
       {
           echo $_SESSION['add'];
           unset($_SESSION['add']);
       } 
       if (isset($_SESSION['remove']))
       {
           echo $_SESSION['remove'];
           unset($_SESSION['remove']);
       } 
       if (isset($_SESSION['delete']))
       {
           echo $_SESSION['delete'];
           unset($_SESSION['delete']);
       } 
       if (isset($_SESSION['no-category-found']))
       {
           echo $_SESSION['no-category-found'];
           unset($_SESSION['no-category-found']);
       } 
       if (isset($_SESSION['update']))
       {
           echo $_SESSION['update'];
           unset($_SESSION['update']);
       } 
       if (isset($_SESSION['upload']))
       {
           echo $_SESSION['upload'];
           unset($_SESSION['upload']);
       } 
       if (isset($_SESSION['failed-remove']))
       {
           echo $_SESSION['failed-remove'];
           unset($_SESSION['failed-remove']);
       }  
?>
   <br/><br/>
   <!-- Button to add admin Category -->
   <a href="<?php echo $SITEURL; ?>admin/add-category.php" class="btn btn-primary">Add Category</a>
   <br/><br/>
<table class="table">
    <tr>
        <th>No</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action</th>
    </tr>
<?php
//Query to get all data from database
$sql = "SELECT * FROM tbl_category";
//Execute the Query
$res = mysqli_query($conn, $sql);
//chount rows
$count = mysqli_num_rows($res);
$sn=1;
//Count Rows to check whether we have data in database or not 
if ($count>0)
{
    //we have data in database
    //Gett the data and display
    while ($row=mysqli_fetch_assoc($res))
    {
    //Get individual data
    $id = $row['id'];
    $title = $row['title'];
    $image_name = $row['image_name'];
    //Display the value in our table
    ?>
    <tr>
        <td><?php echo $sn++; ?></td>
        <td><?php echo $title; ?></td>
        <td>
            <?php
            //Check whether image name is avariable or not
            if($image_name !="")
            {
                //Display the image
            ?>
            <img src="<?php echo $SITEURL;?>images/category/<?php echo $image_name;?>" width="90px">
            <?php
            }
            else
            {
                //Display the message
                echo "<div class='danger'>Image not added</div>";
            }
            ?>
        </td>
    <td>Feature</td>
    <td>Active</td>
    <td>
    <a href="<?php echo $SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn btn-primary">Update</a>
    <a href="<?php echo $SITEURL;?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"class="btn btn-danger">Delete</a>
    </td>
    </tr>
    <?php
    }
}
else
    {
    //We don't have the data
    //We'll display the message inside table
    ?>
       <tr>
           <td>
               <div class="danger">No Category Added.</div>
           </td>
       </tr>
    <?php
    }
?>
</table>
<!-- Footer  Session Starts -->
<?php include('partial/footer.php') ?>
<!-- Footer Session Ends -->
