<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
   protected $companyRepo;

   public function __construct(CompanyRepositoryInterface $companyRepo)
   {
      $this->companyRepo = $companyRepo;
   }

   public function index()
   {
      $companies = $this->companyRepo->paginate(10);
      return view('companies.index', compact('companies'));
   }

   public function create()
   {
      // Mengarahkan ke resources/views/companies/create.blade.php
      return view('companies.create');
   }

   public function store(CompanyRequest $request)
   {
      // Data dikirim ke repository untuk diproses (simpan file & database)
      $this->companyRepo->create($request->validated());

      return redirect()->route('companies.index')
         ->with('success', 'Data perusahaan berhasil ditambahkan!');
   }

   public function edit($id)
   {
      // Mengambil data perusahaan berdasarkan ID melalui repository
      $company = $this->companyRepo->find($id);

      return view('companies.edit', compact('company'));
   }

   public function update(CompanyRequest $request, $id)
   {
      $this->companyRepo->update($id, $request->validated());
      return redirect()->route('companies.index')->with('success', 'Data perusahaan berhasil diperbarui!');
   }

   public function destroy($id)
   {
      $this->companyRepo->delete($id);
      return redirect()->route('companies.index')->with('success', 'Data perusahaan berhasil dihapus!');
   }
}
