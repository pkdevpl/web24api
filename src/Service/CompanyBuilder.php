<?php

namespace App\Service;

use App\Entity\Company;
use App\Lib\Dto\CompanyDto;

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