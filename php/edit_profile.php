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

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($profileName) && !empty($birthDate) && !empty($phoneNumber) && !empty($theme)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND unique_id != '{$unique_id}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This email already exists!";
            } else {
                $update_query = "UPDATE users SET fname = '{$fname}', lname = '{$lname}', email = '{$email}', ProfileName = '{$profileName}', BirthDate = '{$birthDate}', PhoneNumber = '{$phoneNumber}', theme = '{$theme}'";
                
                if(!empty($new_password) && !empty($confirm_password)){
                    if($new_password === $confirm_password){
                        $encrypt_pass = md5($new_password);
                        $update_query .= ", password = '{$encrypt_pass}'";
                    } else {
                        echo "Passwords do not match!";
                        exit;
                    }
                }

                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];

                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);

                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($img_ext, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($img_type, $types) === true){
                            $time = time();
                            $new_img_name = $time.$img_name;
                            if(move_uploaded_file($tmp_name, "images/".$new_img_name)){
                                $update_query .= ", img = '{$new_img_name}'";
                            } else {
                                echo "Failed to move the uploaded file.";
                                exit;
                            }
                        } else {
                            echo "Please upload an image file - jpeg, png, jpg";
                            exit;
                        }
                    } else {
                        echo "Please upload an image file - jpeg, png, jpg";
                        exit;
                    }
                }

                $update_query .= " WHERE unique_id = '{$unique_id}'";
                if(mysqli_query($conn, $update_query)){
                    echo "Profile updated successfully!";
                } else {
                    echo "Something went wrong. Please try again!";
                }
            }
        } else {
            echo "$email is not a valid email!";
        }
    } else {
        echo "All input fields are required!";
    }
} else {
    header("location: login.php");
}
?>
