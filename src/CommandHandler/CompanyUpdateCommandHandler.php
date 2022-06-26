<?php

namespace App\CommandHandler;

use App\Command\CompanyUpdateCommand;
use App\Entity\Company;
use App\Exception\NotFoundException;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;

class CompanyUpdateCommandHandler implements ComandHandlerInterface
{
    private CompanyRepository $companyRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(CompanyRepository $companyRepository, EntityManagerInterface $entityManager)
    {
        $this->companyRepository = $companyRepository;
        $this->entityManager = $entityManager;
    }

    public function __invoke(CompanyUpdateCommand $command)
    {
        $company = $this->companyRepository->find($command->getId());
        if (!$company instanceof Company) {
            throw new NotFoundException("Company with provided id was not found");
        }

        $company->setName($command->getName());
        $company->setAddress($command->getAddress());
        $company->setNip($command->getNip());
        $company->setCity($command->getCity());
        $company->setPostal($command->getPostal());

        $this->entityManager->flush();
    }
}