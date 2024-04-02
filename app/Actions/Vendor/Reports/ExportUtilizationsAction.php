<?php

namespace App\Actions\Vendor\Reports;

use App\Core\Actions\CoreAction;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExportUtilizationsAction extends CoreAction
{
    public function handle($utilizationProducts)
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $allBorders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color'       => ['argb' => '000'],
                ],
                'outline'    => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color'       => ['argb' => '000'],
                ],
            ],
        ];

        $spreadsheet->getProperties()->setTitle(__('Отчет по утилизациям'));

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);

        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', __('Отчет по утилизациям'));

        $sheet
            ->setCellValue('A2', __('Наименование'))
            ->setCellValue('B2', __('Штрих-код'))
            ->setCellValue('C2', __('QR-код'))
            ->setCellValue('D2', __('Отправитель'))
            ->setCellValue('E2', __('Дата'));

        $rowIndex = 3;

        foreach ($utilizationProducts as $index => $utilizationProduct) {
            $sheet
                ->setCellValue("A$rowIndex", $utilizationProduct->dicProduct->name)
                ->setCellValue("B$rowIndex", $utilizationProduct->dicProduct->barcode)
                ->setCellValue("C$rowIndex", $utilizationProduct->product->barcode)
                ->setCellValue("D$rowIndex", $utilizationProduct->utilization->returner)
                ->setCellValue("E$rowIndex", $utilizationProduct->utilization->created_at->format('d.m.Y'));

            if ($index !== $utilizationProducts->count() - 1) {
                $rowIndex++;
            }
        }

        $sheet->getStyle("A1:E$rowIndex")->applyFromArray($allBorders);
        $sheet->getStyle("A1:E$rowIndex")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A1:E2")->getFont()->setBold(true);
        $sheet->getStyle("A2:E2")->getFont()->getColor()->setRGB('f9f9f9');
        $sheet->getStyle("A2:E2")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('00a933');


        return IOFactory::createWriter($spreadsheet, 'Xls');
    }
}
