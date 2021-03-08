<?php
  session_start();

  // Validation for add to cart button if not logged in
  if (!isset($_SESSION['customerid']) && isset($_POST['add_to_cart_btn'])) {
    echo
    '<script>
      alert("Please login to add to cart.");
      window.history.back();
    </script>';
    return false;
  }

  // Create cart session
  if (isset($_SESSION['customerid']) && isset($_SESSION['cart'])) {
    $_SESSION['cart'];
  }

  // Add menu to cart
  if (isset($_POST['add_to_cart_btn'])) {

    $id = $_POST['menu_id'];
    $quantity = $_POST['quantity'];

    if ($quantity > 0 && filter_var($quantity, FILTER_VALIDATE_INT)) {
      if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += $quantity;

        echo
        '<script>
          alert("Menu is added to the cart successfully.");
        </script>';
      } else {
          $_SESSION['cart'][$id] = $quantity;

          echo
          '<script>
            alert("Menu is added to the cart successfully.");
          </script>';   
      }
    } else {
        echo
        '<script>
            alert("Please enter a valid number.");
        </script>';
    }
  }
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Beverages</title>
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


  <!-- Page Content -->
  <div class="container-fluid-content">

    <div class="row">
      <?php
        $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

        $query = "SELECT * FROM Menu WHERE Category='Beverages'";
        $query_run = mysqli_query($connection, $query);

          if (mysqli_num_rows($query_run) > 0) { 
            while ($row = mysqli_fetch_assoc($query_run)) {      
      ?>
      <div class="col-sm-3 col-md-4 col-lg-3 card">
        <?php echo '<img class="card-img-top" src=data:image;base64,'.$row['Image'].' alt="Menu Picture">'; ?>
          <div class="card-body">
            <h4><?php echo $row['Name']; ?></h4>
            <h5><?php echo "RM ".number_format($row['Price'],2); ?></h5>
            <p><?php echo $row['Description']."&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp"; ?></p>
            <form action="menu_beverages.php" method="POST">
              <input class="col-md-4" type="number" name="quantity" value="1" min="1" max="10">&nbsp &nbsp
              <input type="hidden" name="menu_id" value="<?php echo $row['MenuID']; ?>">
              <button class="btn btn-primary" type="submit" name="add_to_cart_btn"><i class='fas fa-cart-plus'></i> Add to cart</button>
            </form>
          </div>
      </div>
      <?php
            }
        } else {
            echo "No food menu is found.";
        }
        mysqli_close($connection);
      ?>
    </div>
  </div>


    <!-- Footer -->
    <footer class="py-5 bg-info">
      <div class="container">
      <img class="m-3 text-left" src="image/MyFoodWeyh Logo (White).png" alt="MyFoodWeyh" width="120px" height="30px">
      <p class="m-3 text-left text-white">EkoCheras Mall No 693, Batu, 5, Jalan Cheras, 56000 Kuala Lumpur,<br>Federal Territory of Kuala Lumpur.</p>
      </div>
    </footer>

  </body>
</html>