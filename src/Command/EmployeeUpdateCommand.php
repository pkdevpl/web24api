<?php

namespace App\Command;

class EmployeeUpdateCommand implements CommandInterface
{
    private int $id;
    private int $companyId;
    private ?string $name;
    private ?string $lastName;
    private ?string $email;
    private ?string $phone;

    public function __construct(int $companyId, int $id)
    {
        $this->id = $id;
        $this->companyId = $companyId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }
}