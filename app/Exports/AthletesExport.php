<?php

namespace App\Exports;

use App\Models\Athlete;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AthletesExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting
{
    protected $contingentId;

    public function __construct($contingentId)
    {
        $this->contingentId = $contingentId;
    }

    /**
     * Export data as a collection.
     */
    public function collection()
    {
        return Athlete::where('contingent_id', $this->contingentId)
            ->select(
                'athlete_name',
                'nik',
                'athlete_gender',
                'date_birth',
                'place_birth',
                'school_name',
                'weight',
                'height',
            )
            ->with('age:age_id,age_name')
            ->get()
            ->map(function ($athlete) {
                return [
                    'name' => $athlete->athlete_name,
                    'nik' => $athlete->nik,
                    'gender' => $athlete->athlete_gender,
                    'birth_date' => $athlete->date_birth,
                    'birth_place' => $athlete->place_birth,
                    'school' => $athlete->school_name,
                    'weight' => $athlete->weight . ' Kg',
                    'height' => $athlete->height . ' Cm',
                ];
            });
    }

    /**
     * Define the Excel file headings.
     */
    public function headings(): array
    {
        return [
            'Nama',
            'NIK',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Tempat Lahir',
            'Nama Sekolah',
            'Berat',
            'Tinggi',
        ];
    }

    public function styles(Worksheet $sheet)
    {
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
                'startColor' => ['rgb' => '000000'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        // Apply header style to row 1
        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

        // Auto size columns
        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return [];
    }

    /**
     * Apply column formatting.
     */
    public function columnFormats(): array
    {
        return [
            'B' => '0000000000000000', // Format NIK column with 16-digit zero padding
        ];
    }
}
