<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    
    // Delete all messages between these two users
    $sql = "DELETE FROM messages WHERE 
            (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id}) OR 
            (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id})";
    
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "not_logged_in";
}
?>
