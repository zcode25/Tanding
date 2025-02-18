<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contingent;
use App\Models\Athlete;
use App\Exports\AthletesExport;
use Maatwebsite\Excel\Facades\Excel;

class ContingentController extends Controller
{
    public function index() {

        $contingents = Contingent::all();

        $provinceFile = public_path('json/provinces.json');
        $provinces = file_exists($provinceFile) ? json_decode(file_get_contents($provinceFile), true) : [];

        $contingentCities = [];

        foreach ($contingents as $contingent) {
            // Inisialisasi daftar kota untuk contingent saat ini
            $contingentCities[$contingent->contingent_id] = [];
    
            if ($contingent->province) {
                $cityFile = public_path('json/cities/kab-' . $contingent->province . '.json');
                if (file_exists($cityFile)) {
                    $cities = json_decode(file_get_contents($cityFile), true);
    
                    // Hanya masukkan kota yang cocok dengan data contingent
                    if (isset($cities[$contingent->city])) {
                        $contingentCities[$contingent->contingent_id][] = $cities[$contingent->city];
                    }
                }
            }
        }

        return view('admin.contingent.index', [
            'contingents' => $contingents,
            'provinces' => $provinces,
            'contingentCities' => $contingentCities,
        ]);
    }

    public function detail(Contingent $contingent) {
        $athletes = Athlete::where('contingent_id', $contingent->contingent_id)->get();

        return view('admin.contingent.detail', [
            'athletes' => $athletes,
            'contingent' => $contingent
        ]);

    }

    public function export(Request $request,Contingent $contingent)
    {
        // dd($contingent);
        return Excel::download(new AthletesExport($contingent->contingent_id), "athletes_contingent_{$contingent->contingent_name}.xlsx");
    }
}
