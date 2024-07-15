<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Producto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $productos = Producto::latest()->get();

        return response()->json($productos, Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request): JsonResponse
    {
        $producto = Producto::create($request->validated());

        return response()->json($producto, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $producto = Producto::findOrFail($id);

        return response()->json($producto, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, string $id): JsonResponse
    {
        try {
            $producto = Producto::findOrFail($id);

            $producto->update($request->validated());

            return response()->json($producto, Response::HTTP_OK);
        } catch (ValidationException $excepcion) {
            return response()->json($excepcion->validator->errors(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $producto = Producto::findOrFail($id);

        $producto->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
