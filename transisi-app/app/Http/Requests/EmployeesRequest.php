<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeesRequest extends FormRequest
{
    /**
     * Izinkan user untuk melakukan request ini.
     */
    public function authorize()
    {
        return true; 
    }

    /**
     * Aturan validasi untuk Employee.
     */
    public function rules()
    {
        return [
            'name'       => 'required|string|max:255',
            'email'      => 'required|email',
            'company_id' => 'required|exists:companies,id', // Validasi bahwa perusahaan harus ada di DB
        ];
    }

    /**
     * Opsional: Pesan error kustom dalam Bahasa Indonesia
     */
    public function messages()
    {
        return [
            'company_id.required' => 'Wajib memilih perusahaan.',
            'company_id.exists'   => 'Perusahaan yang dipilih tidak valid.',
        ];
    }
}