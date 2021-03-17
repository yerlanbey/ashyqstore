<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
          [
          'name' => 'Мобильные телефоны',
          'code' => 'mobiles',
          'description' => 'Описание мобильных телефонов',
          'image' => 'categories/mobile.jpg'

          ],
          [
            'name' => 'Бытовая техника',
            'code' => 'appliances',
            'description' => 'Описание бытовой техники',
            'image' => 'categories/appliance.jpg'

          ],
          [
            'name' => 'Портативная техника',
            'code' => 'portable',
            'description' => 'Описание портативной техники',
            'image' => 'categories/portable.jpg'

          ],
        ]);

    }
}
