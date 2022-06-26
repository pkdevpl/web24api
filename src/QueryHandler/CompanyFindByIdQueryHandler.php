<?php

namespace App\QueryHandler;

use App\Query\CompanyFindByIdQuery;
use App\Service\CompanyDtoFinder;

class CompanyFindByIdQueryHandler implements QueryHandlerInterface
{
    private CompanyDtoFinder $companyDtoFinder;

    public function __construct(CompanyDtoFinder $companyDtoFinder)
    {
        $this->companyDtoFinder = $companyDtoFinder;
    }

    public function __invoke(CompanyFindByIdQuery $query)
    {
        return $this->companyDtoFinder->findById($query->getId());
    }
}