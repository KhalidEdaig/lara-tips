<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;


class ReportExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithDrawings,
    WithCustomStartCell
{
    use Exportable;

    protected $reservations;
    protected $restaurantName;
    protected $mealTime;
    protected $dateRange;

    public function __construct($restaurantName, $mealTime, $dateRange)
    {
        
        $this->restaurantName = $restaurantName;
        $this->mealTime = $mealTime;
        $this->dateRange = $dateRange;
    }

    public function collection()
    {
        return collect([
            [
                'description' => 'test',
                'reservation_time' => '8:00',
            ]
        ]);
    }

    public function map($reservation): array
    {

        return [
            $reservation['description'],
            $reservation['reservation_time'],
        ];
    }

    public function headings(): array
    {
        return [
            'Description',
            'Time',
        ];
    }

    public function startCell(): string
    {
        return 'B11';
    }

    public function styles(Worksheet $sheet)
    {

        $sheet->setAutoFilter('B11:N11');

        $sheet->getStyle(11)->getFont()->setBold(true);
        $sheet->getStyle(11)->getFont()->setSize(12);

        $sheet->getStyle('B11:N11')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('B11:N11')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('B11:N11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getRowDimension('11')->setRowHeight(20);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(15);
        $sheet->getColumnDimension('I')->setWidth(15);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(20);
        $sheet->getColumnDimension('L')->setWidth(25);
        $sheet->getColumnDimension('M')->setWidth(40);

        $sheet->setShowGridlines(false);

        $sheet->setCellValue('C5', 'Restaurant: ');
        $sheet->setCellValue('D5', $this->restaurantName);
        $sheet->setCellValue('C6', 'Total Covers: ');
        // $sheet->setCellValue('D6', $this->reservations->sum('adults') + $this->reservations->sum('kids'));
        $sheet->getStyle('D6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValue('C7', 'Meal Time: ');
        $sheet->setCellValue('D7', $this->mealTime);
        $sheet->setCellValue('C8', 'Date Range: ');
        $sheet->setCellValue('D8', $this->dateRange);
        $sheet->setCellValue('C9', 'Exported At: ');
        $sheet->setCellValue('D9', date('Y-m-d H:i:s'));

        // $reservations = $this->reservations->sortBy('reservation_time')->groupBy('reservation_time');
        // $currentRow = 12;
        // $lastRow = 0;

        // foreach ($reservations as $time => $group) {
        //     $sheet->mergeCells("B{$currentRow}:B" . ($currentRow + count($group) - 1));
        //     $sheet->setCellValue("B{$currentRow}", $time);
        //     $sheet->getStyle("B{$currentRow}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        //     $sheet->getStyle("B{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        //     foreach ($group as $reservation) {
        //         $row = $currentRow++;
        //         $sheet->getRowDimension($row)->setRowHeight(20);
        //         $sheet->getStyle("B{$row}:N{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        //         $sheet->getStyle("B{$row}:N{$row}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        //         $sheet->getStyle("B{$row}:N{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        //     }
        //     $lastRow = $currentRow - 1;
        //     $sheet->getStyle("B{$lastRow}:N{$lastRow}")->getBorders()->getBottom()->setBorderStyle(Border::BORDER_DOUBLE);
        // }
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/images/image-1.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('B5');

        $drawing->setWidth(250);
        $drawing->setHeight(100);

        return $drawing;
    }
}
