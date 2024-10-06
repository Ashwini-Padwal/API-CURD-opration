<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    function list(){
        return Student::all();
    }
    function addStudent(Request $request){
        $rules=array(
            "first_name"=>'required | min:2 |max:10',
            "last_name"=>'required | min:2| max:10',
            "age"=>'required | min:1 | max:3',
            "marks"=>'required | min:2 | max:3'
        );
        $validation=Validator::make($request->all(),$rules);
        if($validation->fails()){
                return $validation->errors();
        }else{
        $student=new Student();
        $student->student_id=$request->student_id;        
        $student->first_name=$request->first_name;
        $student->last_name=$request->last_name;
        $student->age=$request->age;
        $student->marks=$request->marks;
        if($student->save()){
            return ['result'=>'Data Added Successfully'];
            //return 'data added';
        }else{
            return ['result'=>'Error'];
            //return 'Error';
        }
        }
    }

    function updateStudent(Request $request){
        $student= Student::find($request->student_id);
        $student->first_name=$request->first_name;
        $student->last_name=$request->last_name;
        $student->age=$request->age;
        $student->marks=$request->marks;
        if($student->save()){
            return ['result'=>'Data Updated Successfully'];
            //return 'data added';
        }else{
            return ['result'=>'Error'];
            //return 'Error';
        }

    }
    function deleteStudent($id){
        $student=Student::destroy($id);
        if($student){
            return ['result'=>'Data Deleted'];
        }else{
            return ['result'=>'Data not Deleted'];
        }
    }
    function searchStudent($name){
        $student=Student::where('first_name','like',"%$name%")->get();
        if($student){
            return ['result'=>$student];
        }else{
            return ['result'=>'No Data Found'];
        }
    }
}
