<?php

namespace App\Http\Requests\Imovel;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        // make all of the fields required, set featured image to accept only images
        return [
            'endereco' => 'required|string|min:3|max:50',
            'descricao' => 'required|string|min:3|max:50',
            'proprietario' => 'required|string|min:3|max:50',
            'foto' => 'required|image|max:1024|mimes:jpg,jpeg,png,webp',
        ];
    }
}
