<?php

namespace App\CommandHandler;

use App\Command\EmployeeDeleteCommand;
use App\Entity\Company;
use App\Entity\Employee;
use App\Exception\NotFoundException;
use App\Repository\CompanyRepository;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;

class EmployeeDeleteCommandHandler implements ComandHandlerInterface
{
    private EntityManagerInterface $entityManager;
    private CompanyRepository $companyRepository;
    private EmployeeRepository $employeeRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        CompanyRepository $companyRepository,
        EmployeeRepository $employeeRepository
    ) {
        $this->entityManager = $entityManager;
        $this->companyRepository = $companyRepository;
        $this->employeeRepository = $employeeRepository;
    }

    public function __invoke(EmployeeDeleteCommand $command): void
    {
        $company = $this->companyRepository->find($command->getCompanyId());
        if (!$company instanceof Company) {
            throw new NotFoundException("Company with provided id was not found");
        }

        $employee = $this->employeeRepository->findOneBy(['company' => $company, 'id' => $command->getId()]);
        if (!$employee instanceof Employee) {
            throw new NotFoundException("Employee with provided id was not found for this company");
        }

        $this->entityManager->remove($employee);
        $this->entityManager->flush();
    }
}