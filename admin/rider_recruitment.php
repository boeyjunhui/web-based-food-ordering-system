<?php
    session_start();

    // Validation for enter URL without login
    if (!$_SESSION['Email']) {
        header('location: admin_login.php');
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Rider Recruitment</title>
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <!-- Top Navbar -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="dashboard.php"><img src="image/myfoodweyh_logo_(white).png" alt="MyFoodWeyh" width="120px" height="30px"></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

            <!-- Profile -->
            <form class="ml-auto"></form>
            <div>
                <p class="text-white small mr-3"><?php echo "Logged in as: " .$_SESSION['Email']; ?></p>
            </div>
            <ul class="navbar-nav ml-auto ml-md-0">
                <li>
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-user-circle"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <form action="process.php" method="POST">
                            <button class="dropdown-item" onClick="return confirm('Are you sure to logout?');" type="submit" name="admin_logout_btn">Logout</button>
                        </form>
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
                        
                            <!-- Dashboard Sidebar Menu -->
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="far fa-chart-bar"></i></div>
                                DASHBOARD
                            </a>

                            <!-- Members Sidebar Menu -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMembers" aria-expanded="false" aria-controls="collapseMembers">
                                <div class="sb-nav-link-icon"><i class="far fa-user"></i></div>
                                MEMBERS
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseMembers" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="organization_members.php">Organization Members</a>
                                    <a class="nav-link" href="add_member.php">Add Member</a>
                                    <a class="nav-link" href="rider_recruitment.php">Rider Recruitment</a>
                                </nav>
                            </div>
      
                            <!-- Customers Sidebar Menu -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomers" aria-expanded="false" aria-controls="collapseCustomers">
                                <div class="sb-nav-link-icon"><i class="far fa-user"></i></div>
                                CUSTOMERS
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCustomers" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class ="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="registered_customers.php">Registered Customers</a>
                                    <a class="nav-link" href="customer_contact.php">Customer Contact</a>
                                </nav>
                            </div>

                            <!-- Menu Sidebar Menu -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenu" aria-expanded="false" aria-controls="collapseMenu">
                                <div class="sb-nav-link-icon"><i class="far fa-newspaper"></i></div>
                                MENU
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseMenu" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="add_food_menu.php">Add Food Menu</a>
                                    <a class="nav-link" href="manage_food_menu.php">Manage Food Menu</a>
                                </nav>
                            </div>

                            <!-- Orders Sidebar Menu -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="false" aria-controls="collapseOrders">
                                <div class="sb-nav-link-icon"><i class="far fa-edit"></i></div>
                                ORDERS
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseOrders" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="new_orders.php">New Orders</a>
                                    <a class="nav-link" href="dispatch.php">Order Dispatch</a>
                                    <a class="nav-link" href="order_history.php">Order History</a>
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

                <h1 class="mt-4 mb-4 ml-1">Rider Recruitment</h1>

                <div class="row col-md-6">
                    <input class="mb-4 ml-1 col-md-6 form-control" id="search" type="search" name="search_rider" placeholder="Search Name, Email, Contact Number">
                </div>

                <div class="row table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>IC Number</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Street Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip Code</th>
                                <th>IC Picture</th>
                                <th>Driving License Picture</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tablerecord">
                        <?php
                            $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

                            $query = "SELECT * FROM Rider";
                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                            <tr>
                                <td><?php echo $row['RiderID']; ?></td>
                                <td><?php echo $row['FirstName']; ?></td>
                                <td><?php echo $row['LastName']; ?></td>
                                <td><?php echo $row['ICNumber']; ?></td>
                                <td><?php echo $row['ContactNumber']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['Password'] ?></td>
                                <td><?php echo $row['StreetAddress']; ?></td>
                                <td><?php echo $row['City']; ?></td>
                                <td><?php echo $row['State']; ?></td>
                                <td><?php echo $row['ZipCode']; ?></td>
                                <td><?php echo '<img src=data:image;base64,'.$row['ICPicture'].' alt="IC Picture" width="192px" height="108px">'; ?></td> 
                                <td><?php echo '<img src=data:image;base64,'.$row['DrivingLicensePicture'].' alt="Driving License Picture" width="192px" height="108px">'; ?></td>
                                <td>
                                    <form action="process.php" method="POST">
                                        <input type="hidden" name="accept_rider" value="<?php echo $row['RiderID']; ?>">
                                        <button class="btn btn-primary" type="submit" name="accept_rider_btn">Accept</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="process.php" method="POST">
                                        <input type="hidden" name="reject_rider" value="<?php echo $row['RiderID']; ?>">
                                        <button class="btn btn-danger" onClick="return confirm('Are you sure to reject rider request?');" type="submit" name="reject_rider_btn">Reject</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                    }
                                } else {
                                    echo '<p class="ml-3">'."No rider recruitment record is found.".'</p>';
                                }
                                mysqli_close($connection);
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