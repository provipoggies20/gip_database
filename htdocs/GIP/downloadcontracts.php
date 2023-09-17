<?php
include 'connection.php'; // Include your database connection code

// Require the PhpSpreadsheet classes
require_once __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Query your database to fetch the data
$sql = "SELECT * FROM gip_table";
$result = mysqli_query($conn, $sql);

// Create a new PhpSpreadsheet spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Add column headers
$sheet->fromArray(['Name', 'Address', 'Birth Date', 'Gender', 'Office', 'Contract Number', 'Start Date', 'End Date', 'Rendered', 'Total', 'Leftover', 'Status'], NULL, 'A1');

// Populate data rows
$rowIndex = 2;
while ($data = mysqli_fetch_assoc($result)) {
    $rowData = [
        $data['name'],
        $data['address'],
        $data['birth_date'],
        $data['gender'],
        $data['office'],
        $data['contract_number'],
        $data['start_date'],
        $data['end_date'],
        $data['rendered'],
        $data['total'],
        $data['leftover'],
        $data['status'],
    ];
    $sheet->fromArray($rowData, NULL, 'A' . $rowIndex);
    $rowIndex++;
}

// Create a new Xlsx writer
$writer = new Xlsx($spreadsheet);

// Set headers for Excel file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="contracts.xlsx"');

// Save the Excel file to output
$writer->save('php://output');

// Close the database connection
mysqli_close($conn);
?>
