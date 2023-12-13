<?php

namespace App\Interfaces\Repositories;

use App\Dto\Company\CompanyGetDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CompanyRepositoryInterface extends RepositoryInterface
{
    public function getAllWithSearch(CompanyGetDto $dto): LengthAwarePaginator;
}
