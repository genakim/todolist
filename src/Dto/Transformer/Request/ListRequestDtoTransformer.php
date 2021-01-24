<?php

namespace App\Dto\Transformer\Request;

use App\Dto\ListDto;
use App\Entity\Lists;

class ListRequestDtoTransformer implements DtoRequestTransformer
{
	/**
	 * @param Lists $list
	 *
	 * @param ListDto $dto
	 *
	 * @return Lists
	 */
    public function transformObject($list, $dto): Lists
    {
        $list->setTitle($dto->title);
        $list->setColor($dto->color);
        $list->setUpdatedAt(new \DateTime());

        return $list;
    }
}