<?php

namespace App\Service;

use App\Dto\CompanyDto;
use App\Dto\CompanyListDto;
use App\Entity\Company;

class CompanyBuilder
{
    public function buildDtoFromEntity(Company $entity): CompanyDto
    {
        $dto = new CompanyDto();

        $dto->id = $entity->getId();
        $dto->name = $entity->getName();
        $dto->nip = $entity->getNip();
        $dto->address = $entity->getAddress();
        $dto->city = $entity->getCity();
        $dto->postal = $entity->getPostal();

        return $dto;
    }

    public function buildDtoCollection(array $dtoCollection, int $page, int $perPage, int $total): CompanyListDto
    {
        $dto = new CompanyListDto();

        $dto->companies = $dtoCollection;
        $dto->page = $page;
        $dto->perPage = $perPage;
        $dto->totalPages = ceil($total / $perPage);

        return $dto;
    }
}