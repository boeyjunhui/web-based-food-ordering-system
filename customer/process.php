<?php
    session_start();

    // Validation for direct URL entry
    if (!isset($_SERVER['HTTP_REFERER'])) {
        header('location: homepage.php');
    }

    $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

    // Sign up
    if (isset($_POST['register_btn'])) {

        $query = "INSERT INTO Customer (FirstName, LastName, ContactNumber, Email, Password, StreetAddress, City, State, ZipCode) VALUES ('$_POST[firstname]','$_POST[lastname]','$_POST[contactnumber]','$_POST[email]','$_POST[password]','$_POST[streetaddress]','$_POST[city]','$_POST[state]','$_POST[zipcode]')";
        $query_run = mysqli_query($connection, $query);
  
        if ($query_run) {
            echo 
            '<script>
                alert("Registration successfully.");
                window.location.href="sign_up.php";
            </script>';
          } else {
            echo 
            '<script>
                alert("Registration fail. Try again.");
                window.location.href="sign_up.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Edit profile
    if (isset($_POST['update_profile_btn'])) {

        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $contactnumber = $_POST['contactnumber'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $streetaddress = $_POST['streetaddress'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
    
        $query = "UPDATE Customer SET FirstName='$firstname', LastName='$lastname', ContactNumber='$contactnumber', Email='$email',  Password='$password', StreetAddress='$streetaddress', City='$city', State='$state', ZipCode='$zipcode' WHERE CustomerID='$id'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Profile is updated successfully.");
                window.location.href="view_profile.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to update the profile. Try again.");
                window.location.href="view_profile.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Forgot password
    if(isset($_POST['submit_btn'])) {
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);

        $url = "http://localhost:8080/www/myfoodweyh/customer/create_new_password.php?selector=" . $selector . "&validator=" . bin2hex($token);

        $expires = date("U") + 1800;

        $Email = $_POST["email"];

        $query ="DELETE FROM Forgot_Password WHERE Email=?";
        $stmt = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo 
            '<script>
                alert("There was an error");
                window.location.href="login.php";
            </script>';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $Email);
            mysqli_stmt_execute($stmt);
        }   

        $query = "INSERT INTO Forgot_Password (Email, ForgotPasswordSelector, ForgotPasswordToken, ForgotPasswordExpires) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo 
            '<script>
                alert("There was an error");
                window.location.href="login.php";
            </script>';
        }
        else {
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ssss", $Email, $selector, $hashedToken, $expires);
            mysqli_stmt_execute($stmt);
        }

        mysqli_stmt_close($stmt);
        mysqli_close();

        $to = $Email;

        $subject = 'Reset your password for MyFoodWeyh';

        $message = '<p>We received a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email.</p>';
        $message .= '<p>Here is your password reset link: </br>';
        $message .= '<a href="' . $url . '">' . $url . '</a></p>';

        $headers = "From: MyFoodWeyh <myfoodweyh@gmail.com>\r\n";
        $headers .= "Reply-To: myfoodweyh@gmail.com\r\n"; 
        $headers .= "Content-type: text/html\r\n";

        mail($to, $subject, $message, $headers);

        header("Location: forgot_password.php?reset=success");

    }

    // Reset password
    if(isset($_POST["reset_password_submit_btn"])) {

        $selector = $_POST["selector"];
        $validator = $_POST["validator"];
        $password = $_POST["pwd"];
        $passwordRepeat = $_POST["pwd-repeat"];

        if (empty($password) || empty($passwordRepeat)) {
            echo "Please make sure it is not empty.";
            exit();
        }
        elseif ($password != $passwordRepeat) {
            echo "The password is not same! Please try again.";
            exit();
        }

        $currentDate =date("U");

        $query = "SELECT * FROM Forgot_Password WHERE ForgotPasswordSelector=? AND ForgotPasswordExpires >= ?";
        $stmt = mysqli_stmt_init($connection);

            if (!mysqli_stmt_prepare($stmt, $query)) {
                echo 
                '<script>
                    alert("There was an error.");
                    window.location.href="login.php";
                </script>';
            }
            else {
                mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);
                if (!$row = mysqli_fetch_assoc($result)) {
                    echo "You need to re-submit your reset request.";
                    exit();
                }
                else {
                
                    $tokenBin = hex2bin($validator);
                    $tokenCheck = password_verify($tokenBin, $row["ForgotPasswordToken"]);

                    if ($tokenCheck == false) {
                        echo "You need to re-submit your reset request.";
                        exit();    
                    }
                    elseif ($tokenCheck == true) {
                        $tokenEmail = $row['Email'];

                        $query = "SELECT * FROM Customer WHERE Email=?";
                        $stmt = mysqli_stmt_init($connection);

                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        echo 
                        '<script>
                            alert("There was an error2.");
                            window.location.href="login.php";
                        </script>';
                    }
                    else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "There was an error!";
                        exit();
                    }
                    else {
                        
                        $query = "UPDATE Customer SET Password=? WHERE Email=?";
                        $stmt = mysqli_stmt_init($connection);

                        if (!mysqli_stmt_prepare($stmt, $query)) {
                            echo 
                            '<script>
                                alert("There was an error in updating.");
                                window.location.href="login.php";
                            </script>';
                        }
                        else { 
                        mysqli_stmt_bind_param($stmt, "ss", $password, $tokenEmail);
                        mysqli_stmt_execute($stmt);

                            $query = "DELETE FROM Forgot_Password WHERE Email=?";
                            $stmt = mysqli_stmt_init($connection);

                            if (!mysqli_stmt_prepare($stmt, $query)) {
                                echo 
                                '<script>
                                    alert("There was an error in delete.");
                                    window.location.href="login.php";
                                </script>';
                            }
                            else {
                                mysqli_stmt_bind_param($stmt, "s", $Email);
                                mysqli_stmt_execute($stmt);
                                echo 
                                '<script>
                                    alert("Update Password Success");
                                    window.location.href="login.php";
                                </script>';

                            }
                        }

                    }

                    }

                    }
                }
            }
    }

    // Register rider
    if (isset($_POST['register_rider_btn'])) {

        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $icnumber = $_POST['ic_number']; 
        $contact = $_POST['contact_number'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedpassword = $_POST['confirm_password'];
        $streetaddress = $_POST['street_address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
        $icimage = $_FILES['ic']['tmp_name'];
        $icimage = base64_encode(file_get_contents(addslashes($icimage)));
        $drivinglicenseimage = $_FILES['driving_license']['tmp_name'];
        $drivinglicenseimage = base64_encode(file_get_contents(addslashes($drivinglicenseimage)));

        $query = "INSERT INTO Rider (FirstName, LastName, ICNumber, ContactNumber, Email, Password, StreetAddress, City, State, ZipCode, ICPicture, DrivingLicensePicture) 
        VALUES ('$firstname','$lastname','$icnumber','$contact','$email','$confirmedpassword','$streetaddress','$city','$state','$zipcode','$icimage','$drivinglicenseimage')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Your enrollment is registered successfully.");
                window.location.href="sign_up_rider.php"; 
            </script>';
        } 
        else {
            echo
            '<script>
                alert("Failed to enroll. Try again.");
                return false;
            </script>';
        }
        mysqli_close($connection);
    }

    // Contact message
    if (isset($_POST['add_contact_btn'])) {

        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $contact = $_POST['contact_number'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $query = "INSERT INTO Contact (FirstName, LastName, Email, ContactNumber, Message) 
        VALUES ('$firstname','$lastname','$email','$contact','$message')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Your message is delivered successfully.");
                window.location.href="contact_us.php"; 
            </script>';
        } 
        else {
            echo
            '<script>
                alert("Failed to send message. Try again.");
                return false;
            </script>';
        }
        mysqli_close($connection);
    }

    // Customer checkout & place order
    if (isset($_POST['place_order_btn'])) {

        $customerid = $_SESSION['customerid'];
        $grandtotal = $_SESSION['grandtotal'];
        
        $successful = TRUE;

        $new_order_query = "INSERT INTO New_Order (CustomerID, Date, Time, DeliveryAddress, PaymentMethod, GrandTotal, Status)
        VALUES ('$customerid', CURDATE(), CURRENT_TIME() +80000, '$_POST[delivery_address]', '$_POST[payment_method]', '$grandtotal', 'Pending')";
        $new_order_query_run = mysqli_query($connection, $new_order_query);

        $select_query = "SELECT NewOrderID FROM New_Order WHERE CustomerID='$customerid'";
        $select_query_run = mysqli_query($connection, $select_query);

        $neworderid = 0;

        if (mysqli_num_rows($select_query_run) > 0) {
            while ($row = mysqli_fetch_assoc($select_query_run)) {
            $neworderid = $row['NewOrderID'];
            }
        }

        foreach ($_SESSION['cart'] as $id => $quantity) {
            $order_item_query = "INSERT INTO Order_Item (NewOrderID, MenuID, Quantity) VALUES ('$neworderid', '$id', '$quantity')";
            $order_item_query_run = mysqli_query($connection, $order_item_query);
             
            if (!$order_item_query_run) {
                $successful = FALSE;
            }
        }

        if ($new_order_query_run) {
            echo
            '<script>
                alert("Order is placed successfully.");
                window.location.href="orders.php";
            </script>';
        } else {
            $successful = FALSE;
            echo
            '<script>
                alert("Failed to place order. Try again.");
                window.location.href="payment.php";
            </script>';
        }

        if ($successful == TRUE) {
            unset($_SESSION['cart']);
        }
        mysqli_close($connection);
    }
?>