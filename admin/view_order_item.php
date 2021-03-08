<?php
    session_start();

    // Validation for enter URL without login
    if (!$_SESSION['Email']) {
        header('location: admin_login.php');
    }

    // Validation for direct URL entry
    if (!isset($_SERVER['HTTP_REFERER'])) {
        header('location: dashboard.php');
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>View Order Item</title>
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
    
                <h1 class="mt-4 mb-4 ml-1">Order Item</h1>
        
                <div class="row table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="tablerecord">
                        <?php
                            $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

                            $neworderid = $_POST['new_order_id'];

                            $query = "SELECT * FROM Order_Item
                            INNER JOIN Menu ON Order_Item.MenuID = Menu.MenuID
                            INNER JOIN New_Order ON Order_Item.NewOrderID = New_Order.NewOrderID
                            WHERE Order_Item.NewOrderID='$neworderid'";
                            $query_run = mysqli_query($connection, $query);

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
                                echo '<p class="ml-3">'."No order item is found.".'</p>';
                            }
                            mysqli_close($connection);
                        ?>
                        </tbody>
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