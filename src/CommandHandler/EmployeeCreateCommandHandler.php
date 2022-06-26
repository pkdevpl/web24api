<?php

namespace App\CommandHandler;

use App\Command\EmployeeCreateCommand;
use App\Entity\Company;
use App\Entity\Employee;
use App\Exception\NotFoundException;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EmployeeCreateCommandHandler implements ComandHandlerInterface
{
    private EntityManagerInterface $entityManager;
    private CompanyRepository $companyRepository;
    private ValidatorInterface $validator;

    public function __construct(
        EntityManagerInterface $entityManager,
        CompanyRepository $companyRepository,
        ValidatorInterface $validator
    ) {
        $this->entityManager = $entityManager;
        $this->companyRepository = $companyRepository;
        $this->validator = $validator;
    }

    public function __invoke(EmployeeCreateCommand $command): int
    {
        $company = $this->companyRepository->find($command->getCompanyId());
        if (!$company instanceof Company) {
            throw new NotFoundException("Company with provided id was not found");
        }

        $employee = new Employee();

        $employee->setName($command->getName());
        $employee->setLastname($command->getLastname());
        $employee->setEmail($command->getEmail());
        $employee->setPhone($command->getPhone());

        $company->addEmployee($employee);

        $violations = $this->validator->validate($employee);
        if (count($violations) > 0) {
            throw new ValidationFailedException($violations[0], $violations);
        }

        $this->entityManager->persist($employee);
        $this->entityManager->flush();

        return $employee->getId();
    }
}