<?php

namespace App\Shared\Domain\Service;

use App\Shared\Domain\Interface\ToArrayInterface;

class EntityToArrayService
{
    public static function toArray(ToArrayInterface $entity): array
    {
        return $entity->toArray();
    }
}