<?php

namespace App\Dto\Transformer\Response;

use App\Dto\ListItemDto;
use App\Entity\ListItem;

class ListItemResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    /**
     * @param ListItem $list
     *
     * @return ListItemDto
     */
    public function transformObject($list): ListItemDto
    {
        $dto = new ListItemDto();

        $dto->id = $list->getId();
        $dto->parent_id = $list->getParentId();
        $dto->text = $list->getText();
        $dto->checked = $list->getChecked();
        $dto->updated_at = $list->getUpdatedAt()->getTimestamp();

        return $dto;
    }

}