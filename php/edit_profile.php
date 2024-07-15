<?php
session_start();
include_once "config.php";

if(isset($_SESSION['unique_id'])){
    $unique_id = $_SESSION['unique_id'];

    $fname = isset($_POST['fname']) ? mysqli_real_escape_string($conn, $_POST['fname']) : '';
    $lname = isset($_POST['lname']) ? mysqli_real_escape_string($conn, $_POST['lname']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $profileName = isset($_POST['profilename']) ? mysqli_real_escape_string($conn, $_POST['profilename']) : '';
    $birthDate = isset($_POST['birthdate']) ? mysqli_real_escape_string($conn, $_POST['birthdate']) : '';
    $phoneNumber = isset($_POST['phonenumber']) ? mysqli_real_escape_string($conn, $_POST['phonenumber']) : '';
    $current_password = isset($_POST['current_password']) ? mysqli_real_escape_string($conn, $_POST['current_password']) : '';
    $new_password = isset($_POST['new_password']) ? mysqli_real_escape_string($conn, $_POST['new_password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? mysqli_real_escape_string($conn, $_POST['confirm_password']) : '';

    $sql = "SELECT * FROM users WHERE unique_id = '{$unique_id}'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if(!$user) {
        echo "User not found.";
        exit;
    }

    if(!empty($current_password) && !password_verify($current_password, $user['password'])) {
        $_SESSION['message'] = "Current password is incorrect.";
        header("location: ../edit_profile.php");
        exit;
    }

    $update_query = "UPDATE users SET ";
    $fields = [];

    if(!empty($fname)) {
        $fields[] = "fname = '{$fname}'";
    }
    if(!empty($lname)) {
        $fields[] = "lname = '{$lname}'";
    }
    if(!empty($email)) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_check_query = "SELECT * FROM users WHERE email = '{$email}' AND unique_id != '{$unique_id}'";
            $email_check_result = mysqli_query($conn, $email_check_query);
            if(mysqli_num_rows($email_check_result) > 0) {
                $_SESSION['message'] = "This email is already in use.";
                header("location: ../edit_profile.php");
                exit;
            }
            $fields[] = "email = '{$email}'";
        } else {
            $_SESSION['message'] = "Invalid email format.";
            header("location: ../edit_profile.php");
            exit;
        }
    }
    if(!empty($profileName)) {
        $fields[] = "ProfileName = '{$profileName}'";
    }
    if(!empty($birthDate)) {
        $fields[] = "BirthDate = '{$birthDate}'";
    }
    if(!empty($phoneNumber)) {
        $fields[] = "PhoneNumber = '{$phoneNumber}'";
    }

    if(!empty($new_password) && !empty($confirm_password)) {
        if($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $fields[] = "password = '{$hashed_password}'";
        } else {
            $_SESSION['message'] = "New passwords do not match.";
            header("location: ../edit_profile.php");
            exit;
        }
    }

    if(isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];

        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);

        $extensions = ["jpeg", "png", "jpg"];
        if(in_array($img_ext, $extensions)) {
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if(in_array($img_type, $types)) {
                $time = time();
                $new_img_name = $time . $img_name;
                if(move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                    $fields[] = "img = '{$new_img_name}'";
                } else {
                    $_SESSION['message'] = "Failed to upload image.";
                    header("location: ../edit_profile.php");
                    exit;
                }
            } else {
                $_SESSION['message'] = "Invalid image type.";
                header("location: ../edit_profile.php");
                exit;
            }
        } else {
            $_SESSION['message'] = "Invalid image extension.";
            header("location: ../edit_profile.php");
            exit;
        }
    }

    if(count($fields) > 0) {
        $update_query .= implode(", ", $fields) . " WHERE unique_id = '{$unique_id}'";
        if(mysqli_query($conn, $update_query)) {
            $_SESSION['message'] = "Profile updated successfully.";
            header("location: ../edit_profile.php");
            exit;
        } else {
            $_SESSION['message'] = "Failed to update profile.";
            header("location: ../edit_profile.php");
            exit;
        }
    } else {
        $_SESSION['message'] = "No changes made.";
        header("location: ../edit_profile.php");
        exit;
    }
} else {
    header("location: login.php");
}
?>
