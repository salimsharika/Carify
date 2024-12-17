<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard (for regular users).
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the Admin Dashboard with all users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminDashboard()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    /**
     * Show the form to edit a user.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editUser(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    /**
     * Update the user in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'usertype' => 'required|string|in:admin,user', // ensure valid usertype
        ]);

        $user->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser(User $user)
    {
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }
}
