<?php

namespace App\CommandHandler;

use App\Command\CompanyDeleteCommand;
use App\Entity\Company;
use App\Exception\NotFoundException;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;

class CompanyDeleteCommandHandler implements ComandHandlerInterface
{
    private CompanyRepository $companyRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(CompanyRepository $companyRepository, EntityManagerInterface $entityManager)
    {
        $this->companyRepository = $companyRepository;
        $this->entityManager = $entityManager;
    }

    public function __invoke(CompanyDeleteCommand $command)
    {
        $company = $this->companyRepository->find($command->getId());
        if (!$company instanceof Company) {
            throw new NotFoundException("Company with provided id was not found");
        }

        $this->entityManager->remove($company);
        $this->entityManager->flush();
    }
}