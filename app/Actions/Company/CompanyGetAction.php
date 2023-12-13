<?php

namespace App\Actions\Company;

use App\Dto\Company\CompanyGetDto;
use App\Interfaces\Repositories\CompanyRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CompanyGetAction
{
    /**
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(private readonly CompanyRepositoryInterface $companyRepository)
    {
    }

    /**
     * @param CompanyGetDto $dto
     * @return LengthAwarePaginator
     */
    public function execute(CompanyGetDto $dto): LengthAwarePaginator
    {
        return $this->companyRepository->getAllWithSearch($dto);
    }
}
