<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(Student::all());
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'subject_id' => 'required'
        ]);
        Student::create($request->all());
        return  response()->json("data save successfully done...");
    }
    public function show($id)
    {
        return response()->json(Student::findOrFail($id));
    }
    public function update(Request $request, $id)
    {
        $data = Student::findOrFail($id);
        $data->update($request->all());
        return  response()->json("data updated successfully done.");
    }
    public function destroy($id)
    {
        $data = Student::findOrFail($id);
        @unlink($data->photo);
            $data->delete();
        return  response()->json("data Deleted successfully done.");
    }
}
