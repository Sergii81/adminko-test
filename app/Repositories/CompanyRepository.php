<?php

namespace App\Repositories;

use App\Dto\Company\CompanyGetDto;
use App\Interfaces\Repositories\CompanyRepositoryInterface;
use App\Models\Company;
use App\Repositories\AbstractRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class CompanyRepository extends AbstractRepository implements CompanyRepositoryInterface
{
    public function getModel(): Model
    {
        return new Company();
    }

    /**
     * @param CompanyGetDto $dto
     * @return LengthAwarePaginator
     */
    public function getAllWithSearch(CompanyGetDto $dto): LengthAwarePaginator
    {
        $query = $this->getQuery();

        if ($dto->getSearch()) {
            $query->search($dto->getSearch());
        }

        return $query->paginate(perPage: $dto->getPerPage(), page: $dto->getPage());
    }
}
