<?php
session_start();
include_once "config.php";

if(isset($_SESSION['unique_id'])){
    $unique_id = $_SESSION['unique_id'];

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $profileName = mysqli_real_escape_string($conn, $_POST['profilename']);
    $birthDate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $theme = mysqli_real_escape_string($conn, $_POST['theme']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);

    // Check if current password matches with the stored password
    $password_check_query = "SELECT * FROM users WHERE unique_id = '{$unique_id}'";
    $result = mysqli_query($conn, $password_check_query);
    $user = mysqli_fetch_assoc($result);
    $stored_password = $user['password'];
    
    if(!password_verify($current_password, $stored_password)) {
        echo "Current password is incorrect.";
        exit;
    }

    // Build the update query dynamically based on provided data
    $update_query = "UPDATE users SET ";

    if(!empty($fname)) {
        $update_query .= "fname = '{$fname}', ";
    }

    if(!empty($lname)) {
        $update_query .= "lname = '{$lname}', ";
    }

    if(!empty($email)) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $update_query .= "email = '{$email}', ";
        } else {
            echo "$email is not a valid email!";
            exit;
        }
    }

    if(!empty($profileName)) {
        $update_query .= "ProfileName = '{$profileName}', ";
    }

    if(!empty($birthDate)) {
        $update_query .= "BirthDate = '{$birthDate}', ";
    }

    if(!empty($phoneNumber)) {
        $update_query .= "PhoneNumber = '{$phoneNumber}', ";
    }

    if(!empty($theme)) {
        $update_query .= "theme = '{$theme}', ";
    }

    // Add password update if new password is provided and confirmed
    if(!empty($new_password) && !empty($confirm_password)){
        if($new_password === $confirm_password){
            $encrypt_pass = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query .= "password = '{$encrypt_pass}', ";
        } else {
            echo "Passwords do not match!";
            exit;
        }
    }

    // Handle profile image update
    if(isset($_FILES['image']) && $_FILES['image']['size'] > 0){
        $img_name = $_FILES['image']['name'];
        $img_tmp = $_FILES['image']['tmp_name'];

        $img_path = "images/" . $img_name;

        if(move_uploaded_file($img_tmp, $img_path)){
            $update_query .= "img = '{$img_path}', ";
        } else {
            echo "Failed to upload image.";
            exit;
        }
    }

    // Remove trailing comma and space from update query
    $update_query = rtrim($update_query, ", ");

    // Add WHERE clause to update only for the current user
    $update_query .= " WHERE unique_id = '{$unique_id}'";

    // Execute the update query
    if(mysqli_query($conn, $update_query)){
        echo "Profile updated successfully!";
    } else {
        echo "Something went wrong. Please try again!";
    }
} else {
    header("location: login.php");
}
?>
