<?php

namespace App\Repositories\Contracts;

interface EmployeesRepositoryInterface
{
    public function getAll();
    public function paginate($perPage);
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
}
