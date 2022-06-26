<?php

namespace App\Command;

class EmployeeDeleteCommand implements CommandInterface
{
    private int $companyId;
    private int $id;

    public function __construct(int $companyId, int $id)
    {
        $this->companyId = $companyId;
        $this->id = $id;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function getId(): int
    {
        return $this->id;
    }
}