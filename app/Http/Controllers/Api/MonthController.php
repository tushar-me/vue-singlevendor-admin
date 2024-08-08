<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Month;
use Illuminate\Http\Request;

class MonthController extends Controller
{
    public function index(){
        return response()->json(Month::all());
    }

    public function employeeSalary($id){
        return response()->json(Employee::with('salaries')->findOrFail($id)) ;
    }
}
