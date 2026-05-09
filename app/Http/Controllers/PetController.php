<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json([
            'data' => Pet::where(
               'owner_user_id',
                $request->user()->id
            )->get()
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
         // VALIDACIÓN DE DATOS
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'species' => 'required|string|max:255',
        'breed' => 'nullable|string|max:255',
        'size' => 'nullable|string|max:50',
        'birth_date' => 'nullable|date',
        'care_notes' => 'nullable|string',
        'photo_path' => 'nullable|string',
    ]);

    // CREAR MASCOTA
    $pet = Pet::create([
        ...$validated,
        // OWNER DESDE USUARIO AUTENTICADO
        'owner_user_id' => $request->user()->id,
    ]);

    // RESPUESTA
    return response()->json([
        'message' => 'Mascota creada correctamente',
        'data' => $pet
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Pet $pet)
    {
            // Verificar ownership
        if ($pet->owner_user_id !== $request->user()->id) {

            return response()->json([
                'message' => 'No tienes permisos para acceder a esta mascota'
            ], 403);
        }

        // Respuesta correcta
        return response()->json([
            'data' => $pet
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        // Verificar ownership
        if ($pet->owner_user_id !== $request->user()->id) {

            return response()->json([
                'message' => 'No tienes permisos para modificar esta mascota'
            ], 403);
        }

        // VALIDACIÓN
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'species' => 'sometimes|string|max:255',
            'breed' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:50',
            'birth_date' => 'nullable|date',
            'care_notes' => 'nullable|string',
            'photo_path' => 'nullable|string',
        ]);

    $pet->update($validated);

    return response()->json([
        'message' => 'Mascota actualizada',
        'data' => $pet
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        
    // Verificar ownership
    if ($pet->owner_user_id !== $request->user()->id) {

        return response()->json([
            'message' => 'No tienes permisos para modificar esta mascota'
        ], 403);
    }
    
    $pet->delete();

    return response()->json([
        'message' => 'Mascota eliminada'
    ]);
    }

    public function staffIndex()
    {
        return response()->json([
            'data' => Pet::with('owner')->get()
        ]);
    }

    public function staffShow(Pet $pet)
    {
        return response()->json([
            'data' => $pet->load('owner')
        ]);
    }
}
