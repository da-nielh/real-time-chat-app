<?php
session_start();
include_once "php/config.php";
if(!isset($_SESSION['unique_id'])){
    header("location: index.php");
}
$unique_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");
if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
} else {
    header("location: index.php");
}

$message = '';
if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>
<?php include_once "header.php"; ?>
<body>
    <div class="full_wrapper">
        <div class="profile_wrapper">
            <section class="form edit-profile">
                <header>
                    <div class="back_link">
                        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left" style="font-size: 24px;"></i></a>
                    </div>
                    <div class="header_right page_description">
                        <h1>Chat</h1>
                        <span>Edit Profile</span>
                    </div>
                </header>
                <?php if(!empty($message)): ?>
                    <div class="alert"><?php echo $message; ?></div>
                <?php endif; ?>
                <form action="php/edit_profile.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="error-text"></div>
                    <div class="left_edit_wrapper">
                        <div class="field image">
                            <img src="php/images/<?php echo $row['img']; ?>" alt="Profile Image">
                            <div class="user_name">
                                <h1><?php echo $row['ProfileName']; ?></h1>
                                <h3>
                                    <span><?php echo $row['fname']; ?></span>
                                    <span><?php echo $row['lname']; ?></span>
                                </h3>
                            </div>
                            <label for="file-upload" class="custom-file-upload">
                                <span id="file-chosen" style="color: #8AA6A3">No file chosen</span>
                            </label>
                            <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="file-upload">
                        </div>
                    </div>
                    <div class="right_edit_rapper">
                        <div class="field input">
                            <label>Profile Name</label>
                            <input type="text" name="profilename" value="<?php echo $row['ProfileName']; ?>">
                        </div>
                        <div class="field input">
                            <label>Birth Date</label>
                            <input type="date" name="birthdate" value="<?php echo $row['BirthDate']; ?>">
                        </div>
                        <div class="field input">
                            <label>Phone Number</label>
                            <input type="text" name="phonenumber" value="<?php echo $row['PhoneNumber']; ?>">
                        </div>
                        <div class="name-details">
                            <div class="field input">
                                <label>First Name</label>
                                <input type="text" name="fname" value="<?php echo $row['fname']; ?>">
                            </div>
                            <div class="field input">
                                <label>Last Name</label>
                                <input type="text" name="lname" value="<?php echo $row['lname']; ?>">
                            </div>
                        </div>
                        <div class="change_pass">
                            <label> Change Password</label>
                            <i class="fa fa-chevron-down toggle-passwords" style="font-size:18px"></i>
                            <div class="passwords" style="display: none;">
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
                                    <i class="fas fa-eye"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="field button">
                            <input type="submit" name="submit" value="Save Changes">
                        </div>
                    </div>
                    
                </form>
            </section>
        </div>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script>
        // Toggle the visibility of passwords div
        document.addEventListener("DOMContentLoaded", function() {
            const togglePasswordsIcon = document.querySelector('.toggle-passwords');
            const passwordsDiv = document.querySelector('.passwords');

            togglePasswordsIcon.addEventListener('click', function() {
                if (passwordsDiv.style.display === "none" || passwordsDiv.style.display === "") {
                    passwordsDiv.style.display = "block";
                } else {
                    passwordsDiv.style.display = "none";
                }
            });
        });

        // Display alert message and remove it after 3 seconds
        window.onload = function() {
            const alertBox = document.querySelector('.alert');
            if(alertBox) {
                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 3000);
            }
        }
    </script>
    <script>
        document.getElementById('file-upload').addEventListener('change', function() {
            const fileChosen = document.getElementById('file-chosen');
            fileChosen.textContent = this.files[0].name;
        });
    </script>
</body>
</html>
