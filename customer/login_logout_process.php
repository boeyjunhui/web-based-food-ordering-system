<?php
    session_start();

    // Validation for direct URL entry
    if (!isset($_SERVER['HTTP_REFERER'])) {
        header('location: homepage.php');
    }

    $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

    // Customer Login
    if (isset($_POST['login_btn'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $customer_query = "SELECT * FROM Customer WHERE Email='$email' AND Password='$password'";
        $customer_query_run = mysqli_query($connection, $customer_query);

        if (mysqli_num_rows($customer_query_run) > 0) {

            while ($row = mysqli_fetch_assoc($customer_query_run)) {
                $_SESSION['customerid'] = $row['CustomerID'];
            }

            header('location: homepage.php');

        } else {
            echo
            '<script>
                alert("Email or password is invalid. Failed to login, please try again.");
                window.location.href="login.php";
            </script>';
        }
        mysqli_close($connection);
    }
    
    // Customer Logout
    if (isset($_POST['customer_logout_btn'])) {
        session_destroy();
        header('location: login.php');
    }
?>