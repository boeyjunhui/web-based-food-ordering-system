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
        <title>Add Food Menu</title>
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

                <h1 class="mt-4 mb-4 ml-5">Add Food Menu</h1>

                <form action="process.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-4 ml-5 col-md-4">
                            <label for="foodname">Food Name *</label>
                            <div><input class="col-md-9 col-form-label" type="text" name="name" placeholder="Enter food name" pattern="[A-Za-z -]+" minlength="1" maxlength="50" required></div>
                        </div>
                        <div class="mb-4 ml-5 col-md-4">
                            <label for="description">Description *</label>
                            <div><input class="col-md-9 col-form-label" type="text" name="description" placeholder="Enter food description" pattern="[A-Za-z0-9 ,-]+" required></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-4 ml-5 col-md-4">
                            <label for="price">Price (RM) *</label>
                            <div><input class="col-md-9 col-form-label" type="number" name="price" step="0.01" placeholder="Enter food price" min="1" max="100" required></div>
                        </div>
                        <div class="mb-4 ml-5 col-md-4">
                            <label for="image">Image *</label>
                            <div><input type="file" name="image" accept="image/*" required></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-4 ml-5 col-md-4">
                            <label for="category">Category *</label>
                            <div>
                                <select class="col-md-4 col-form-label" name="category" required>
                                    <option value="">Please select...</option>
                                    <option value="Pizza">Pizza</option>
                                    <option value="Pastas">Pastas</option>
                                    <option value="Salads">Salads</option>
                                    <option value="Desserts">Desserts</option>       
                                    <option value="Beverages">Beverages</option>              
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mt-5 ml-5 col-md-4">
                            <a href="dashboard.php" class="btn btn-danger">Cancel</a>
                            <input class="ml-3 btn btn-primary" type="submit" name="add_menu_btn" value="Add Menu">
                        </div>
                    </div>
                </form>

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
    </body>
</html>