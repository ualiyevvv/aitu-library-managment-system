<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        DB::table('users')->insert([
            'nickname' => 'admin',
            'tg_username' => "admin",
            'group' => "admin",
            'idcard' => "admin",
            'is_admin' => 1,
            'password' => "$2y$10$56LwWa34YVZDa5hzWeff4eYdT35sWgr7H/ufwhZnfSBjnL0uR2te2"
        ]);
    }
}
