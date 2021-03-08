<?php
  session_start();
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Career</title>

    <!-- Bootstrap core CSS -->
    <link href="css/style2.css" rel="stylesheet">

    <!-- Bootstrap custom -->
    <link href="css/career.css" rel="stylesheet">
    
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

  <!--Header-->
  <div class="container-fluid">
    <div class="row">
      <header>
        <div class="content text-white">
          <br>
          <br>
          <br>
          <h1>Easy Job,<br>Easy Service. </h1>
          <br>
          <div class="text-center">
            <a href="sign_up_rider.php" class="btn btn-primary btn-lg">Apply Now!</a>
          </div>
        </div>
          <div class="imagebox"></div>
      </header>
    </div>
  </div>
  
  <!--First Content-->
  <div class="container">
    <div class="rowcontent row">
      <section id="content1">
        <div class="text-white">
          <h3>Raise your profit</h3>
          <br>
          <ul class="fa-ul">
            <li style="font-size:20px"><i class="fa fa-check"></i>&ensp; Earn fast money for each fast delivery</li>
            <br>
            <li style="font-size:20px"><i class="fa fa-check"></i>&ensp; The tips are <b><em>100%</em></b> yours</li>
          </ul>
        </div>
      </section>
      
      <section id="content2">
          <u><b><p style="font-size:25px"><a href="sign_up_rider.php" target="parent">Want to become a deliver rider?</a></p></b></u>
          <u><b><p style="font-size:25px"><a href="requirement.php" target="parent">What do you need to become a rider?</a></p></b></u>
      </section>
    </div>
  </div>

   <!--Second Content-->
  <div class="container">
    <div class="rowcontent row text">
      <section id="content3">
          <h3 style="color:#207b8f">What do we provide to rider?</h3>
          <br>
          <p style="font-size:20px; color: #207b8f"><i class="fa fa-check-square"></i>&ensp; High-quality accessories</p> 
          <p style="font-size:20px; color: #207b8f"><i class="fa fa-check-square"></i>&ensp; such as a motorcycle helmet, raincoat,<br>&emsp;&nbsp; phone holder and more</p>
          <br>
          <h3 style="color:#207b8f">Where do we deliver to?</h3>
          <br>
          <p style="font-size:20px; color: #207b8f"><i class="fa fa-check-square"></i>&ensp; We are delivering in KL and Selangor area.</p>
      </section>

      <section id="content4">
        <h3 style="color:#207b8f">Things that you'll need as a delivery rider</h3>
          <br>
          <ul class="fa-ul">
            <li style="font-size:20px; color: #207b8f"><i class="fa fa-id-card"></i>&ensp; Valid competent motorcycle license Malaysia</li>
            <br>
            <li style="font-size:20px; color: #207b8f"><i class="fa fa-id-card"></i>&ensp; A motorcycle (Optional)</li>
            <br>
            <li style="font-size:20px; color: #207b8f"><i class="fa fa-id-card"></i>&ensp; Malaysia citizenship or permanent resident status</li>
          </ul>
          <br>
      </section>
    </div>
  </div>

  <!--Third Content-->
  <div class="container-fluid">
    <div class="row">
      <section id="box1">
        <div class="text-center text-white">
          <br>
          <br>
          <div class="text-center">
            <a href="sign_up_rider.php" class="btn btn-primary btn-lg ">Sign Up for Rider now!</a>
          </div>
          <br>
          <br>
        </div>
      </section>
    </div>
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