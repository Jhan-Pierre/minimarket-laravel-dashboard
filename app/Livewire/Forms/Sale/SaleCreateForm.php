<?php

namespace App\Livewire\Forms\Sale;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\DB;

class SaleCreateForm extends Form
{

    public $igv = 18, $total, $metodo_pago_id, $tipo_comprobante_id;

    public function rules()
    {
        return [
            'igv' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'metodo_pago_id' => 'required|exists:tb_metodo_pago,id', 
            'tipo_comprobante_id' => 'required|exists:tb_tipo_comprobante,id', 
        ];
    }

    public function messages()
    {
        return [
            'igv.required' => 'El IGV es obligatorio.',
            'igv.numeric' => 'El campo IGV debe ser un numero.',
            'igv.min' => 'El campo IGV debe ser minimo a :min.',
            'total.required' => 'El campo Total es obligatorio.',
            'total.numeric' => 'El campo Total debe ser un numero.',
            'total.min' => 'El campo Total debe ser minimo :min.',
            'metodo_pago_id.required' => 'El Método de Pago es obligatorio.',
            'metodo_pago_id.exists' => 'El Método de Pago seleccionado no es válido.',
            'tipo_comprobante_id.required' => 'El Tipo de Comprobante es obligatorio.',
            'tipo_comprobante_id.exists' => 'El Tipo de Comprobante seleccionado no es válido.',
        ];
    }

    public function store()
    {
        $userId = auth()->id(); 

        $this->validate();

        DB::statement('CALL sp_registrar_venta(?, ?, ?, ?, ?)', [
            $this->igv, 
            $this->total, 
            $this->tipo_comprobante_id, 
            $this->metodo_pago_id, 
            $userId
        ]);

        return redirect()->route('admin.sale.index');
    }
}
