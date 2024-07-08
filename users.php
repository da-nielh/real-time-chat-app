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
  <!-- logo section -->
  <div class="logo user_logo">
    <img src="./chatapp.png" alt="app logo" />
  </div>

  <!-- user section -->
  <div class="wrapperr user-wrapper">
    <section class="users">
      <header>
        <h1>Chat</h1>
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
  <div class="chat_content">
    <div class="chat_info">
      <div class="circle">
        <img src="./chatapp.png" alt="applogo" />
      </div>
      <h3>Welcome to Doot Chat App</h3>
      <p>
        Lorem ipsum dolor sit amet,consectetuer adipiscing elit. Aenean
        commodo ligula eget dolor. cum sociisnatoque penatibus et
      </p>
      <div class="start_button">
        <button>Get Start</button>
      </div>
    </div>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
