<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                'id'    => 2,
                'title' => 'User',
            ],
            [
                'id' => 3,
                'title' => 'Restaurateur'
            ],
            [
                'id' => 4,
                'title' => 'Retailer'
            ],
            [
                'id' => 5,
                'title' => 'Entrepreneur'
            ]
        ];

        Role::insert($roles);
    }
}
