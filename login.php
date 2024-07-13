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

    <!-- form section -->
    <div class="wrapper login_wrapper">
      <section class="form login">
        <div class="header login_header">
          <h1>Welcome Back !</h1>
          <p>Sign in to continue to Chat.</p>
        </div>
        <form
          action="#"
          method="POST"
          enctype="multipart/form-data"
          autocomplete="off"
        >
          <div class="error-text"></div>
          <div class="field input">
            <label>Email Address</label>
            <input
              type="text"
              name="email"
              placeholder="Enter your email"
              required
            />
          </div>
          <div class="field input">
            <label>Password</label>
            <input
              type="password"
              name="password"
              placeholder="Enter your password"
              required
            />
            <i class="fas fa-eye"></i>
          </div>
          <div class="field button">
            <input type="submit" name="submit" value="Log In" />
          </div>
        </form>
        <div class="link">
          Not yet signed up? <a href="index.php">Signup now</a>
        </div>
      </section>
    </div>

    <script src="javascript/themes.js"></script>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>
  </body>
</html>
