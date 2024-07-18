<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
  header("location: index.php");
  exit;
}

  $unique_id = $_SESSION['unique_id'];
  
  // Fetch the current user's details
  $sql = mysqli_query($conn, "SELECT ProfileName FROM users WHERE unique_id = '{$unique_id}'");
  $row = mysqli_fetch_assoc($sql);
  $user_name = $row['ProfileName'];
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

  <!-- Chat section -->
  <div class="chating">
    <section class="chat-area">
      <header>
        <?php
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
          header("location: users.php");
          exit;
        }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="header">
          <div class="details">
            <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
          <div class="right_header">
            <a href="#" id="dropdownToggle"><i class="fas fa-ellipsis-h" style="font-size:24px"></i></a>
            <div id="dropdownMenu" class="dropdown-menu">
              <a href="#" class="delete-option">Delete all Chat</a>
            </div>
          </div>
        </div>
      </header>
      <div class="chat-box">
      </div>
      <form action="php/insert-chat.php" method="POST" class="typing-area" enctype="multipart/form-data">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type your message here..." autocomplete="off">
        <label for="file-upload" class="custom-file-upload"><i class="fa fa-paperclip" style="font-size:24px"></i></label>
        <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" class="file-input" id="file-upload">
        <button type="submit"><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/themes.js"></script>
  <script src="javascript/users.js"></script>
  <script src="javascript/chat.js"></script>
  
</body>

</html>
