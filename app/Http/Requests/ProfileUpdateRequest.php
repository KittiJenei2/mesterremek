<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        
        return [
            'nev' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('felhasznalo')->ignore($this->user()->id),
            ],
            'telefonszam' => [
                'required',
                'numeric',
                'digits:11',
                'regex:/^06\d{9}$/', 
               
                Rule::unique('felhasznalo')->ignore($this->user()->id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Kérjük, érvényes email címet adjon meg.',
            'email.unique' => 'Ez az email cím már foglalt.',
            'telefonszam.digits' => 'A telefonszámnak pontosan 11 számjegyűnek kell lennie.',
            'telefonszam.regex' => 'A telefonszám formátuma hibás. Helyes formátum: 06301234567',
            'telefonszam.unique' => 'Ez a telefonszám már más felhasználóhoz tartozik.',
        ];
    }
}