<?php include('partial/menu.php') ?>
    <!-- Menu Sessions Starts -->
    <div class="main-content">
        <div class="wrapper">
    <!-- Menu Sessions Ends -->
    <h1>Manage Order</h1>
    <br/> <br/>

     <?php
      if(isset($_SESSION['update']))
      {
         echo $_SESSION['update'];
         unset($_SESSION['update']);
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
               <th>Food</th>
               <th>Price</th>
               <th>Qty</th>
               <th>Total</th>
               <th>Order Date</th>
               <th>Status</th>
               <th>Customer Name</th>
               <th>Contact</th>
               <th>Email</th>
               <th>Address</th>
               <th>Action</th>
           </tr>

           <?php
           //Get all Order From database
           $sql = "SELECT * FROM tbl_order ORDER BY id DESC";//Display the latest order at first
           //Execute the Query
           $res = mysqli_query($conn, $sql);
           //Count Rows to check whether we data in database or not
           $count = mysqli_num_rows($res);
           $sn =1;
            //Check number of rows
            if ($count>0){
               //Using loop to get all the data from database
               //And while loop will run as long as we have data in database
                while ($rows=mysqli_fetch_assoc($res))
                {
                    //Get individual data
                    $id = $rows['id'];
                    $food = $rows['food'];
                    $price = $rows['price'];
                    $qty = $rows['qty'];
                    $total = $rows['total'];
                    $order_date = $rows['order_date'];
                    $status = $rows['status'];
                    $customer_name = $rows['customer_name'];
                    $customer_contact = $rows['customer_contact'];
                    $customer_email = $rows['customer_email'];
                    $customer_address = $rows['customer_address'];
                    //Display the value in our table
            ?>
            <tr>
            <td><?php echo $sn++ ?></td>
            <td><?php echo $food; ?></td>
            <td>$<?php echo $price; ?></td>
            <td><?php echo $qty; ?></td>
            <td>$<?php echo $total ?></td>
            <td><?php echo $order_date; ?></td>

            <td>
               <?php
               //Ordered, On Delivery, Deliverd, Cancelled
               if($status=="Ordered")
               {
                  echo "<label>$status</label>";
               }
               elseif($status=="On Delivery")
               {
                  echo "<label style='color: orange;'>$status</label>";
               }
               elseif($status=="Delivered")
               {
                  echo "<label style='color: #2ecc71;'>$status</label>";
               }
               elseif($status=="Cancelled")
               {
                  echo "<label style='color: red;'>$status</label>";
               }
               ?>
            </td>

            <td><?php echo $customer_name; ?></td>
            <td><?php echo $customer_contact ?></td>
            <td><?php echo $customer_email; ?></td>
            <td><?php echo $customer_address; ?></td>
            <td colspan="2">
            <a href="<?php echo $SITEURL;?>admin/update-order.php?id=<?php echo $id; ?>" class="btn btn-primary">Update</a>
            </td>
            </tr>
            <?php
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

