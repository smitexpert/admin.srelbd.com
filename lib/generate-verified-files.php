<?php

include('barcode/BarcodeGenerator.php');
include('barcode/BarcodeGeneratorPNG.php');
include('barcode/BarcodeGeneratorSVG.php');
include('barcode/BarcodeGeneratorJPG.php');
include('barcode/BarcodeGeneratorHTML.php');

$generatorHTML = new Picqer\Barcode\BarcodeGeneratorHTML();
file_put_contents('tests/081231723897-code128.html', $generatorHTML->getBarcode('1904000000', $generatorHTML::TYPE_CODE_128));


$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();


?>

<div class="img" style="text-align:center; width: 100%;">
    <?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('SUJANMOLLACSE', $generator::TYPE_CODE_128)) . '">'; ?>
</div>

<?php





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

