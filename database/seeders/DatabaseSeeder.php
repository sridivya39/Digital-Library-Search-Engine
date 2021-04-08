<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model as Eloquent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call(UsersTablesSeeder::class);
        $this->call(ClaimTablesSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
