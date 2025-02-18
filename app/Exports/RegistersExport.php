<?php

namespace App\Exports;

use App\Models\Register;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class RegistersExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $registers;

    public function __construct($registers)
    {
        $this->registers = $registers;
    }


    public function collection()
    {
        $data = [];

        foreach ($this->registers as $index => $register) {
            $athletes = $register->athletes->map(function ($athlete) {
                return $athlete->athlete_name;
            })->implode(", ");

            $row = [
                'No' => $index + 1,
                'Atlet' => $athletes,
                'Kontingen' => $register->contingent->contingent_name ?? 'N/A',
                'Kategori Pertandingan' => $register->category->category_name ?? 'N/A',
                'Kategori Umur' => $register->age->age_name ?? 'N/A',
                'Jenis Kelamin' => $register->gender ?? 'N/A',
            ];

            if ($register->category->category_type == 'Tanding') {
                $row['Kelas'] = $register->matchClass->class_name . ' (' . $register->matchClass->class_min . 'Kg s/d ' . $register->matchClass->class_max . 'Kg)';
            }

            $data[] = $row;
        }

        return collect($data);
    }

    public function headings(): array
    {
        $headings = [
            'No',
            'Atlet',
            'Kontingen',
            'Kategori Pertandingan',
            'Kategori Umur',
            'Jenis Kelamin',
        ];

        if ($this->registers->first() && $this->registers->first()->category->category_type == 'Tanding') {
            $headings[] = 'Kelas';
        }

        return $headings;
    }



    public function styles(Worksheet $sheet)
    {
        // Style untuk header (baris pertama)
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '000000'], // Warna latar hitam
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $lastColumn = $sheet->getHighestColumn(); 
        $headerRange = 'A1:' . $lastColumn . '1'; 

        $sheet->getStyle($headerRange)->applyFromArray($headerStyle);

        foreach (range('A', $lastColumn) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return [];
    }

    
}
