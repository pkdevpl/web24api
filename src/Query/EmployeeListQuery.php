<?php

namespace App\Query;

use App\Traits\ListQueryTrait;

class EmployeeListQuery implements QueryInterface
{
    use ListQueryTrait;

    private int $companyId;

    public function __construct(int $companyId)
    {
        $this->companyId = $companyId;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }
}