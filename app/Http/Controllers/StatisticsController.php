<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    // Obtener el número de estudios leídos por cada radiólogo y el tiempo promedio
    public function getReadingsByRadiologist(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $modalities = $request->query('modalities');

        $readings = DB::table('readings')
            ->join('studies', 'readings.id_orden', '=', 'studies.id_orden')
            ->join('users', 'readings.user_id', '=', 'users.id')
            ->select('users.name as usuario', DB::raw('count(*) as lecturas'), 'studies.modalidad')
            ->whereBetween('readings.created_at', [$startDate, $endDate])
            ->whereIn('studies.modalidad', $modalities)
            ->groupBy('users.name', 'studies.modalidad')
            ->get();

        return response()->json(['datos' => $readings]);
    }

    // Obtener la intensidad media y volúmenes para un rango de edad y valor de BIRADS
    public function getStudiesStatistics(Request $request)
    {
        $ageMin = $request->query('age_min');
        $ageMax = $request->query('age_max');
        $birads = $request->query('birads');

        $studies = DB::table('readings')
            ->join('patients', 'readings.id_paciente', '=', 'patients.id_paciente')
            ->select(
                DB::raw('count(*) as num_estudios'),
                DB::raw('avg(intensidad_media) as intensidad_med'),
                DB::raw('avg(vol_agua) as vol_agua_m'),
                DB::raw('avg(vol_tot) as vol_tot_m')
            )
            ->where('readings.birads', $birads)
            ->whereRaw('TIMESTAMPDIFF(MONTH, patients.fecha_nacimiento, readings.created_at) BETWEEN ? AND ?', [$ageMin, $ageMax])
            ->first();

        return response()->json($studies);
    }
}


function findMaxSumSubarray(array $array) {
    // Inicializamos max_current y max_global con el primer elemento del array.
    $max_current = $array[0];
    $max_global = $array[0];

    // Iteramos desde el segundo elemento hasta el final del array.
    for ($i = 1; $i < count($array); $i++) {
        // Calculamos max_current como el máximo entre el elemento actual y
        // la suma de max_current y el elemento actual.
        $max_current = max($array[$i], $max_current + $array[$i]);

        // Si max_current es mayor que max_global, actualizamos max_global.
        if ($max_current > $max_global) {
            $max_global = $max_current;
        }
    }

    // Retornamos la suma máxima del subarray contiguo.
    return $max_global;
}

// Ejemplo de uso
$array = [-2, 1, -3, 4, -1, 2, 1, -5, 4];
echo findMaxSumSubarray($array);  // Output: 6