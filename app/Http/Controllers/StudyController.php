<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Study;
use App\Models\Reading;

class StudyController extends Controller
{
    public function index()
    {
        // Consumiendo la API externa para obtener los estudios
        $response = Http::get('https://4235962c-8635-4694-85dc-4f420d53a7c4.mock.pstmn.io');
        $studies = $response->json();

        // Guardar los estudios en la base de datos
        foreach ($studies as $study) {
            Study::updateOrCreate(
                ['id_orden' => $study['orden']['id_orden']],
                [
                    'id_paciente' => $study['paciente']['id_paciente'],
                    'modalidad' => $study['estudio']['modalidad'],
                    'nombre_estudio' => $study['estudio']['nombre'],
                    'id_imagen' => $study['estudio']['id_imagen']
                ]
            );
        }

        // Filtrar estudios que no tienen una lectura asociada
        $pendingStudies = Study::doesntHave('readings')->get();

        return view('index', compact('pendingStudies'));
    }
}

