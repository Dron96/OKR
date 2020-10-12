<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\KeyResult;
use Illuminate\Http\Request;

class KeyResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Goal $goal)
    {
        return $goal->keyResults;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Goal $goal)
    {
        $input = $request->toArray();
        $input['goal_id'] = $goal->id;

        return KeyResult::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function show(KeyResult $keyResult)
    {
        return $keyResult;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param KeyResult $keyResult
     * @return KeyResult
     */
    public function update(Request $request, KeyResult $keyResult)
    {
        $input = $request->toArray();
        $keyResult->fill($input);
        $keyResult->save();

        return $keyResult;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(KeyResult $keyResult)
    {
        $keyResult->delete();

        return response()->json(['message' => 'Ключевой результат успешно удален'], 200);
    }
}
