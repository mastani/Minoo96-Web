<?php

class CaptchaSecurityImages {
    /* select the type of font, must be used in directoy in which script is being called into */
    var $font = 'BYekan.ttf';

    function generateCode($characters) {
        $possible = '23456789';
        $possible = $possible.$possible.'2345678923456789';
        $code = '';
        $i = 0;
        while ($i < $characters) {
            $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
            $i++;
        }
        return $code;
    }

    function CaptchaSecurityImages($width = 145,$height = 35, $characters = 6) {
        $code = $this->generateCode($characters);
        session_start();
        $_SESSION['captcha'] = $code;
        $font_size = $height * 0.60;
        $image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');

        /* set the colours */
        $bgR = mt_rand(0, 255); $bgG = mt_rand(0, 255); $bgB = mt_rand(0, 255);
        $background_color = imagecolorallocate($image, $bgR, $bgG, $bgB);
        $noise_color = imagecolorallocate($image, abs(100 - $bgR), abs(100 - $bgG), abs(100 - $bgB));
        $text_color = imagecolorallocate($image, abs(255 - $bgR), abs(255 - $bgG), abs(255 - $bgB));

        /* generate random dots in background */
        for($i = 0; $i < ($width*$height) / 3; $i++) {
            imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
        }

        /* generate random lines in background */
        for($i = 0; $i < ($width*$height) / 150; $i++) {
            imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
        }

        /* set random colors */
        $w = imagecolorallocate($image, abs(100 - $bgR), abs(100 - $bgG), abs(100 - $bgB));
        $r = imagecolorallocate($image, abs(100 - $bgR), abs(100 - $bgG), abs(100 - $bgB));

        /* Draw a dashed line, 5 red pixels, 5 white pixels */
        $style = array($r, $r, $r, $r, $r, $w, $w, $w, $w, $w);
        imagesetstyle($image, $style);
        imageline($image, 0, 0, $width, $height, IMG_COLOR_STYLED);
        imageline($image, $width, 0, 0, $height, IMG_COLOR_STYLED);

        /* create random polygon points */
        $values = array(
            mt_rand(0, $width), mt_rand(0, $height),
            mt_rand(0, $height), mt_rand(0, $width),
            mt_rand(0, $width), mt_rand(0, $height),
            mt_rand(0, $height), mt_rand(0, $width),
            mt_rand(0, $width), mt_rand(0, $height),
            mt_rand(0, $height), mt_rand(0, $width),
            mt_rand(0, $width), mt_rand(0, $height),
            mt_rand(0, $height), mt_rand(0, $width),
            mt_rand(0, $width), mt_rand(0, $height),
            mt_rand(0, $height), mt_rand(0, $width),
            mt_rand(0, $width), mt_rand(0, $height),
            mt_rand(0, $height), mt_rand(0, $width),);

        /* create Random Colors then set it to $clr */
        $r = abs(100 - mt_rand(0, 255));
        $g = abs(100 - mt_rand(0, 255));
        $b = abs(100 - mt_rand(0, 255));
        $clr = imagecolorallocate($image, $r, $g, $b);

        /* create filled polygon with random points */
        imagefilledpolygon($image, $values, 6, $clr);

        $textbox = imagettfbbox($font_size, 0, $this->font, $code) or die('Error in imagettfbbox function');
        $x = ($width - $textbox[4])/2;
        $y = ($height - $textbox[5])/2;
        imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code) or die('Error in imagettftext function');

        /* pretty it */
        imageantialias($image, 100);
        imagealphablending($image, 1);
        imagelayereffect($image, IMG_EFFECT_OVERLAY);

        /* output captcha image to browser */
        imagejpeg($image);
        imagedestroy($image);
    }
}

$captcha = new CaptchaSecurityImages(160, 35, rand(4, 5));

//$image = imagecreatefromjpeg($captcha);

//ob_start(); // Let's start output buffering.
//imagejpeg($image); //This will normally output the image, but because of ob_start(), it won't.
//$contents = ob_get_contents(); //Instead, output above is saved to $contents
//ob_end_clean(); //End the output buffer.

//$dataUri = "data:image/jpeg;base64," . base64_encode($contents);

//echo $dataUri;