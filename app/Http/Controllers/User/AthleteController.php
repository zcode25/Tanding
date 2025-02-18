<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Age;
use App\Models\Athlete;
use App\Models\Contingent;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Imports\AthletesImport;

class AthleteController extends Controller
{
    public function index() {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $contingent = Contingent::where('user_id', auth()->user()->id)->first();
        $athletes = Athlete::where('contingent_id', $contingent->contingent_id)->get();

       
        return view('user.athlete.index', [
            'athletes' => $athletes
        ]);
    }

    public function downloadTemplate()
    {
        
        // $ages = Age::select('age_id', 'age_name')->get();
        // $ageDropdown = $ages->map(function ($age) {
        //     return "{$age->age_id} - {$age->age_name}";
        // })->implode(',');
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Header Titles
        $headers = [
            'A1' => 'Nama',
            'B1' => 'Jenis Kelamin',
            'C1' => 'Tanggal Lahir (YYYY-MM-DD)',
            'D1' => 'Tempat Lahir',
            'E1' => 'NIK',
            'F1' => 'Berat (Kg)',
            'G1' => 'Tinggi (Cm)',
            'H1' => 'Nama Sekolah',
        ];
    
        // Styling for Header
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
    
        // Apply Headers and Styles
        foreach ($headers as $cell => $text) {
            $sheet->setCellValue($cell, $text);
        }
        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);
    
        // Auto-size Columns
        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    
        $sheet->setCellValue('A2', 'John Doe');
        $sheet->setCellValue('B2', 'Putra');
        $sheet->setCellValueExplicit('C2', '2005-01-15', DataType::TYPE_STRING);
        $sheet->setCellValue('D2', 'Jakarta');
        $sheet->setCellValue('E2', '3201011234567890');
        $sheet->setCellValue('F2', 60);
        $sheet->setCellValue('G2', 175);
        $sheet->setCellValue('H2', 'High School Jakarta');
    
        // Add Dropdown for Athlete Gender
        $genderValidation = $sheet->getCell('B2')->getDataValidation();
        $genderValidation->setType(DataValidation::TYPE_LIST);
        $genderValidation->setErrorStyle(DataValidation::STYLE_STOP);
        $genderValidation->setAllowBlank(false);
        $genderValidation->setShowInputMessage(true);
        $genderValidation->setShowErrorMessage(true);
        $genderValidation->setShowDropDown(true);
        $genderValidation->setFormula1('"Putra,Putri"'); // Dropdown values
    

        // Apply dropdown validation for multiple rows (B2 to B100)
        foreach (range(2, 100) as $row) {
            $sheet->getCell("B$row")->setDataValidation(clone $genderValidation);
            $sheet->getStyle("E{$row}")->getNumberFormat()->setFormatCode('0000000000000000');
            $sheet->getStyle("C$row")->getNumberFormat()->setFormatCode('@'); // Format teks
        }

        
    
        // Menambahkan border untuk semua sel dari A1 hingga I100
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        $sheet->getStyle('A1:H100')->applyFromArray($borderStyle);
    
        // File Name
        $fileName = 'Athlete_Template.xlsx';
    
        // Download File
        $writer = new Xlsx($spreadsheet);
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
        exit;
    }

    public function importAthletes(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        $contingent = Contingent::where('user_id', auth()->user()->id)->first();
        $contingent_id = $contingent ? $contingent->contingent_id : null;

        $old = Athlete::where('contingent_id', $contingent_id)->count();

        Excel::import(new AthletesImport, $request->file('file'));

        $new = Athlete::where('contingent_id', $contingent_id)->count();

        $count = $new - $old;

        if ($count == 0) {
            return redirect('/userAthlete')->with('error', 'Data tidak sesuai');
        } else {
            return redirect('/userAthlete')->with('success', 'Data Berhasil Disimpan ' . $count . ' athlete');
        }
        
    }


    public function create() {

        $genders = [
            [
                "type" => "Putra"
            ],
            [
                "type" => "Putri"
            ],
        ];

        return view('user.athlete.create', [
            'genders' => $genders,
        ]);

    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'athlete_name' => 'required',
            'athlete_gender' => 'required',
            'date_birth' => 'required',
            'place_birth' => 'required',
            'nik' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'school_name' => 'required',
            'athlete_photo' => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if($request->file('athlete_photo')) {
            $validatedData['athlete_photo'] = $request->file('athlete_photo')->store('athlete_photo');
        }

        $contingent = Contingent::where('user_id', auth()->user()->id)->first();
        $validatedData['contingent_id'] = $contingent->contingent_id;
        
        Athlete::create($validatedData);

        return redirect('/userAthlete')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit(Athlete $athlete) {
        $genders = [
            [
                "type" => "Putra"
            ],
            [
                "type" => "Putri"
            ],
        ];

        return view('user.athlete.edit', [
            'athlete' => $athlete,
            'genders' => $genders,
        ]);
    }

    public function update(Request $request, Athlete $athlete) {

        $validatedData = $request->validate([
            'athlete_name' => 'required',
            'athlete_gender' => 'required',
            'date_birth' => 'required',
            'place_birth' => 'required',
            'nik' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'school_name' => 'required',
            'athlete_photo' => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $athlete = Athlete::where('athlete_id', $athlete->athlete_id)->first();

        if($request->file('athlete_photo')) {
            if($athlete->athlete_photo != null) {
                Storage::delete($athlete->athlete_photo);
            }
             
            $validatedData['athlete_photo'] = $request->file('athlete_photo')->store('athlete_photo');
        }
        
        Athlete::where('athlete_id', $athlete->athlete_id)->update($validatedData);

        return redirect('/userAthlete')->with('success', 'Data Berhasil Disimpan');

    }

    public function destroy(Athlete $athlete) {

        $athlete = Athlete::where('athlete_id', $athlete->athlete_id)->first();

        try{
            if($athlete->athlete_photo != null) {
                Storage::delete($athlete->athlete_photo);
            }
            Athlete::where('athlete_id', $athlete->athlete_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/userAthlete')->with('success', 'Data deleted successfully');
    }
}
