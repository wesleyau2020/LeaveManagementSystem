<?php

// src/View/Helper/ExcelHelper.php

declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelHelper extends Helper
{
    public function exportResultSet(array $resultSet, string $filename): void
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header row
        $headerRow = array_keys($resultSet[0]);
        $sheet->fromArray($headerRow, null, 'A1');

        // Data rows
        $dataRows = array_map(function ($row) {
            return array_values($row);
        }, $resultSet);
        $sheet->fromArray($dataRows, null, 'A2');

        // Export the spreadsheet to Excel file
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($filename);
    }
}


?>