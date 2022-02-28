<?php


namespace App\API;


class SubCategories
{
    /**
     * Категория: Компьютер
     * ID:5751
     */
    const SYSTEM_BLOCKS_ID = 21356;

    /**
     * Категория: Комплект для ПК
     * ID: 3586
     */
    const CPU_ID = 3593;
    const MB_ID  = 3590;
    const VGA_ID = 3587;
    const OZU_ID = 3592;
    const HDD_ID = 3589;
    const SSD_ID = 3594;

    /**
     * Категория: Вентиляторы охлаждения
     * ID: 3486
     */

    const WATER_COOLING_ID             = 3486;
    const UNIVERSAL_COOLING_FOR_CPU_ID = 3493;
    const COOLING_ON_THE_SOCKET_ID     = 3491;
    const COOLING_HARD_DRIVES_ID       = 3489;
    const COOLING_FOR_CASE_ID          = 3490;
    const CONTROL_PANEL_COOLING        = 3494;

    /**
     * Категория: Мониторы и аксессуары
     * ID: 5648
     */

    const MONITORS_ID = 5649;
    const BRACKET_ID  = 5668;

    /**
     * Категория: Устройства для ввода
     * ID: 3773
     */

    const WIRED_KITS_ID               = 3784;
    const WIRELESS_KITS_ID            = 3776;
    const WIRED_MOUSE_ID              = 3785;
    const WIRELESS_MOUSE_ID           = 3777;
    const MOUSE_BLUETOOTH_ID          = 3782;
    const GAME_MOUSE_ID               = 3779;
    const WIRED_KEYBOARDS_ID          = 3783;
    const WIRELESS_KEYBOARDS_ID       = 3775;
    const GAME_KEYBOARDS_ID           = 3778;
    const PROFESSIONAL_GAME_MATS_ID   = 3786;
    const MAT_CLOTH_FACE_ID           = 3781;
    const ACCESSORIES_INPUT_DEVICE_ID = 3774;

    /**
     * Категория: Наушники и микрофоны
     * ID: 3648
     */

    const HEAD_MOUNTS_ID            = 3652;
    const INSERTS_ID                = 3651;
    const WIRELESS_ID               = 3650;
    const BLUETOOTH_HEADSETS_ID     = 3649;
    const MICROPHONES_ID            = 3654;
    const ACCESSORIES_HEADPHONES_ID = 4963;

    /**
     * @return int[]
     */
    public static function getSubCategoriesComputers(): array
    {
        return [
            self::SYSTEM_BLOCKS_ID
        ];
    }

    /**
     * @return int[]
     */
    public static function getSubCategoriesAccessoriesPc(): array
    {
        return [
            self::CPU_ID,
            self::MB_ID,
            self::VGA_ID,
            self::OZU_ID,
            self::HDD_ID,
            self::SSD_ID
        ];
    }

    /**
     * @return int[]
     */
    public static function getSubCategoriesCoolingFans(): array
    {
        return [
            self::WATER_COOLING_ID,
            self::UNIVERSAL_COOLING_FOR_CPU_ID,
            self::COOLING_ON_THE_SOCKET_ID,
            self::COOLING_HARD_DRIVES_ID,
            self::COOLING_FOR_CASE_ID,
            self::CONTROL_PANEL_COOLING
        ];
    }

    /**
     * @return int[]
     */
    public static function getSubCategoriesMonitorsAccessories(): array
    {
        return [
            self::MONITORS_ID,
            self::BRACKET_ID
        ];
    }

    /**
     * @return int[]
     */
    public static function getSubCategoriesDevicesForInput(): array
    {
        return [
            self::WIRED_KITS_ID,
            self::WIRELESS_KITS_ID,
            self::WIRED_MOUSE_ID,
            self::WIRELESS_MOUSE_ID,
            self::MOUSE_BLUETOOTH_ID,
            self::GAME_MOUSE_ID,
            self::WIRED_KEYBOARDS_ID,
            self::WIRELESS_KEYBOARDS_ID,
            self::GAME_KEYBOARDS_ID,
            self::PROFESSIONAL_GAME_MATS_ID,
            self::MAT_CLOTH_FACE_ID,
            self::ACCESSORIES_INPUT_DEVICE_ID
        ];
    }

    /**
     * @return int[]
     */
    public static function getSubCategoriesHeadphonesMicrophone(): array
    {
        return [
            self::HEAD_MOUNTS_ID,
            self::INSERTS_ID,
            self::WIRELESS_ID,
            self::BLUETOOTH_HEADSETS_ID,
            self::MICROPHONES_ID,
            self::ACCESSORIES_HEADPHONES_ID
        ];
    }

    public function getSubCategories(int $id)
    {
        switch ($id) {
            case ($id == CategoriesList::CATEGORY_COMPUTERS_ID):
                return self::getSubCategoriesComputers();
            case ($id == CategoriesList::CATEGORY_ACCESSORIES_PC_ID):
                return self::getSubCategoriesAccessoriesPc();
            case ($id == CategoriesList::CATEGORY_COOLING_FANS_ID):
                return self::getSubCategoriesCoolingFans();
            case ($id == CategoriesList::CATEGORY_MONITORS_ACCESSORIES_ID):
                return self::getSubCategoriesMonitorsAccessories();
            case ($id == CategoriesList::CATEGORY_INPUT_DEVICES_ACCESSORIES_ID):
                return self::getSubCategoriesDevicesForInput();
            case ($id == CategoriesList::CATEGORY_HEADPHONES_MICROPHONES_ID):
                return self::getSubCategoriesHeadphonesMicrophone();
        }
    }
}
