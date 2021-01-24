<?php

namespace App\Dto\Transformer\Response;

interface DtoResponseTransformer
{
    public function transformObject($object);
    public function transformObjects(iterable $objects): iterable;
}