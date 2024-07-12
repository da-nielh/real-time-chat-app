<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }

  $unique_id = $_SESSION['unique_id'];
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
    <iframe id="contentFrame" src="start.html"></iframe>
  </div>

  <script src="javascript/themes.js"></script>
  <script src="javascript/users.js"></script>
  <script src="javascript/iframe-nav.js"></script>
</body>
</html>
