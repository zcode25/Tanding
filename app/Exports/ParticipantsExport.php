<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ParticipantsExport implements FromCollection, WithHeadings, WithStyles
{
    protected $participants;

    // Konstruktor untuk menerima data peserta
    public function __construct($participants)
    {
        $this->participants = $participants;
    }

    // Mengembalikan data peserta yang sudah disaring
    public function collection()
    {
        $data = [];

        // Loop untuk memformat data peserta
        foreach ($this->participants as $participant) {
            $athletes = json_decode($participant->athlete_name, true);
            $athleteNames = is_array($athletes) ? implode(', ', $athletes) : $participant->athlete_name;

            // Menyusun data untuk setiap peserta
            $row = [
                'Nomor Undian' => $participant->draw_number ?? '-',
                'Atlet' => $athleteNames,
                'Kontingen' => $participant->contingent_name,
                'Kategori Pertandingan' => $participant->category->category_name,
                'Kategori Umur' => $participant->age->age_name,
                'Jenis Kelamin' => $participant->gender,
            ];

            // Menambahkan kolom kelas jika kategori pertandingan adalah 'Tanding'
            if ($participant->category->category_type == 'Tanding') {
                $row['Kelas'] = $participant->matchclass->class_name . ' ( ' . 
                                $participant->matchclass->class_min . 'Kg s/d ' . 
                                $participant->matchclass->class_max . 'Kg)';
            } else {
                $row['Kelas'] = ''; // Jika bukan kategori 'Tanding', kosongkan kelas
            }

            $data[] = $row;
        }

        return collect($data); // Mengembalikan data dalam format koleksi
    }

    // Menentukan judul kolom untuk Excel
    public function headings(): array
    {

        $headings = [
            'Nomor Undian',
            'Atlet',
            'Kontingen',
            'Kategori Pertandingan',
            'Kategori Umur',
            'Jenis Kelamin',
        ];

        if ($this->participants->first() && $this->participants->first()->category->category_type == 'Tanding') {
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
