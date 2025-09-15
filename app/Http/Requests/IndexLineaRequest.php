<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexLineaRequest extends FormRequest
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
            'page' => ['nullable', 'integer', 'min:1'],

            // 📜 Número de items por página.
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],

            // 🎯 Campos en el que se hara la búsqueda (nombre,descripcion).
            'search_in' => ['sometimes', 'string', 'regex:/^(\*|((nombre|descripcion)(,(nombre|descripcion))*))$/'],

            // 🔍 Texto de búsqueda.
            'search' => ['nullable', 'string', 'max:255'],

            // 📚 Campo por el que se ordena.
            'sort_by' => ['nullable', 'in:id,nombre,descripcion,created_at,updated_at'],

            // ↕️ Dirección del orden.
            'sort_dir' => ['nullable', 'in:asc,desc'],
        ];
    }
}
