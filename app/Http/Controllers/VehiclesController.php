<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicles; // Importar el modelo de vehiculos

class VehiclesController extends Controller
{
    /**
     * @OA\Get(
     *     path="vehicles",
     *     summary="Obtener todos los vehiculos",
     *     tags={"Vehiculos"},
     *     @OA\Response(
     *         response=200,
     *         description="Devuelve una lista de todos los vehiculos.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Vehicle")
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        // Lógica para obtener todos los vehiculos desde la base de datos
        $vehicles = Vehicles::all();
        return response()->json($vehicles);
    }

    /**
     * @OA\Get(
     *     path="vehicles/{id}",
     *     summary="Obtener un vehiculo",
     *     tags={"Vehiculo"},
     *     @OA\Response(
     *         response=200,
     *         description="Devuelve un vehiculo por ID desde la base de datos.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Vehicle")
     *         ),
     *     ),
     * )
     */
    public function show($id)
    {
        // Lógica para obtener un vehiculo por ID desde la base de datos
        $vehicles = Vehicles::findOrFail($id);
        return response()->json($vehicles);
    }

    /**
     * @OA\Post(
     *     path="vehicles",
     *     summary="Crear un vehiculo",
     *     tags={"C_Vehiculo"},
     *     @OA\Response(
     *         response=200,
     *         description="Crear un vehiculo en la base de datos.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Vehicle")
     *         ),
     *     ),
     * )
     */
    public function store(Request $request)
    {
        // Lógica para crear un nuevo vehiculo en la base de datos
        $data = $request->validate([
            'name' => 'required|string',
            'model' => 'required|string',
            'vehicle_class' => 'string',
            'manufacturer' => 'string',
            'length' => 'string',
            'cost_in_credits' => 'string',
            'crew' => 'string',
            'passengers' => 'string',
            'max_atmosphering_speed' => 'string',
            'cargo_capacity' => 'string',
            'consumables' => 'string',
            'films' => 'string',
            'pilots' => 'string',
            'url' => 'string',
            'created' => 'string',
            'edited' => 'string',
            'count' => 'required|integer' // Campo para el inventario
        ]);
    
        // Crea un nuevo registro en la base de datos con el conteo inicial especificado
        $vehicles = Vehicles::create([
            'name' => $data['name'],
            'model' => $data['model'],
            'vehicle_class' => $data['vehicle_class'],
            'manufacturer' => $data['manufacturer'],
            'length' => $data['length'],
            'cost_in_credits' => $data['cost_in_credits'],
            'crew' => $data['crew'],
            'passengers' => $data['passengers'],
            'max_atmosphering_speed' => $data['max_atmosphering_speed'],
            'cargo_capacity' => $data['cargo_capacity'],
            'consumables' => $data['consumables'],
            'films' => $data['films'],
            'pilots' => $data['pilots'],
            'url' => $data['url'],
            'created' => $data['created'],
            'edited' => $data['edited'],
            'count' => $data['count']
        ]);

        return response()->json($vehicles, 201);
    }

    /**
     * @OA\Put(
     *     path="vehicles/{id}",
     *     summary="Actualizar un vehiculo",
     *     tags={"A_Vehiculo"},
     *     @OA\Response(
     *         response=200,
     *         description="Actualizar un vehiculo por ID desde la base de datos.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Vehicle")
     *         ),
     *     ),
     * )
     */
    public function update(Request $request, $id)
    {
        // Lógica para actualizar un vehiculo por ID en la base de datos
        $data = $request->validate([
            'name' => 'string',
            'model' => 'string',
            'vehicle_class' => 'string',
            'manufacturer' => 'string',
            'length' => 'string',
            'cost_in_credits' => 'string',
            'crew' => 'string',
            'passengers' => 'string',
            'max_atmosphering_speed' => 'string',
            'cargo_capacity' => 'string',
            'consumables' => 'string',
            'films' => 'string',
            'pilots' => 'string',
            'url' => 'string',
            'created' => 'string',
            'edited' => 'string',
            'count' => 'integer' // Campo para el inventario
        ]);
    
        $vehicles = Vehicles::findOrFail($id);
        $vehicles->update($data);
    
        return response()->json($vehicles);
    }

    /**
     * @OA\Delete(
     *     path="vehicles/{id}",
     *     summary="Eliminar un vehiculo",
     *     tags={"E_Vehiculo"},
     *     @OA\Response(
     *         response=200,
     *         description="Eliminar un vehiculo por ID desde la base de datos.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Vehicle")
     *         ),
     *     ),
     * )
     */
    public function destroy($id)
    {
        // Lógica para eliminar un vehiculo por ID de la base de datos
        $vehicles = Vehicles::findOrFail($id);

        // Disminuye el conteo en 1 antes de eliminar el registro
        if ($vehicles->count > 0) {
            $vehicles->count -= 1;
            $vehicles->save();
        } else {
            return response()->json(['error' => 'No hay naves para eliminar'], 400);
        }

        $vehicles->delete();

        return response()->json(null, 204);
    }
}
