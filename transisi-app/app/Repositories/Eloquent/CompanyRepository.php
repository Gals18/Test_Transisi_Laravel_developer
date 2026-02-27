<?php

namespace App\Repositories\Eloquent;

use App\Models\companies; // Sesuaikan dengan nama model Anda
use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class CompanyRepository implements CompanyRepositoryInterface
{
   public function getAll()
   {
      return companies::all();
   }

   public function paginate($perPage = 10)
   {
      return companies::latest()->paginate($perPage);
   }

   public function create(array $data)
   {
      if (isset($data['logo'])) {
         // Simpan ke storage/app/public/company (agar bisa diakses publik)
         $path = $data['logo']->store('company', 'public');
         $data['logo'] = $path;
      }
      return companies::create($data);
   }

   public function find($id)
   {
      return companies::findOrFail($id);
   }

   public function update($id, array $data)
   {
      $company = \App\Models\companies::findOrFail($id);

      if (isset($data['logo']) && $data['logo'] instanceof \Illuminate\Http\UploadedFile) {
         // Jika ada file baru: hapus yang lama, simpan yang baru
         if ($company->logo) {
            \Illuminate\Support\Facades\Storage::delete($company->logo);
         }
         $data['logo'] = $data['logo']->store('company');
      } else {
         // JIKA KOSONG: Kita ambil data logo yang sudah ada di DB sebelumnya
         $data['logo'] = $company->logo;
      }

      return $company->update($data);
   }

   public function delete($id)
   {
      $company = $this->find($id);
      if ($company->logo) {
         Storage::disk('public')->delete($company->logo);
      }
      return $company->delete();
   }
}
