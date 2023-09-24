<?php
include '../interface/connection.php';

require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$sql = "SELECT * FROM gip_beneficiaries";
$result = mysqli_query($conn, $sql);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->fromArray(['No.', 'Surname', 'Firstname', 'Middle Initial', 'Age', 'Birthdate', 'Sex', 'Barangay', 'Municipality', 'Province', 'Educational Attainment', 'Start', 'End', 'Office', 
'Proponent', 'ADL', 'Contact', 'Remarks'], NULL, 'A1');

$rowIndex = 2;
while ($data = mysqli_fetch_assoc($result)) {
    $rowData = [
        $data['sur_name'],
        $data['first_name'],
        $data['middle_name'],
        $data['age'],
        $data['birth_date'],
        $data['sex'],
        $data['barangay'],
        $data['municipality'],
        $data['province'],
        $data['educational_attainment'],
        $data['start_date'],
        $data['end_date'],
        $data['office'],
        $data['proponent'],
        $data['adl'],
        $data['contact'],
        $data['remarks'],
    ];
    $sheet->fromArray($rowData, NULL, 'A' . $rowIndex);
    $rowIndex++;
}

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="beneficiaries.xlsx"');

$writer->save('php://output');

mysqli_close($conn);
?>
