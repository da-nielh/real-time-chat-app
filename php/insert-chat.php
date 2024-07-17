<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";

    function str_openssl_enc($str, $iv) {
        $key = '1234567890vishal%$%^%$$#$#';
        $chiper = "AES-128-CTR";
        $options = 0;
        $str = openssl_encrypt($str, $chiper, $key, $options, $iv);
        return $str;
    }

    $iv = openssl_random_pseudo_bytes(16);
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Encrypt the message
    $message = str_openssl_enc($message, $iv);
    $iv = bin2hex($iv);

    // Handle the image upload
    $image_url = "";
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);
        $extensions = ["jpeg", "png", "jpg"];
        if (in_array($img_ext, $extensions) === true) {
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if (in_array($img_type, $types) === true) {
                $time = time();
                $new_img_name = $time . $img_name;
                if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                    $image_url = $new_img_name;
                }
            }
        }
    }

    if (!empty($message) || !empty($image_url)) {
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, iv) VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$iv}')") or die(mysqli_error($conn));
        $msg_id = mysqli_insert_id($conn);

        if (!empty($image_url)) {
            $sql2 = mysqli_query($conn, "INSERT INTO message_images (msg_id, image_url) VALUES ({$msg_id}, '{$image_url}')") or die(mysqli_error($conn));
        }
    }
} else {
    header("location: ../login.php");
}
?>
