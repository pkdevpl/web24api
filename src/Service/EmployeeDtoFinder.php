<?php

namespace App\Service;

use App\Dto\EmployeeDto;
use App\Dto\EmployeeListDto;
use App\Entity\Employee;
use App\Exception\NotFoundException;
use App\Repository\EmployeeRepository;

class EmployeeDtoFinder
{
    private EmployeeRepository $repository;
    private EmployeeBuilder $employeeBuilder;

    public function __construct(EmployeeRepository $repository, EmployeeBuilder $employeeBuilder)
    {
        $this->repository = $repository;
        $this->employeeBuilder = $employeeBuilder;
    }

    public function findById(int $companyId, int $id): EmployeeDto
    {
        $employee = $this->repository->findOneBy(['company' => $companyId, 'id' => $id]);
        if (!$employee instanceof Employee) {
            throw new NotFoundException("Employee with provided id was not found for company");
        }

        return $this->employeeBuilder->buildDtoFromEntity($employee);
    }

    public function findAll(int $companyId, int $page, int $perPage, ?string $queryField = null, ?string $query = null): EmployeeListDto
    {
        $queryBuilder = $this->repository->createQueryBuilder('Employee')
            ->where('Employee.company=:companyId')
            ->setParameter('companyId', $companyId)
            ->setFirstResult(($page - 1) * $perPage)
            ->setMaxResults($perPage);

        switch ($queryField) {
            case 'name':
                $queryBuilder->andWhere('Employee.name LIKE :query')->setParameter('query', '%' . $query . '%');
                break;
            case 'lastname':
                $queryBuilder->andWhere('Employee.lastname LIKE :query')->setParameter('query', '%' . $query . '%');
                break;
            case 'email':
                $queryBuilder->andWhere('Employee.email LIKE :query')->setParameter('query', '%' . $query . '%');
                break;
            case 'phone':
                $queryBuilder->andWhere('Employee.phone LIKE :query')->setParameter('query', '%' . $query . '%');
                break;
        }

        $employees = $queryBuilder->getQuery()->getResult();

        $total = $queryBuilder->getMaxResults();

        $dtoCollection = array_map(fn($company) => $this->employeeBuilder->buildDtoFromEntity($company), $employees);

        return $this->employeeBuilder->buildDtoCollection($dtoCollection, $page, $perPage, $total);
    }
}