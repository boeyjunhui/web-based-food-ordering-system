<?php
  session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>FAQ</title>

  <!-- Bootstrap core CSS -->
  <link href="css/style2.css" rel="stylesheet">

  <!-- Bootstrap custom -->
  <link href="css/faq.css" rel="stylesheet">
  
  <!-- Bootstrap components (icons) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!--Bootstrap scripts-->
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

  <!--Title-->
  <div class="container">
    <div class="row text mt-5 ml-4">
        <h1 class="mt-3" style="color:#207b8f">Frequently Asked Questions</h1>
    </div>
  </div>

  <!--content-->
    <div class="container">
        <div class="row ml-3">
            <section id="content1">
                <h3 style="color:#207b8f"><i class="fa fa-question"></i>&ensp; What if a customer wants to reject the order right after it is delivered?</h3>
                <br>
                <p class="ml-5 mr-5" style="font-size:20px; color: #179bad; text-align: justify"><b>A customer must pay the order and take the food. Otherwise, they are legally penalized for  
                    RM 50.00 through our agreement and terms before they checking out the food.</p></b>
                <br>
                
                <h3 style="color:#207b8f"><i class="fa fa-question"></i>&ensp; What will happen to the personal vehicle if a rider has injuries from during the<br>&emsp;&nbsp; delivery?</h3>
                
                <br>
                <p class="ml-5 mr-5" style="font-size:20px; color: #179bad ; text-align: justify"><b>We only issue life insurance, but not vehicle. Bringing personal vehicle to work will be the 
                    rider's responsibility.</p></b>
                <br>
                
                <h3 style="color:#207b8f"><i class="fa fa-question"></i>&ensp; What if a rider delivers customer's food package later than an hour?</h3>
                <br>
                <p class="ml-5 mr-5" style="font-size:20px; color: #179bad; text-align: justify"><b> A rider can provide suitable reason to report the lateness to us. This is because we would
                    estimate and improve our delivery time and path. So, we will serve customers to a better place on time.</p></b>
                <br>

                <h3 style="color:#207b8f"><i class="fa fa-question"></i>&ensp; What will happen if a rider damages customer's food package?</h3>
                <br>
                <p class="ml-5 mr-5" style="font-size:20px; color: #179bad ; text-align: justify"><b>A rider has to be responsible for the food. For example, customers are allowed to give 
                    lower from fixed tips. Except, a rider encounters an accident, we will cover it. </p></b>
                <br>
            </section>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mt-5">
                <u><b><p style="font-size:25px"><a href="contact_us.php" target="parent">Contact us if you have more questions about our restaurant.</a></p></b></u>
            </div>
        </div>
    </div>
    
    <!--footer-->   
    <footer class="py-5 bg-info mt-5">
        <div class="container">
        <image class="m-3 text-left" src="image/MyFoodWeyh Logo (White).png" alt="MyFoodWeyh" width="120px" height="30px">
        <p class="m-3 text-left text-white">EkoCheras Mall No 693, Batu, 5, Jalan Cheras, 56000 Kuala Lumpur,<br>
            Federal Territory of Kuala Lumpur</p>
        </div>
    </footer> 

  </body>
</html>