<?php

namespace App\CommandHandler;

use App\Command\CompanyCreateCommand;
use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;

class CompanyCreateCommandHandler implements ComandHandlerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(CompanyCreateCommand $command)
    {
        $company = new Company();

        $company->setName($command->getName());
        $company->setAddress($command->getAddress());
        $company->setNip($command->getNip());
        $company->setCity($command->getCity());
        $company->setPostal($command->getPostal());

        $this->entityManager->persist($company);
        $this->entityManager->flush($company);

        return $company->getId();
    }
}