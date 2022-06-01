<?php
session_start();
function getCode()
{//生成随机字符串
    $str='';
    $charset='0123456789';//字典abcdefghijklmnopqrstuvwxyzQWERTYUPLKJHGFDSAZXCVBNM
    $len= strlen($charset)-1;
    for ($i=0;$i<5;$i++) {
        $str.=$charset[rand(0, $len)];
    }
    return $str;
}
function creatCap($code)
{
    $_SESSION['code']=$code;//将后台生成的随机验证码保存到session中
	$w=200;$h=80;
    $image=imagecreate(200, 80);
    imagecolorallocate($image, 255, 255, 255);//背景色
    $fontcolor= imagecolorallocate($image, rand(100, 255), rand(100, 255), rand(100, 255));//前景色
	for($i = 0;$i <strlen($code);$i++){
	   $x = 10 + $i * 40;
	   $y = mt_rand(4,rand($h/1.5,$h/4));
	   $color = imagecolorallocate($image,mt_rand(0,225),mt_rand(0,150),mt_rand(0,225));
	   imagechar($image,30,$x,$y,$code[$i],$color);}
   for ($i=0;$i<1000;$i++) {
        imagesetpixel($image, rand(1, 259), rand(1, 59), imagecolorallocate($image, rand(100, 255), rand(100, 255), rand(100, 255)));
    }
    for ($i=0;$i<10;$i++) {
        imageline($image, rand(1, 259), rand(1, 59), rand(1, 259), rand(1, 59), $fontcolor);
    }
   ob_clean();
    header('Content-type:image/png');	
    imagepng($image);
    imagedestroy($image);
}
//echo getCode();
creatCap(getCode());
