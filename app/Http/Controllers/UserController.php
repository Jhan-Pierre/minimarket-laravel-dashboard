<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        return view('admin.users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', // Cambiado a nullable
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]);
    
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if ($request->filled('password')) { // Verifica si se proporciona una nueva contraseña
            $user->password = Hash::make($validatedData['password']); // Usa Hash::make() para hashear la nueva contraseña
        }
        $user->save();
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index', $user)->with('info', 'Usuario actualizado con éxito');
    }
    
    public function create(){
        $roles = Role::all(); 
        return view("admin.users.create", compact('roles'));
    }

    public function store(Request $request, User $user){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Añade la regla 'confirmed'
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]);
    
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']); // Usa Hash::make() para hashear la contraseña
        $user->save();

        if ($request->has('roles')) {
            $user->roles()->attach($request->input('roles'));
        }

        return redirect()->route('admin.users.index');
    }

}
