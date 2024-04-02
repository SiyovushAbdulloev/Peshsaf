<?php

namespace App\Actions\Vendor\Reports;

use App\Core\Actions\CoreAction;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExportSalesAction extends CoreAction
{
    public function handle($products)
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

        $spreadsheet->getProperties()->setTitle(__('Отчет по покупкам'));

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);

        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', __('Отчет по покупкам'));

        $sheet
            ->setCellValue('A2', __('Наименование'))
            ->setCellValue('B2', __('Штрих-код'))
            ->setCellValue('C2', __('QR-код'))
            ->setCellValue('D2', __('Покупатель'))
            ->setCellValue('E2', __('Дата'));

        $rowIndex = 3;

        foreach ($products as $index => $product) {
            $sheet
                ->setCellValue("A$rowIndex", $product->product->name)
                ->setCellValue("B$rowIndex", $product->product->barcode)
                ->setCellValue("C$rowIndex", $product->barcode)
                ->setCellValue("D$rowIndex", $product->saleProduct->sale->client_name)
                ->setCellValue("E$rowIndex", $product->created_at->format('d.m.Y'));

            if ($index !== $products->count() - 1) {
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
