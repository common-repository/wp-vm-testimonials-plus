<?php 
session_start();
$image_width = 120;
$image_height = 40;
$characters_on_image = 6;
$font = './monofont.ttf';
$possible_letters = '23456789bcdfghjkmnpqrstvwxyz';
$random_dots = 0;
$random_lines = 20;
$captcha_text_color="0x142864";
$captcha_noice_color = "0x142864";
$code = '';
$i = 0;
while ($i < $characters_on_image) { 
$code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
$i++;
}
$font_size = $image_height * 0.75;
$image = @imagecreate($image_width, $image_height);

$background_color = imagecolorallocate($image, 255, 255, 255);

$arr_text_color = hexrgb($captcha_text_color);
$text_color = imagecolorallocate($image, $arr_text_color['red'], 
		$arr_text_color['green'], $arr_text_color['blue']);

$arr_noice_color = hexrgb($captcha_noice_color);
$image_noise_color = imagecolorallocate($image, $arr_noice_color['red'], 
		$arr_noice_color['green'], $arr_noice_color['blue']);

for( $i=0; $i<$random_dots; $i++ ) {
imagefilledellipse($image, mt_rand(0,$image_width),
 mt_rand(0,$image_height), 2, 3, $image_noise_color);
}

for( $i=0; $i<$random_lines; $i++ ) {
imageline($image, mt_rand(0,$image_width), mt_rand(0,$image_height),
 mt_rand(0,$image_width), mt_rand(0,$image_height), $image_noise_color);
}


$textbox = imagettfbbox($font_size, 0, $font, $code); 
$x = ($image_width - $textbox[4])/2;
$y = ($image_height - $textbox[5])/2;
imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code);


header('Content-Type: image/jpeg');
imagejpeg($image);
imagedestroy($image);
$_SESSION['vm-session'] = $code;

function hexrgb ($hexstr)
{  $int = hexdec($hexstr);
  return array("red" => 0xFF & ($int >> 0x10),
               "green" => 0xFF & ($int >> 0x8),
               "blue" => 0xFF & $int);}
?>