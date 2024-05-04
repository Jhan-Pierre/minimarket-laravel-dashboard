<?php

namespace App\Livewire\Forms\User;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserCreateForm extends Form
{
    public $name, $email, $password, $passwordConfirmation, $selectedRoles = [], $estado_id;

    public function rules() 
    {
        return [
            'name' => 'required|min:3|max:80',
            'email' => 'required|email|max:40|unique:users,email',
            'password' => 'required|min:8|max:50|same:passwordConfirmation',
            'selectedRoles' => 'required|array|min:1',
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre no debe exceder los 80 caracteres.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.max' => 'El correo no debe exceder los 40 caracteres.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña debe exceder los 50 caracteres.',
            'password.same' => 'Las contraseñas no coinciden.',
            'selectedRoles.required' => 'Debe seleccionar al menos un rol para el usuario.',
            'selectedRoles.array' => 'El formato de los roles seleccionados no es válido.',
            'selectedRoles.min' => 'Debe seleccionar al menos un rol para el usuario.',
        ];
    }

    public function store()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'estado_id' => $this->estado_id,
        ]);

        $user->roles()->attach($this->selectedRoles);

        return redirect()->route('admin.users.index');
    }
}
