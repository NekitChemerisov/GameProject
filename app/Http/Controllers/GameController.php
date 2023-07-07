<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{   
    /**
     * Выводит все игры
     * 
     * @OA\Get (
     *     path="/api/game",
     *     tags={"Game"},
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="meta", type="object",
     *                  @OA\Property(property="code", type="number", example=200),
     *                  @OA\Property(property="status", type="string", example="success"),
     *                  @OA\Property(property="message", type="string", example=null),
     *              ),
     *          ),
     *     ),
     * )
     */
    public function index()
    {
        $games = Game::all();
        return response()->json($games);
    }

    /**
     * Возвращаем представление формы создания игры
     * 
     * @OA\Get (
     *     path="/api/game/create",
     *     tags={"Game"},
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="meta", type="object",
     *                  @OA\Property(property="code", type="number", example=200),
     *                  @OA\Property(property="status", type="string", example="success"),
     *                  @OA\Property(property="message", type="string", example=null),
     *              ),
     *          ),
     *     ),
     * )
     */
    public function create()
    {
        return view('game.create');
    }

    /**
     * Добавляет игру в БД
     * 
     * @OA\Post (
     *     path="/api/game/store",
     *     tags={"Game"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      property="name",
     *                      type="string"
     *                 ),
     *                 @OA\Property(
     *                      property="description",
     *                      type="text"
     *                 )
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="meta", type="object",
     *                  @OA\Property(property="code", type="number", example=200),
     *                  @OA\Property(property="status", type="string", example="success"),
     *                  @OA\Property(property="message", type="string", example=null),
     *              ),
     *          ),
     *     ),
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Game::create($request->all());
        return response()->json(['message' => 'Game created successfully'], 200);
    }

    /**
     * Выводит полную информацию о игре
     * 
     * @OA\Get (
     *     path="/api/game/show/{id}",
     *     tags={"Game"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID игры",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="meta", type="object",
     *                  @OA\Property(property="code", type="number", example=200),
     *                  @OA\Property(property="status", type="string", example="success"),
     *                  @OA\Property(property="message", type="string", example=null),
     *              ),
     *          ),
     *     ),
     * )
     */
    public function show($id)
    {
        $game = Game::find($id);

        if ($game) {
            return response()->json($game);
        } else {
            return response()->json(['message' => 'Game not found'], 404);
        }
    }

    /**
     * Обновляет информацию о игре
     * 
     * @OA\Put (
     *     path="/api/game/update/{id}",
     *     tags={"Game"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID игры",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      property="name",
     *                      type="string"
     *                 ),
     *                 @OA\Property(
     *                      property="description",
     *                      type="text"
     *                 )
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="meta", type="object",
     *                  @OA\Property(property="code", type="number", example=200),
     *                  @OA\Property(property="status", type="string", example="success"),
     *                  @OA\Property(property="message", type="string", example=null),
     *              ),
     *          ),
     *     ),
     * )
     */
    public function update(Request $request, $id)
    {
        //Для работы кода нужно указать метод внутри формы {{ method_field ('PUT')}}
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $game = Game::findOrFail($id);

        if ($game) {
            $game->name = $request->input('name');
            $game->description = $request->input('description');
            $game->save();

            return response()->json(['message' => 'Game updated successfully']);
        } else {
            return response()->json(['message' => 'Game not found']);
        }
    }

    /**
     * Удаляет игру
     * 
     * @OA\Delete (
     *     path="/api/game/delete/{id}",
     *     tags={"Game"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID игры",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="meta", type="object",
     *                  @OA\Property(property="code", type="number", example=200),
     *                  @OA\Property(property="status", type="string", example="success"),
     *                  @OA\Property(property="message", type="string", example=null),
     *              ),
     *          ),
     *     ),
     * )
     */
    public function destroy($id)
    {
        $game = Game::find($id);

        if ($game) {
            $game->delete();
            return response()->json(['message' => 'Game deleted successfully']);
        } else {
            return response()->json(['message' => 'Game not found'], 404);
        }
    }
}