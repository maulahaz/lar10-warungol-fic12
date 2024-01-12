<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSoalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'pertanyaan'    => 'required|max:255',
            'kategori'      => 'required|in:Numeric,Verbal,Logika',
            'opsi_a'        => 'required|max:255',
            'opsi_b'        => 'required|max:255',
            'opsi_c'        => 'required|max:255',
            'opsi_d'        => 'required|max:255',
            'jawaban'       => 'required|in:a,b,c,d',
        ];
    }
}
