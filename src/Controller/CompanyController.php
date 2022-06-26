<?php

namespace App\Controller;

use App\Command\CompanyCreateCommand;
use App\Command\CompanyUpdateCommand;
use App\Query\CompanyFindByIdQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class CompanyController extends AbstractController
{
    private MessageBusInterface $commandBus;
    private MessageBusInterface $queryBus;

    public function __construct(MessageBusInterface $commandBus, MessageBusInterface $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function index(): Response
    {
        return new JsonResponse(['status' => 'OK']);
    }

    public function create(Request $request): Response
    {
        $command = new CompanyCreateCommand();

        $command->setName($request->request->get('name'));
        $command->setNip($request->request->get('nip'));
        $command->setAddress($request->request->get('address'));
        $command->setCity($request->request->get('city'));
        $command->setPostal($request->request->get('postal'));

        $companyId = $this->commandBus->dispatch($command)->last(HandledStamp::class)->getResult();

        $companyDto = $this->queryBus->dispatch(new CompanyFindByIdQuery($companyId))->last(HandledStamp::class)->getResult();

        return new JsonResponse(['company' => $companyDto], Response::HTTP_CREATED);
    }


    public function read(int $id): Response
    {
        $query = new CompanyFindByIdQuery($id);

        $companyDto = $this->queryBus->dispatch($query)->last(HandledStamp::class)->getResult();

        return new JsonResponse(['company' => $companyDto]);
    }


    public function update(int $id, Request $request): Response
    {
        $command = new CompanyUpdateCommand();

        $command->setId($id);
        $command->setName($request->request->get('name'));
        $command->setNip($request->request->get('nip'));
        $command->setAddress($request->request->get('address'));
        $command->setCity($request->request->get('city'));
        $command->setPostal($request->request->get('postal'));

        $this->commandBus->dispatch($command);

        $companyDto = $this->queryBus->dispatch(new CompanyFindByIdQuery($id))->last(HandledStamp::class)->getResult();

        return new JsonResponse(['company' => $companyDto]);
    }


    public function delete(int $id): Response
    {
        return new JsonResponse(['status' => 'OK'], Response::HTTP_NO_CONTENT);
    }
}