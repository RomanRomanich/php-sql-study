<?php 
    session_start();

    $im = imagecreatetruecolor(300, 200);

    $bg = imagecolorallocate($im, rand(1, 255), rand(1, 255), 200);
    $textColor = imagecolorallocate($im, rand(1, 255), 50, rand(1, 255));

    $fonts = __DIR__ . '/files/arial.ttf';
    $a = rand(1, 50);
    $b = rand(1, 50);
    $_SESSION['expression'] = $a + $b;

    imagefill($im, 0, 0, $bg);
    imagettftext($im, rand(25, 45), rand(0, 45), 50, 110, $textColor, $fonts, $a);
    imagettftext($im, 30, 0, 120, 110, $textColor, $fonts, ' + ');
    imagettftext($im, rand(25, 45), rand(0, 45), 200, 110, $textColor, $fonts, $b);

    header('Content-Type: image/png');
    imagepng($im);
    imagedestroy($im);
    #$_SESSION['expression'] = $b;

    #session_destroy();
?>