<?php
  session_start();
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Driving Requirement</title>

    <!-- Bootstrap core CSS -->
    <link href="css/style2.css" rel="stylesheet">

    <!-- Bootstrap custom -->
    <link href="css/requirement.css" rel="stylesheet">
    
    <!-- Bootstrap components (icons) -->
    
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
        <h1 class="mt-3" style="color:#207b8f">Driving Requirement</h1>
    </div>
  </div>

   <!--content-->
   <div class="container">
      <div class="row ml-3">
        <section id="content1">
          <br>
          <ul class="fa-ul">
            <li style="font-size:20px; color:#207b8f"><i class="fa fa-check-square"></i>&ensp; A rider must be 21 or above to work.</li>
            <br>
            <li style="font-size:20px; color:#207b8f"><i class="fa fa-check-square"></i>&ensp; A rider must have competent driving license. (Not Probationary)</li>
            <br>
            <br>
            <div class="row">
              <div class="column">
                <figure><image class="ml-5" src="image/competent.jfif" alt="competent driving license"><figcaption class="ml-5">Competent Driving License</figcaption></figure>
              </div>
              <div class="column">
                <figure><image class="ml-5" src="image/Probationary.jfif" alt="Probationary driving license"><figcaption class="ml-5">Probationary Driving License</figcaption></figure>
              </div>
            </div>
            <li style="font-size:20px; color:#207b8f"><i class="fa fa-check-square"></i>&ensp; A rider must be a Malaysia citizen or permanent local resident.</li>
            <br>
            <li style="font-size:20px; color:#207b8f"><i class="fa fa-check-square"></i>&ensp; A rider must at least knows how to speak a basic of English Language or Bahasa Malaysia.</li>
            <br>
            <li style="font-size:20px; color:#207b8f"><i class="fa fa-check-square"></i>&ensp; A rider must have no accident records and criminal records in lifetime.</li>
            <br>
            <li style="font-size:20px; color:#207b8f"><i class="fa fa-check-square"></i>&ensp; A rider must be physically and mentally healthy to work.</li>
          </ul>
          <br>
        </section>
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