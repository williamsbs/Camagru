<?php
session_start();
include_once 'header.php';
include_once 'include/dbh.php';
?>
  <section class="main-container">
    <div class="main-wrapper">
      <?php
      if (!isset($_SESSION['u_id'])) {
        echo "<h2>Home</h2>";
        }
        else{
          echo "<h2>Welcome to your profile page";
        }
          if (isset($_SESSION['u_id'])) {
            echo "<h2>you are logged in</h2>";
          }
        ?>
    </div>
  </section>

  <form action="search.php" method="POST">
  <input type="text" name="search" placeholder="Search">
    <button type="submit" name="submit-search"></button>
  </form>
  <?php
include_once 'aside.php';
include_once 'footer.php';
?>
