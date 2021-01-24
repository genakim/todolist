<?php

namespace App\Dto;

use JMS\Serializer\Annotation as Serialization;
use App\Entity\ListItem;

class ListItemDto
{
    /**
     * @Serialization\Type("string")
     */
    public string $type = ListItem::TYPE;

	/**
	 * @Serialization\Type("int")
	 */
	public int $id;

    /**
     * @Serialization\Type("int")
     */
    public string $parent_id;

    /**
     * @Serialization\Type("string")
     */
    public string $text;

    /**
     * @Serialization\Type("bool")
     */
    public bool $checked;

	/**
	 * @Serialization\Type("int")
	 */
	public int $updated_at;
}