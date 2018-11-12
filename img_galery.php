<?php
session_start();
include "includes/dbh.inc.php";
include_once "header.php";

//$sql = "SELECT * FROM uploaded_img WHERE user_id ='$_SESSION[u_id]'";
//$result = $connexion->query($sql);
//if($result->rowCount() > 0)
//{
//    echo "<div style = 'display:'>";
//    while($row = $result->fetch(PDO::FETCH_ASSOC))
//    {
//        echo "<section class='up_upload_img' style= 'width: 250px;'>
//                <a href='image_commentaire.php?image=". $row[img_name] ."'>
//                 <img src='images/". $row[img_name] ." '>
//                  <h3 style='text-decoration: underline'>$row[title]:</h3>
//                  $row[description]
//                  <br>
//                  $row[nb_likes]
//                </a>
//              </section>";
//    }
//    echo "</div>";
//
//}
//echo "<div id='upload_box' style=' display: inline-block; width: 100%'>";
//echo"<div class='up_upload'>";
//if(isset($_SESSION['u_id']))
//{
//    echo '<form action="upload_details.php" method="POST">
//             <button type="submit" name="submit">New image</button>
//           </form>';
//
//    echo "<div class='up_delete'>";
//    echo '<form action="includes/delete_img.inc.php" method="POST">
//            <input type="text" name="delete" placeholder="Type in image name">
//            <button type="submit" name="submit">Delete image</button>
//          </form>';
//    echo "</div>";
//}
//else
//    echo '<div id="header"><h1>You must be logged in to upload images</h1></div>';
//
//echo "</div>";
//echo "</div>";
//?>
<!--<div class="msg">-->
<!--    --><?php
//    if(!isset($_GET['galery']))
//    {
////        exit();
//    }
//    else {
//        $DELCheck = $_GET['galery'];
//
//        if ($DELCheck == 'error') {
//            echo "<h1>You did not fill in Delete fields</h1>";
//            exit();
//        }
//    }
$img = $_POST['img'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$img = base64_decode($img);
//$im = imagecreatefromstring($img);

//header ("Content-type: image/png");

// Traitement de l'image source
function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefrompng($file);
    $dst = imagecreate($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}
$source= resize_image("images/filtre2.png", 300, 300);
// $source = imagecreatefrompng("images/filtre2.png");
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
imagealphablending($source, true);
imagesavealpha($source, true);

//// Traitement de l'image destination
$destination = imagecreatefromstring($img);
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);

//// Calcul des coordonnées pour placer l'image source dans l'image de destination
$destination_x = ($largeur_destination - $largeur_source)/2;
$destination_y =  ($hauteur_destination - $hauteur_source)-250;
////
//// On place l'image source dans l'image de destination
imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source, 300);
imagecopy($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source);
//
//// On affiche l'image de destination
imagepng($destination, "images/new.png");
//print_r($destination);
imagedestroy($source);
imagedestroy($destination);

?>
    <video id="video"></video>
    <button id="startbutton">Prendre une photo</button>
    <canvas id="canvas"></canvas>
<img id="photo" src="images/avatar.jpg">
    <script type="text/javascript">
        var streaming = false,
            video        = document.querySelector('#video'),
            cover        = document.querySelector('#cover'),
            canvas       = document.querySelector('#canvas'),
            photo        = document.querySelector('#photo'),
            startbutton  = document.querySelector('#startbutton'),
            width = 500,
            height = 0;

        navigator.getMedia = ( navigator.getUserMedia ||
            navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia ||
            navigator.msGetUserMedia);

        navigator.getMedia(
            {
                video: true,
                audio: false
            },
            function(stream) {
                if (navigator.mozGetUserMedia) {
                    video.mozSrcObject = stream;
                } else {
                    var vendorURL = window.URL || window.webkitURL;
                    video.src = vendorURL.createObjectURL(stream);
                }
                video.play();
            },
            function(err) {
                console.log("An error occured! " + err);
            }
        );

        video.addEventListener('canplay', function(ev){
            if (!streaming) {
                height = video.videoHeight / (video.videoWidth/width);
                video.setAttribute('width', width);
                video.setAttribute('height', height);
                canvas.setAttribute('width', width);
                canvas.setAttribute('height', height);
                streaming = true;
            }
        }, false);
        function takepicture() {
            canvas.width = width;
            canvas.height = height;
            canvas.getContext('2d').drawImage(video, 0, 0, width, height);
            var data = canvas.toDataURL('image/png');
            photo.setAttribute('src', data);

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                //     if (xmlhttp.readyState == XMLHttpRequest.DONE) {
                //         if (xmlhttp.status == 200) {
                document.getElementById('canvas').innerHTML = xmlhttp.responseText;
            }
            xmlhttp.open("POST", "img_galery.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send("img="+data);
        }

        startbutton.addEventListener('click', function(ev){
            takepicture();
            ev.preventDefault();
        }, false);
    </script>
<?php

include_once "footer.php";
?>
