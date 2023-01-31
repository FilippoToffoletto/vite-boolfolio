<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=> 'required|max:255|min:3',
            'client_name'=> 'required|max:255|min:3',
            'summary'=> 'required|min:10',
            'cover_image'=> 'nullable|max:255|min:3',
        ];
    }

    public function messages(){
        return[
            'name.required' => 'Il nome e\' obbligatorio',
            'client_name.required' => 'Il nome del cliente e\' obbligatorio',
            'name.max' => 'Il puo\' contenere il massimo di 255 caratteri',
            'client_name.max' => 'Il puo\' contenere il massimo di 255 caratteri',
            'name.min' => 'Il puo\' contenere il minimo di 3 caratteri',
            'client_name.min' => 'Il puo\' contenere il minimo di 3 caratteri',
            'summary.required' => 'La descrizione e\' obbligatoria',
            'summary.min' => 'Il puo\' contenere il minimo di 10 caratteri'
        ];
    }
}
