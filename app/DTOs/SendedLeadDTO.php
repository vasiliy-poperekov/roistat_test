<?php

namespace App\DTOs;

class SendedLeadDTO
{
    private string $price;
    private string $contactName;
    private string $email;
    private string $phone;

    public function __construct(
        string $price,
        string $contactName,
        string $email,
        string $phone
    ) {
        $this->price = $price;
        $this->contactName = $contactName;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getContactName(): string
    {
        return $this->contactName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function setContactName(string $contactName): void
    {
        $this->contactName = $contactName;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
}
