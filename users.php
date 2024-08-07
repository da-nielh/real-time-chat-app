<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: index.php");
  }

  $unique_id = $_SESSION['unique_id'];
  
  // Fetch the current user's details
  $sql = mysqli_query($conn, "SELECT ProfileName FROM users WHERE unique_id = '{$unique_id}'");
  $row = mysqli_fetch_assoc($sql);
  $user_name = $row['ProfileName'];
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
  <div class="logo user_logo">
    <img src="./chatapp.png" alt="app logo" />
  </div>

  <!-- user section -->
  <div class="wrapperr user-wrapper">
    <section class="users">
      <header>
        <h1>Chat</h1>
        <a href="edit_profile.php" class="settings-icon"><i class="fas fa-cog"></i></a>
      </header>
      <div class="welcome-message">
        <h3>Welcome: <?php echo $user_name; ?></h3>
      </div>
      <div class="search">
          <input type="text" placeholder="Enter name to search..." />
          <a href="php/logout.php?logout_id=<?php echo $unique_id; ?>" class="logout">Logout</a>
          <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
      </div>
    </section>
  </div>

  <!-- chat iframe section -->
  <div class="iframe-container">
    <iframe id="contentFrame" src="chat_preloader.php"></iframe>
  </div>

  <script src="javascript/themes.js"></script>
  <script src="javascript/users.js"></script>
  <script src="javascript/iframe-nav.js"></script>
</body>
</html>
