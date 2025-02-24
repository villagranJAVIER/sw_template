<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|max:255|unique:roles,name',
            'guard_name'    => 'required',
            'description'   => 'required|max:255',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'exists:permissions,id', // Valida que cada permiso exista
        ];
    }

    public function attributes(): array
    {
        return [
            'name'          => 'nombre',
            'guard_name'    => 'nombre de guardia',
            'description'   => 'descripción',
            'permissions'   => 'permisos',
            'permissions.*' => 'permiso',
        ];
    }
}
