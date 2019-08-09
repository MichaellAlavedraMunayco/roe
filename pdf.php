<?php
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'default_font_size' => 9,
    'default_font' => 'dejavusans'
]);
$mpdf->WriteHTML($_POST["html"], \Mpdf\HTMLParserMode::HTML_BODY);
echo base64_encode($mpdf->Output('report.pdf', 's'));
