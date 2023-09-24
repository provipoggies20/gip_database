<?php
require_once '../vendor/autoload.php'; // Include PHPWord autoloader
require '../interface/connection.php';

// Get the personal_id from the query string
$personal_id = $_GET['personal_id'];

// Query the database to fetch the data based on personal_id
$sql = "SELECT * FROM gip_table WHERE personal_id = $personal_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Load the Word document template
$templatePath = '../files/certificate.docx'; // Replace with the path to your Word template
$phpWord = \PhpOffice\PhpWord\IOFactory::load($templatePath);

// Define the values you want to replace
$gender = $row['gender'];
$genderTitle = ($gender == 'F') ? 'MS.' : 'MR.'; // Check gender and set appropriate title

$office = $row['office'];
$office = explode("/", $office);
$start_date = $row['start_date'];
$start_date = explode("/", $start_date);
$end_date = $row['end_date'];
$end_date = explode("/", $end_date);

if ($office[1] == "" && !empty($start_date[1])) {
    $office[1] == $office[0];
}

// Replace placeholders with actual data
$replacements = [
    'NAME' => $row['name'],
    'GENDER' => $genderTitle,
    'TOTAL' => $row['total'],
    'STARTDATE1' => $start_date[0],
    'ENDDATE1' => $end_date[0],
    'OFFICE1' => $office[0],
    'STARTDATE2' => "; " . $start_date[1],
    'ENDDATE2' => $end_date[1],
    'OFFICE2' => $office[1],
    'STARTDATE3' => "; " . $start_date[2],
    'ENDDATE3' => $end_date[2],
    'OFFICE3' => $office[2],
    'STARTDATE4' => "; " . $start_date[3],
    'ENDDATE4' => $end_date[3],
    'OFFICE4' => $office[3],
    'DAYTODAY' => date('d'), // Current day
    'MONTHTODAY' => date('F'), // Current month
    'YEARTODAY' => date('Y'), // Current year
];

foreach ($phpWord->getSections() as $section) {
    // Exclude headers and footers from processing
    if (!$section->getFooter() && !$section->getHeader()) {
        foreach ($section->getElements() as $element) {
            if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                foreach ($element->getElements() as $text) {
                    if ($text instanceof \PhpOffice\PhpWord\Element\Text) {
                        // Replace placeholders in the text content
                        $text->setText(str_replace(array_keys($replacements), array_values($replacements), $text->getText()));
                    }
                }
            } elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                // Replace placeholders in the text content
                $element->setText(str_replace(array_keys($replacements), array_values($replacements), $element->getText()));
            }
        }
    }
}

// Save the modified document
$outputFileName = 'certificate_output.docx';
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save($outputFileName);

// Output the modified document for download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $outputFileName . '"');
readfile($outputFileName);

// Clean up temporary files if needed
unlink($outputFileName);
?>
