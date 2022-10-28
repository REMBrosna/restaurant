<?php include('partial-front/menu.php') ?>
    <?php 
    //Check whether food is set or not
    if(isset($_GET['food_id']))
    {
        //Get the Detail id and Details of the seleted food
        $food_id = $_GET['food_id'];

        //Get the Details of the selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Count the rows
        $count = mysqli_num_rows($res);
        //Check whehther data is available or not
        if($count==1)
        {
            //We have Data
            //Get the data from Database
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            //Food not Available
            //Redirect to home page
            header("location:".$SITEURL);
        }  
    }
    else
    {
        //Redirec to Home page
        header("location:".$SITEURL);
    }
    ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <form action="" method="POST" class="order" style="color: #ffff;">
                <fieldset>
                    <legend>Selected Food</legend>
                    <div class="food-menu-img">
                    <?php 
                    //Check whether the image is available or not
                    if($image_name=="")
                    {
                        //Image not Available
                        echo "<div class='error'>Image not Available</div>";
                    }
                    else
                    {
                        //Image Available
                        ?>
                        <img src="<?php echo $SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                    </div>
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required> 
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full_name" placeholder="Enter Your Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Enter Your PhoneNumber" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter Your Email" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Enter Street, City, Country" class="input-responsive" required></textarea>
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
        <?php 
            //Check whether submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //Get the Details from form
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty; //Total = Price x Qty
                $order_date = date("y-m-d"); //Order Date
                $status = "Ordered"; //Ordered, On Delivery, Delivered, Cancelled

                $customer_name = $_POST['full_name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                //Save the order in Database
                //Create the SQL to save the data
                $sql2 ="INSERT INTO tbl_order  SET
                    food ='$food',
                    price=$price,
                    qty=$qty,
                    total=$total,
                    order_date='$order_date',
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'                
                ";
                //Execute the Query 
                $res2 = mysqli_query($conn, $sql2);
                
                //Check whether query Execute Successfully or not
                if($res2==true)
                {
                //Query Exucuted and order Save
                $_SESSION['order'] = "<div class='success'>Food Ordered Successfully</div>";
                header("location:".$SITEURL);
                }
                else
                {
                //Failed to save order Save
                $_SESSION['order'] = "<div class='Error'>Fialed to Save Order</div>";
                header("location:".$SITEURL);
                }  
            } 
        ?>
        </div>
    </section>
<!-- FOOD Search Section Ends Here -->
<?php include('partial-front/footer.php') ?>