<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        if(isset($_GET['logout_id'])){
            $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
            
            // Check if the logout_id matches the session unique_id for security
            if($logout_id == $_SESSION['unique_id']){
                $status = "last seen recently";
                $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id='{$logout_id}'");
                if($sql){
                    session_unset();
                    session_destroy();
                    header("location: ../index.php");
                    exit();
                } else {
                    echo "Error updating status. Please try again.";
                }
            } else {
                echo "Invalid logout request.";
            }
        } else {
            header("location: ../users.php");
            exit();
        }
    }else{  
        header("location: ../index.php");
        exit();
    }
?>
