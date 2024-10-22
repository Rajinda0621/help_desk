<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Display all departments
    public function index()

    {
        
        $departments = Department::with('headOfDepartment')->get();
        $users = User::all();
        return view('departments.index', compact('departments','users'));
    }

    // Show form to create a new department
    public function create()
    {
        return view('departments.create');
    }

    // Store the new department
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments',
        ]);

        Department::create($request->only('name'));

        return redirect()->route('departments.index')->with('success', 'Department created successfully!');
    }

    // Show form to edit a department
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    // Update a department
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
        ]);

        $department->update($request->only('name'));

        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }

    // Delete a department
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully!');
    }

    // Assign a head of department
    public function assignHead(Request $request, Department $department)
    {

        \Log::info('Received request to assign head of department', [
            'user_id' => $request->user_id,
            'department_id' => $department->id
        ]);
    // Validate that the user exists
    $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    // Update the department with the new head of department
    $department->update(['head_of_department_id' => $request->user_id]);

    return redirect()->route('departments.index')->with('success', 'Head of department assigned successfully!');
}

}
