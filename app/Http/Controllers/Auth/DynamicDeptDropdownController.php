<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DynamicDeptDropdownController extends Controller
{
    // public function fetchData(){
    //     $data = Department::all();
    //      return route('/department-dropdown',['data' => $data]);
    // }
    // public function fetchData() {
    //     $data = Department::all();
    //     return response()->json($data);
    // }
    // public function fetchData(){
    // $departments = Department::all();
    // return view('department-dropdown', compact('departments'));
    //return view('/department-dropdown',['data' => $data]);
    public function fetchData(){
        $departments = DB::select('select * from departments');
        return view('department-dropdown', compact('departments'));
    }
    protected $table = 'departments';

}
    

