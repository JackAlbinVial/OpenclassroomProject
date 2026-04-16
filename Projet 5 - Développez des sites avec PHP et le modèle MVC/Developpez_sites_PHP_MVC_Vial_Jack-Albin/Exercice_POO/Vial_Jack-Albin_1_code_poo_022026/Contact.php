<?php

class Contact
{
    private ?int $id              = null;
    private ?string $name         = null;
    private ?string $email        = null;
    private ?string $phone_number = null;

    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?string $email = null,
        ?string $phone_number = null
    ) {
        $this->id           = $id;
        $this->name         = $name;
        $this->email        = $email;
        $this->phone_number = $phone_number;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function setPhoneNumber(?string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    // --- Méthode d'affichage ---

    public function __toString(): string
    {
        return "{$this->id}, {$this->name}, {$this->email}, {$this->phone_number}\n";
    }
}
