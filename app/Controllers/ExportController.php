<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MasterListModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Dompdf\Dompdf;
use Dompdf\Options;

class ExportController extends BaseController
{
    public function exportExcel()
    {
        $model = new MasterListModel();
        $lists = $model->where('isDelete', 0)->orderBy('lastname', 'ASC')->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'Last Name',
            'First Name',
            'Middle Name',
            'Name Extension',
            'Sex',
            'Barangay',
            'Unit',
            'Birthdate',
            'Age',
            'OSCA ID No.',
            'Remarks',
            'Date Issued',
            'Date Applied'
        ];

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $col++;
        }

        $row = 2;
        foreach ($lists as $n) {
            $sheet->setCellValue('A' . $row, strtoupper($n['lastname']));
            $sheet->setCellValue('B' . $row, strtoupper($n['firstname']));
            $sheet->setCellValue('C' . $row, strtoupper($n['middle_name']));
            $sheet->setCellValue('D' . $row, strtoupper($n['suffix']));
            $sheet->setCellValue('E' . $row, strtoupper($n['sex']));
            $sheet->setCellValue('F' . $row, strtoupper($n['barangay']));
            $sheet->setCellValue('G' . $row, $n['unit']);
            $sheet->setCellValue('H' . $row, strtoupper(date('F d, Y', strtotime($n['birthdate']))));
            $sheet->setCellValue('I' . $row, strtoupper($n['age']));
            $sheet->setCellValue('J' . $row, strtoupper($n['osca_id']));
            $sheet->setCellValue('K' . $row, strtoupper($n['remarks']));
            $sheet->setCellValue('L' . $row, !empty($n['date_issued']) ? strtoupper(date('F d, Y', strtotime($n['date_issued']))) : 'N/A');
            $sheet->setCellValue('M' . $row, !empty($n['date_applied']) ? strtoupper(date('F d, Y', strtotime($n['date_applied']))) : 'N/A');
            $row++;
        }

        $sheet->getStyle('A1:M1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'], // white text for contrast
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '198754'], // Bootstrap success green
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        $filename = 'OSCA_MASTERLIST_' . date('Y-m-d') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit;
    }


    public function exportExcelByBarangay()
    {
        $model = new MasterListModel();
        $barangay = $this->request->getPost('barangay');
        $lists = $model->where('isDelete', 0)
            ->where('barangay', $barangay)
            ->orderBy('lastname', 'ASC')
            ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // --- Barangay Title ---
        $sheet->setCellValue('A1', 'Barangay: ' . strtoupper($barangay));
        $sheet->mergeCells('A1:M1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        // --- Table Headers ---
        $headers = [
            'Last Name',
            'First Name',
            'Middle Name',
            'Name Extension',
            'Sex',
            'Barangay',
            'Unit',
            'Birthdate',
            'Age',
            'OSCA ID No.',
            'Remarks',
            'Date Issued',
            'Date Applied'
        ];

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '3', $header); // Start headers at row 3
            $col++;
        }

        // --- Data Rows ---
        $row = 4;
        foreach ($lists as $n) {
            $sheet->setCellValue('A' . $row, strtoupper($n['lastname']));
            $sheet->setCellValue('B' . $row, strtoupper($n['firstname']));
            $sheet->setCellValue('C' . $row, strtoupper($n['middle_name']));
            $sheet->setCellValue('D' . $row, strtoupper($n['suffix']));
            $sheet->setCellValue('E' . $row, strtoupper($n['sex']));
            $sheet->setCellValue('F' . $row, strtoupper($n['barangay']));
            $sheet->setCellValue('G' . $row, $n['unit']);
            $sheet->setCellValue('H' . $row, strtoupper(date('F d, Y', strtotime($n['birthdate']))));
            $sheet->setCellValue('I' . $row, strtoupper($n['age']));
            $sheet->setCellValue('J' . $row, strtoupper($n['osca_id']));
            $sheet->setCellValue('K' . $row, strtoupper($n['remarks']));
            $sheet->setCellValue('L' . $row, !empty($n['date_issued']) ? date('F d, Y', strtotime($n['date_issued'])) : 'N/A');
            $sheet->setCellValue('M' . $row, !empty($n['date_applied']) ? date('F d, Y', strtotime($n['date_applied'])) : 'N/A');
            $row++;
        }

        // --- Styling ---
        // $sheet->getStyle('A3:M3')->getFont()->setBold(true);
        $sheet->getStyle('A3:M3')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'], // white text for contrast
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '198754'], // Bootstrap success green
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);
        foreach (range('A', 'M') as $colLetter) {
            $sheet->getColumnDimension($colLetter)->setAutoSize(true);
        }

        // --- Output File ---
        $writer = new Xlsx($spreadsheet);
        $filename = 'OSCA_MASTERLIST_BARANGAY_' . ucfirst($barangay) . '_' . date('Y-m-d') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit;
    }

    public function exportExcelByUnit()
    {
        $model = new MasterListModel();
        $unit = $this->request->getPost('unit');
        $lists = $model->where('isDelete', 0)
            ->where('unit', $unit)
            ->orderBy('barangay', 'ASC')
            ->orderBy('lastname', 'ASC')
            ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Main title
        $sheet->setCellValue('A1', 'Barangay Unit: ' . strtoupper($unit));
        $sheet->mergeCells('A1:M1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        // Headers (fixed position after barangay titles)
        $headers = [
            'Last Name',
            'First Name',
            'Middle Name',
            'Name Extension',
            'Sex',
            'Barangay',
            'Unit',
            'Birthdate',
            'Age',
            'OSCA ID No.',
            'Remarks',
            'Date Issued',
            'Date Applied'
        ];

        $row = 3;
        $currentBarangay = '';

        foreach ($lists as $n) {
            if ($currentBarangay !== strtoupper($n['barangay'])) {
                if ($currentBarangay !== '') {
                    $row++;
                }

                // Barangay Indicator
                $sheet->setCellValue('A' . $row, 'BARANGAY: ' . strtoupper($n['barangay']));
                $sheet->mergeCells('A' . $row . ':M' . $row);
                $sheet->getStyle('A' . $row)->getFont()->setBold(true)->setSize(12)->getColor()->setRGB('000000');
                $sheet->getStyle('A' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('D9EAD3');
                $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal('center');
                $currentBarangay = strtoupper($n['barangay']);

                $row++;

                $col = 'A';
                foreach ($headers as $header) {
                    $sheet->setCellValue($col . $row, $header);
                    $col++;
                }

                $sheet->getStyle('A' . $row . ':M' . $row)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '198754'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $row++;
            }

            // Fill rows under barangay
            $sheet->setCellValue('A' . $row, strtoupper($n['lastname']));
            $sheet->setCellValue('B' . $row, strtoupper($n['firstname']));
            $sheet->setCellValue('C' . $row, strtoupper($n['middle_name']));
            $sheet->setCellValue('D' . $row, strtoupper($n['suffix']));
            $sheet->setCellValue('E' . $row, strtoupper($n['sex']));
            $sheet->setCellValue('F' . $row, strtoupper($n['barangay']));
            $sheet->setCellValue('G' . $row, $n['unit']);
            $sheet->setCellValue('H' . $row, !empty($n['birthdate']) ? date('F d, Y', strtotime($n['birthdate'])) : 'N/A');
            $sheet->setCellValue('I' . $row, $n['age']);
            $sheet->setCellValue('J' . $row, strtoupper($n['osca_id']));
            $sheet->setCellValue('K' . $row, strtoupper($n['remarks']));
            $sheet->setCellValue('L' . $row, !empty($n['date_issued']) ? date('F d, Y', strtotime($n['date_issued'])) : 'N/A');
            $sheet->setCellValue('M' . $row, !empty($n['date_applied']) ? date('F d, Y', strtotime($n['date_applied'])) : 'N/A');
            $row++;
        }

        // Autosize columns
        foreach (range('A', 'M') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Output Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'OSCA_MASTERLIST_BARANGAY_UNIT_' . strtoupper($unit) . '_' . date('Y-m-d') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit;
    }



    // PDF EXPORT
    public function exportPdfByUnit()
    {
        $model = new MasterListModel();
        $unit = $this->request->getPost('unit');
        $lists = $model->where('isDelete', 0)
            ->where('unit', $unit)
            ->orderBy('barangay', 'ASC')
            ->orderBy('lastname', 'ASC')
            ->findAll();

        // Group records by barangay
        $grouped = [];
        foreach ($lists as $row) {
            $grouped[$row['barangay']][] = $row;
        }

        // Render the view as HTML
        $html = view('PDF/pdf_layout', [
            'unit' => $unit,
            'grouped' => $grouped
        ]);

        // Initialize Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // ✅ VIEW IN BROWSER FIRST (NOT AUTO DOWNLOAD)
        $filename = 'OSCA_MASTERLIST_BARANGAY_' . strtoupper($unit) . '_' . date('Y-m-d') . '.pdf';
        $dompdf->stream($filename, ["Attachment" => false]); // <-- false = view first

        exit;
    }


    public function exportAllPDF()
    {
        $model = new MasterListModel();
        $lists = $model->where('isDelete', 0)
            ->orderBy('barangay', 'ASC')
            ->orderBy('lastname', 'ASC')
            ->findAll();

        // ✅ Group by Barangay for cleaner layout
        $grouped = [];
        foreach ($lists as $row) {
            $grouped[$row['barangay']][] = $row;
        }

        // ✅ Load the PDF layout view
        $html = view('PDF/pdf_all_layout', [
            'grouped' => $grouped,
            'title' => 'Senior Citizen Master List',
            'dateGenerated' => date('F d, Y | h:i A')
        ]);

        // ✅ Initialize Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // ✅ VIEW PDF IN BROWSER (not auto-download)
        $filename = 'OSCA_MASTERLIST_' . date('Y-m-d') . '.pdf';
        $dompdf->stream($filename, ["Attachment" => false]); // <-- view-only mode
        exit;
    }

    public function exportPDFByBarangay()
    {
        $model = new MasterListModel();
        $barangay = $this->request->getPost('barangay');
        $lists = $model->where('isDelete', 0)
            ->where('barangay', $barangay)
            ->orderBy('lastname', 'ASC')
            ->findAll();

        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'portrait');

        $data = [
            'barangay' => $barangay,
            'lists' => $lists
        ];

        $html = view('PDF/pdf_barangay', $data);

        $dompdf->loadHtml($html);
        $dompdf->render();

        $dompdf->stream('OSCA_BARANGAY_' . ucfirst($barangay) . '_LIST.pdf', ['Attachment' => false]);
    }
}
