<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/8/29
 * Time: 15:20
 */



header("Content-type: image/PNG");

$im = imagecreate(70,30);

//$bgcolor = imagecolorallocate($im,0,0,0);
$bgcolor = imagecolorallocate($im,rand(0,99),rand(0,99),rand(0,99));

imagefill($im,0,0,$bgcolor);

$string = array(
    2,3,4,5,6,7,8,9,
    'A','B','C','D','E','F','G','H','J','K',
    'M','N','P','R','S','T','U','V','W','X',
    'Y','Z'
);


$vdcode = '';
for($i= 0; $i<4;$i++){
    $rand = $string[rand(0,count($string) -1)];
    $vdcode.= $rand;
    $fontColor = imagecolorallocate($im,rand(100,255),rand(100,255),rand(100,255));
    imagestring($im,5,10+$i*10,rand(3,10),$rand,$fontColor);
}

$_SESSION['vdcode'] = strtolower($vdcode);


imagepng($im);

imagedestroy($im);









