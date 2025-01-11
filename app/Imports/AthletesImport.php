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
        $age_id = explode(' - ', $row['age_id_age_name'])[0];
        $contingent = Contingent::where('user_id', auth()->user()->id)->first();
        $contingent_id = $contingent ? $contingent->contingent_id : null;

        $data = [
            'athlete_name'   => $row['athlete_name'],
            'athlete_gender' => $row['athlete_gender'],
            'date_birth'     => $row['date_of_birth_yyyy_mm_dd'],
            'place_birth'    => $row['place_of_birth'],
            'nik'            => $row['nik_id_number'],
            'weight'         => $row['weight_kg'],
            'height'         => $row['height_cm'],
            'school_name'    => $row['school_name'],
            'age_id'         => $age_id,
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
            empty($data['age_id']) ||
            empty($data['contingent_id'])) {

            return;
        }

        Athlete::create($data);

    }
}
