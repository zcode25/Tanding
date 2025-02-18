<?php

namespace App\Imports;

use App\Models\Athlete;
use App\Models\Contingent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AthletesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        $contingent = Contingent::where('user_id', auth()->user()->id)->first();
        $contingent_id = $contingent ? $contingent->contingent_id : null;

        $data = [
            'athlete_name'   => $row['nama'],
            'athlete_gender' => $row['jenis_kelamin'],
            'date_birth'     => $row['tanggal_lahir_yyyy_mm_dd'],
            'place_birth'    => $row['tempat_lahir'],
            'nik'            => $row['nik'],
            'weight'         => $row['berat_kg'],
            'height'         => $row['tinggi_cm'],
            'school_name'    => $row['nama_sekolah'],
            'contingent_id'  => $contingent_id 
        ];

        if (empty($data['athlete_name']) || 
            empty($data['athlete_gender']) ||
            empty($data['date_birth']) ||
            empty($data['place_birth']) ||
            empty($data['nik']) ||
            empty($data['weight']) ||
            empty($data['height']) ||
            empty($data['school_name']) ||
            empty($data['contingent_id'])) {

            return;
        }

        Athlete::create($data);

    }
}
