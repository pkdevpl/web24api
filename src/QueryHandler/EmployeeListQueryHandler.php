<?php

namespace App\QueryHandler;

use App\Dto\EmployeeListDto;
use App\Query\EmployeeListQuery;
use App\Service\EmployeeDtoFinder;

class EmployeeListQueryHandler implements QueryHandlerInterface
{
    private EmployeeDtoFinder $finder;

    public function __construct(EmployeeDtoFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(EmployeeListQuery $query): EmployeeListDto
    {
        return $this->finder->findAll($query->getCompanyId(), $query->getPage(), $query->getPerPage(), $query->getQueryField(), $query->getQuery());
    }
}