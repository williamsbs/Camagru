<?php
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
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagealphablending($dst, false);
        $transp = imagecolorallocatealpha($dst, 0, 0, 0, 127);
        imagefilledrectangle($dst,0,0,imagesx($dst), imagesy($dst),$transp);
        imagealphablending($dst, true);
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

    //VERIFIER LE TITRE N'EST PAS MALICIEUX
    $name = $_POST["title"].".png";
    imagepng($destination, "imagesTmp/$name");
    echo "imagesTmp/$name";
    imagedestroy($source);
    imagedestroy($destination);
//    header("Refresh:0; url=webcam.php");
}