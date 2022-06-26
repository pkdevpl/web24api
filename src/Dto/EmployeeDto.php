<?php

namespace App\Dto;

class EmployeeDto
{
    public ?int $id;
    public ?string $name;
    public ?string $lastname;
    public ?string $email;
    public ?string $phone;

    public function __construct()
    {
        $this->id = null;
        $this->name = null;
        $this->lastname = null;
        $this->email = null;
        $this->phone = null;
    }
}