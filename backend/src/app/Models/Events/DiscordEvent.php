<?php

namespace App\Models\Events;

use App\Interfaces\SourceEventModelInterface;
use Illuminate\Database\Eloquent\Model;


class DiscordEvent implements SourceEventModelInterface
{
    //



    
    public function resolve(): void
    {
	throw new \BadMethodCallException('Not implemented');
    }

    
    public function validate(): bool
    {
	throw new \BadMethodCallException('Not implemented');
    }

    
    public function getType(): string
    {
	throw new \BadMethodCallException('Not implemented');
    }
    
    
    public function getPayload(): array
    {
	throw new \BadMethodCallException('Not implemented');
    }
}
