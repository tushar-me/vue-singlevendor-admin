<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        return response()->json(Salary::all());
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'emp_id' => 'required',
            'amount' => 'required',
            'month' => 'required',
        ]);

        $emp = Salary::where('emp_id', $request->emp_id)->where('month', $request->month)->first();
        if ($emp){
            return response()->json(['message' =>'Employee Salary Already Paid In This Month...'], 500);
        }else{
            $data = $request->all();
            $data['date'] = date('d/m/y');
            $data['year'] = date('Y');
            Salary::create($data);
            return response()->json(['message' =>'Salary Pay successfully done.'], 200);
        }

    }
    public function show(Salary $salary)
    {
        return response()->json($salary);
    }
    public function update(Request $request, Salary $salary)
    {
        $data = $request->all();
        $salary->update($data);
        return response()->json(['message' =>'Salary update successfully done.'], 200);
    }
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return response()->json(['message' =>'Salary delete successfully done.'], 200);
    }
    public function monthSalary($id){
        $salary = Salary::with('employees')->where('month', $id)->first();
        return response()->json($salary);
    }
}
