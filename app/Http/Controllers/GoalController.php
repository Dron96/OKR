<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Goal[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return Goal::with('author')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('createGoal', auth()->user());
        $input = $request->toArray();
        $input['author'] = auth()->id();
        $input['command'] = auth()->user()->command;
        $goal = Goal::create($input);

        return $goal;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Goal|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function show(Goal $goal)
    {
        return $goal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Goal $goal
     * @return Goal
     */
    public function update(Request $request, Goal $goal)
    {
        $input = $request->toArray();
        $goal->fill($input);
        $goal->save();

        return $goal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Goal $goal)
    {
        $keyResuts = $goal->keyResults;
        foreach ($keyResuts as $keyResut) {
            $performers = $keyResut->performers;
            $performers->users()->detach();
            $performers->delete();
            $keyResut->delete();
        }
        $goal->delete();

        return response()->json(['message' => 'Цель и ее ключевые результаты успешно удалены'], 200);
    }

    public function sendForCheck(Goal $goal)
    {
        $goal->update(['status' => 'proposed']);

        return $goal;
    }

    public function reject(Goal $goal)
    {
        $goal->update(['status' => 'rejected']);

        return $goal;
    }

    public function approve(Goal $goal)
    {
        $goal->update(['status' => 'approved']);

        return $goal;
    }
}
