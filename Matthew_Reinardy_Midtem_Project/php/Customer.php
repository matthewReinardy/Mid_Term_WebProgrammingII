<?php
class Customer
{
    public String $userFirstName;
    public String $userLastName;
    public String $email;
    public String $shippingAddress;

    // Constructor
    public function __construct(string $userFirstName, string $userLastName, string $email, string $shippingAddress)
    {
        $this->userFirstName = $userFirstName;
        $this->userLastName = $userLastName;
        $this->email = $email;
        $this->shippingAddress = $shippingAddress;
    }

    // Getters
    public function getUserFirstName(): string
    {
        return $this->userFirstName;
    }

    public function getUserLastName(): string
    {
        return $this->userLastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getShippingAddress(): string
    {
        return $this->shippingAddress;
    }

    // Setters
    public function setUserFirstName(string $userFirstName): void
    {
        $this->userFirstName = $userFirstName;
    }

    public function setUserLastName(string $userLastName): void
    {
        $this->userLastName = $userLastName;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setShippingAddress(string $shippingAddress): void
    {
        $this->shippingAddress = $shippingAddress;
    }
}
