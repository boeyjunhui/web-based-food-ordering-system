<?php
  session_start();
?>

<!DOCTYPE html>
<html>

  <head>
    <title>About Us</title>

    <!-- Bootstrap core CSS -->
    <link href="css/style2.css" rel="stylesheet">

    <!-- Bootstrap custom -->
    <link href="css/aboutus.css" rel="stylesheet">
    
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

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">
        <h2 class="my-4">About Us</h2>
        <div class="list-group">
          <a href="#background" class="list-group-item text-info">Our Background</a>
          <a href="#service" class="list-group-item text-info">Our Service</a>
          <a href="#rider" class="list-group-item text-info">Rider Matter</a>
          <a href="#support" class="list-group-item text-info">Customer Support</a>
        </div>
      </div>

    <!-- Article Content Column -->
        <!-- Post Content Column -->
    <div class="col-lg-8">

          <!-- Background -->
          <a name="background"></a>
          <h2 class="mt-4">Background of our business</h2>

          <!-- Preview Image -->
          <br>
          
          <img class="img-fluid rounded" src="image/klcc.jfif" alt="klcc">
          
          <!-- Article Content -->
          <br>
          <br>
          
          <p style="text-align: justify; font-size:18px" >When Boey, founder and CEO of MyFoodWeyh settled a restaurant in Kuala 
          Lumpur, Malaysia in 2020, he discovered a city full of opportunities that 
          people are busy getting out to eat, and he was amazed that so few of them 
          are delivering food. He had made it his mission to directly bring the best 
          service to the doors of people.</p>
          
          <!-- Service -->
          <a name="service"></a>
          <h2 class="mt-4">Our Service</h2></a>
          
          <!-- Article Content -->
          <br>
          
          <p style="text-align: justify; font-size:18px">Allows local people to order preferred food from our restaurant and have the 
            food delivered right at the door within 1 hour (including time to prepare 
            food).</p>

          <p style="text-align: justify; font-size:18px">Are you searching for something delightful? Hungry for your favorite western 
            cuisine? Since we know one trend, it's taking the deliciousness from our 
            restaurant right to your doorstep so you can enjoy delicious food in KL and 
            Selangor. At MyFoodWeyh, you can comfortably please yourself with the 
            range of food and western cuisine to choose from top quality of our menu.</p>

          
          <!-- Rider -->
          <a name="rider"></a>
          <h2 class="mt-4">Rider Matter</a></h2>

          <!-- Preview Image -->
          <br>
          
          <img class="img-fluid rounded" src="image/rider.jfif" alt="">

          <!-- Article Content -->
          <br>
          <br>
          
          <p style="text-align: justify; font-size:18px">We will always ensure every rider from our restaurant has a life 
            insurance that provided by us. Not only we will provide a life insurance, we can 
            issue safety equipment for rider to wear with while driving.  So, every ride will 
            comfortably deliver our food without hesitancy of job security.</p>

        
          <!-- Customer Support -->
          <a name="support"></a>
          <h2 class="mt-4">Customer Support</h2>
          
          <!-- Article Content -->
          <br>
      
          <p style="text-align: justify; font-size:18px">Your opinion are essential for improving and developing our career. We would like to 
            learn more and hear more from you. You may contact us through:</p>
  
          <p style="text-align: justify; font-size:18px">Call Support: +601-1125-5518 / +603-3365-5577</p>

          <p style="text-align: justify; font-size:18px">Email Support: <a href="mailto:support@myfoodweyh.com">support@myfoodweyh.com</a></p>
    
        </div>

      </div>
  
    </div>




  <!-- Footer -->
  <footer class="mt-5 py-5 bg-info">
    <div class="container">
      <image class="m-3 text-left" src="image/MyFoodWeyh Logo (White).png" alt="MyFoodWeyh" width="120px" height="30px">
      <p class="m-3 text-left text-white">EkoCheras Mall No 693, Batu, 5, Jalan Cheras, 56000 Kuala Lumpur,<br>
        Federal Territory of Kuala Lumpur</p>
    </div>
  </footer>

  </body>
</html>