<?php
  session_start();

  // Validation for enter URL without login
  if (!$_SESSION['customerid']) {
    header('location: login.php');
  }

  // Validation for direct URL entry
  if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location: homepage.php');
}
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Payment</title>
    <link href="css/style1.css" rel="stylesheet">  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
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


    <!-- Page Content -->
    <div class="container">
      
      <form action="process.php" method="POST">

        <div class="row justify-content-around">

          <!-- Address -->
          <div class="col-md-4">

            <!-- Delivery Address -->
            <div class="form-group mt-5 mb-4">
              <label for="delivery_address">Delivery Address *</label>
              <div><textarea class="col-form-label col-md-12" name="delivery_address" rows="5" placeholder="Kuala Lumpur, Malaysia" required></textarea></div>
            </div>

            <!-- Payment Method -->
            <div class="form-group mb-4">
              <label for="payment_method">Payment Method *</label>
              <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="payment_method" value="Credit Card" required>Credit Card
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="payment_method" value="Debit Card" required>Debit Card
              </div>
            </div>
        
            <!-- Card Number -->
            <div class="form-group mb-4">
              <label for="card_number">Card Number *</label>
              <div><input class="form-control mb-4" type="number" name="card_number" placeholder="1111 2222 3333 4444" min="1111111111111111" max="9999999999999999" required></div>
            </div>

            <!-- Card Expiry -->
            <div class="form-group mb-4">
              <label for="card_expiry_date">Card Expiry Date *</label>
                <div>
                  <label for="month">Month *</label>
                  <select class="form-control mb-3" name="expiry_month" required>
                    <option value="">Select month...</option>
                    <option value="01">Jan (01)</option>
                    <option value="02">Feb (02)</option>
                    <option value="03">Mar (03)</option>
                    <option value="04">Apr (04)</option>
                    <option value="05">May (05)</option>
                    <option value="06">Jun (06)</option>
                    <option value="07">Jul (07)</option>
                    <option value="08">Aug (08)</option>
                    <option value="09">Sep (09)</option>
                    <option value="10">Oct (10)</option>
                    <option value="11">Nov (11)</option>
                    <option value="12">Dec (12)</option>
                  </select>

                  <label for="year">Year *</label>
                  <select class="form-control" name="expiry_year" required>
                    <option value="">Select year...</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                  </select>
                </div>
            </div>

            <!-- CVV -->
            <div class="form-group">
              <label for="cvv">CVV *</label>
              <div><input class="form-control mb-4" type="number" name="cvv" placeholder="123" min="111" max="999" required></div>
            </div>

            <div>
              <a href="cart.php" class="btn btn-primary mt-3 mb-5" name="back_to_cart_btn">Back to Cart</a>
            </div>
          </div>

          <?php
            $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

            $grandtotal = 0;

            foreach ($_SESSION['cart'] as $id => $quantity) {

              $query = "SELECT * FROM Menu WHERE MenuID='$id'";
              $query_run = mysqli_query($connection, $query);

              if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {

                $subtotal = $quantity * $row['Price'];
                $grandtotal += $subtotal;
                }
              }
            }
            mysqli_close($connection);
          ?>

          <!-- Grand Total & Place Order -->
          <div class="col-md-4">
            <div class="card mt-5" style="max-width: 20rem;">
              <div class="card-body text-center">
                <h5><b>Grand Total: RM <?php echo number_format($grandtotal,2); ?></b></h5>
                <div>
                  <button class="mt-3 mb-3 btn btn-primary col-md-9" name="place_order_btn">Place Order</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>

    </div>


    <!-- Footer -->
    <footer class="mt-5 py-5 bg-info">
      <div class="container">
        <img class="m-3 text-left" src="image/MyFoodWeyh Logo (White).png" alt="MyFoodWeyh" width="120px" height="30px">
        <p class="m-3 text-left text-white">EkoCheras Mall No 693, Batu, 5, Jalan Cheras, 56000 Kuala Lumpur,<br>Federal Territory of Kuala Lumpur.</p>
      </div>
    </footer>

  </body>
</html>