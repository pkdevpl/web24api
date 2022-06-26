<?php

namespace App\Command;

class CompanyCreateCommand implements CommandInterface
{
    private ?string $name;
    private ?string $nip;
    private ?string $address;
    private ?string $city;
    private ?string $postal;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getNip(): ?string
    {
        return $this->nip;
    }

    public function setNip(?string $nip): void
    {
        $this->nip = $nip;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getPostal(): ?string
    {
        return $this->postal;
    }

    public function setPostal(?string $postal): void
    {
        $this->postal = $postal;
    }
}