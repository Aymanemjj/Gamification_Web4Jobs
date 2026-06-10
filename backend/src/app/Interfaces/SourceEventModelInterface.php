<?php

namespace App\Interfaces;

interface SourceEventModelInterface
{
    public function resolve(): void;
    public function validate(): bool;
    public function getType(): string;
    public function getPayload(): array;
}
