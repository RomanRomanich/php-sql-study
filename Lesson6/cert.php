<?php 
    
    session_start();
    if (empty($_SESSION['rightAnsvers']) || empty($_SESSION['maxAnsver']) || empty($_SESSION['humanName'])) {
        header('Location: test.php');
    }

    $im = imagecreatetruecolor(200, 200);

    $bg = imagecolorallocate($im, 200, 255, 200);
    $textColor = imagecolorallocate($im, 50, 50, 50);

    $fonts = __DIR__ . '/files/arial.ttf';
    $text = $_SESSION['rightAnsvers'].' из '.$_SESSION['maxAnsver'];

    imagefill($im, 0, 0, $bg);
    imagettftext($im, 20, 0, 50, 50, $textColor, $fonts, $_SESSION['humanName']);
    imagettftext($im, 10, 0, 20, 80, $textColor, $fonts, 'Правильных ответов');
    imagettftext($im, 20, 0, 50, 120, $textColor, $fonts, $text);

    header('Content-Type: image/png');
    imagepng($im);
    imagedestroy($im);

    session_destroy();

 ?>