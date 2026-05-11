<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function availability(Request $request, Service $service)
    {
        // VALIDACIÓN
        $request->validate([
            'date' => ['required', 'date_format:Y-m-d'],
        ]);

        // SOLO PARA SERVICIOS TIME SLOT
        if ($service->booking_mode !== 'time_slot') {
            return response()->json([
                'data' => [],
            ]);
        }

        // FECHA
        $date = $request->query('date');

        // HORAS DEL SERVICIO
        $startMinutes = $this->timeToMinutes(
            $service->default_start_time
        );

        $endMinutes = $this->timeToMinutes(
            $service->default_end_time
        );

        // CONFIGURACIÓN
        $duration = (int) (
            $service->duration_minutes ?? 60
        );

        $interval = (int) (
            $service->slot_interval_min ?? 60
        );

        // HORAS YA RESERVADAS
        $reservedTimes = Reservation::query()
            ->where('service_id', $service->id)
            ->whereIn('status', [
                'pending',
                'confirmed'
            ])
            ->whereDate('start_at', $date)
            ->pluck('start_at')
            ->map(fn ($startAt) =>
                Carbon::parse($startAt)->format('H:i')
            )
            ->toArray();

        // GENERAR SLOTS
        $slots = [];

        for (
            $minutes = $startMinutes;
            $minutes + $duration <= $endMinutes;
            $minutes += $interval
        ) {

            $time = $this->minutesToTime($minutes);

            // SI NO ESTÁ RESERVADO
            if (!in_array($time, $reservedTimes, true)) {
                $slots[] = [
                    'value' => $time,
                    'label' => $time,
                ];
            }
        }

        // RESPUESTA
        return response()->json([
            'data' => $slots,
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

    private function timeToMinutes(?string $time): int
    {
        if (!$time) {
            return 0;
        }

        [$hours, $minutes] = explode(
            ':',
            substr($time, 0, 5)
        );

        return ((int) $hours * 60)
            + (int) $minutes;
    }

    private function minutesToTime(int $minutes): string
    {
        $hours = floor($minutes / 60);

        $mins = $minutes % 60;

        return str_pad(
            $hours,
            2,
            '0',
            STR_PAD_LEFT
        )

        . ':'

        . str_pad(
            $mins,
            2,
            '0',
            STR_PAD_LEFT
        );
    }
}
