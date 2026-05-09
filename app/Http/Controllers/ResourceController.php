<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Resource::orderBy('name')->get()
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
            'name' => 'required|string|max:80',
            'type' => 'required|string|in:kennel,yard,room,other',
            'zone' => 'required|string|in:hotel,daycare,support',
            'size_group' => 'required|string|in:toy_small,medium,large,all',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string|in:active,cleaning,disabled',
        ]);
        // CREAR RECURSO
        $resource = Resource::create($validated);
        // RESPUESTA
        return response()->json([
            'message' => 'Recurso creado correctamente',
            'data' => $resource
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        return response()->json([
            'data' => $resource
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        // VALIDACIÓN
        $validated = $request->validate([
            'name' => 'sometimes|string|max:80',
            'type' => 'sometimes|string|in:kennel,yard,room,other',
            'zone' => 'sometimes|string|in:hotel,daycare,support',
            'size_group' => 'sometimes|string|in:toy_small,medium,large,all',
            'capacity' => 'sometimes|integer|min:1',
            'status' => 'sometimes|string|in:active,cleaning,disabled',
        ]);

        // ACTUALIZAR
        $resource->update($validated);

        // RESPUESTA
        return response()->json([
            'message' => 'Recurso actualizado correctamente',
            'data' => $resource
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();

        return response()->json([
            'message' => 'Recurso eliminado correctamente'
        ]);
    }
}
