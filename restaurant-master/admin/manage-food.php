<?php include('partial/menu.php') ?>
<div class="main-content">
   <div class="wrapper">
   <h1>Manage Food</h1>
   <br/><br/>
    <?php
     if(isset($_SESSION['add']))
     {
         echo $_SESSION['add'];
         unset($_SESSION['add']);
     }
     if(isset($_SESSION['delete']))
     {
         echo $_SESSION['delete'];
         unset($_SESSION['delete']);
     }
     if(isset($_SESSION['upload']))
     {
         echo $_SESSION['upload'];
         unset($_SESSION['upload']);
     }
     if(isset($_SESSION['Unauthorized']))
     {
         echo $_SESSION['Unauthorized'];
         unset($_SESSION['Unauthorized']);
     }
     if(isset($_SESSION['update']))
     {
         echo $_SESSION['update'];
         unset($_SESSION['update']);
     }
    ?>
    <br/><br/>
    <a href="<?php $SITEURL;?>add-food.php" class="btn btn-primary"> Add Food </a>
    </br></br>
       <table class="table">
           <tr>
               <th>No</th>
               <th>Title</th>
               <th>Price</th>
               <th>Image</th>
               <th>Featured</th>
               <th>Active</th>
           </tr>
    <?php
        //Create SQL Query to get all the Food
        $sql ="SELECT * FROM tbl_food";
        //Execute the Query
        $res = mysqli_query($conn, $sql);
        //Count rows to check whether we have food or not
        $count = mysqli_num_rows($res);
        //Create the Serial Number Varaible and set Dafualt value as 1
        $sn = 1;
        if($count>0)
        {
            //We have food in Database
            //Get the food from database and display
            while($row=mysqli_fetch_assoc($res))
        {
            //Get the value from individual columns
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
            ?>
            <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $title; ?></td>
            <td><?php echo $price;  ?>$</td>
            <td>
            <?php 
                //Check whether we have image or not
                if($image_name=="")
                {
                    //We do not have image display Error message
                    echo "<div class='error'>Image not Added</div>";
                }
                else
                {
                    //We have image, Display Image
                    ?>
                    <img src="<?php echo $SITEURL;?>images/food/<?php echo $image_name; ?>" width="90px">
                    <?php
                }
            ?>
        </td>
        <td><?php echo $featured; ?></td>
        <td><?php echo $active; ?></td>
        <td>
            <a href="<?php echo $SITEURL; ?>admin/update-food.php?id=<?php echo $id;?>">
                <input class="btn btn-primary" type="submit" value="Update">
            </a>
            <a href="<?php echo $SITEURL;?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>">
            <input class="btn btn-danger" type="submit" value="Delete">
            </a>
            </td>
        </tr>
        <?php

            }
        }
        else
        {
            //Food not add in Database
            echo "<tr>
            <td colspan='6' class='error'>Food not added yet.</td>
            </tr>";
        }
        ?>
       </table>
   </div>
</div>
<!-- Footer  Session Starts -->
<?php include('partial/footer.php') ?>
    <!-- Footer Session Ends -->