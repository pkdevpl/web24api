<?php

namespace App\Service;

use App\Dto\EmployeeListDto;
use App\Dto\EmployeeDto;
use App\Entity\Employee;

class EmployeeBuilder
{
    public function buildDtoFromEntity(Employee $employee): EmployeeDto
    {
        $dto = new EmployeeDto();

        $dto->id = $employee->getId();
        $dto->name = $employee->getName();
        $dto->lastname = $employee->getLastname();
        $dto->email = $employee->getEmail();
        $dto->phone = $employee->getPhone();

        return $dto;
    }

    public function buildDtoCollection(array $dtoCollection, int $page, int $perPage, int $total): EmployeeListDto
    {
        $dto = new EmployeeListDto();

        $dto->employees = $dtoCollection;
        $dto->page = $page;
        $dto->perPage = $perPage;
        $dto->totalPages = ceil($total / $perPage);

        return $dto;
    }
}