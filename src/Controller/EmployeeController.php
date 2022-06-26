<?php

namespace App\Controller;

use App\Command\EmployeeCreateCommand;
use App\Command\EmployeeDeleteCommand;
use App\Command\EmployeeUpdateCommand;
use App\Query\EmployeeFindByIdQuery;
use App\Query\EmployeeListQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class EmployeeController extends AbstractController
{
    private MessageBusInterface $commandBus;
    private MessageBusInterface $queryBus;

    public function __construct(MessageBusInterface $commandBus, MessageBusInterface $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function index(int $companyId, Request $request): Response
    {
        $query = new EmployeeListQuery($companyId);

        $query->setPage($request->query->get('page'));
        $query->setPerPage($request->query->get('perPage'));
        $query->setQueryField($request->query->get('queryField'));
        $query->setQuery($request->query->get('query'));

        $listDto = $this->queryBus->dispatch($query)->last(HandledStamp::class)->getResult();

        return new JsonResponse($listDto);
    }

    public function create(int $companyId, Request $request): Response
    {
        $command = new EmployeeCreateCommand($companyId);

        $command->setName($request->request->get('name'));
        $command->setLastname($request->request->get('lastName'));
        $command->setEmail($request->request->get('email'));
        $command->setPhone($request->request->get('phone'));

        $employeeId = $this->commandBus->dispatch($command)->last(HandledStamp::class)->getResult();

        $query = new EmployeeFindByIdQuery($companyId, $employeeId);
        $employeeDto = $this->queryBus->dispatch($query)->last(HandledStamp::class)->getResult();

        return new JsonResponse(['employee' => $employeeDto], Response::HTTP_CREATED);
    }

    public function read(int $companyId, int $id): Response
    {
        $query = new EmployeeFindByIdQuery($companyId, $id);

        $employeeDto = $this->queryBus->dispatch($query)->last(HandledStamp::class)->getResult();

        return new JsonResponse(['employee' => $employeeDto]);
    }

    public function update(int $companyId, int $id, Request $request): Response
    {
        $command = new EmployeeUpdateCommand($companyId, $id);

        $command->setName($request->request->get('name'));
        $command->setLastname($request->request->get('lastName'));
        $command->setEmail($request->request->get('email'));
        $command->setPhone($request->request->get('phone'));

        $this->commandBus->dispatch($command);

        $query = new EmployeeFindByIdQuery($companyId, $id);
        $employeeDto = $this->queryBus->dispatch($query)->last(HandledStamp::class)->getResult();

        return new JsonResponse(['employee' => $employeeDto]);
    }

    public function delete(int $companyId, int $id): Response
    {
        $command = new EmployeeDeleteCommand($companyId, $id);

        $this->commandBus->dispatch($command);

        return new JsonResponse(['status' => 'OK'], Response::HTTP_NO_CONTENT);
    }
}