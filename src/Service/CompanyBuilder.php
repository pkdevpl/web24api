<?php

namespace App\Service;

use App\Dto\CompanyDto;
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
}