<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeesRequest;
use App\Imports\EmployeeImport;
use App\Models\companies;
use App\Models\Company; // Gunakan PascalCase (Singular) sesuai standar Laravel
use App\Models\Employee;
use App\Models\employees;
use App\Repositories\Eloquent\CompanyRepository;
use App\Repositories\Eloquent\EmployeesRepository;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request; // BENAR
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class EmployeesController extends Controller
{
    protected $employRepo;
    protected $companyRepo;

    // WAJIB: Tambahkan Constructor agar $this->employRepo tidak null
    public function __construct(EmployeesRepository $employeeRepository, CompanyRepository $companyRepository)
    {
        $this->employRepo = $employeeRepository;
        $this->companyRepo = $companyRepository;
    }

    public function index()
    {
        $employees = $this->employRepo->paginate(5);
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

    public function export()
    {
        // 1. Ambil data (Contoh: Detail Pembayaran)
        $emp = $this->employRepo->getAllWithCompany();

        // 2. Siapkan data untuk view
        $data = [
            'title' => 'Data Karyawan',
            'date' => date('d/m/Y'),
            'employees' => $emp
        ];

        // dd($data->employees);
        $pdf = SnappyPdf::loadView('employees.pdf.employees', compact('data'))
            ->setPaper('a4')
            ->setOption('margin-bottom', 10);
        // 5. Download atau Stream
        return $pdf->download('Data-emp.pdf');
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,txt,xlsx,xls',
            'company_id' => 'required|exists:companies,id'
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        $company = $this->companyRepo->find($request->company_id);

        if (!$company) {
            return back()->with('error', 'Tambahkan data company terlebih dahulu!');
        }

        try {
            \Maatwebsite\Excel\Facades\Excel::import(
                new \App\Imports\EmployeeImport($company->id),
                $request->file('file')
            );
            return redirect()->route('employees.index')->with('success', 'Import 100 data selesai dengan sistem chunk!');

            // dd("sukses");
        } catch (\Throwable $th) {
            // dd("error " . $th->getMessage());
            return back()->with('error', 'Import gagal!');
            Log::error("Error : " . $th->getMessage());
        }
        // return redirect()->route('employees.index')->with('success', 'Import 100 data selesai!');
    }
     public function destroy($id)
   {
      $this->employRepo->delete($id);
      return redirect()->route('employees.index')->with('success', 'Data perusahaan berhasil dihapus!');
   }
}
