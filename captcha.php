<?php
	session_start();
	if(isset($_SESSION['my_captcha']))
	{
		unset($_SESSION['my_captcha']);
	}
	
	$string1="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ";
	$string2="1234567890";
	$string=$string1.$string2;
	$string= str_shuffle($string);
	$random_text= substr($string,0,8);
	$_SESSION['my_captcha']=$random_text;
	$my_img = imagecreate( 200, 80 );
	$background = imagecolorallocate( $my_img, 0, 0, 0 );
	$text_colour = imagecolorallocate( $my_img, 255, 255, 0 );
	$line_colour = imagecolorallocate( $my_img, 255, 255, 255 );
	imagettftext($my_img, 30, 0, 12, 45, $text_colour, 'CorsivaMTStd.otf', $random_text);
	for($i=0;$i<20;$i++){
		imageline($my_img, rand(1,200), rand(1,80), rand(1,200), rand(1,80), $line_colour);
	}
	imagesetthickness ( $my_img, 5 );
	header( "Content-type: image/png" );
	imagepng( $my_img );
	imagedestroy( $my_img );
?>

