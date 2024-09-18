<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read PDF Content with FPDF</title>
</head>
<body>

    <h1>Read PDF Content with FPDF</h1>

    <?php
    
    require_once __DIR__ . '/vendor/autoload.php';
    $pdfUrl = 'http://localhost:8080/Advance_LMS/Teacher/lessons/1708111894.pdf';

    $pdfUrl = 'http://localhost:8080/Advance_LMS/Teacher/lessons/1708111894.pdf';

    class PDFReader
    {
        function extractText($filename)
        {
            $mpdf = new \Mpdf\Mpdf();
            $text = $mpdf->SetSourceFile($filename);
            for ($i = 1; $i <= $mpdf->numPages; $i++) {
                $text .= $mpdf->GetText($i);
            }
            return $text;
        }
    }

    // Create a new PDFReader instance
    $pdfReader = new PDFReader();

    // Read the content of the PDF file
    $content = $pdfReader->extractText($pdfUrl);
    ?>

    <div>
        <h2>PDF Content</h2>
        <pre><?php echo $content; ?></pre>
    </div>

</body>
</html>