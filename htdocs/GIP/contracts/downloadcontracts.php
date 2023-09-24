<?php
include '../interface/connection.php';

require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$sql = "SELECT * FROM gip_table";
$result = mysqli_query($conn, $sql);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->fromArray(['Name', 'Address', 'Birth Date', 'Gender', 'Office', 'Contract Number', 'Start Date', 'End Date', 'Rendered', 'Total', 'Leftover', 'Status'], NULL, 'A1');

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

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="contracts.xlsx"');

$writer->save('php://output');

mysqli_close($conn);
?>
