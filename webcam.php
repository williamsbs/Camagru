<?php
session_start();
include "includes/config/database.php";
include_once "header.php";
$title = $_SESSION['title'];
$description = $_SESSION['desc'];
$filtre = $_GET['filtre'];
$img = ($_POST['img']);
//-----------------------------------------------------REDIMENTION---------------------------------------------------------------------------------------------
if(!isset($_SESSION['u_id']))
{
  header("Location: index.php");
  exit();
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
clearstatcache();
$dir = "imagesTmp/";
if (is_dir_empty("imagesTmp/"))
{
    file_put_contents("imagesTmp/$title.png", NULL);
}
    echo '<aside style="display:none;height:500px;float:right">
        <img id="imagenew" src="imagesTmp/' . $title . '.png" style="width:80%" >
      </aside>';

function is_dir_empty($dir) {
  if (!is_readable($dir)) return NULL;
  return (count(scandir($dir)) == 2);
}
echo '
<video id="video"></video>
<canvas id="canvas" style="display:none;"></canvas>';
if(!empty($filtre))
{
echo '<button id="startbutton">Prendre une photo</button>';
}
else {
  echo '<div id="startbutton"></div>';
}
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

    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
  	    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
  	        video.srcObject = stream;
  	        video.play();
  	    });
  	}

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
                if (this.readyState == 4 && this.status == 200)
                {
                    document.getElementById('imagenew').src = xmlhttp.responseText;
                    document.getElementById('imagenew').parentElement.style.display= "inline";
                }
            }
            xmlhttp.open("POST", "webcamsave.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send("img=" + data + "&title=" + title + "&description=" + desc + "&filtre=" + filtre);
            // window.location.reload();
        }
    startbutton.addEventListener('click', function (ev) {
        takepicture();
        ev.preventDefault();
        // window.location.reload();
    }, false);
    })();
</script>

<?php
include_once "footer.php";
