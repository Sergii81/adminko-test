<?php

namespace App\Dto\Parser;

class UserStoreDto
{

    public function __construct(
        private string $id,
        private string $name_first,
        private string $name_last,
        private string $email,
    ) {
    }

    /**
     * @param array $data
     * @return UserStoreDto
     */
    public static function fromArray(array $data): UserStoreDto
    {
        return new self(
            id: $data['Id'],
            name_first: $data['FirstName'],
            name_last: $data['LastName'],
            email: $data['Email']
        );
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
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
    public function getNameFirst(): string
    {
        return $this->name_first;
    }

    /**
     * @return string
     */
    public function getNameLast(): string
    {
        return $this->name_last;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}
