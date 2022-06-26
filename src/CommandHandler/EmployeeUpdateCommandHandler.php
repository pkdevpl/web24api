<?php

namespace App\CommandHandler;

use App\Command\EmployeeUpdateCommand;
use App\Entity\Company;
use App\Entity\Employee;
use App\Exception\NotFoundException;
use App\Repository\CompanyRepository;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EmployeeUpdateCommandHandler implements ComandHandlerInterface
{
    private EntityManagerInterface $entityManager;
    private CompanyRepository $companyRepository;
    private EmployeeRepository $employeeRepository;
    private ValidatorInterface $validator;

    public function __construct(
        EntityManagerInterface $entityManager,
        CompanyRepository $companyRepository,
        EmployeeRepository $employeeRepository,
        ValidatorInterface $validator
    ) {
        $this->entityManager = $entityManager;
        $this->companyRepository = $companyRepository;
        $this->employeeRepository = $employeeRepository;
        $this->validator = $validator;
    }

    public function __invoke(EmployeeUpdateCommand $command): void
    {
        $company = $this->companyRepository->find($command->getCompanyId());
        if (!$company instanceof Company) {
            throw new NotFoundException("Company with provided id was not found");
        }

        $employee = $this->employeeRepository->findOneBy(['company' => $company, 'id' => $command->getId()]);
        if (!$employee instanceof Employee) {
            throw new NotFoundException("Employee with provided id was not found for this company");
        }

        $employee->setName($command->getName());
        $employee->setLastname($command->getLastname());
        $employee->setEmail($command->getEmail());
        $employee->setPhone($command->getPhone());

        $violations = $this->validator->validate($employee);
        if (count($violations) > 0) {
            throw new ValidationFailedException($violations[0], $violations);
        }

        $this->entityManager->flush();
    }
}