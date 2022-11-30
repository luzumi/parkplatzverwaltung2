<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'Land' => 'required|string|max:30',
            'PLZ' => 'required|integer|digits:5',
            'Stadt' => 'required|string',
            'Strasse' => 'required|string',
            'Nummer' => 'required|integer',
        ];
    }
}
