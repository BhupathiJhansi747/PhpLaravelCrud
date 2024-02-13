<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class StudentController extends Controller
{
  //get all students function
    public function index()
    {
        $students = Student::all();
        if ($students->count() > 0) {
            return response()->json([
                'status' => 200,
                'students' => $students
            ], 200);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'no records found'


            ], 404);
        }
    }
    //add student function
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'mobile' => 'required|max:191',
            'age' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->message()
            ], 422);
        } else {
            $student = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'age' => $request->age,
            ]);
            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => "student created successfully"

                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "something went wrong"

                ], 500);
            }
        }
    }
        //getbyid student function
        public function show($id){
            $student=Student::find($id);
            if ($student) {
                return response()->json([
                    'status' => 200,
                    'student' => $student

                ], 200);
            }else {
                return response()->json([
                    'status' => 404,
                    'message' => "No such found student"

                ], 404);
            }


        }
        public function edit($id){
            $student=Student::find($id);
            if ($student) {
                return response()->json([
                    'status' => 200,
                    'student' => $student

                ], 200);
            }else {
                return response()->json([
                    'status' => 404,
                    'message' => "No such found student"

                ], 404);
            }
        }
        //update student function
        public function update(Request $request,int $id){

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:191',
                'email' => 'required|email|max:191',
                'mobile' => 'required|max:191',
                'age' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'error' => $validator->message()
                ], 422);
            } else {
                $student = Student::find($id);

                if ($student) {
                    $student->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'mobile' => $request->mobile,
                        'age' => $request->age,
                    ]);
                    return response()->json([
                        'status' => 200,
                        'message' => "student updated successfully"

                    ], 200);
                } else {
                    return response()->json([
                        'status' => 404,
                        'message' => "something went wrong"

                    ], 404);
                }
            }
        }
        //delete student function
        public function destroy($id){
            $student=Student::find($id);
            if ($student) {
          $student->delete();
          return response()->json([
            'status' => 200,
            'message' => "student successfully deleted"

        ], 200);

            }else {
                return response()->json([
                    'status' => 404,
                    'message' => "No such found student"

                ], 404);
            }

        }


}
