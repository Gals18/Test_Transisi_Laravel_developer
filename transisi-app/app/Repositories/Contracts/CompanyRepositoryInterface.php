<?php

namespace App\Repositories\Contracts;

interface CompanyRepositoryInterface
{
    public function getAll();
    public function paginate($perPage);
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
    public function search($query, $perPage = 10);
}
