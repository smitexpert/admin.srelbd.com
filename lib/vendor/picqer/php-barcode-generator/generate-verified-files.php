<?php

include('src/BarcodeGenerator.php');
include('src/BarcodeGeneratorPNG.php');
include('src/BarcodeGeneratorSVG.php');
include('src/BarcodeGeneratorJPG.php');
include('src/BarcodeGeneratorHTML.php');

$generatorHTML = new Picqer\Barcode\BarcodeGeneratorHTML();
file_put_contents('tests/verified-files/081231723897-code128.html', $generatorHTML->getBarcode('1904000000', $generatorHTML::TYPE_CODE_128));


$barCode = new Picqer\Barcode\BarcodeGeneratorPNG();
$barCode = $barCode->getBarcode('1904000000', $barCode::TYPE_CODE_128);

header('Content-Type: image/png');
die($barCode);





/*
include('src/BarcodeGenerator.php');
include('src/BarcodeGeneratorPNG.php');
include('src/BarcodeGeneratorSVG.php');
include('src/BarcodeGeneratorJPG.php');
include('src/BarcodeGeneratorHTML.php');

$generatorSVG = new Picqer\Barcode\BarcodeGeneratorSVG();
$generatorSVG->getBarcode('081231723897', $generatorSVG::TYPE_CODE_128);

header('Content-Type: image/png');
die($generatorSVG);
*/

