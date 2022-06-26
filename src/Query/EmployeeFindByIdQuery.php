<?php

namespace App\Query;

class EmployeeFindByIdQuery implements QueryInterface
{
    private int $companyId;
    private int $id;

    public function __construct(int $companyId, int $id)
    {
        $this->companyId = $companyId;
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }
}