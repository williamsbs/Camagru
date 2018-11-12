<?php
include_once "header.php";
?>
<section class="main-container">
    <div id="wrapper">
        <form class="signup-form" method="POST" action="includes/signup.inc.php">
            <?php
            if(isset($_GET['first'])){
                $first = htmlspecialchars($_GET['first']);
                echo '<input type="text" name="first" placeholder="Firstname" value="'.$first.'"><br/>';
            }
            else{
                echo '<input type="text" name="first" placeholder="Firstname"><br/>';
            }
            if(isset($_GET['last'])){
                $last = htmlspecialchars($_GET['last']);
                echo '<input type="text" name="last" placeholder="Lastname" value="'.$last.'"><br/>';
            }
            else{
                echo '<input type="text" name="last" placeholder="Lastname"><br/>';
            }
            if(isset($_GET['email'])){
                $email = htmlspecialchars($_GET['email']);
                echo '<input type="text" name="email" placeholder="E-mail" value="'.$email.'"><br/>';
            }
            else{
                echo '<input type="text" name="email" placeholder="E-mail"><br/>';
            }
            if(isset($_GET['uid'])){
                $uid = htmlspecialchars($_GET['uid']);
                echo '<input type="text" name="uid" placeholder="Username" value="'.$uid.'"><br/>';
            }
            else{
                echo '<input type="text" name="uid" placeholder="Username"><br/>';
            }
            ?>
            <input type="password" name="pwd" placeholder="Password"><br/>
            <button type="submit" name="submit">Sign up</button>
        </form>
        <?php
        include_once "footer.php";
        ?>
        </div>
    <div class="msg">
    <?php
    if(!isset($_GET['signup']))
    {
        exit();
    }
    else{
        $signupCheck = htmlspecialchars($_GET['signup']);

        if($signupCheck == 'empty'){
            echo "<h1>You did not fill in all fields</h1>";
            exit();
        }
        else if($signupCheck == 'InvalidCharacter'){
            echo "<h1>Invalid character</h1>";
            exit();
        }
        else if($signupCheck == 'WrongPwdFormat'){
            echo "<h1>Your password must be at least 6 characters and contain one number, one letter and one capital letter</h1>";
            exit();
        }
        else if($signupCheck == 'InvalidEmail'){
            echo "<h1>Invalid Email</h1>";
            exit();
        }
        else if($signupCheck == 'InvalidPasseword'){
            echo "<h1>InvalidPassword</h1>";
            exit();
        }
        else if($signupCheck == 'UserTaken'){
            echo "<h1>Username or Email all ready taken</h1>";
            exit();
        }
        else if($signupCheck == 'logged_in'){
            echo "<h1>You are all ready logged in</h1>";
            exit();
        }
        else if($signupCheck == 'sucess'){
            echo "<h1>You have been signed up</h1>";
            exit();
        }
    }
    ?>
    </div>
</section>
