<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends AbstractController
{
    public function index(int $companyId): Response
    {
        return new JsonResponse(['status' => 'OK']);
    }

    public function create(int $companyId): Response
    {
        return new JsonResponse(['status' => 'OK'], Response::HTTP_CREATED);
    }


    public function read(int $companyId, int $id): Response
    {
        return new JsonResponse(['status' => 'OK']);
    }


    public function update(int $companyId, int $id): Response
    {
        return new JsonResponse(['status' => 'OK']);
    }


    public function delete(int $companyId, int $id): Response
    {
        return new JsonResponse(['status' => 'OK'], Response::HTTP_NO_CONTENT);
    }
}