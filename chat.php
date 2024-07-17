<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
  header("location: index.php");
}
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
      <div class="chat_search">
        <div class="search">
          <input type="text" placeholder="Enter name to search..." />
          <a href="php/logout.php?logout_id=<?php echo $unique_id; ?>" class="logout" >Logout</a>
          <button><i class="fas fa-search"></i></button>
      </div>
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
            <a href="users.php"><i class='fas fa-user-friends' style='font-size:36px'></i></a>
          </div>
        </div>
      </header>
      <div class="chat-box">
      </div>
      <!-- <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type your message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form> -->
    <form action="#" class="typing-area" enctype="multipart/form-data">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type your message here..." autocomplete="off">
        <label for="file-upload" class="custom-file-upload"><i class="fa fa-paperclip" style="font-size:24px"></i></label>
        <input type="file" name="image" class="file-uploadd">
        <button><i class="fab fa-telegram-plane"></i></button>
    </form>

    </section>
  </div>

  <script src="javascript/themes.js"></script>
  <script src="javascript/users.js"></script>
  <script src="javascript/chat.js"></script>

</body>

</html>