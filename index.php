<?php
require 'vendor/autoload.php';

use BaconQrCode\Encoder\BlockPair;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
$result = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data('Custom QR code contents')
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
    ->size(300)
    ->margin(10)
    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->labelText('This is the label')
    ->labelFont(new NotoSans(20))
    ->labelAlignment(new LabelAlignmentCenter())
    ->validateResult(false)
    ->build();
use Endroid\QrCode\QrCode;
// echo '<pre>';
// var_dump($_SERVER);
// die();
$qr_code = QrCode::create('http://localhost:8090/export.php')->setSize(600)->setMargin(40)->setForegroundColor(new Color(255,24,56))->setBackgroundColor(new Color(153,204,5))
    ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh);
$label = Label::create("This is label");
$writer = new PngWriter;

$result = $writer->write($qr_code,null,$label);
// header("Content-Type:".$result->getMimeType());
// echo $result->getString();

$result->saveToFile('qr-code.png');