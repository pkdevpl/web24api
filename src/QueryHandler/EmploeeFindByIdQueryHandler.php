<?php

namespace App\QueryHandler;

use App\Dto\EmployeeDto;
use App\Query\EmployeeFindByIdQuery;
use App\Service\EmployeeDtoFinder;

class EmploeeFindByIdQueryHandler implements QueryHandlerInterface
{
    private EmployeeDtoFinder $dtoFinder;

    public function __construct(EmployeeDtoFinder $dtoFinder)
    {
        $this->dtoFinder = $dtoFinder;
    }

    public function __invoke(EmployeeFindByIdQuery $query): EmployeeDto
    {
        return $this->dtoFinder->findById($query->getCompanyId(), $query->getId());
    }
}