<?php

namespace CRUD_Sample\Model;

class Person
{
    /** @var int $id */
    private int $id;

    /** @var string $firstName */
    private string $firstName;

    /** @var string $lastName */
    private string $lastName;

    /** @var string $username */
    private string $username;

    /** @var string $password */
    private string $password;

    /** @var int $role */
    private int $role;

    /**
     * @return int
     */
    public function getId()
    {
        if (isset($this->id)) {
            return $this->id;
        } else {
            return null;
        }
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }


    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }


    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


    /**
     * @return int
     */
    public function getRole(): string
    {
        return $this->role;
    }


    /**
     * @param int $role
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }
}
