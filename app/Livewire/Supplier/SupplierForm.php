<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\State;

class SupplierForm extends Component
{
    public $states = [];

    public $name, $ruc, $descripcion, $telefono, $correo, $direccion, $estado_id;

    public $suppliersEdit = [
        'name' => '',
        'ruc' => '',
        'descripcion' => '',
        'telefono' => '',
        'correo' => '',
        'direccion' => '',
        'estado_id' => '',
    ];

    public $openCreate = false;

    public $suppliersEditId = '';
 
    public $openEdit = false;

    public $suppliersDeleteId = "", $suppliersDeleteName = "";

    public $openDelete = false;

    #[Url(as: 's')]
    public $search = "";

    public function mount(){
        $this->states = State::all();
    }

    public function save(){
        Supplier::create(
            $this->only('name', 'ruc', 'descripcion', 'telefono', 'correo', 'direccion', 'estado_id')
        );

        $this->reset(['name', 'ruc', 'descripcion', 'telefono', 'correo', 'direccion', 'estado_id', 'openCreate']);
    }

    public function edit($suppliersId)
    {
        $this->openEdit = true;

        $this->suppliersEditId = $suppliersId;

        $suppliers = Supplier::find($suppliersId);
        $this->suppliersEdit['name'] = $suppliers->name;
        $this->suppliersEdit['ruc'] = $suppliers->ruc;
        $this->suppliersEdit['descripcion'] = $suppliers->descripcion;
        $this->suppliersEdit['telefono'] = $suppliers->telefono;
        $this->suppliersEdit['correo'] = $suppliers->correo;
        $this->suppliersEdit['direccion'] = $suppliers->direccion;
        $this->suppliersEdit['estado_id'] = $suppliers->estado_id;
    }

    public function update()
    {
        $suppliers = Supplier::find($this->suppliersEditId);

        $suppliers->update([
            'name' => $this->suppliersEdit['name'],
            'ruc' => $this->suppliersEdit['ruc'],
            'descripcion' => $this->suppliersEdit['descripcion'],
            'telefono' => $this->suppliersEdit['telefono'],
            'correo' => $this->suppliersEdit['correo'],
            'direccion' => $this->suppliersEdit['direccion'],
            'estado_id' => $this->suppliersEdit['estado_id'],
        ]);

        $this->reset(['suppliersEditId', 'openEdit']);
    }

    public function render()
    {
        $suppliers = Supplier::orderBy('created_at', 'desc')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);
        return view('livewire.supplier.supplier-form', compact('suppliers'));
    }

    public function delete($suppliersId, $suppliersName)
    {
        $this->openDelete = true;

        $this->suppliersDeleteId = $suppliersId;
        $this->suppliersDeleteName = $suppliersName;
    }

    public function destroy()
    {
        $suppliers = Supplier::find($this->suppliersDeleteId);
        $suppliers->delete();

        $this->reset(['suppliersEdit', 'suppliersDeleteId', 'openDelete']);
    }
}
