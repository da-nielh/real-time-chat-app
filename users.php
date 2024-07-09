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
        <ul>
          <li><a href="#" data-url="https://www.example.com">chat</a></li>
        </ul>
      </div>
    </section>
  </div>

  <!-- chat iframe section -->
  <div class="iframe-container">
    <iframe id="contentFrame" src="start.html"></iframe>
  </div>

  <script src="javascript/users.js"></script>
  <script src="javascript/iframe-nav.js"></script>
</body>
</html>
