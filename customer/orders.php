<?php
  session_start();

  // Validation for enter URL without login
  if (!$_SESSION['customerid']) {
    header('location: login.php');
  }
?>

<!DOCTYPE html>
<html>
  
  <head>
    <title>Orders</title>
    <meta http-equiv ="refresh" content="10">
    <link href="css/style1.css" rel="stylesheet">  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
  </head>

  <body>
    <!--Navigation-->
	  <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
      <div class="container">
        <a class="navbar-brand" href="homepage.php"><img src="image/MyFoodWeyh Logo (White).png" alt="MyFoodWeyh" width="120px" height="30px"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

        <!-- Menu -->
        <li class="nav-item dropdown ml-3 mr-3">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Menu</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="menu_pizza.php">Pizza</a>
              <a class="dropdown-item" href="menu_pastas.php">Pasta</a>
              <a class="dropdown-item" href="menu_salads.php">Salads</a>
              <a class="dropdown-item" href="menu_desserts.php">Desserts</a>
              <a class="dropdown-item" href="menu_beverages.php">Beverages</a>
            </div>
        </li>

        <!-- Orders -->
        <li class="nav-item ml-3 mr-3">
          <a class="nav-link" href="orders.php">Orders</a>
        </li>

        <!-- Contact -->
        <li class="nav-item ml-3 mr-3">
          <a class="nav-link" href="contact_us.php">Contact</a>
        </li>

        <!-- Career -->
        <li class="nav-item ml-3 mr-3">
          <a class="nav-link" href="career.php">Career</a>
        </li>
            
        <!-- About Us -->
        <li class="nav-item ml-3 mr-3">
          <a class="nav-link" href="about_us.php">About Us</a>
        </li>

        <!-- Guides -->
        <li class="nav-item dropdown ml-3 mr-3">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Guides</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="FAQ.php">FAQ</a>
              <a class="dropdown-item" href="requirement.php">Driving Requirements</a>
            </div>
        </li>
		
        <!-- Member -->
        <li class="nav-item dropdown ml-3 mr-3">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Member</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="../admin/admin_login.php">Admin Login</a>
              <a class="dropdown-item" href="../rider/rider_login.php">Rider Login</a>
            </div>
        </li>

        <!-- Cart -->
        <li class="nav-item ml-4 mr-3">
          <a class="nav-link" href="cart.php">
          <i class="fas fa-shopping-cart" alt="cart"></i></a>
        </li>
            
        <!-- Profile -->
        <form class="ml-2 mr-3"></form>
          <ul class="navbar-nav">
            <li>
              <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <?php
                  // Login
                  if (!isset($_SESSION['customerid'])) {
                    echo '<a class="dropdown-item" href="login.php">Login</a>';
                  }

                  // View Profile
                  if (isset($_SESSION['customerid'])) {
                    echo '<a class="dropdown-item" href="view_profile.php">View Profile</a>';
                    echo '<div class="dropdown-divider"></div>';
                  }

                  // Logout
                  if (isset($_SESSION['customerid'])) {
                    echo '<form action="login_logout_process.php" method="POST">';
                    echo '<button class="dropdown-item" onClick="return confirm(\'Are you sure to logout?\');" type="submit" name="customer_logout_btn">Logout</button>';
                    echo '</form>';
                  }
                ?>
              </div>
            </li>
          </ul>

          </ul>
        </div>
      </div>
    </nav>


    <!-- Content -->
    <main>
      <div class="container content-margin-bottom">

        <!-- Pending Orders -->
        <h1 class="mt-5 mb-3"><b>Pending Orders</b></h1>

        <div class="row table-responsive">
          <table class="table table-bordered table-hover text-center">
            <thead class="bg-info text-white">
              <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Delivery Address</th>
                <th>Payment Method</th>
                <th>Grand Total</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

              $query = "SELECT * FROM New_Order WHERE CustomerID='$_SESSION[customerid]' AND Status='Pending'";
              $query_run = mysqli_query($connection, $query);   

              if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
              <tr>
                <td><?php echo $row['Date']; ?></td>
                <td><?php echo $row['Time']; ?></td>
                <td><?php echo $row['DeliveryAddress']; ?></td>
                <td><?php echo $row['PaymentMethod']; ?></td>
                <td><?php echo "RM ".$row['GrandTotal']; ?></td>
                <td><?php echo $row['Status']; ?></td>
                <td>
                  <form action="view_order_item.php" method="POST">
                    <input type="hidden" name="new_order_id" value="<?php echo $row['NewOrderID']; ?>">
                    <button class="btn btn-info" type="submit" name="view_order_btn">View Order Item</button>
                  </form>
                </td>
              </tr>
            <?php
                  }
              } else {
                echo "No pending order.";
              }
              mysqli_close($connection);
            ?>
            </tbody>
          </table>
        </div>

        
        <!-- Accepted Orders -->
        <h1 class="mt-5 mb-3"><b>Accepted Orders</b></h1>

        <div class="row table-responsive">
          <table class="table table-bordered table-hover text-center">
            <thead class="bg-info text-white">
              <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Delivery Address</th>
                <th>Payment Method</th>
                <th>Grand Total</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

              $query = "SELECT * FROM New_Order WHERE CustomerID='$_SESSION[customerid]' AND Status='Accepted' OR CustomerID='$_SESSION[customerid]' AND Status='Delivering'";
              $query_run = mysqli_query($connection, $query);  

              if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
              <tr>
                <td><?php echo $row['Date']; ?></td>
                <td><?php echo $row['Time']; ?></td>
                <td><?php echo $row['DeliveryAddress']; ?></td>
                <td><?php echo $row['PaymentMethod']; ?></td>
                <td><?php echo "RM ".$row['GrandTotal']; ?></td>
                <td><?php echo $row['Status']; ?></td>
                <td>
                  <form action="view_order_item.php" method="POST">
                    <input type="hidden" name="new_order_id" value="<?php echo $row['NewOrderID']; ?>">
                    <button class="btn btn-info" type="submit" name="view_order_btn">View Order Item</button>
                  </form>
                </td>
              </tr>
            <?php
                  }
              } else {
                echo "No accepted order.";
              }
              mysqli_close($connection);
            ?>
            </tbody>
          </table>
        </div>


        <!-- Order History -->
        <h1 class="mt-5 mb-3"><b>Order History</b></h1>

        <div class="row table-responsive">
          <table class="table table-bordered table-hover text-center">
            <thead class="bg-info text-white">
              <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Delivery Address</th>
                <th>Payment Method</th>
                <th>Grand Total</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

              $query = "SELECT * FROM New_Order WHERE CustomerID='$_SESSION[customerid]' AND Status='Delivered'";
              $query_run = mysqli_query($connection, $query);    

              if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
              <tr>
                <td><?php echo $row['Date']; ?></td>
                <td><?php echo $row['Time']; ?></td>
                <td><?php echo $row['DeliveryAddress']; ?></td>
                <td><?php echo $row['PaymentMethod']; ?></td>
                <td><?php echo "RM ".$row['GrandTotal']; ?></td>
                <td><?php echo $row['Status']; ?></td>
                <td>
                  <form action="view_order_item.php" method="POST">
                    <input type="hidden" name="new_order_id" value="<?php echo $row['NewOrderID']; ?>">
                    <button class="btn btn-info" type="submit" name="view_order_btn">View Order Item</button>
                  </form>
                </td>
              </tr>
            <?php
                  }
              } else {
                echo "No order history.";
              }
              mysqli_close($connection);
            ?>
            </tbody>
          </table>
        </div>

      </div>   
    </main>


    <!-- Footer -->
    <footer class="mt-5 py-5 bg-info">
      <div class="container">
      <img class="m-3 text-left" src="image/MyFoodWeyh Logo (White).png" alt="MyFoodWeyh" width="120px" height="30px">
      <p class="m-3 text-left text-white">EkoCheras Mall No 693, Batu, 5, Jalan Cheras, 56000 Kuala Lumpur,<br>Federal Territory of Kuala Lumpur.</p>
      </div>
    </footer>

  </body>
</html>