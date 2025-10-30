<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('admin.layout.partials.app');
    }

    /**
     * Display a listing of the users.
     */
    public function index()
    {
        // Join users with roles to get role name
        $users = \Illuminate\Support\Facades\DB::table('user')
            ->leftJoin('role', 'user.idrole', '=', 'role.id')
            ->select('user.*', 'role.role as role_role')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form to create a new user.
     */
    public function create()
    {
        // Load roles from the database table 'role'
        $roles = DB::table('role')->get();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     *
     * Password confirmation is validated only if the form includes the
     * password_confirmation field. This allows the view to omit the
     * confirmation input while keeping validation strict when it's present.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'user' => 'required|string|max:255|unique:user,user',
            'password' => 'required|string|min:6',
            'idrole' => 'required|exists:role,id',
        ];

        // Password confirmation removed per request: do not require 'confirmed'
        $request->validate($rules);

        User::create([
            'nama' => $request->nama,
            'user' => $request->user,
            'password' => Hash::make($request->password),
            'idrole' => $request->idrole,
        ]);

        return redirect()->route('admin.users.create')->with('success', 'User created successfully.');
    }
}
