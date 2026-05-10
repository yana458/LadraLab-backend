<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Service::where(
                'is_active',
                true
            )
            ->orderBy('name')
            ->get()
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
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'booking_mode' => 'required|in:date_range,single_day,time_slot',
            'default_start_time' => 'nullable|date_format:H:i',
            'default_end_time' => 'nullable|date_format:H:i',
            'duration_minutes' => 'nullable|integer|min:1',
            'slot_interval_min' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        // CREAR SERVICIO
        $service = Service::create($validated);

        // RESPUESTA
        return response()->json([
            'message' => 'Servicio creado correctamente',
            'data' => $service
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        // VERIFICAR QUE EL SERVICIO ESTÉ ACTIVO
        if (!$service->is_active) {
            return response()->json([
                'message' => 'Servicio no disponible'
            ], 404);
        }

        // RESPUESTA
        return response()->json([
            'data' => $service
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        // VALIDACIÓN
        $validated = $request->validate([
            'name' => 'sometimes|string|max:100',
            'description' => 'nullable|string',
            'base_price' => 'sometimes|numeric|min:0',
            'booking_mode' => 'sometimes|in:date_range,single_day,time_slot',
            'default_start_time' => 'nullable|date_format:H:i',
            'default_end_time' => 'nullable|date_format:H:i',
            'duration_minutes' => 'nullable|integer|min:1',
            'slot_interval_min' => 'nullable|integer|min:1',
            'is_active' => 'sometimes|boolean',
        ]);

        // ACTUALIZAR
        $service->update($validated);

        // RESPUESTA
        return response()->json([
            'message' => 'Servicio actualizado correctamente',
            'data' => $service
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
