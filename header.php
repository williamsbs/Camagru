<?php
session_start();
include_once 'include/dbh.php';

 ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <nav>
    <ul>
      <li class='user-container'>  <?php
      $id = $_SESSION['id'];
      $sql = "SELECT * FROM users WHERE user_id='$id'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      if ($resultCheck > 0)
      {
        while ($row = mysqli_fetch_assoc($result))
        {
          $uid = $row['user_uid'];
          $sql_img = "SELECT * FROM profil_img WHERE userid='$id'";
          $result_img = mysqli_query($conn, $sql_img);
           while ($row_img = mysqli_fetch_assoc($result_img))
          {
            echo "<div class='user-container'>";
              if ($row_img['status'] == 0) {
                $fileName = "uploads/".$uid."*";
                $fileInfo = glob($fileName);
                $fileExt = explode(".", $fileInfo[0]);
                $fileActualExt = $fileExt[1];
                echo "<img src='uploads/".$uid.".".$fileActualExt."?".mt_rand()."'>";
              }
              else {
                echo "<img src='uploads/default.jpeg'>";
              }
              echo "<div class='profil-info'>";
                echo "<p>".$row['user_uid']."</br>";
                echo $row['user_first']." ".$row['user_last']."</p>";
              echo "</div>";
            echo "</div>";
            clearstatcache();
          }

        }
      }
      else {
        echo "<h2>Please Sign in</h2>";
      } ?></li></ul>
      <div class="main-wrapper">
          <ul>
            <li id="menu"><a href="index.php">Home</a></li>
          </ul>
          <div class="nav-login">
            <?php
              if (isset($_SESSION['u_id'])) {
                echo '<form action="include/logout.inc.php" method="POST">
                  <button type="submit" name="submit">Logout</button>
                </form>';
              }
              else {
                echo '<form action="include/login.inc.php" method="POST">
                    <input type="text" name="uid" placeholder="Username/email">
                    <input type="password" name="pwd" placeholder="Password">
                    <button type="submit" name="submit">Login</button>
                  </form>
                  <a href="signup.php">Sign up</a>';
              }
             ?>
          </div>
      </div>
    </nav>
  </header>
