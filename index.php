<?php
session_start();
include_once "includes/dbh.inc.php";
//include_once "header.php";
//?>
<!--<div id="wrapper">-->
<!--    <header id="header"?>-->
<!--        <div id="header">-->
<!--            <span class="avatar">-->
<!--                --><?php

//                    $sql = "SELECT * FROM users;";
//                    $result = mysqli_query($connexion, $sql);
//                    if(mysqli_num_rows($result) > 0)
//                    {
//                        while($row = mysqli_fetch_assoc($result))
//                        {
//                            $id = $row['user_id'];
//                            $sqlImg = "SELECT * FROM profil_img WHERE userid='$id';";
//                            $resultImg = mysqli_query($connexion, $sqlImg);
//                            while($rowImg = mysqli_fetch_assoc($resultImg))
//                            {
//                                if($rowImg['userid'] == $_SESSION['id'])
//                                {
//                                    if ($rowImg['status'] == 0)
//                                    {
//                                        echo "<a href='upload_Img.php'><img src='images/profil" . $id . ".jpg'></a>";
//                                    }
//                                    else
//                                    {
//                                        echo "<a href='upload_Img.php'><img src='images/default.jpg'></a>";
//                                    }
//                                }
//                            }
//                        }
//                        if(!isset($_SESSION['u_id']))
//                            echo "<a href='upload_Img.php'><img src='images/thumbs/04.jpg'></a>";
//
//                    }?>
<!--            </span>-->
<!--            --><?php //if(isset($_SESSION['u_id'])){?>
<!--            <h1><strong>Bonjour --><?php //echo $_SESSION['u_id'];?><!--</strong></h1>-->
<!--            --><?php //} ?>
<!--            <h1>Bienvenue sur Camagru, tu peux poster des photos de ce que tu aimes ou <strong>Encore</strong> mieux,-->
<!--                tu peux te prendre en photo avec la fonctionnalité <strong>Webcam</strong>.</h1>-->
<!---->
<!--            <ul class="icons">-->
<!--                <li><a href="https://twitter.com/lepenjm" class="icon style2 fa-twitter"><span class="label">Twitter</span></a></li>-->
<!--                <li><a href="https://www.facebook.com/JMLP.officiel/" class="icon style2 fa-facebook"><span class="label">Facebook</span></a></li>-->
<!--                <li><a href="https://www.instagram.com/jeanmarielepenofficiel/?hl=fr" class="icon style2 fa-instagram"><span class="label">Instagram</span></a></li>-->
<!--                <li><a href="http://www.jeanmarielepen.com/p/contact.html" class="icon style2 fa-envelope-o"><span class="label">Email</span></a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </header>-->
<!--<section id="main">-->
<!---->
<!--    <!-- Thumbnails -->-->
<!--    <section class="thumbnails">-->
<!--        <div>-->
<!--            <a href="image_commentaire.php?image=plage.jpg">-->
<!--                <img src="images/plage.jpg" alt="" />-->
<!--                <h3>Lorem ipsum dolor sit amet</h3>-->
<!--            </a>-->
<!--            <a href="image_commentaire.php?image=amesterdam.jpg">-->
<!--                <img src="images/amesterdam.jpg" alt="" />-->
<!--                <h3>Lorem ipsum dolor sit amet</h3>-->
<!--            </a>-->
<!--        </div>-->
<!--        <div>-->
<!--            <a href="images/fulls/03.jpg">-->
<!--                <img src="images/thumbs/03.jpg" alt="" />-->
<!--                <h3>Lorem ipsum dolor sit amet</h3>-->
<!--            </a>-->
<!--            <a href="images/sunset.jpg">-->
<!--                <img src="images/sunset.jpg" alt="" />-->
<!--                <h3>Lorem ipsum dolor sit amet</h3>-->
<!--            </a>-->
<!--            <a href="images/facebook.jpg">-->
<!--                <img src="images/facebook.jpg" alt="" />-->
<!--                <h3>Lorem ipsum dolor sit amet</h3>-->
<!--            </a>-->
<!--        </div>-->
<!--        <div>-->
<!--            <a href="images/notredame.jpg">-->
<!--                <img src="images/notredame.jpg" alt="" />-->
<!--                <h3>Lorem ipsum dolor sit amet</h3>-->
<!--            </a>-->
<!--            <a href="images/fulls/07.jpg">-->
<!--                <img src="images/fulls/07.jpg" alt=""/>-->
<!--                <h3>Lorem ipsum dolor sit amet</h3>-->
<!--            </a>-->
<!---->
<!--        </div>-->
<!--    </section>-->
<!---->
<!--</section>-->
<!--<!--<section class="main-container">-->-->
<!--<!--    <div class="main-wrapper">-->-->
<!--<!--        -->--><?php
////            if (!isset($_SESSION['u_id'])) {
////                echo "<h2>Home</h2>";
////            }
////            else{
////                echo "<h2>Welcome to your profile page";
////            }
////            if (isset($_SESSION['u_id'])) {
////                echo "<h2>you are logged in</h2>";
////            }
////        ?>
<!--<!--    </div>-->-->
<!--<!--</section>-->-->
<!---->
<?php
//include_once "footer.php";
//?>
<!---->
