<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use Illuminate\Http\Request;
use App\Models\Reservation;

class DailyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => DailyReport::with([
                'reservation',
                'media'
            ])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // VALIDACIÓN
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'report_date' => 'required|date',
            'status' => 'required|string|in:draft,published',
            'food_done' => 'boolean',
            'walk_done' => 'boolean',
            'rest_done' => 'boolean',
            'hygiene_done' => 'boolean',
            'medication_done' => 'boolean',
            'play_done' => 'boolean',
            'summary' => 'nullable|string',
            'observations' => 'nullable|string',
        ]);

        // SI ESTÁ PUBLICADO
        // ASIGNAR FECHA
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $exists = DailyReport::where(
            'reservation_id',
            $validated['reservation_id']
        )
        ->where(
            'report_date',
            $validated['report_date']
        )
        ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Ya existe un informe para esta fecha'
            ], 422);
        }

        // CREAR REPORT
        $dailyReport = DailyReport::create($validated);

        // RESPUESTA
        return response()->json([
            'message' => 'Informe diario creado correctamente',
            'data' => $dailyReport->load([
                'reservation',
                'media'
            ])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyReport $dailyReport)
    {
        return response()->json([
            'data' => $dailyReport->load([
                'reservation',
                'media'
            ])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyReport $dailyReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DailyReport $dailyReport)
    {
        // VALIDACIÓN
        $validated = $request->validate([
            'status' => 'sometimes|string|in:draft,published',
            'food_done' => 'sometimes|boolean',
            'walk_done' => 'sometimes|boolean',
            'rest_done' => 'sometimes|boolean',
            'hygiene_done' => 'sometimes|boolean',
            'medication_done' => 'sometimes|boolean',
            'play_done' => 'sometimes|boolean',
            'summary' => 'nullable|string',
            'observations' => 'nullable|string',
        ]);

        // SI PUBLICADO
        if (
            isset($validated['status']) &&
            $validated['status'] === 'published'
        ) {
            $validated['published_at'] = now();
        }

        // ACTUALIZAR
        $dailyReport->update($validated);

        // RESPUESTA
        return response()->json([
            'message' => 'Informe actualizado correctamente',
            'data' => $dailyReport->load([
                'reservation',
                'media'
            ])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyReport $dailyReport)
    {
        $dailyReport->delete();

        return response()->json([
            'message' => 'Informe eliminado correctamente'
        ]);
    }

    public function reservationReports(Request $request, Reservation $reservation)
    {
        $user = $request->user();

        // SI ES CLIENTE
        // VERIFICAR OWNERSHIP
        if (
            $user->role === 'client' &&
            $reservation->client_user_id !== $user->id
        ) {
            return response()->json([
                'message' => 'No tienes permisos para acceder a estos informes'
            ], 403);
        }

        // RESPUESTA
        return response()->json([
            'data' => DailyReport::with('media')
                ->where(
                    'reservation_id',
                    $reservation->id
                )
                ->get()
        ]);
    }

    public function summary(Request $request, Reservation $reservation)
    {
        $user = $request->user();

        // OWNERSHIP CLIENTE
        if (
            $user->role === 'client' &&
            $reservation->client_user_id !== $user->id
        ) {
            return response()->json([
                'message' => 'No tienes permisos para acceder al resumen'
            ], 403);
        }

        // OBTENER REPORTS
        $reports = DailyReport::where(
            'reservation_id',
            $reservation->id
        )->get();

        // RESPUESTA
        return response()->json([
            'reservation_id' => $reservation->id,
            'total_reports' => $reports->count(),
            'published_reports' => $reports
                ->where('status', 'published')
                ->count(),
        ]);
    }
}
