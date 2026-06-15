<?php

namespace App\Interfaces;

interface BasicDtoInterface
{
    public function toArray(): array;
    public static function make(array $data): static;
    public static function collection(array $data): array;
}
