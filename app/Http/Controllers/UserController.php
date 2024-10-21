<?php



namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;

// class UserController extends Controller
// {
//     public function index() {
//         $users = User::with(['roles', 'department'])->paginate(10); 
//         return view('users', compact('users'));
//     }
// }

// User assign test 01

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index()
    {
        // Get all users with their roles
        $users = User::with('roles')->get();

        // Pass users to the view
        return view('users', compact('users'));
    }

    public function assignRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        // Remove all current roles and assign the new role
        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'Role assigned successfully!');
    }
}


