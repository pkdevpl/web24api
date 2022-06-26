<?php

namespace App\Service;

use App\Entity\Company;
use App\Exception\NotFoundException;
use App\Repository\CompanyRepository;

class CompanyDtoFinder
{
    private CompanyRepository $companyRepository;
    private CompanyBuilder $builder;

    public function __construct(CompanyRepository $companyRepository, CompanyBuilder $builder)
    {
        $this->companyRepository = $companyRepository;
        $this->builder = $builder;
    }

    public function findById(int $id)
    {
        $company = $this->companyRepository->find($id);
        if (!$company instanceof Company) {
            throw new NotFoundException('Company with provided id was not found');
        }

        return $this->builder->buildDtoFromEntity($company);
    }
}