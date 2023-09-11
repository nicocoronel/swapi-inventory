<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Starships; // Importar el modelo de naves espaciales

class StarshipsController extends Controller
{
    /**
     * @OA\Get(
     *     path="starships",
     *     summary="Obtener todas las naves espaciales",
     *     tags={"Naves Espaciales"},
     *     @OA\Response(
     *         response=200,
     *         description="Devuelve una lista de todas las naves espaciales.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Starship")
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        // Lógica para obtener todas las naves espaciales desde la base de datos
        $starships = Starships::all();
        return response()->json($starships);
    }

    /**
     * @OA\Get(
     *     path="starships/{id}",
     *     summary="Obtener una nave espacial",
     *     tags={"Nave Espacial"},
     *     @OA\Response(
     *         response=200,
     *         description="Devuelve una nave espacial por ID desde la base de datos.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Starship")
     *         ),
     *     ),
     * )
     */
    public function show($id)
    {
        // Lógica para obtener una nave espacial por ID desde la base de datos
        $starships = Starships::findOrFail($id);
        return response()->json($starships);
    }

    /**
     * @OA\Post(
     *     path="starships",
     *     summary="Crear una nave espacial",
     *     tags={"C_Nave Espacial"},
     *     @OA\Response(
     *         response=200,
     *         description="Crear una nave espacial en la base de datos.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Starship")
     *         ),
     *     ),
     * )
     */
    public function store(Request $request)
    {
        // Lógica para crear una nueva nave espacial en la base de datos
        $data = $request->validate([
            'name' => 'required|string',
            'model' => 'required|string',
            'starship_class' => 'string',
            'manufacturer' => 'string',
            'cost_in_credits' => 'string',
            'length' => 'string',
            'crew' => 'string',
            'passengers' => 'string',
            'max_atmosphering_speed' => 'string',
            'hyperdrive_rating' => 'string',
            'MGLT' => 'string',
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
        $starships = Starships::create([
            'name' => $data['name'],
            'model' => $data['model'],
            'starship_class' => $data['starship_class'],
            'manufacturer' => $data['manufacturer'],
            'cost_in_credits' => $data['cost_in_credits'],
            'length' => $data['length'],
            'crew' => $data['crew'],
            'passengers' => $data['passengers'],
            'max_atmosphering_speed' => $data['max_atmosphering_speed'],
            'hyperdrive_rating' => $data['hyperdrive_rating'],
            'MGLT' => $data['MGLT'],
            'cargo_capacity' => $data['cargo_capacity'],
            'consumables' => $data['consumables'],
            'films' => $data['films'],
            'pilots' => $data['pilots'],
            'url' => $data['url'],
            'created' => $data['created'],
            'edited' => $data['edited'],
            'count' => $data['count']
        ]);
    
        return response()->json($starships, 201);
    }

    /**
     * @OA\Put(
     *     path="starships/{id}",
     *     summary="Actualizar una nave espacial",
     *     tags={"A_Nave Espacial"},
     *     @OA\Response(
     *         response=200,
     *         description="Actualizar una nave espacial por ID desde la base de datos.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Starship")
     *         ),
     *     ),
     * )
     */
    public function update(Request $request, $id)
    {
        // Lógica para actualizar una nave espacial por ID en la base de datos
        $data = $request->validate([
            'name' => 'string',
            'model' => 'string',
            'starship_class' => 'string',
            'manufacturer' => 'string',
            'cost_in_credits' => 'string',
            'length' => 'string',
            'crew' => 'string',
            'passengers' => 'string',
            'max_atmosphering_speed' => 'string',
            'hyperdrive_rating' => 'string',
            'MGLT' => 'string',
            'cargo_capacity' => 'string',
            'consumables' => 'string',
            'films' => 'string',
            'pilots' => 'string',
            'url' => 'string',
            'created' => 'string',
            'edited' => 'string',
            'count' => 'integer' // Campo para el inventario
        ]);
    
        $starships = Starships::findOrFail($id);
        $starships->update($data);
    
        return response()->json($starships);
    }

    /**
     * @OA\Delete(
     *     path="starships/{id}",
     *     summary="Eliminar una nave espacial",
     *     tags={"E_Nave Espacial"},
     *     @OA\Response(
     *         response=200,
     *         description="Eliminar una nave espacial por ID desde la base de datos.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Starship")
     *         ),
     *     ),
     * )
     */
    public function destroy($id)
    {
        // Lógica para eliminar una nave espacial por ID de la base de datos
        $starships = Starships::findOrFail($id);

        // Disminuye el conteo en 1 antes de eliminar el registro
        if ($starships->count > 0) {
            $starships->count -= 1;
            $starships->save();
        } else {
            return response()->json(['error' => 'No hay naves para eliminar'], 400);
        }

        $starships->delete();

        return response()->json(null, 204);
    }
}
