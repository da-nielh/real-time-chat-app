<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
    <!-- Preloader -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="preloader__content text-center">
                    <div class="preloader__logo chat_logo">
                        <img src="./chatapp.png" alt="app logo" />
                        <h1>Chat</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- logo section -->
    <div class="logo">
      <img src="./chatapp.png" alt="app logo" />
      <h1>Chat</h1>
    </div>
    <div class="wrapper">
      <section class="form signup">
        <div class="header">
          <h1>Register Account</h1>
          <p>Get free chat account now.</p>
        </div>

        <form
          action="#"
          method="POST"
          enctype="multipart/form-data"
          autocomplete="off"
        >
          <div class="error-text"></div>
          <div class="field input">
            <label>Profile Name</label>
            <input type="text" name="profilename" placeholder="Profile Name" required />
          </div>
          <div class="field input">
            <label>Birth Date</label>
            <input type="date" name="birthdate" required />
          </div>
          <div class="field input">
            <label>Phone Number</label>
            <input type="text" name="phonenumber" placeholder="Phone Number" required />
          </div>
          <div class="name-details">
            <div class="field input">
              <label>First Name</label>
              <input type="text" name="fname" placeholder="First name" required />
            </div>
            <div class="field input">
              <label>Last Name</label>
              <input type="text" name="lname" placeholder="Last name" required />
            </div>
          </div>
          <div class="field input">
            <label>Email Address</label>
            <input type="text" name="email" placeholder="Enter your email" required />
          </div>
          <div class="field input">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter new password" required />
            <i class="fas fa-eye"></i>
          </div>
          <div class="field input">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Confirm your password" required />
            <i class="fas fa-eye"></i>
          </div>
          <div class="field image">
            <label>Select Image</label>
            <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required />
          </div>
          <div class="field button">
            <input type="submit" name="submit" value="Sign up" />
          </div>
        </form>
        <div class="link">
          Already signed up? <a href="login.php">Login now</a>
        </div>
      </section>
    </div>

    <script src="javascript/themes.js"></script>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>

  </body>
</html>
