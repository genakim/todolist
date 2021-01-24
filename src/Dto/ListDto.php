<?php

namespace App\Dto;

use JMS\Serializer\Annotation as Serialization;
use App\Entity\Lists;

class ListDto
{
    /**
     * @Serialization\Type("string")
     */
    public string $type = Lists::TYPE;

	/**
	 * @Serialization\Type("int")
	 */
	public int $id;

    /**
     * @Serialization\Type("string")
     */
    public string $title;

    /**
     * @Serialization\Type("string")
     */
    public string $color;

	/**
	 * @Serialization\Type("int")
	 */
	public int $updated_at;
}