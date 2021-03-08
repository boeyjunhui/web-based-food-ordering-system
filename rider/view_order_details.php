<?php
    session_start();

    // Validation for enter url without login
    if (!isset($_SESSION['Email'])) {
        echo "<script>alert('Please login!'); window.location.href='rider_login.php';</script>";
    }
?>

<!DOCTYPE html>
<html>

    <head>
        <title>View Order Details</title>
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>

    <body>
    <!-- Top Navbar -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark"> 
            <button class="btn btn-link btn-sm order-1 order-lg-0 ml-4" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <a class="navbar-brand" href="ongoing.php"><img src="image/myfoodweyh_logo_(white).png" alt="MyFoodWeyh" width="120px" height="30px"></a>
    

        <!-- Profile -->
            <form class="ml-auto"></form>
            <div>
                <p class="text-white small mr-3"><?php echo "Logged in as: ".$_SESSION['FullName']; ?></p>
            </div>
            <ul class="navbar-nav ml-auto ml-md-0">
            <li>
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-user-circle"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="rider_logout_process.php">Logout</a>
                </div>
            </li>
            </ul>
        </nav>

        <!-- Side Navigation Menu-->
        <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
          <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
              <div class="sb-sidenav-menu">
                  <div class="nav">
    
                      <!-- Orders Sidebar Menu -->
                      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="false" aria-controls="collapseOrders">
                          <div class="sb-nav-link-icon"><i class="far fa-edit"></i></div>
                          ON DUTY
                          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                      </a>
                      <div class="collapse" id="collapseOrders" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                          <nav class="sb-sidenav-menu-nested nav">
                              <a class="nav-link" href="ongoing.php">On Going</a>
                              <a class="nav-link" href="completed.php">Completed</a>
                          </nav>
                      </div>

                      </div>
                  </div>
              </nav>
          </div>
        <div id="layoutSidenav_content">


            <!-- Content -->
            <main>
                <div class="container-fluid">
       
                    <h1 class="mt-4 mb-4 ml-1">Order Information</h1>

                    <div class="row col-md-6">
                        <input class="mb-4 ml-1 col-md-6 form-control" id="search" type="search" name="search_order" placeholder="Search Menu, Price">
                    </div>

                    <?php
                        include("rider_delivery_process.php");

                        $neworderid = $_POST['new_order_id'];

                        $query = "SELECT * FROM Order_Item
                        INNER JOIN Menu ON Order_Item.MenuID = Menu.MenuID
                        INNER JOIN New_Order ON Order_Item.NewOrderID = New_Order.NewOrderID
                        WHERE Order_Item.NewOrderID='$neworderid'
                        ";

                        $query1 ="SELECT * FROM Dispatch where MemberID ='$_SESSION[MemberID]'
                        GROUP BY Dispatch.DutyID";

                        $query2 ="SELECT * FROM New_Order where NewOrderID='$neworderid'";

                        $query_run = mysqli_query($connection, $query);
                        $query_run1 = mysqli_query($connection,$query1);
                        $query_run2 = mysqli_query($connection,$query2);
                    ?>
          
                        <div class="row table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Menu</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody id="tablerecord">
                                <?php
                                    if (mysqli_num_rows($query_run) > 0) {
                                        while ($row = mysqli_fetch_assoc($query_run)) {  
                                ?>
                                    <tr>
                                        <td><?php echo $row['Name']; ?></td>
                                        <td><?php echo $row['Quantity']; ?></td>
                                        <td><?php echo "RM ".number_format($row['Quantity'] * $row['Price'],2); ?></td>
                                        
                                    </tr>  
                                <?php
                                        }
                                    } else {
                                        echo '<p class="ml-3">'."No record is found.".'</p>';
                                    }
                                ?> 
                                </tbody>
                                <tbody class="tablerecord">
                                <?php
                                    if (mysqli_num_rows($query_run2) > 0) {
                                        while ($row = mysqli_fetch_assoc($query_run2)) {  
                                ?>
                                <tr>
                                    <th></th>
                                    <th style="padding-left:52px">Grand Total:</th>
                                    <th><?php echo "RM ".$row['GrandTotal']; ?></th>
                                </tr>

                                <tr>
                                    <th></th>
                                    <th style="padding-left:10px">Delivery Address:</th>
                                    <th><?php echo $row['DeliveryAddress']; ?></th>
                                </tr>
                                </tbody>
                                <?php
                                        }
                                    } else {
                                        echo '<p class="ml-3">'."No record is found.".'</p>';
                                    }
                                ?>
                            </table>   
                        </div>

                        <div>
                            <button class="btn btn-primary mt-3" name="go_back_btn" onclick="goback()">Back</button>
                        </div>

                </div>       
            </main>

           <!-- footer -->
           <footer class="py-4 bg-light">
                <div class="container-fluid">
                    <div class="small">
                        <div class="text-white">&copy; 2020 MyFoodWeyh</div>
                    </div>
                </div>
            </footer>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>