<?php

namespace App\Services;

use App\Dto\Parser\CompanyStoreDto;
use App\Dto\Parser\PositionStoreDto;
use App\Dto\Parser\UserStoreDto;
use App\Interfaces\ClientService\ParseServiceInterface;
use App\Interfaces\Repositories\CompanyRepositoryInterface;
use App\Interfaces\Repositories\PositionRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;

class ParseService extends AbstractClientService implements ParseServiceInterface
{
    protected string $baseUrl = 'http://127.0.0.1:8000/api/v1/' /*http://localhost:3000/'*/;
    protected string $userUrl = 'users?page=';
    protected string $companyUrl = 'companies?page=';
    protected string $companyPositionUrl = 'company/';
    protected string $xClient = 'X-Client: 237cd6a8-5a0e-4ff0-b7e2-0bf34675d058';
    protected const METHOD_GET = 'GET';
    private array $headers;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly CompanyRepositoryInterface $companyRepository,
        private readonly PositionRepositoryInterface $positionRepository
    ) {

    }

    /**
     * @return void
     */
    public function storeUsers(): void
    {
        $page = 1;

        while(! empty($users = $this->getUsers($page)))
        {
            foreach ($users as $user) {
                $dto = UserStoreDto::fromArray($user);
                $this->userRepository->updateOrCreate(['id' => $dto->getId()], $dto->toArray());
            }
            $page++;
        }
    }

    /**
     * @return void
     */
    public function storeCompanies(): void
    {
        $page = 1;
        while (! empty($companies = $this->getCompanies($page)))
        {
            foreach ($companies as $company) {
                $companyDto = CompanyStoreDto::fromArray($company);
                $this->companyRepository->updateOrCreate(['id' => $companyDto->getId()], $companyDto->toArray());
            }
        }
    }

    /**
     * @return void
     */
    public function storePositions(): void
    {
        $companies = $this->companyRepository->getAll();
        if ($companies->isNotEmpty()) {
            foreach ($companies as $company) {
                $positions = $this->getPositions($company->id);
                foreach ($positions as $position) {
                    $positionDto = PositionStoreDto::fromArray($position);
                    $position = $this->positionRepository->updateOrCreate(['id' => $positionDto->getId()], $positionDto->toArray());
                    $user = $this->userRepository->getById($positionDto->getUserId());
                    $company = $this->companyRepository->getById($positionDto->getCompanyId());
                    if ($user && $company) {
                        $user->position_id = $position->id;
                        $user->company_id = $company->id;
                        $company->positions()->attach($position->id);
                    }
                }
            }
        }
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(): array
    {
        return $this->headers = [
            'Authorization' => $this->xClient,
        ];
    }

    /**
     * @param int $page
     * @return false|mixed
     */
    private function getUsers(int $page): mixed
    {
        $url = $this->baseUrl . $this->userUrl . $page;

        return $this->request(self::METHOD_GET, $url, ['headers' => $this->getHeaders()]);
    }

    private function getCompanies(int $page)
    {
        $url = $this->baseUrl . $this->companyUrl . $page;

        return $this->request(self::METHOD_GET, $url, ['headers' => $this->getHeaders()]);
    }

    public function getPositions(string $companyId)
    {
        $url = $this->baseUrl . $this->companyPositionUrl . $companyId;

        return $this->request(self::METHOD_GET, $url, ['headers' => $this->getHeaders()]);
    }
}
