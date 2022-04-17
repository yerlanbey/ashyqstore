<?php

use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insertOrIgnore([
            'user_id' => 1,
            'role_id' => 1
        ]);
    }
}
