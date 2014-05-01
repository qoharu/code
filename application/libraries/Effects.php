<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Effects{
    private $image;

public function add_effect($image, $filter = NULL){
$this->image = $image;

switch( $filter ){
case 'colorise' : $this->makeColorise(); break;
case 'sepia'    : $this->makeSepia(); break;
case 'sharpen'  : $this->makeSharpen(); break;
case 'emboss'   : $this->makeEmboss(); break;
case 'cool'     : $this->makeCool(); break;
case 'old'      : $this->makeOld(); break;
case 'light'    : $this->makeLight(); break;
case 'aqua'    	: $this->makeAqua(); break;
case 'fuzzy'    : $this->makeFuzzy(); break;
case 'boost'    : $this->makeBoost(); break;
case 'gray'     : $this->makeGray(); break;

}
}

protected function makeColorise()
{
    $dest = imagecreatefromjpeg(dirname(__FILE__) . "/files/pattern5.jpg");

    $x = imagesx($this->image);
    $y = imagesy($this->image);

    $x2 = imagesx($dest);
    $y2 = imagesy($dest);

    $thumb = imagecreatetruecolor($x, $y);
    imagecopyresized($thumb, $dest, 0, 0, 0, 0, $x, $y, $x2, $y2);

    imagecopymerge($this->image, $thumb, 0, 0, 0, 0, $x, $y, 40);
    imagefilter($this->image, IMG_FILTER_CONTRAST, -25);

}

protected function makeSepia()
{
    imagefilter($this->image, IMG_FILTER_GRAYSCALE);
    imagefilter($this->image, IMG_FILTER_COLORIZE, 100, 50, 0);
}

protected function makeSharpen()
{
    $gaussian = array(
        array(1.0, 1.0, 1.0),
        array(1.0, -7.0, 1.0),
        array(1.0, 1.0, 1.0)
    );
    imageconvolution($this->image, $gaussian, 1, 4);
}

protected function makeEmboss()
{
    $gaussian = array(
        array(-2.0, -1.0, 0.0),
        array(-1.0, 1.0, 1.0),
        array(0.0, 1.0, 2.0)
    );
    imageconvolution($this->image, $gaussian, 1, 5);
}

protected function makeCool()
{
    imagefilter($this->image, IMG_FILTER_MEAN_REMOVAL);
    imagefilter($this->image, IMG_FILTER_CONTRAST, -50);
}

protected function makeOld()
{
    $dest = imagecreatefromjpeg(dirname(__FILE__) . "/files/bg1.jpg");

    $x = imagesx($this->image);
    $y = imagesy($this->image);

    $x2 = imagesx($dest);
    $y2 = imagesy($dest);

    $thumb = imagecreatetruecolor($x, $y);
    imagecopyresized($thumb, $dest, 0, 0, 0, 0, $x, $y, $x2, $y2);

    imagecopymerge($this->image, $thumb, 0, 0, 0, 0, $x, $y, 30);
}

protected function makeLight()
{
    imageFilter($this->image, IMG_FILTER_BRIGHTNESS, 10);
    imagefilter($this->image, IMG_FILTER_COLORIZE, 100, 50, 0, 10);
}

protected function makeAqua()
{
    imagefilter($this->image, IMG_FILTER_COLORIZE, 0, 70, 0, 30);
}

protected function makeFuzzy()
{
    $gaussian = array(
        array(1.0, 1.0, 1.0),
        array(1.0, 1.0, 1.0),
        array(1.0, 1.0, 1.0)
    );

    imageconvolution($this->image, $gaussian, 9, 20);
}

protected function makeBoost()
{
    imagefilter($this->image, IMG_FILTER_CONTRAST, -35);
    imagefilter($this->image, IMG_FILTER_BRIGHTNESS, 10);
}

protected function makeGray()
{
    imageFilter($this->image, IMG_FILTER_CONTRAST, -60);
    imageFilter($this->image, IMG_FILTER_GRAYSCALE);
}
}