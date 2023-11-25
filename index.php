<?php

class User
{
    private string $name;
    private int $age;
    private string $email;

    private function setName(string $name): void
    {
        $this->name = $name;
    }

    private function setAge(int $age): void
    {
        $this->age = $age;
    }

    private function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function __call($checkSet, $arguments)
    {
        $setters = ['setName', 'setAge', 'setEmail'];

        if (in_array($checkSet, $setters)) {
            $this->$checkSet(...$arguments);
        } else {
            throw new CustomException("Setter not allowed");
        }
    }

    public function getAll(): array
    {
        return ['name' => $this->name, 'age' => $this->age, 'email' => $this->email];
    }
}

class CustomException extends Exception {}

try {
    $user = new User();

    //$user->setName("Alex");
    //$user->setAge(11);
    //$user->setEmail("Alex111@gmail.com");

    //$user->setPhone('12345');

    $userGetInfo = $user->getAll();

    print_r($userGetInfo);
}
catch (CustomException $exception)
{
    echo $exception->getMessage();
}

