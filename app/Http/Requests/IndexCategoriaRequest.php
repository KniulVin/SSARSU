<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexCategoriaRequest extends FormRequest
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
            // 📄 Página actual.
            'page'        => ['nullable', 'integer', 'min:1'],

            // 📜 Número de items por página.
            'per_page'    => ['nullable', 'integer', 'min:1', 'max:100'],

            // 🎯 Campos en el que se hara la búsqueda (nombre,descripcion).
            // 'search_in' => ['nullable', 'string'],
            'search_in' => ['sometimes', 'string', 'regex:/^(\*|((nombre|descripcion)(,(nombre|descripcion))*))$/'],

            // 🔍 Texto de búsqueda.
            'search'      => ['nullable', 'string', 'max:255'],

            // 📚 Campo por el que se ordena.
            'sort_by'     => ['nullable', 'in:id,nombre,descripcion,created_at,updated_at'],

            // ↕️ Dirección del orden.
            'sort_dir'    => ['nullable', 'in:asc,desc'],
        ];
    }

    /**
     * Mensajes personalizados (opcional).
     */
    // public function messages(): array
    // {
    //     return [
    //         'search_in.array'      => 'El parámetro search_in debe ser un arreglo.',
    //         'search_in.*.in'       => 'Uno o más campos de búsqueda no son válidos.',
    //         'sort_by.in'           => 'El campo sort_by solo admite: id, nombre, descripcion, created_at, updated_at.',
    //         'sort_dir.in'          => 'El campo sort_dir debe ser asc o desc.',
    //         'page.integer'         => 'El número de página debe ser un entero.',
    //         'per_page.integer'     => 'El número de registros por página debe ser un entero.',
    //         'per_page.max'         => 'No puedes solicitar más de 100 registros por página.',
    //     ];
    // }
}
