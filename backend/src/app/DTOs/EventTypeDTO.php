<?php

namespace App\DTOs;

use App\Interfaces\BasicDtoInterface;
use App\Models\Platform;

readonly class EventTypeDTO implements BasicDtoInterface
{
    public function __construct(
        public string $type,
        public Platform $platform,
    ) {}

    public static function make(array $data): self
    {
        return new self(
            type: $data['type'],
            platform: Platform::where('name', $data['platform'])->firstOrFail(),
        );
    }

    public static function collection(array $data): array
    {
        return array_map(fn($item) => self::make($item), $data);
    }

    public function toArray(): array
    {
        return [
            'type'        => $this->type,
            'platform_id' => $this->platform->id,
        ];
    }
}