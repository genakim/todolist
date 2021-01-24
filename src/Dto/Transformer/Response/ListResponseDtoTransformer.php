<?php

namespace App\Dto\Transformer\Response;

use App\Dto\ListDto;
use App\Entity\Lists;

class ListResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    /**
     * @param Lists $list
     *
     * @return ListDto
     */
    public function transformObject($list): ListDto
    {
        $dto = new ListDto();

        $dto->id = $list->getId();
        $dto->title = $list->getTitle();
        $dto->color = $list->getColor();
        $dto->updated_at = $list->getUpdatedAt()->getTimestamp();

        return $dto;
    }
}