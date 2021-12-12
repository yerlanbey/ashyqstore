<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Для Админа
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        // Для продавцов одежды
        $entrepreneur_shop = $admin_permissions->filter(function ($permission) {
            if ((substr($permission->title, 0, 5) == 'shop_') == true)
                return substr($permission->title, 0, 5) == 'shop_';
        });

        $entrepreneur_product = $admin_permissions->filter(function ($permission) {
            if ((substr($permission->title, 0, 8) == 'product_') == true){
                return substr($permission->title, 0, 8) == 'product_';
            }
        });

        Role::findOrFail(5)->permissions()->attach($entrepreneur_shop);
        Role::findOrFail(5)->permissions()->attach($entrepreneur_product);

        // Для продуктовых магазинов
        $retailer_market = $admin_permissions->filter(function ($permission) {
            if((substr($permission->title, 0, 7) == 'market_') == true){
                return substr($permission->title, 0, 7) == 'market_';
            }
        });

        $retailer_food = $admin_permissions->filter(function ($permission){
            if((substr($permission->title, 0, 5) == 'food_') == true){
                return substr($permission->title, 0, 5) == 'food_';
            }
        });

        Role::findOrFail(4)->permissions()->attach($retailer_market);
        Role::findOrFail(4)->permissions()->attach($retailer_food);

        //Для Ресторатор
        $restaurateur_restaurant = $admin_permissions->filter(function ($permission) {
            if((substr($permission->title, 0, 11) == 'restaurant_') == true)
                return substr($permission->title, 0, 11) == 'restaurant_';
        });


        $restaurateur_dish = $admin_permissions->filter(function ($permission) {
            if((substr($permission->title, 0, 5) == 'dish_') == true){
                return substr($permission->title, 0, 5) == 'dish_';
            }
        });

        Role::findOrFail(3)->permissions()->attach($restaurateur_restaurant);
        Role::findOrFail(3)->permissions()->attach($restaurateur_dish);




    }
}
