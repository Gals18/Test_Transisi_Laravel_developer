<?php

namespace App\Repositories\Eloquent;

use App\Models\employees;
use App\Repositories\Contracts\EmployeesRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class EmployeesRepository implements EmployeesRepositoryInterface
{
    public function getAll()
    {
        return employees::all();
    }
    public function getAllWithCompany()
    {
        return employees::with('company')->get();
    }


    public function paginate($perPage)
    {
        return employees::paginate($perPage);
    }

    public function create(array $data)
    {
        return employees::create($data);
    }

    public function find($id)
    {
        return employees::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $employ = \App\Models\employees::findOrFail($id);
        return $employ->update($data);
    }

    public function delete($id)
    {
        $employ = $this->find($id);
        return $employ->delete();
    }
}
