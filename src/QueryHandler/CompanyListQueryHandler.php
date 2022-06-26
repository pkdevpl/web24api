<?php

namespace App\QueryHandler;

use App\Dto\CompanyListDto;
use App\Query\CompanyListQuery;
use App\Service\CompanyDtoFinder;

class CompanyListQueryHandler implements QueryHandlerInterface
{
    private CompanyDtoFinder $finder;

    public function __construct(CompanyDtoFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(CompanyListQuery $query): CompanyListDto
    {
        return $this->finder->findAll($query->getPage(), $query->getPerPage(), $query->getQueryField(), $query->getQuery());
    }
}