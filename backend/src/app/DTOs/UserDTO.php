<?php

namespace App\DTOs;

use App\Interfaces\BasicDtoInterface;
use JsonSerializable;

readonly class UserDTO implements BasicDtoInterface, JsonSerializable
{
    public function __construct(
        public int    $id,
        public string $firstname,
        public string $lastname,
        public int    $age,
        public string $email,
        public string $role,
    ) {}

    public static function make(array $data): static
    {
        return new self(
            id:        $data['id'],
            firstname: $data['firstname'],
            lastname:  $data['lastname'],
            age:       $data['age'],
            email:     $data['email'],
            role:      $data['role'],
        );
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'id'        => $this->id,
            'firstname' => $this->firstname,
            'lastname'  => $this->lastname,
            'age'       => $this->age,
            'email'     => $this->email,
            'role'      => $this->role,
        ];
    }
    public static function collection(array $data): array
    {
        return array_map(fn ($item) => self::make($item), $data);
    }
}