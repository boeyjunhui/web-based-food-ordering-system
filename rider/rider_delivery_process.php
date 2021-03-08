<?php
     if (!isset($_SERVER['HTTP_REFERER'])) {
        header('location: ongoing.php');
    }
    
    $connection = mysqli_connect("localhost","root","","MyFoodWeyh");

    // Accept Delivered Order
    if (isset($_POST['delivered_btn'])) {

        $dutyid = $_POST['duty_id'];
        $neworderid = $_POST['new_order_id'];

        $insert_query = "UPDATE Dispatch SET EndTime = CURRENT_TIME() WHERE DutyID='$dutyid'";
        $update_query = "UPDATE Dispatch SET Status = 'Delivered' WHERE DutyID='$dutyid'";
        $update_new_order_query = "UPDATE New_Order SET Status = 'Delivered' WHERE NewOrderID='$neworderid'";

         $insert_query_run = mysqli_query($connection, $insert_query);
         $update_query_run = mysqli_query($connection, $update_query);
         $update_new_order_query_run = mysqli_query($connection, $update_new_order_query);

         if ($insert_query_run && $update_query_run && $update_new_order_query_run) {
            echo
            '<script>
                alert("Order is delivered successfully.");
                window.location.href="completed.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to deliver order. Try again.");
                window.location.href="ongoing.php";
            </script>';
        }
        mysqli_close($connection);
    }
?>
