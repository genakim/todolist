<?php
namespace App\Enum;

use ReflectionClass;

/**
 * Class Color
 * @package App\Enum
 */
class Color
{
    public const YELLOW = '#ffeb3b';
    public const GREEN = '#00e676';
    public const BLUE = '#00b8d4';
    public const GREY = '#e0e0e0';
    public const DEFAULT ='#ffffff';

    /**
     * Gets color hex code
     *
     * @param string $color
     */
    public function get(string $color)
    {
        $reflection = new ReflectionClass(__CLASS__);
        $colors = $reflection->getConstants();
        return $colors[$color] ?? self::DEFAULT;
    }
}