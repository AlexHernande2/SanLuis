<?php
// Require composer autoload
require_once '../../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

// Write some HTML code:
$pdf = $mpdf->WriteHTML('Hello World');

echo $pdf;

// Output a PDF file directly to the browser
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<button onclick="hola()" type="button"></button>    
</body>
</html>

