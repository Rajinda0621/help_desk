<?php



namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;



class UserController extends Controller
{
    public function index(Request $request)
    {
        // Get the search input
        $search = $request->input('search');

        // Query users by name or role based on the search input
        $users = User::with('roles')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhereHas('roles', function ($query) use ($search) {
                          $query->where('name', 'like', "%{$search}%");
                      });
            })
            ->paginate(10);

        // Pass users and the search query to the view
        return view('users', compact('users', 'search'));
    }

    public function assignRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        // Remove all current roles and assign the new role
        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'Role assigned successfully!');
    }
}


