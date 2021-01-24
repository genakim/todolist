<?php

namespace App\Dto;

use JMS\Serializer\Annotation as Serialization;

class MessageDto
{
    /**
     * @Serialization\Type("string")
     */
    public string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }
}