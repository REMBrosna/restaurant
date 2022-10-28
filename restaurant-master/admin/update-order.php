<?php include('partial/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br/><br/>
        <?php 
        
        if(isset($_GET['id']))
        {
            //Check whether id is set or not
            $id = $_GET['id'];
            //Get all other details based on this id
            //SQL Query to get the order details
            $sql ="SELECT * FROM tbl_order WHERE id=$id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count Rows
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                //Details Available
                $row = mysqli_fetch_assoc($res);

                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            }
            else
            {
                //Detail Not Available
                //Redirect to manage order
                header("location:".$SITEURL.'admin/manage-order.php');
            }
        }
        else
        {
            //Redirect to Manage Order Page
            header("location:".$SITEURL.'admin/manage-order.php');
        }
        ?>
        <form action="" method="POST">
            <table class="table">
            <tr>
                <td>Food Name</td>
                <td><b><?php echo $food; ?></b></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><?php echo $price; ?></td>
            </tr>
            <tr>
                <td>Qty</td>
                <td>
                    <input type="number" name="qty" value="<?php echo $qty; ?>">
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="status">
                        <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                        <option <?php if($status=="On Delivery"){echo "selected";} ?>value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Delivered"){echo "selected";} ?>value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){echo "selected";} ?>value="Cancelled">Cancelled</option>
                        
                    </select>
                </td>
            </tr>
            <tr>
                <td>Customer Name</td>
                <td>
                    <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                </td>
            </tr>
            <tr>
                <td>Customer Contact</td>
                <td>
                    <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                </td>
            </tr>
            <tr>
                <td>Customer Email</td>
                <td>
                    <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                </td>
            </tr>
            <tr>
                <td>Customer Address</td>
                <td>
                    <textarea name="customer_address" cols="20" rows="5"><?php echo $customer_address;?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="submit" name="submit" value="Update Order" class="btn btn-primary">
                </td>
            </tr>     
            </table>
        </form>
        <?php 
            //Check whether Update Button is clicked not
            if(isset($_POST['submit']))
            {
                //Get all The value from form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty =$_POST['qty'];

                $total = $price * $qty;

                $status=$_POST['status'];
                $customer_name=$_POST['customer_name'];
                $customer_contact=$_POST['customer_contact'];
                $customer_email=$_POST['customer_email'];
                $customer_address=$_POST['customer_address'];

                //Update the Value
                $sql2 ="UPDATE tbl_order SET
                qty =$qty,
                total=$total,
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'
                WHERE id=$id
                ";
                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether update or not
                //And Redirect to manage Order with message
                if($res==true)
                {
                    //Update Succesfully
                    $_SESSION['update']="<div>Update Successfully</div>";
                    header("location:".$SITEURL.'admin/manage-order.php');
                }
                else
                {
                    //Update Failed
                    $_SESSION['update']="<div>Update Failed</div>";
                    header("location:".$SITEURL.'admin/manage-order.php');
                }
            }
        
        
        
        ?>
    </div>
</div>
<!-- Footer  Session Starts -->
<?php include('partial/footer.php') ?>
<!-- Footer Session Ends -->
