<?php
session_start();

$image = imagecreatetruecolor(120, 40);

$bg_color = imagecolorallocate($image, 255, 255, 255);
imagefilledrectangle($image, 0, 0, 120, 40, $bg_color);

// Set random lines.
for ($i = 0; $i < 10; $i++) {
    $line_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $line_color);
}

// Set random dots.
for ($i = 0; $i < 100; $i++) {
    $dot_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    imagesetpixel($image, rand(0, 120), rand(0, 40), $dot_color);
}

// Generate random text
$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$length = 6;
$captcha = '';
for ($i = 0; $i < $length; $i++) {
    $captcha .= $chars[rand(0, strlen($chars) - 1)];
}

$_SESSION['captcha'] = $captcha;

$text_color = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 5, 20, 10, $captcha, $text_color);

header('Content-Type: image/png');

imagepng($image);

imagedestroy($image);
?>
