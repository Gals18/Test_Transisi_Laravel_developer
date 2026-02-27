<?php

namespace App\Repositories\Contracts;

interface CompanyRepositoryInterface
{
    public function getAll();
    public function paginate($perPage = 10);
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
}