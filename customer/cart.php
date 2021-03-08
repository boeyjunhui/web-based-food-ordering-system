<?php
  session_start();

  // Validation for enter URL without login
  if (!$_SESSION['customerid']) {
      header('location: login.php');
  }

  // Update or delete quantity in cart
  if  (isset($_POST['update_quantity_btn'])) {
    $id = $_POST['menu_id'];
    $quantity = $_POST['quantity'];

    if ($quantity > 0 && filter_var($quantity, FILTER_VALIDATE_INT)) {
    $_SESSION['cart'][$id] = $quantity;
    } else {
        echo
        '<script>
        alert("Please enter a valid number.");
        </script>';
    }
  }

  // Delete all cart items
  if (isset($_POST['remove_all_cart_item_btn'])) {
      $_SESSION['cart'] = array();
  }

  // Delete 1 cart item
  if (isset($_POST['remove_cart_item_btn'])) {
      $id = $_POST['menu_id'];
      unset($_SESSION['cart'][$id]);
  }
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Cart</title>
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
        <li class="nav-item dropdown ml-2 mr-2">
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
    <div class="container content-margin-bottom">
      <div class="row justify-content-center">
        
        <h1 class="text-center mt-5 mb-5"><b>Shopping Cart</b></h1>

        <div class="row table-responsive">
          <table class="table table-bordered table-hover text-center">
            <thead class="bg-info text-white">
              <tr>
                <th>Menu</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <?php
                  if (isset($_SESSION['cart']) && $_SESSION['cart'] !== array()) {
                    echo '<th>';
                    echo '<form action="cart.php" method="POST">';
                    echo '<button class="btn btn-danger" onClick="return confirm(\'Are you sure to delete all cart item?\');" type="submit" name="remove_all_cart_item_btn"><i class="far fa-trash-alt"></i> Remove All</button>';
                    echo '</form>';
                    echo '</th>';
                  }
                ?>
              </tr>
            </thead>
            <tbody>
            <?php
              $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

              $grandtotal = 0;

              if (isset($_SESSION['cart'])) {

              foreach ($_SESSION['cart'] as $id => $quantity) {

                $query = "SELECT * FROM Menu WHERE MenuID='$id'";
                $query_run = mysqli_query($connection, $query);

                if (mysqli_num_rows($query_run) > 0) {
                  while ($row = mysqli_fetch_assoc($query_run)) {

                  $subtotal = $quantity * $row['Price'];
                  $grandtotal += $subtotal;
                  $_SESSION['grandtotal'] = $grandtotal;
            ?>
              <tr>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo '<img src=data:image;base64,'.$row['Image'].' alt="Menu Picture" width="192px" height="108px">'; ?></td>
                <td><?php echo "RM ".number_format($row['Price'],2); ?></td>
                <td>
                  <form action="cart.php" method="POST">
                    <input class="col-md-5" type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" max="10">&nbsp &nbsp
                    <input type="hidden" name="menu_id" value="<?php echo $id; ?>">
                    <input class="btn btn-primary" type="submit" name="update_quantity_btn" value="Update">
                  </form>
                </td>
                <td><?php echo "RM ".number_format($subtotal,2); ?></td>
                <td>
                  <form action="cart.php" method="POST">
                    <input type="hidden" name="menu_id" value="<?php echo $id; ?>">
                    <button class="btn btn-danger" onClick="return confirm('Are you sure to delete cart item?');" type="submit" name="remove_cart_item_btn"><i class='far fa-trash-alt'></i> Remove</button>
                  </form>
                </td>
              </tr>
              <?php
                      }
                    }
                  }
                  mysqli_close($connection);
                }
              ?>
              <tr>
                <td colspan="2">
                  <a href="menu_pizza.php" class="btn btn-primary"><i class='fas fa-cart-plus'></i> Continue Shopping</a>
                </td>
                <td colspan="3">
                  <h5><b>
                    <?php
                    if (isset($_SESSION['cart']) && $_SESSION['cart'] !== array()) {
                      echo "Grand Total: RM ".number_format($grandtotal,2);
                    } else {
                      echo "Your shopping cart is empty.";
                    }
                    ?>
                  </b></h5>
                </td>
                <?php
                  if (isset($_SESSION['cart']) && $_SESSION['cart'] !== array()) {
                    echo '<td>';
                    echo '<a href="payment.php" class="btn btn-success" name="proceed_to_payment_btn">Proceed to Payment</a>';
                    echo '</td>';
                  }
                ?>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
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