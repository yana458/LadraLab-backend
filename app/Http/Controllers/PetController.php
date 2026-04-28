<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
        'data' => Pet::all()
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
        'user_id' => 'required|exists:users,id',
        'name' => 'required|string|max:255',
        'species' => 'required|string|max:255',
        'breed' => 'nullable|string|max:255',
        'age' => 'nullable|integer|min:0',
    ]);

    // CREAR MASCOTA
    $pet = Pet::create($validated);

    // RESPUESTA
    return response()->json([
        'message' => 'Mascota creada correctamente',
        'data' => $pet
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
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
        $validated = $request->validate([
        'name' => 'sometimes|string|max:255',
        'species' => 'sometimes|string|max:255',
        'breed' => 'nullable|string|max:255',
        'age' => 'nullable|integer|min:0',
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
         $pet->delete();

    return response()->json([
        'message' => 'Mascota eliminada'
    ]);
    }
}
