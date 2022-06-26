<?php

namespace App\Controller;

use App\Command\EmployeeCreateCommand;
use App\Command\EmployeeDeleteCommand;
use App\Command\EmployeeUpdateCommand;
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

    public function index(int $companyId): Response
    {
        return new JsonResponse(['status' => 'OK']);
    }

    public function create(int $companyId, Request $request): Response
    {
        $command = new EmployeeCreateCommand($companyId);

        $command->setName($request->request->get('name'));
        $command->setLastname($request->request->get('lastName'));
        $command->setEmail($request->request->get('email'));
        $command->setPhone($request->request->get('phone'));

        $employeeId = $this->commandBus->dispatch($command)->last(HandledStamp::class)->getResult();

        return new JsonResponse(['employee' => $employeeId], Response::HTTP_CREATED);
    }

    public function read(int $companyId, int $id): Response
    {
        return new JsonResponse(['status' => 'OK']);
    }

    public function update(int $companyId, int $id, Request $request): Response
    {
        $command = new EmployeeUpdateCommand($companyId, $id);

        $command->setName($request->request->get('name'));
        $command->setLastname($request->request->get('lastName'));
        $command->setEmail($request->request->get('email'));
        $command->setPhone($request->request->get('phone'));

        $this->commandBus->dispatch($command);

        return new JsonResponse(['employee' => $id]);
    }

    public function delete(int $companyId, int $id): Response
    {
        $command = new EmployeeDeleteCommand($companyId, $id);

        $this->commandBus->dispatch($command);

        return new JsonResponse(['status' => 'OK'], Response::HTTP_NO_CONTENT);
    }
}