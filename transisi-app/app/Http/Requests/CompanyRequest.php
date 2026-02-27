<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
   /**
    * Izinkan user untuk melakukan request ini.
    */
   public function authorize()
   {
      return true; // Ubah ke true supaya tidak error 'Unauthorized'
   }

   /**
    * Aturan validasi sesuai instruksi tugas.
    */
   public function rules()
   {
      // Cek apakah ini aksi Update (PUT/PATCH)
      $isUpdate = $this->isMethod('put') || $this->isMethod('patch');

      return [
         'name'    => 'required',
         'email'   => 'required|email',
         'website' => 'required|url',
         'logo'    => [
            $isUpdate ? 'nullable' : 'required', // Tetap sah secara aturan tugas
            'image',
            'mimes:png',
            'dimensions:min_width=100,min_height=100',
            'max:2048'
         ],
      ];
   }

   public function find($id)
   {
      return \App\Models\companies::findOrFail($id);
   }
}
