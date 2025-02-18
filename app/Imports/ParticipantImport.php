<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ParticipantImport implements ToCollection
{
    protected $event_id;
    protected $competition_id;
    protected $category_id;
    protected $age_id;
    protected $gender;
    protected $class_id;

    public function __construct($event_id, $category_id, $age_id, $gender, $class_id)
    {
        $this->event_id = $event_id;
        $this->category_id = $category_id;
        $this->age_id = $age_id;
        $this->gender = $gender;
        $this->class_id = $class_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index == 0) continue; // Skip header row

            Participant::create([
                'event_id' => $this->event_id,
                'category_id' => $this->category_id,
                'age_id' => $this->age_id,
                'gender' => $this->gender,
                'class_id' => $this->class_id,
                'athlete_name' => json_encode(array_filter([$row[0], $row[1] ?? null, $row[2] ?? null])),
                'contingent_name' => $row[3],
            ]);
        }
    }
}
