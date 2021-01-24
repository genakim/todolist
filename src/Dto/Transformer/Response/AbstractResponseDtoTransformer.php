<?php

namespace App\Dto\Transformer\Response;

abstract class AbstractResponseDtoTransformer implements DtoResponseTransformer
{
    public function transformObjects(iterable $objects): array
    {
        $dto = [];
        foreach ($objects as $object) {
            $dto[] = $this->transformObject($object);
        }
        return $dto;
    }
}