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
        <title>Rider - Completed</title>
        <meta http-equiv ="refresh" content="60">

        <!-- Bootstrap core CSS -->
        <link href="css/style.css" type="text/css" rel="stylesheet">

        <!--Bootstrap scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <!-- Header (Navbar) -->
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
                
            <h1 class="mt-4 mb-4 ml-1">Completed Order</h1>

            <div class="row col-md-6">
                <input class="mb-4 ml-1 col-md-6 form-control" id="search" type="search" name="search_order" placeholder="Search Order Number, Date">
            </div>

            <div class="row table-responsive">
                            <table class="table">
                                <thead class="text-center" style="background-color:#36454f; color:white;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer Name</th>
                                        <th>Date</th>
                                        <th>End-Time</th>
                                        <th>Grand Total</th>
                                        <th>More Details</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="tablerecord">
                                    <?php
                                        $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

                                        $query = "SELECT * FROM Dispatch
                                            
                                            INNER JOIN New_Order ON Dispatch.NewOrderID = New_Order.NewOrderID
                                            INNER JOIN Customer ON New_Order.CustomerID = Customer.CustomerID
                                            WHERE Dispatch.Status = 'Delivered' AND Dispatch.MemberID='$_SESSION[MemberID]'";
                                        $query_run = mysqli_query($connection, $query);
                                        
                                        if (mysqli_num_rows($query_run) > 0) {
                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <tr class="text-center">
                                        <td><?php echo $row['DutyID']; ?></td>
                                        <td><?php echo $row['FirstName']." ".$row['LastName']; ?></td>
                                        <td><?php echo $row['Date']; ?></td>
                                        <td><?php echo $row['EndTime']; ?></td>
                                        <td><?php echo "RM ".$row['GrandTotal']; ?></td>
                                        <td>
                                            <form action="view_order_details.php" method="POST">
                                                <input type="hidden" name="new_order_id" value="<?php echo $row['NewOrderID']; ?>">
                                                <button class="btn btn-info" type="submit" name="view_order_btn">View Order Details</button>
                                            </form>
                                        </td>
                            </tr>
                            <?php
                                }
                                } 
                                else {
                                echo '<p class="ml-3">'."No record is found.".'</p>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

        </div>        
        </main>


        <!-- footer -->
        <footer class="py-4 bg-light">
        <div class="container-fluid">
            <div class="small">
                <div class="text-muted">&copy; 2020 MyFoodWeyh</div>
            </div>
        </div>
        </footer>
                

        <!--Body JavaScripts-->
        <script src="js/script.js"></script>
        <script src="js/scripts.js"></script>
    
    </body>
</html>