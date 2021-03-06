<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\KeyResult;
use App\Models\Performers;
use Illuminate\Http\Request;

class KeyResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Goal $goal)
    {
        return $goal->keyResults()->with('performers.users')->get();
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
        $keyResult = KeyResult::create($input);
        Performers::create(['key_results_id' => $keyResult->id]);

        return $keyResult;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return KeyResult
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

        $goal = $keyResult->goal;
        $percent = 0;
        foreach ($goal->keyResults as $keyResult) {
            $percent += $keyResult->weight * $keyResult->percent / 100;
        }
        $goal['percentOfCompletion'] = (integer)$percent;
        $goal->save();

        return $keyResult;
    }

    public function addUserToPerformers(KeyResult $keyResult, Request $request)
    {
        $performers = $keyResult->performers;
        $performers->users()->detach();
        $performers->users()->attach($request->users);

        return response()->json(['Исполнители' => $performers->users]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(KeyResult $keyResult)
    {
        $performers = $keyResult->performers;
        $performers->users()->detach();
        $performers->delete();
        $keyResult->delete();

        return response()->json(['message' => 'Ключевой результат успешно удален'], 200);
    }
}
