<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ParticipantTemplateExport implements FromArray, WithHeadings, WithStyles
{
    public function headings(): array
    {
        return [
            'Nama Atlet 1',   // Nama atlet 1
            'Nama Atlet 2',   // Nama atlet 2 (jika kategori Double/Group)
            'Nama Atlet 3',   // Nama atlet 3 (jika kategori Group)
            'Nama Kontingen',  // Nama kontingen
        ];
    }

    public function array(): array
    {
        return [
            ['', '', '', ''], // Template kosong, user hanya mengisi nama atlet dan kontingen
        ];
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

        // Tentukan range header berdasarkan jumlah kolom
        $lastColumn = $sheet->getHighestColumn(); // Ambil kolom terakhir
        $headerRange = 'A1:' . $lastColumn . '1'; // Contoh: A1:D1 (jika ada 4 kolom)

        // Terapkan style ke header
        $sheet->getStyle($headerRange)->applyFromArray($headerStyle);

        // Auto size semua kolom
        foreach (range('A', $lastColumn) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return [];
    }
}
