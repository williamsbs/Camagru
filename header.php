<?php
session_start();
?>
<!DOCTYPE html>

<html>
<head>
    <title>Camagru</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>

<nav>
    <div class="main-wrapper">
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
        </ul>
    </div>
        <div class="nav-login">
                <ul class="search">
                    <li><a href="search.php" class="icon style3 fa-search" "><span class="label">Search</span></a></li>
                </ul>
            <?php
            if(isset($_SESSION['u_id']))
            {
                echo '<form action="includes/logout.inc.php" method="POST">
                                         <button type="submit" name="submit">Logout</button>
                                    </form>';
                echo '<form action="Compte.php" method="POST">
                                         <button class="nav-login" type="submit" name="Modif">Compte</button>
                                    </form>';


            }
            else
            {
                echo '<form method="POST" action="includes/login.inc.php">
                                        <input type="text" name="uid" placeholder="Username/Email">
                                        <input type="password" name="pwd" placeholder="Password">
                                        <button type="submit" name="submit">Login</button>
                                     </form>
                                    <a href="signup.php" class="signup_text">Sign up</a>';
            }
            ?>
        </div>
</nav>

<!--<html>-->
<!--<head>-->
<!--    <title></title>-->
<!--    <link rel="stylesheet" type="text/css" href="style.css">-->
<!--</head>-->
<!--<body>-->
<!--<header>-->
<!--    <nav>-->
<!--        <div class="main-wrapper">-->
<!--            <ul>-->
<!--                <li>-->
<!--                    <a href="index.php">Home</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <div class="nav-login">-->
<!--                --><?php
//                if(isset($_SESSION['u_id']))
//                {
//                    echo '<form action="includes/logout.inc.php" method="POST">
//                             <button type="submit" name="submit">Logout</button>
//                        </form>';
//                }
//                else
//                {
//                    echo '<form method="POST" action="includes/login.inc.php">
//                            <input type="text" name="uid" placeholder="Username/Email">
//                            <input type="password" name="pwd" placeholder="Password">
//                            <button type="submit" name="submit">Login</button>
//                         </form>
//                        <a href="signup.php">Sign up</a>';
//                }
//                ?>
<!--            </div>-->
<!--        </div>-->
<!--    </nav>-->
<!--</header>-->