<?php

namespace App\libs\captcha;

class Captcha
{
    public static function create()
    {
        $image = imagecreatetruecolor(100, 40) OR die('cannot create canvas.<br>');

        $red = imagecolorallocate($image, 255, 0, 0);
        $green = imagecolorallocate($image, 0, 255, 0);
        $blue = imagecolorallocate($image, 0, 0, 255);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefill($image, 0, 0, $white);

        imagerectangle($image, 1, 1, 99, 39, $black);

        $color = [$red, $green, $blue];
        for ($i = 1; $i <= 100; $i++) {
            imagesetpixel($image, mt_rand(2, 98), mt_rand(2, 38), $color[mt_rand(0, 2)]);
        }

        $source = "abcdefghigklmnopqrstuvwxyz0123456789ABCDEFGHIGKLMNOPQRSTUVWXYZ";

        $first = $source[mt_rand(0, 61)];
        $second = $source[mt_rand(0, 61)];
        $third = $source[mt_rand(0, 61)];
        $fourth = $source[mt_rand(0, 61)];

        $_SESSION['captcha'] = $first.$second.$third.$fourth;


        $font = dirname(dirname(__DIR__)) . '/../public/assets/fonts/SpicyRice.ttf';


        imagettftext($image, 20, mt_rand(-20, 20), 10, 30, $blue, $font, $first);
        imagettftext($image, 20, mt_rand(-20, 20), 30, 30, $blue, $font, $second);
        imagettftext($image, 20, mt_rand(-20, 20), 50, 30, $blue, $font, $third);
        imagettftext($image, 20, mt_rand(-20, 20), 70, 30, $blue, $font, $fourth);

        return imagejpeg($image);
    }
}
