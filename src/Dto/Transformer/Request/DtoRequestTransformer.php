<?php

namespace App\Dto\Transformer\Request;

interface DtoRequestTransformer
{
    public function transformObject($object, $dto);
}