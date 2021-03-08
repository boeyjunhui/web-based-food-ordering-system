<?php
    // Validation for direct URL entry
    if (!isset($_SERVER['HTTP_REFERER'])) {
        header('location: dashboard.php');
    }

    $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

    // Admin Login
    if (isset($_POST['admin_login_btn'])) {

        session_start();

        $email = $_POST['email'];
        $password = $_POST['password'];

        $admin_query = "SELECT * FROM Organization_Member WHERE Email='$email' AND Password='$password' AND UserRole='Admin'";
        $admin_query_run = mysqli_query($connection, $admin_query);

        if (mysqli_fetch_array($admin_query_run)) {
            $_SESSION['Email'] = $email;
            echo
            '<script>
                window.location.href="dashboard.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Email or password is invalid. Failed to login, please try again.");
                window.location.href="admin_login.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Admin Logout
    if (isset($_POST['admin_logout_btn'])) {
        session_start();
        unset($_SESSION['Email']);
        session_destroy();
        header('location: admin_login.php');
    }

    // Add Member
    if (isset($_POST['add_member_btn'])) {

        $query = "INSERT INTO Organization_Member (FirstName, LastName, Email, ContactNumber, Password, UserRole) VALUES ('$_POST[firstname]','$_POST[lastname]','$_POST[email]','$_POST[contactnumber]','$_POST[password]','$_POST[userrole]')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("1 member account is added successfully.");
                window.location.href="organization_members.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to add member account. Try again.");
                window.location.href="add_member.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Update Member
    if (isset($_POST['update_member_btn'])) {

        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $contactnumber = $_POST['contactnumber'];
        $password = $_POST['password'];
        $userrole = $_POST['userrole'];
    
        $query = "UPDATE Organization_Member SET FirstName='$firstname', LastName='$lastname', Email='$email', ContactNumber='$contactnumber',Password='$password', UserRole='$userrole' WHERE MemberID='$id'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Member account is updated successfully.");
                window.location.href="organization_members.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to update member account. Try again.");
                window.location.href="organization_members.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Delete Member
    if (isset($_POST['delete_member_btn'])) {

        $id = $_POST['delete_member'];

        $query = "DELETE FROM Organization_Member WHERE MemberID='$id'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Member account is deleted successfully.");
                window.location.href="organization_members.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to delete member account. Try again.");
                window.location.href="organization_members.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Accept Rider Request
    if (isset($_POST['accept_rider_btn'])) {

        $id = $_POST['accept_rider'];

        $insert_query = "INSERT INTO Organization_Member (FirstName, LastName, Email, ContactNumber, Password, UserRole) SELECT FirstName, LastName, Email, ContactNumber, Password, 'Rider' FROM Rider WHERE RiderID='$id'";
        $insert_query_run = mysqli_query($connection, $insert_query);

        $delete_query = "DELETE FROM Rider WHERE RiderID='$id'";
        $delete_query_run = mysqli_query($connection, $delete_query);
        
        if ($insert_query_run && $delete_query_run) {
            echo
            '<script>
                alert("Rider request is accepted successfully.");
                window.location.href="organization_members.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to accept rider request. Try again.");
                window.location.href="rider_recruitment.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Reject Rider Request
    if (isset($_POST['reject_rider_btn'])) {

        $id = $_POST['reject_rider'];

        $query = "DELETE FROM Rider WHERE RiderID='$id'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Rider request is rejected successfully.");
                window.location.href="rider_recruitment.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to reject rider request. Try again.");
                window.location.href="rider_recruitment.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Delete Customer
    if (isset($_POST['delete_customer_btn'])) {

        $id = $_POST['delete_customer'];

        $query = "DELETE FROM Customer WHERE CustomerID='$id'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Customer account is deleted successfully.");
                window.location.href="registered_customers.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to delete customer account. Try again.");
                window.location.href="registered_customers.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Delete Message
    if (isset($_POST['delete_message_btn'])) {

        $id = $_POST['delete_message'];

        $query = "DELETE FROM Contact WHERE ContactID='$id'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Message is deleted successfully.");
                window.location.href="customer_contact.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to delete message. Try again.");
                window.location.href="customer_contact.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Add Food Menu
    if (isset($_POST['add_menu_btn'])) {

        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_FILES['image']['tmp_name'];
        $image = base64_encode(file_get_contents(addslashes($image)));
        $category = $_POST['category'];

        $query = "INSERT INTO Menu (Name, Description, Price, Image, Category) VALUES ('$name','$description','$price','$image','$category')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("1 food menu is added successfully.");
                window.location.href="manage_food_menu.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to add food menu. Try again. ");
                window.location.href="add_food_menu.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Update Food Menu
    if (isset($_POST['update_menu_btn'])) {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_FILES['image']['tmp_name'];
        $image = base64_encode(file_get_contents(addslashes($image)));
        $category = $_POST['category'];
    
        $query = "UPDATE Menu SET Name='$name', Description='$description', Price='$price', Image='$image', Category='$category' WHERE MenuID='$id'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Food menu is updated successfully.");
                window.location.href="manage_food_menu.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to update food menu. Try again.");
                window.location.href="manage_food_menu.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Delete Food Menu
    if (isset($_POST['delete_menu_btn'])) {

        $id = $_POST['delete_menu'];

        $query = "DELETE FROM Menu WHERE MenuID='$id'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Food menu is deleted successfully.");
                window.location.href="manage_food_menu.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to delete food menu. Try again.");
                window.location.href="manage_food_menu.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Accept New Order
    if (isset($_POST['accept_order_btn'])) {

        $neworderid = $_POST['new_order_id'];

        $query = "UPDATE New_Order SET Status='Accepted' WHERE NewOrderID='$neworderid'";
        $query_run = mysqli_query($connection, $query);
        
        if ($query_run) {
            echo
            '<script>
                alert("Order is accepted successfully.");
                window.location.href="dispatch.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to accept order. Try again.");
                window.location.href="new_orders.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Reject New Order
    if (isset($_POST['reject_order_btn'])) {

        $neworderid = $_POST['new_order_id'];
       
        $delete_order_item_query = "DELETE FROM Order_Item WHERE NewOrderID IN (SELECT NewOrderID FROM New_Order WHERE NewOrderID='$neworderid')";
        $delete_order_item_query_run = mysqli_query($connection, $delete_order_item_query);

        $delete_new_order_query = "DELETE FROM New_Order WHERE NewOrderID='$neworderid'";
        $delete_new_order_query_run = mysqli_query($connection, $delete_new_order_query);

        if ($delete_order_item_query_run && $delete_new_order_query_run) {
            echo
            '<script>
                alert("Order is rejected successfully.");
                window.location.href="new_orders.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to reject order. Try again.");            
                window.location.href="new_orders.php";
            </script>';
        }
        mysqli_close($connection);
    }

    // Deploy Rider
    if (isset($_POST['deploy_rider_btn'])) {

        $neworderid = $_POST['new_order_id'];
        $rider = $_POST['rider'];

        $query = "INSERT INTO Dispatch (NewOrderID, MemberID, StartTime, Status) VALUES ($neworderid, $rider, CURRENT_TIME(), 'Delivering')";
        $query_run = mysqli_query($connection, $query);
        
        $order_query = "UPDATE New_Order SET Status='Delivering' WHERE NewOrderID='$neworderid'";
        $order_query_run = mysqli_query($connection, $order_query);

        if ($query_run && $order_query_run) {
            echo
            '<script>
                alert("Order is deployed to rider successfully.");
                window.location.href="dispatch.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to deploy order to rider. Try again.");
                window.location.href="dispatch.php";
            </script>';
        }
        mysqli_close($connection);
    }
?>