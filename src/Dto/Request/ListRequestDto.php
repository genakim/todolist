<?php

namespace App\Dto\Request;

use JMS\Serializer\Annotation as Serialization;
use App\Dto\ListDto;

class ListRequestDto extends ListDto
{
	/**
	 * @Serialization\Type("array<App\Dto\ListItemDto>")
	 */
	public array $items;
}