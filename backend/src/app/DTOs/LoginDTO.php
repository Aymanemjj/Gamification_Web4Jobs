<?php

namespace App\DTOs;

use App\Interfaces\BasicDtoInterface;
use JsonSerializable;

class LoginDTO implements BasicDtoInterface, JsonSerializable
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $email,
        public string $password,
    ) {}
    
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    public static function make(array $data): self
    {
        return new self(
            $data['email'],
            $data['password'],
        );
    }

    public static function collection(array $data): array
    {
        return array_map(fn($item) => self::make($item), $data);
    }
}
