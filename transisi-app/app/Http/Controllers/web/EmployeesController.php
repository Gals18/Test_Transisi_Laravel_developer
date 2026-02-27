<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeesRequest;
use App\Models\companies;
use App\Models\Company; // Gunakan PascalCase (Singular) sesuai standar Laravel
use App\Models\Employee;
use App\Models\employees;
use App\Repositories\Eloquent\EmployeesRepository;

class EmployeesController extends Controller
{
    protected $employRepo;

    // WAJIB: Tambahkan Constructor agar $this->employRepo tidak null
    public function __construct(EmployeesRepository $employeeRepository)
    {
        $this->employRepo = $employeeRepository;
    }

    public function index()
    {
        // Pastikan nama model dan relasi 'company' sudah benar di Model Employee
        $employees = employees::with('company')->paginate(5);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $companies = companies::all(); 
        return view('employees.create', compact('companies'));
    }

    public function store(EmployeesRequest $request)
    {
        // Sekarang $this->employRepo sudah terisi melalui constructor
        $this->employRepo->create($request->validated());

        return redirect()->route('employees.index') // Redirect ke index employee, bukan company
            ->with('success', 'Data karyawan berhasil ditambahkan!');
    }
}