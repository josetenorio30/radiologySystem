<?php
namespace App\Http\Controllers;

use App\Models\Reading;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReadingController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Store method called');
        Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'id_paciente' => 'required|string',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'id_orden' => 'required|string',
            'intensidad_media' => 'required|numeric',
            'birads' => 'required|string',
            'vol_agua' => 'required|numeric',
            'vol_tot' => 'required|numeric',
            'hallazgos' => 'required|string',
        ]);

        // Guardar los datos del paciente si no existe
        $patientData = [
            'id_paciente' => $request->id_paciente,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'fecha_nacimiento' => $request->fecha_nacimiento
        ];

        Log::info('Patient data: ', $patientData);

        $patient = Patient::updateOrCreate(
            ['id_paciente' => $patientData['id_paciente']],
            $patientData
        );

        Log::info('Patient saved or updated: ', ['patient' => $patient]);

        // Guardar la lectura
        $reading = new Reading();
        $reading->id_paciente = $request->id_paciente;
        $reading->id_orden = $request->id_orden;
        $reading->user_id = auth()->id();
        $reading->intensidad_media = $request->intensidad_media;
        $reading->birads = $request->birads;
        $reading->vol_agua = $request->vol_agua;
        $reading->vol_tot = $request->vol_tot;
        $reading->hallazgos = $request->hallazgos;
        $reading->save();

        Log::info('Reading saved: ', ['reading' => $reading]);

        // Enviar los datos al HIS
        $response = Http::withHeaders([
            'Authorization' => 'eYJJGCBtJ@Dwd&nEuNHug#dRkp5=G6Ph',
        ])->post('https://4235962c-8635-4694-85dc-4f420d53a7c4.mock.pstmn.io/study', [
            'id_paciente' => $reading->id_paciente,
            'fecha_lectura' => $reading->created_at->format('Y-m-d H:i:s'),
            'id_orden' => $reading->id_orden,
            'usuario_lectura' => $reading->user_id,
            'intensidad_media' => $reading->intensidad_media,
            'birads' => $reading->birads,
            'vol_tot' => $reading->vol_tot,
            'vol_agua' => $reading->vol_agua,
            'perc_agua' => ($reading->vol_agua / $reading->vol_tot) * 100,
            'hallazgos' => $reading->hallazgos,
        ]);

        if ($response->successful()) {
            Log::info('Data sent to HIS successfully');
            return redirect()->route('studies.index')->with('status', 'Reading saved and sent to HIS successfully');
        } else {
            Log::error('Failed to send data to HIS', ['response' => $response->body()]);
            return redirect()->route('studies.index')->with('error', 'Reading saved but failed to send to HIS');
        }
    }
}

