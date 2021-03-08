<?php
  session_start();
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Contact Us</title>

    <!-- Bootstrap core CSS -->
    <link href="css/style2.css" rel="stylesheet">

    <!-- Bootstrap custom -->
    <link href="css/contactus.css" rel="stylesheet">
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
          <a class="nav-link " href="career.php">Career</a>
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

   <!--Page Content--> 
<div class="container">
  <div class="rowcontent row">
    <section id="contactinfo">
      <div>
        <h3 class="text-white">contact Info</h3>
        <br>
        <ul class="info">
          <li>
            <span><i class="fa fa-map-marker"></i></span>
            <span>
              EkoCheras Mall No 693, Batu, 5, Jalan Cheras,
              <br>
              56000 Kuala Lumpur,
              <br>
              Malaysia
              </span>
          </li>

          <li>
            <span><i class="fa fa-envelope"></i></span>
            <span>
              support@myfoodweyh.com
            </span>
          </li>

          <li>
            <span><i class="fa fa-phone"></i></span>
            <span>
              +601-1125-5518 (mobile)
              <br>
              +603-3365-5577 (office)
            </span>
          </li>
        </ul>
      </div>
    </section>
    
    <section id="contactForm">
      <form action="process.php" method="POST" enctype="multipart/form-data" onSubmit="return validate_contact();"> 
        <div class="formBox">
            <div class="col-md-7 mb-4">
              <h2>Send a Message here</h2>
            </div>
            <div class=" inputBox col-md-6">
                <span>First Name</span>
                <input id="name1" type="text" name="first_name" required="required">
            </div>

            <div class="inputBox col-md-6">
              <span>Last Name</span>
              <input id="name2" type="text" name="last_name" required="required">
            </div>

            <div class="inputBox col-md-6">
              <span>Email Address</span>
              <input id="email" type="email" name="email" required="required">
            </div>

            <div class="inputBox col-md-6">
              <span>Contact Number</span>
              <input id="phone" type="tel" name="contact_number" required="required">
            </div>

            <div class="inputBox col-md-12">
              <span>Your Message</span>
              <br>
              <textarea rows="6" name="message" type="text" required="required"></textarea>
            </div>
                
            <div class="col-md-6 mb-5">
            <input class="btn btn-primary" type="submit" name="add_contact_btn" value="Submit">
            </div>
        </div>
      </section>
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