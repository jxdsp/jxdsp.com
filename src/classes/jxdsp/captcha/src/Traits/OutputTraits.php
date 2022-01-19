<?php

namespace jxdsp\Captcha\Traits;

trait OutputTraits
{
    public function outputImageJpeg($quality = 90)
    {
        imagejpeg($this->contents, null, $quality);
    }

    public function outputImagePng($quality = 8, $filters = -1)
    {
        imagepng($this->contents, null, $quality, $filters);
    }

    public function outputImageWebp($quality = 90)
    {
        imagewebp($this->contents, null, $quality);
    }

    public function outputImageGif($file = null)
    {
        imagegif($this->contents, $file);
    }

}
