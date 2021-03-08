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
        <title>Edit Profile</title>
        <link href="css/style1.css" type="text/css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
        <script src="js/validation.js"></script>
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
        <div class="container-fluid">

            <div class="text-center">
                <h1 class="mt-5 mb-5 "><b>Edit Profile</b></h1>
            </div>

            <?php
              $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

              if (isset($_POST['edit_btn'])) {
                $id = $_POST['edit_profile'];

                $query = "SELECT * FROM Customer WHERE CustomerID='$id'";
                $query_run = mysqli_query($connection, $query);

                foreach ($query_run as $row) {
            ?>

                        
            <form id="registration-form" action="process.php" method="POST" enctype="multipart/form-data" onSubmit="return validate_edit_profile();" >
                <input type="hidden" name="id" value="<?php echo $row['CustomerID']; ?>" >
                
                <div class="row justify-content-around">

                    <div class="col col-md-4">
                        <div class="mb-5 form-group">
                            <h5><b>Contact Information</b></h6>
                        </div>

                        <div class="mb-4 form-group">
                            <label for="firstname">First Name *</label>
                            <div><input id="fname" class="form-control" type="text" name="firstname" value= "<?php echo $row['FirstName']; ?>" required></div>
                        </div>

                        <div class="mb-4 form-group">
                            <label for="lastname">Last Name *</label>
                            <div><input id="lname" class="form-control" type="text" name="lastname" value= "<?php echo $row['LastName']; ?>" required></div>
                        </div>

                        <div class="mb-4 form-group">
                            <label for="contactnumber">Contact Number *</label>
                            <div><input id="phone" class="form-control" type="tel" name="contactnumber" value= "<?php echo $row['ContactNumber']; ?>" required></div>
                        </div>

                        <div class="mb-4 form-group">
                            <label for="email">Email *</label>
                            <div><input id="email" class="form-control" type="email" name="email" value= "<?php echo $row['Email']; ?>" required></div>
                        </div>

                        <div class="mb-4 form-group">
                            <label for="password">Password *</label>
                            <div><input class="form-control" type="password" name="password" value= "<?php echo $row['Password']; ?>" required></div>
                        </div>
                    </div>
    
                    <div class="col col-md-4">
                        <div class="mb-5 form-group">
                            <h5><b>Billing Address</b></h6>
                        </div>

                        <div class="mb-4 form-group">
                            <label for="streetaddress">Street Address *</label>
                            <div><input class="form-control" type="text" name="streetaddress" value= "<?php echo $row['StreetAddress']; ?>" required></div>
                        </div>

                        <div class="mb-4 form-group">
                            <label for="city">City *</label>
                            <div><input id="city" class="form-control" type="text" name="city" value= "<?php echo $row['City']; ?>" required></div>
                        </div>

                        <div class="row justify-content-between">
                            <div class="mb-5 col-md-5 form-group">
                                <label for="state">State *</label>
                                <div>
                                    <select class="form-control" name="state" required>
                                        <option value="">Please select...</option>
                                        <?php
                                          if ($row['State'] == 'Selangor') {
                                              echo "<option value='Selangor' selected>Selangor</option>";
                                              echo "<option value='Kuala Lumpur'>Kuala Lumpur</option>";
                                          } else {
                                              echo "<option value='Selangor'>Selangor</option>";     
                                              echo "<option value='Kuala Lumpur' selected>Kuala Lumpur</option>";
                                          }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-5 col-md-5 form-group">
                                <label for="zipcode">Zip Code *</label>
                                <div><input id="zipcode" class="form-control" type="number" name="zipcode" value= "<?php echo $row['ZipCode']; ?>" required></div>
                            </div>
                        </div>
                        <?php
                              }
                              mysqli_close($connection);
                          }
                        ?>

                        <div>
                          <a href="view_profile.php" class="col-md-3 btn btn-danger">Cancel</a>
                          <input class="col-md-3 ml-3 btn btn-primary" type="submit" name="update_profile_btn" value="Save">
                        </div>
                    </div>
                </div>
            </form>
        
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