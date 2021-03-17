<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'category_create',
            ],
            [
                'id'    => '18',
                'title' => 'category_edit',
            ],
            [
                'id'    => '19',
                'title' => 'category_show',
            ],
            [
                'id'    => '20',
                'title' => 'category_delete',
            ],
            [
                'id'    => '21',
                'title' => 'category_access',
            ],
            [
                'id'    => '22',
                'title' => 'shop_create',
            ],
            [
                'id'    => '23',
                'title' => 'shop_edit',
            ],
            [
                'id'    => '24',
                'title' => 'shop_show',
            ],
            [
                'id'    => '25',
                'title' => 'shop_delete',
            ],
            [
                'id'    => '26',
                'title' => 'shop_access',
            ],
            [
                'id'    => '27',
                'title' => 'product_create',
            ],
            [
                'id'    => '28',
                'title' => 'product_edit',
            ],
            [
                'id'    => '29',
                'title' => 'product_show',
            ],
            [
                'id'    => '30',
                'title' => 'product_show',
            ],
            [
                'id'    => '31',
                'title' => 'product_access',
            ],
            [
                'id'    => '32',
                'title' => 'food_create',
            ],
            [
                'id'    => '33',
                'title' => 'food_edit',
            ],
            [
                'id'    => '34',
                'title' => 'food_show',
            ],
            [
                'id'    => '35',
                'title' => 'food_delete',
            ],
            [
                'id'    => '36',
                'title' => 'food_access',
            ],
            [
                'id'    => '37',
                'title' => 'dish_create',
            ],
            [
                'id'    => '38',
                'title' => 'dish_edit',
            ],
            [
                'id'    => '39',
                'title' => 'dish_show',
            ],
            [
                'id'    => '40',
                'title' => 'dish_delete',
            ],
            [
                'id'    => '41',
                'title' => 'dish_access',
            ],
            [
                'id'    => '42',
                'title' => 'market_create',
            ],
            [
                'id'    => '43',
                'title' => 'market_edit',
            ],
            [
                'id'    => '44',
                'title' => 'market_show',
            ],
            [
                'id'    => '45',
                'title' => 'market_delete',
            ],
            [
                'id'    => '46',
                'title' => 'market_access',
            ],
            [
                'id'    => '47',
                'title' => 'restaurant_create',
            ],
            [
                'id'    => '48',
                'title' => 'restaurant_edit',
            ],
            [
                'id'    => '49',
                'title' => 'restaurant_show',
            ],
            [
                'id'    => '50',
                'title' => 'restaurant_delete',
            ],
            [
                'id'    => '51',
                'title' => 'restaurant_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
