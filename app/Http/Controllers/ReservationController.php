<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json([
            'data' => Reservation::with([
                'pet',
                'service',
                'resource'
            ])
            ->where(
                'client_user_id',
                $request->user()->id
            )
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
            'pet_id' => 'required|exists:pets,id',
            'service_id' => 'required|exists:services,id',
            'resource_id' => 'nullable|exists:resources,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'notes' => 'nullable|string',
        ]);

        // BUSCAR MASCOTA
        $pet = \App\Models\Pet::findOrFail(
            $validated['pet_id']
        );

        // VERIFICAR OWNERSHIP
        if ($pet->owner_user_id !== $request->user()->id) {

            return response()->json([
                'message' => 'No puedes crear reservas para mascotas ajenas'
            ], 403);
        }

        // CREAR RESERVA
        $reservation = Reservation::create([

            ...$validated,

            'client_user_id' => $request->user()->id,

            'status' => 'pending',
        ]);

        // RESPUESTA
        return response()->json([
            'message' => 'Reserva creada correctamente',
            'data' => $reservation->load([
                'pet',
                'service',
                'resource'
            ])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Reservation $reservation)
    {
        // VERIFICAR OWNERSHIP
        if ($reservation->client_user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'No tienes permisos para acceder a esta reserva'
            ], 403);
        }
        return response()->json([
            'data' => $reservation->load([
                'pet',
                'service',
                'resource'
            ])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        // VERIFICAR OWNERSHIP
        if ($reservation->client_user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'No tienes permisos para modificar esta reserva'
            ], 403);
        }

        // VALIDACIÓN
        $validated = $request->validate([
            'start_at' => 'sometimes|date',
            'end_at' => 'sometimes|date|after:start_at',
            'notes' => 'nullable|string',
        ]);

        // ACTUALIZAR
        $reservation->update($validated);
        return response()->json([
            'message' => 'Reserva actualizada',
            'data' => $reservation
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Reservation $reservation)
    {
        // VERIFICAR OWNERSHIP
        if ($reservation->client_user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'No tienes permisos para eliminar esta reserva'
            ], 403);
        }

        $reservation->delete();

        return response()->json([
            'message' => 'Reserva eliminada'
        ]);
    }

    public function cancel(Request $request, Reservation $reservation)
    {
        // VERIFICAR OWNERSHIP
        if ($reservation->client_user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'No tienes permisos para cancelar esta reserva'
            ], 403);
        }

        // CAMBIAR ESTADO
        $reservation->update([
            'status' => 'cancelled'
        ]);
        return response()->json([
            'message' => 'Reserva cancelada correctamente',
            'data' => $reservation
        ]);
    }

    public function staffIndex()
    {
        return response()->json([
            'data' => Reservation::with([
                'client',
                'pet',
                'service',
                'resource'
            ])->get()
        ]);
    }

    public function staffShow(Reservation $reservation)
    {
        return response()->json([
            'data' => $reservation->load([
                'client',
                'pet',
                'service',
                'resource'
            ])
        ]);
    }

    public function staffUpdate(Request $request, Reservation $reservation)
    {
        // VALIDACIÓN
        $validated = $request->validate([
            'resource_id' => 'nullable|exists:resources,id',
            'start_at' => 'sometimes|date',
            'end_at' => 'sometimes|date|after:start_at',
            'status' => 'sometimes|string|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);

        // ACTUALIZAR
        $reservation->update($validated);

        // RESPUESTA
        return response()->json([
            'message' => 'Reserva actualizada correctamente',
            'data' => $reservation->load([
                'client',
                'pet',
                'service',
                'resource'
            ])
        ]);
    }

    public function staffStore(Request $request)
    {
        // VALIDACIÓN
        $validated = $request->validate([
            'client_user_id' => 'required|exists:users,id',
            'pet_id' => 'required|exists:pets,id',
            'service_id' => 'required|exists:services,id',
            'resource_id' => 'nullable|exists:resources,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'notes' => 'nullable|string',
        ]);

        // BUSCAR MASCOTA
        $pet = \App\Models\Pet::findOrFail(
            $validated['pet_id']
        );

        // VERIFICAR QUE LA MASCOTA PERTENECE AL CLIENTE
        if ($pet->owner_user_id !== (int)$validated['client_user_id']) {
            return response()->json([
                'message' => 'La mascota no pertenece al cliente indicado'
            ], 422);
        }

        // CREAR RESERVA
        $reservation = Reservation::create([
            ...$validated,
            'status' => 'confirmed',
        ]);

        // RESPUESTA
        return response()->json([
            'message' => 'Reserva creada correctamente',
            'data' => $reservation->load([
                'client',
                'pet',
                'service',
                'resource'
            ])
        ], 201);
    }
}
