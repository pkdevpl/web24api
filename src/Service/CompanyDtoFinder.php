<?php

namespace App\Service;

use App\Dto\CompanyDto;
use App\Dto\CompanyListDto;
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

    public function findById(int $id): CompanyDto
    {
        $company = $this->companyRepository->find($id);
        if (!$company instanceof Company) {
            throw new NotFoundException('Company with provided id was not found');
        }

        return $this->builder->buildDtoFromEntity($company);
    }

    public function findAll(int $page, int $perPage, ?string $queryField = null, ?string $query = null): CompanyListDto
    {
        $queryBuilder = $this->companyRepository->createQueryBuilder('Company')
            ->setFirstResult(($page - 1) * $perPage)
            ->setMaxResults($perPage);

        switch ($queryField) {
            case 'name':
                $queryBuilder->where('Company.name LIKE :query')->setParameter('query', '%' . $query . '%');
                break;
            case 'nip':
                $queryBuilder->where('Company.nip LIKE :query')->setParameter('query', '%' . $query . '%');
                break;
            case 'address':
                $queryBuilder->where('Company.address LIKE :query')->setParameter('query', '%' . $query . '%');
                break;
            case 'city':
                $queryBuilder->where('Company.city LIKE :query')->setParameter('query', '%' . $query . '%');
                break;
            case 'postal':
                $queryBuilder->where('Company.postal LIKE :query')->setParameter('query', '%' . $query . '%');
                break;
        }

        $companies = $queryBuilder->getQuery()->getResult();

        $total = $queryBuilder->getMaxResults();

        $dtoCollection = array_map(fn($company) => $this->builder->buildDtoFromEntity($company), $companies);

        return $this->builder->buildDtoCollection($dtoCollection, $page, $perPage, $total);
    }
}