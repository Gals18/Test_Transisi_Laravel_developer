<?php

namespace App\Imports;

use App\Models\employees;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EmployeeImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    protected $companyId;

    // Kita bisa kirim ID perusahaan lewat constructor
    public function __construct($companyId)
    {
        $this->companyId = $companyId;
    }

    public function model(array $row)
    {
        $uuid = (string) Str::uuid();
        return new employees([
            'id'          => $uuid,
            'name'       => $row['name'],
            'email'      => $row['email'],
            'company_id' => $this->companyId, // ID perusahaan yang sedang aktif
        ]);
    }

    // Memenuhi syarat: Batch insert per 10 data
    public function batchSize(): int
    {
        return 10;
    }

    // Memenuhi syarat: Chunk per 10 data (minimum 100 records total)
    public function chunkSize(): int
    {
        return 10;
    }
}
