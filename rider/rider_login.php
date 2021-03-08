<?php 
  session_start();

  // Validation for accessing page after logged in
  if (isset($_SESSION['Email'])) {
    header('location: ongoing.php');
  }

  // Validation for accessing page after logged in
  if (isset($_SESSION['customerid'])) {
    echo
    '<script>
      alert("Please log out your customer account.");
      history.back();
    </script>';
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Rider - Login</title>
        
        <!-- Bootstrap core CSS -->
        <link href="../customer/css/style1.css" type="text/css" rel="stylesheet">

        <!--Bootstrap scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
    </head>

    <body>
      <!--Navigation-->
      <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
        <div class="container">
          <a class="navbar-brand" href="../customer/homepage.php"><img src="../customer/image/MyFoodWeyh Logo (White).png" alt="MyFoodWeyh" width="120px" height="30px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

          <!-- Menu -->
          <li class="nav-item dropdown ml-3 mr-3">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Menu</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="../customer/menu_pizza.php">Pizza</a>
                <a class="dropdown-item" href="../customer/menu_pastas.php">Pasta</a>
                <a class="dropdown-item" href="../customer/menu_salads.php">Salads</a>
                <a class="dropdown-item" href="../customer/menu_desserts.php">Desserts</a>
                <a class="dropdown-item" href="../customer/menu_beverages.php">Beverages</a>
              </div>
          </li>

          <!-- Orders -->
          <li class="nav-item ml-3 mr-3">
            <a class="nav-link" href="../customer/orders.php">Orders</a>
          </li>

          <!-- Contact -->
          <li class="nav-item ml-3 mr-3">
            <a class="nav-link" href="../customer/contact_us.php">Contact</a>
          </li>

          <!-- Career -->
          <li class="nav-item ml-3 mr-3">
            <a class="nav-link" href="../customer/career.php">Career</a>
          </li>
              
          <!-- About Us -->
          <li class="nav-item ml-3 mr-3">
            <a class="nav-link" href="../customer/about_us.php">About Us</a>
          </li>

          <!-- Guides -->
          <li class="nav-item dropdown ml-3 mr-3">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Guides</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="../customer/FAQ.php">FAQ</a>
                <a class="dropdown-item" href="../customer/requirement.php">Driving Requirements</a>
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
            <a class="nav-link" href="../customer/cart.php">
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
                      echo '<a class="dropdown-item" href="../customer/login.php">Login</a>';
                    }

                    // View Profile
                    if (isset($_SESSION['customerid'])) {
                      echo '<a class="dropdown-item" href="../customer/view_profile.php">View Profile</a>';
                      echo '<div class="dropdown-divider"></div>';
                    }

                    // Logout
                    if (isset($_SESSION['customerid'])) {
                      echo '<form action="../customer/login_logout_process.php" method="POST">';
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

          <!--Page Content -->
          <main>
              <div class="container-fluid">

                  <div class="text-center">
                    <h3 class="mt-5"><b>Welcome back, rider!</b></h3>
                    <h4 class="mt-2"><b>Login to your account</b></h4>
                  </div>

                  <?php
                    $connection = mysqli_connect("localhost","root","","MyFoodWeyh");
                    if ($_SERVER["REQUEST_METHOD"]=="POST")
                    {
                      $email = mysqli_real_escape_string($connection, $_POST["email"]);
                      $password = mysqli_real_escape_string($connection, $_POST["password"]);
              
                      $rider_sql = "SELECT * FROM Organization_Member WHERE Email='$email' AND Password='$password' AND UserRole='Rider'";
              
                      if ($result = mysqli_query($connection, $rider_sql))
                      {
                        $rowcount = mysqli_num_rows($result);
              
                          while ($row = mysqli_fetch_array($result))
                          {
                            $memberid = $row["MemberID"];
                            $name1 = $row["FirstName"];
                            $name2 = $row["LastName"];
                          }
              
                          if ($rowcount==1)
                          {
                              
                            $_SESSION["Email"] = $email;
                            $_SESSION["MemberID"] = $memberid;
                            $_SESSION["FullName"] = $name1." ".$name2; 

                            echo '<script>window.location.href="ongoing.php";</script>';
                          }
                          else
                          {
                            echo '<script>alert("Email or Password not matched! Please re login.");</script>';
                          }
                      }
                      mysqli_close($connection);
                    }
                    ?>

                  <form action="rider_login.php" method="POST">
                      <div class="row">

                          <div class="col-md-4"></div>
                          <div class="col-md-4">

                          <div class="mt-3 mb-5 form-group">
                              <label for="email">Email *</label>
                              <div><input class="form-control" type="email" name="email" required></div>
                          </div>
                      
                          <div class="mb-5 form-group">
                              <label for="password">Password *</label>
                              <div><input class="form-control" type="password" name="password" required></div>
                          </div>
              
                          <div>
                              <input class="col-md-12 btn btn-primary mb-5" type="submit" name="login_rider_btn" value="Login">
                          </div>
                          </div>
                      </div>
                  </form>

              </div>
          </main>

      <!-- Footer -->
      <footer class="mt-5 py-5 bg-info fixed-bottom">
        <div class="container">
          <img class="m-3 text-left" src="../customer/image/MyFoodWeyh Logo (White).png" alt="MyFoodWeyh" width="120px" height="30px">
          <p class="m-3 text-left text-white">EkoCheras Mall No 693, Batu, 5, Jalan Cheras, 56000 Kuala Lumpur,<br>Federal Territory of Kuala Lumpur.</p>
        </div>
      </footer>

    </body>
</html>