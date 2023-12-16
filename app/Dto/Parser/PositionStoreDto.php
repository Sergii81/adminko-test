<?php

namespace App\Dto\Parser;

use Illuminate\Support\Str;

class PositionStoreDto
{
    /**
     * @param string $company_id
     * @param string $user_id
     * @param string $name
     * @param string $id
     */
    public function __construct(
        private string $company_id,
        private string $user_id,
        private string $name,
        private string $id,
    ) {
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        return new static(
            company_id: $data['CompanyId'],
            user_id: $data['UserId'],
            name: $data['Position'],
            id: Str::uuid()
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCompanyId(): string
    {
        return $this->company_id;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->user_id;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
