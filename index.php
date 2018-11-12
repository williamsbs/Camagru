<?php
session_start();
include_once "includes/dbh.inc.php";
include_once "header.php";
?>
    <div class="msg">
    <?php
    if(isset($_GET['login']))
    {
        $loginCheck = htmlspecialchars($_GET['login']);

        if ($loginCheck == 'Notactif') {
            echo "<h1>Your account as no been activated</h1>";
        } else if ($loginCheck == 'forgot') {
            echo "<a href='forgot_password.php'><h1>forgot your password?</h1></a>";
        }else if ($loginCheck == 'envoyer') {
            echo "<h1>An Email as been sent to reset you password</h1>";
        }
    }
?>
<form action="img_galery.php" method="GET">
    <button class="nav-login" type="submit" name="Uplaod">Upload image</button>
</form>
<div id="wrapper">
    <header id="header"?>
        <div id="header">
            <span class="avatar">
                <?php
                    $sql = "SELECT * FROM users;";
                    $result = $connexion->query($sql);
                    while($row = $result->fetch(PDO::FETCH_ASSOC))
                    {
                        $id = $row['user_id'];
                        $sqlImg = "SELECT * FROM profil_img WHERE userid='$id';";
                        $resultImg = $connexion->query($sqlImg);
                        while($rowImg = $resultImg->fetch(PDO::FETCH_ASSOC))
                        {
                            if($rowImg['userid'] == $_SESSION['id'])
                                {
                                    if ($rowImg['status'] == 0)
                                    {
                                        echo "<a href='upload_profil_Img.php'><img src='images/profil" . $id . ".jpg'></a>";
                                    }
                                    else
                                    {
                                        echo "<a href='upload_profil_Img.php'><img src='images/default.jpg'></a>";
                                    }
                                }
                        }
                    }
                if(!isset($_SESSION['u_id']))
                    echo "<a href='upload_profil_Img.php'><img src='images/thumbs/04.jpg'></a>";
                    ?>
            </span>
            <?php if(isset($_SESSION['u_id'])){?>
            <h1><strong>Bonjour <?php echo $_SESSION['u_id'];?></strong></h1>
            <?php } ?>
            <h1>Bienvenue sur Camagru, tu peux poster des photos de ce que tu aimes ou <strong>Encore</strong> mieux,
                tu peux te prendre en photo avec la fonctionnalité <strong>Webcam</strong>.</h1>

            <ul class="icons">
                <li><a href="https://twitter.com/lepenjm" class="icon style2 fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="https://www.facebook.com/JMLP.officiel/" class="icon style2 fa-facebook"><span class="label">Facebook</span></a></li>
                <li><a href="https://www.instagram.com/jeanmarielepenofficiel/?hl=fr" class="icon style2 fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="http://www.jeanmarielepen.com/p/contact.html" class="icon style2 fa-envelope-o"><span class="label">Email</span></a></li>
            </ul>
        </div>
    </header>
<section id="main">
    <?php
    $imgParPages = 5;
    $imageTotalesReq = $connexion->query("SELECT * FROM uploaded_img");
    $imageTotales = $imageTotalesReq->rowCount();
    $pageTotales = ceil($imageTotales/$imgParPages); // arrondie au nombre superieur pour pas avoir un nombre a virgule
    if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0)
    {
        $_GET['page'] = intval($_GET['page']);// si on met une phrase ca remplace par un 0
        $pageCourante = $_GET['page'];
    }else{
        $pageCourante = 1;
    }
    $depart = ($pageCourante - 1)*$imgParPages;
    $sql = "SELECT * FROM uploaded_img LIMIT $depart,$imgParPages";
    $result = $connexion->query($sql);

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<section class='thumbnails'>
        <div class='image_commentaire'>
            <a href='image_commentaire.php?image=" . $row[img_name]. "'>
                <img  src='images/" . $row[img_name]. "' />
                publier par: <strong>$row[user_id]</strong>
                <h3>$row[description]</h3>
                Likes: $row[nb_likes]
            </a>
        </div>
    </section>
    ";
    }
    ?>
    <!-- Thumbnails -->
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

</section>
<!--<section class="main-container">-->
<!--    <div class="main-wrapper">-->
<!--        --><?php
//            if (!isset($_SESSION['u_id'])) {
//                echo "<h2>Home</h2>";
//            }
//            else{
//                echo "<h2>Welcome to your profile page";
//            }
//            if (isset($_SESSION['u_id'])) {
//                echo "<h2>you are logged in</h2>";
//            }
//        ?>
    </div>
<!--</section>-->
<?php
echo "<div class='page'>";
for($i = 1; $i <=$pageTotales; $i++)
{
    if($i == $pageCourante)
    {
        echo "<a href='#' style='border: 1px solid white; padding: 2px'>$i </a>";
//        border: 1px solid white;
    }
    else{
        echo "<a href='index.php?page=$i' class='page1'>. $i .</a>";

    }
}
echo "</div>";
include_once "footer.php";
?>

