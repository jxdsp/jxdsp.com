<?php

namespace jxdsp\Member\Traits;

use Ramsey\Uuid\Uuid;

trait UidTrait
{
    public function createUid(): string
    {
        return Uuid::uuid4()->toString();
    }
}
