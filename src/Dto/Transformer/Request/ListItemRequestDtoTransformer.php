<?php

namespace App\Dto\Transformer\Request;

use App\Dto\ListItemDto;
use App\Entity\ListItem;

class ListItemRequestDtoTransformer implements DtoRequestTransformer
{
	/**
	 * @param ListItem $list_item
	 *
	 * @param ListItemDto $dto
	 *
	 * @return ListItem
	 */
    public function transformObject($list_item, $dto): ListItem
    {
		$list_item->setParentId($dto->parent_id);
        $list_item->setText($dto->text);
        $list_item->setChecked($dto->checked);
        $list_item->setUpdatedAt(new \DateTime());

        return $list_item;
    }
}