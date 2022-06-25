<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends AbstractController
{
    public function index(): Response
    {
        return new JsonResponse(['status' => 'OK']);
    }

    public function create(): Response
    {
        return new JsonResponse(['status' => 'OK'], Response::HTTP_CREATED);
    }


    public function read(int $id): Response
    {
        return new JsonResponse(['status' => 'OK']);
    }


    public function update(int $id): Response
    {
        return new JsonResponse(['status' => 'OK']);
    }


    public function delete(int $id): Response
    {
        return new JsonResponse(['status' => 'OK'], Response::HTTP_NO_CONTENT);
    }
}