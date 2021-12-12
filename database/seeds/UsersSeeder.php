<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('87072355355Er'),
                'email_verified_at' => '2021-07-02 10:48:05',
                'is_admin'       => 2,
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
