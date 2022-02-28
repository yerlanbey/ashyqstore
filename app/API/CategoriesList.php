<?php


namespace App\API;


class CategoriesList
{
    const CATEGORY_COMPUTERS_ID                 = 5751;
    const CATEGORY_ACCESSORIES_PC_ID            = 3586;
    const CATEGORY_COOLING_FANS_ID              = 3486;
    const CATEGORY_MONITORS_ACCESSORIES_ID      = 5648;
    const CATEGORY_INPUT_DEVICES_ACCESSORIES_ID = 3773;
    const CATEGORY_HEADPHONES_MICROPHONES_ID    = 3648;

    /**
     * @return string
     */
    public static function all(): string
    {
        return
            self::CATEGORY_ACCESSORIES_PC_ID . ',' .
            self::CATEGORY_COMPUTERS_ID . ',' .
            self::CATEGORY_COOLING_FANS_ID . ',' .
            self::CATEGORY_MONITORS_ACCESSORIES_ID . ',' .
            self::CATEGORY_INPUT_DEVICES_ACCESSORIES_ID . ',' .
            self::CATEGORY_HEADPHONES_MICROPHONES_ID;
    }

    /**
     * @return array
     */
    public static function IdArray(): array
    {
        return [
                self::CATEGORY_ACCESSORIES_PC_ID,
                self::CATEGORY_COMPUTERS_ID,
                self::CATEGORY_COOLING_FANS_ID,
                self::CATEGORY_MONITORS_ACCESSORIES_ID,
                self::CATEGORY_INPUT_DEVICES_ACCESSORIES_ID,
                self::CATEGORY_HEADPHONES_MICROPHONES_ID
            ];
    }
}
