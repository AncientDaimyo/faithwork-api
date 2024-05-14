<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

use Symfony\Component\Uid\Uuid;

class UuidService
{
    public static function generate() : Uuid {
        
        return Uuid::fromString('d9e7a184-5d5b-11ea-a62a-3499710062d0');
    }
}
