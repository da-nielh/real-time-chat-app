<?php
session_start();
include_once "php/config.php";
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}
$unique_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");
if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
} else {
    header("location: login.php");
}
?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper" style="width: 100%; margin: 0; border-radius: 0%">
        <section class="form edit-profile">
            <header>
                <a href="users.php" class="back-icon settings-icon"><i class="fas fa-arrow-left"></i></a>
                <h2>Edit Profile</h2>
            </header>
            <form action="php/edit_profile.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="field image">
                    <label>Profile Image</label>
                    <img src="php/images/<?php echo $row['img']; ?>" alt="Profile Image">
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                </div>
                <div class="field input">
                    <label>Profile Name</label>
                    <input type="text" name="profilename" value="<?php echo $row['ProfileName']; ?>" >
                </div>
                <div class="field input">
                    <label>Birth Date</label>
                    <input type="date" name="birthdate" value="<?php echo $row['BirthDate']; ?>" >
                </div>
                <div class="field input">
                    <label>Phone Number</label>
                    <input type="text" name="phonenumber" value="<?php echo $row['PhoneNumber']; ?>" >
                </div>
                <div class="field input">
                    <label>First Name</label>
                    <input type="text" name="fname" value="<?php echo $row['fname']; ?>" >
                </div>
                <div class="field input">
                    <label>Last Name</label>
                    <input type="text" name="lname" value="<?php echo $row['lname']; ?>" >
                </div>
                <div class="field input">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>" >
                </div>
                <div class="field input">
                    <label>Theme</label>
                    <input type="text" name="theme" value="<?php echo $row['theme']; ?>" >
                </div>
                <div class="field input">
                    <label>Current Password</label>
                    <input type="password" name="current_password" placeholder="Enter current password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field input">
                    <label>New Password</label>
                    <input type="password" name="new_password" placeholder="Enter new password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field input">
                    <label>Confirm New Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm new password">
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Save Changes">
                </div>
            </form>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
</body>
</html>
