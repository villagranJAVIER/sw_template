<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModuleRequest extends FormRequest
{
    protected string $tableName = 'modules';
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|max:255',
            'description' => 'required|max:255',
            'key'         => "required|string|max:255|min:1|unique:modules,key" . (isset($this->route('module')->id) ? ',' . $this->route('module')->id : ''),
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Nombre',
            'description' => 'Descripción',
            'key' => 'Clave'
        ];
    }
}
