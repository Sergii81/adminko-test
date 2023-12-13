<?php

namespace App\Dto\Company;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyGetDto
{
    public function __construct(
        private readonly ?string $page,
        private readonly ?string $perPage,
        private readonly ?string $search
    ) {
    }

    /**
     * @param Request $request
     * @return CompanyGetDto
     */
    public static function fromRequest(Request $request): CompanyGetDto
    {
        return new self(
            page: $request->get('page') ?: Company::PAGE,
            perPage: $request->get('perPage') ?: Company::PER_PAGE,
            search: $request->get('search') ?: null
        );
    }

    /**
     * @return string|null
     */
    public function getPage(): ?string
    {
        return $this->page;
    }

    /**
     * @return string|null
     */
    public function getPerPage(): ?string
    {
        return $this->perPage;
    }

    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
