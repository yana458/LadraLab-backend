<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\DailyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'file' => 'required|file|max:5120',
            'file_type' => 'required|string|in:image,video,document',
        ]);

        // GUARDAR ARCHIVO
        $path = $request->file('file')->store(
            'daily-reports',
            'public'
        );

        // CREAR MEDIA
        $media = Media::create([
            'daily_report_id' => $dailyReport->id,
            'file_path' => $path,
            'file_type' => $validated['file_type'],
            'uploaded_at' => now(),
        ]);

        // RESPUESTA
        return response()->json([
            'message' => 'Archivo subido correctamente',
            'data' => [
                'id' => $media->id,
                'file_type' => $media->file_type,
                'file_path' => $media->file_path,
                'url' => asset('storage/' . $media->file_path),
            ]
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

        // ELIMINAR ARCHIVO FÍSICO
        Storage::disk('public')->delete(
            $media->file_path
        );

        // ELIMINAR REGISTRO
        $media->delete();

        // RESPUESTA
        return response()->json([
            'message' => 'Archivo eliminado correctamente'
        ]);
    }
}