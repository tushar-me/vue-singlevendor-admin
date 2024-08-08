<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        return response()->json(Expense::all());
    }
    public function store(Request $request)
    {
        $data = $request->all();
        Expense::create($data);
        return response()->json(['message' =>'Expense save successfully done.'], 200);
    }
    public function show(Expense $expense)
    {
        return response()->json($expense);
    }
    public function update(Request $request, Expense $expense)
    {
        $data = $request->all();
        $expense->update($data);
        return response()->json(['message' =>'Expense update successfully done.'], 200);
    }
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json(['message' =>'Expense delete successfully done.'], 200);
    }
}
