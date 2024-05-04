<?php

namespace App\Livewire\Forms\User;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserEditForm extends Form
{
    public $id = "", $name, $email, $password, $passwordConfirmation, $selectedRoles = [];

    public $roles = [];


    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:80',
            'email' => 'required|email|max:40|unique:users,email,' . $this->id,
            'password' => 'nullable|min:8|max:50|same:passwordConfirmation',
            'selectedRoles' => 'required|array|min:1',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre no debe exceder los 80 caracteres.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.max' => 'El correo no debe exceder los 40 caracteres.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña debe exceder los 50 caracteres.',
            'password.same' => 'Las contraseñas no coinciden.',
            'selectedRoles.required' => 'Debe seleccionar al menos un rol para el usuario.',
            'selectedRoles.array' => 'El formato de los roles seleccionados no es válido.',
            'selectedRoles.min' => 'Debe seleccionar al menos un rol para el usuario.',
        ];
    }


    public function edit($id){
        $this->id = $id;

        $user =  User::find($this->id);

        $this->roles = Role::all();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRoles = $user->roles->pluck('id')->toArray();
    }

    public function update()
    {
        $validatedData = $this->validate();

        $user = User::find($this->id);

        if ($user) {
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $user->password,
            ]);

            $user->roles()->sync($this->selectedRoles);
        }

        return redirect()->route('admin.users.index');
    }
}
