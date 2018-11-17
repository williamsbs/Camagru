<?php
session_start();
include "includes/config/database.php";
include_once "header.php";
$title = $_SESSION['title'];
$description = $_SESSION['desc'];
$filtre = $_GET['filtre'];
$img =($_POST['img']);
//-----------------------------------------------------REDIMENTION---------------------------------------------------------------------------------------------

if (isset($_POST['img'])) {

    function resize_image($file, $w, $h, $crop = FALSE)
    {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefrompng($file);
        $dst = imagecreate($newwidth, $newheight);

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        return $dst;
    }
//-----------------------------------------------------CALQUE---------------------------------------------------------------------------------------------

    $source = resize_image("images/filtre/filtre$_POST[filtre].png", 300, 300);
    $largeur_source = imagesx($source);
    $hauteur_source = imagesy($source);
    imagealphablending($source, true);
    imagesavealpha($source, true);

    $img = $_POST['img'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $img = base64_decode($img);
    $destination = imagecreatefromstring($img);
    $largeur_destination = imagesx($destination);
    $hauteur_destination = imagesy($destination);

    $destination_x = ($largeur_destination - $largeur_source) / 2;
    $destination_y = ($hauteur_destination - $hauteur_source)/2;

    imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source, 300);
    imagecopy($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source);

    $name = $title.".png";
    imagepng($destination, "imagesTmp/$name");
    imagedestroy($source);
    imagedestroy($destination);
    header("Refresh:0; url=webcam.php");
}
//-----------------------------------------------------UPLOAD---------------------------------------------------------------------------------------------

if(isset($_POST['upload']))
{
  $file = "imagesTmp/".$title.".png";
  if(file_exists($file)) {
      $fileNew = "images/" . $title . ".png";
      rename($file, $fileNew);
      $date = date('d/m/Y');
      $sql = "SELECT * FROM uploaded_img WHERE title='$title';";
      $result = $connexion->query($sql);
      if ($result->rowCount() == 0) {
          $sqlInsert = "INSERT INTO uploaded_img (user_id, title, description, img_name, nb_likes, a_date) VALUES (?, ?, ?, ?, ?, ?);";
          $stmt = $connexion->prepare($sqlInsert);
          $stmt->execute(array($_SESSION['u_id'], $title, $description, $title . ".png", 0, $date));
      } else {
          $sqlUpdate = "UPDATE uploaded_img SET user_id =?, title =?, description =?, img_name =?, nb_likes =? WHERE uploaded_img.title = '$title';";
          $stmt = $connexion->prepare($sqlInsert);
          $stmt->execute(array($_SESSION['u_id'], $title, $description, $title . ".png", 0, $date));
      }
      header("Location: img_galery.php");
  }
}
//-----------------------------------------------------ANNULE---------------------------------------------------------------------------------------------
if(isset($_POST['annule']))
{
  $title;
  $sqlDel = "DELETE FROM uploaded_img WHERE title=?";
  $stmtDel = $connexion->prepare($sqlDel);
  $stmtDel->execute(array($title));
  $file = "imagesTmp/".$title.".png";
  unlink($file);
  header("Location: img_galery.php");
}
//-----------------------------------------------------FROM---------------------------------------------------------------------------------------------
echo '<div class="upload_img">
<form action="webcam.php" method="POST">
  <button type="submit" name="annule">Annuler</button>
</form>
</div>';

echo '<div class="upload_img">
<form action="webcam.php" method="POST">
  <button type="submit" name="upload">Upload</button>
</form>
</div>';
//-----------------------------------------------------FROM---------------------------------------------------------------------------------------------

echo '<aside id="" style="height:500px;float:right">
      <img src="imagesTmp/'.$title.'.png" style="width:80%" >
    </aside>';

echo '
<video id="video"></video>
<video id="video"></video>
<canvas id="canvas"></canvas>
<button id="startbutton">Prendre une photo</button>';
//-----------------------------------------------------FILTERS---------------------------------------------------------------------------------------------

?>
<div>
    <a href="webcam.php?filtre=chien"><img src="images/filtre/filtrechien.png" width="10%"></a>
    <a href="webcam.php?filtre=paille"><img src="images/filtre/filtrepaille.png"width="10%"></a>
    <a href="webcam.php?filtre=pizza"><img src="images/filtre/filtrepizza.png"width="10%"></a>
    <a href="webcam.php?filtre=paris"><img src="images/filtre/filtreparis.png"width="10%"></a>
</div>
<script type="text/javascript">
(function() {
    var title = "<?= $title ?>"
    var desc = "<?= $description ?>"
    var filtre = "<?= $filtre ?>"

    var streaming = false,
        video        = document.querySelector('#video'),
        cover        = document.querySelector('#cover'),
        canvas       = document.querySelector('#canvas'),
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

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                document.getElementById('canvas').innerHTML = xmlhttp.responseText;
            }
            xmlhttp.open("POST", "webcam.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send("img=" + data + "&title=" + title + "&description=" + desc + "&filtre=" + filtre);
            window.location.reload();
        }
    startbutton.addEventListener('click', function (ev) {
        takepicture();
        ev.preventDefault();
        window.location.reload();
    }, false);
    })();
</script>

<?php
include_once "footer.php";
