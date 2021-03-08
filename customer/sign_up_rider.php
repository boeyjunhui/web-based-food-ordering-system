<?php
  session_start();
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Rider Sign Up</title>

    <!-- Bootstrap core CSS -->
    <link href="css/style2.css" rel="stylesheet">

    <!-- Bootstrap custom -->
    <link href="css/signuprider.css" rel="stylesheet">
  </head>

  <body>
    <!-- Navigation -->
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
          <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#">Menu</a>
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
          <a class="nav-link " href="about_us.php">About Us</a>
        </li>

        <!-- Guides -->
        <li class="nav-item dropdown ml-3 mr-3">
          <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#">Guides</a>
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

    <!--Content-->
    <div class="container">
        <form id="registration-form" class="form-group" action="process.php" method="POST" enctype="multipart/form-data" onSubmit="return validate_rider_sign_up();">
            <h1 class="text-white" style="font-size:50px">Register as a rider</h1>
            <div class="row">
                <div class="col-md-6">
                    <label>First Name:</label>
                    <input id="name1" type="text" class="form-control" placeholder="First Name" Name="first_name" required="required">
                </div>

                <div class="col-md-6">
                    <label>Last Name:</label>
                    <input id="name2" type="text" class="form-control" placeholder="Last Name" Name="last_name" required="required">
                </div>

                <div class="col-md-6">
                    <label>Telephone:</label>
                    <input id="phone" type="tel" class="form-control" placeholder="Contact Number" Name="contact_number" required="required">
                </div>

                <div class="col-md-6">
                    <label>Email:</label>
                    <input id="email" type="email" class="form-control" placeholder="Email Address" Name="email" required="required">
                </div>

                <div class="col-md-6">
                    <label>Identification Number:</label>
                    <input id="ic" type="text" class="form-control" placeholder="Identification Number" Name="ic_number" required="required">
                </div>

                <div class="col-md-6">
                    <label>Street Address:</label>
                    <input type="text" class="form-control" placeholder="Street Address" Name="street_address" required="required">
                </div>

                <div class="col-md-6">
                    <label>City:</label>
                    <input type="text" class="form-control" placeholder="City" Name="city" required="required">
                </div>

                <div class="col-md-4">
                    <label>State:</label>
                    <input type="text" class="form-control" placeholder="State" Name="state" required="required">
                </div>

                <div class="col-md-2">
                    <label>ZipCode:</label>
                    <input id="zipcode" type="text" class="form-control" placeholder="Zip Code" Name="zipcode" required="required">
                </div>

                <div class="col-md-6">
                    <label>Password:</label>
                    <input id="p1" type="password" class="form-control" placeholder="Password" Name="password" required="required">
                </div>
                
                <div class="col-md-6">
                    <label>Re-type Password:</label>
                    <input id="p2" type="password" class="form-control" placeholder="Confirm Password" Name="confirm_password" required="required">                      
                </div>

                <div class="col-md-6">
                    <label>Picture of Driving License:</label><br>
                    <input  class="mb-3" type="file" name="driving_license" accept="image/*" required="required">
        
                </div>
                
                <div class="col-md-6">
                    <label>Picture of Identification Card:</label><br>
                    <input class="mb-3" type="file" name="ic" accept="image/*" required="required"> 
              
                </div>
                <div class="col-md-7 mt-5">
                    <input class="btn btn-primary btn-register" type="submit" name="register_rider_btn" value="Register">
                </div>
            </div>
        </form>  
    </div>

    <!--footer-->   
  <footer class="py-5 bg-info">
    <div class="container">
      <image class="m-3 text-left" src="image/MyFoodWeyh Logo (White).png" alt="MyFoodWeyh" width="120px" height="30px">
      <p class="m-3 text-left text-white">EkoCheras Mall No 693, Batu, 5, Jalan Cheras, 56000 Kuala Lumpur,<br>
        Federal Territory of Kuala Lumpur</p>
    </div>
  </footer>
</body>
</html>

<!--Bootstrap scripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/validation.js"></script>