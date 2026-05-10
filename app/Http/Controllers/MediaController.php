<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\DailyReport;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Listar media de un informe diario
     */
    public function index(DailyReport $dailyReport)
    {
        return response()->json([
            'data' => Media::where(
                'daily_report_id',
                $dailyReport->id
            )->get()
        ]);
    }

    /**
     * Crear media para un informe diario
     */
    public function store(Request $request, DailyReport $dailyReport) 
    {
        // VALIDACIÓN
        $validated = $request->validate([
            'file_path' => 'required|string|max:255',
            'file_type' => 'required|string|in:image,video,document',
        ]);

        // CREAR MEDIA
        $media = Media::create([
            ...$validated,
            'daily_report_id' => $dailyReport->id,
            'uploaded_at' => now(),
        ]);

        // RESPUESTA
        return response()->json([
            'message' => 'Archivo añadido correctamente',
            'data' => $media

        ], 201);
    }

    /**
     * Eliminar media
     */
    public function destroy(DailyReport $dailyReport, Media $media) 
    {
        // VERIFICAR QUE EL MEDIA
        // PERTENECE AL REPORT
        if ($media->daily_report_id !== $dailyReport->id) {
            return response()->json([
                'message' => 'El archivo no pertenece al informe indicado'
            ], 404);
        }

        // ELIMINAR
        $media->delete();

        // RESPUESTA
        return response()->json([
            'message' => 'Archivo eliminado correctamente'
        ]);
    }
}