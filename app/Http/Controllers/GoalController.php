<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use App\Models\Expense;

class GoalController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goals = Goal::with('expenses')->get();
        $unassignedExpenses = Expense::whereNull('goal_id')->get();

        return view('goals.index', compact('goals', 'unassignedExpenses'));
    }

    public function assignExpense(Request $request, Goal $goal)
    {
        $validated = $request->validate([
            'expense_id' => 'required|exists:expenses,id',
        ]);

        $expense = Expense::find($validated['expense_id']);
        $expense->goal_id = $goal->id;
        $expense->save();

        return redirect()->route('goals.index')->with('success', 'Expense assigned to goal.');
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Goal::create($validated);

        return redirect()->route('goals.index')->with('success', 'Goal created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Goal $goal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Goal $goal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Goal $goal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();

        return redirect()->route('goals.index')->with('success', 'Goal deleted successfully.');
    }
}
