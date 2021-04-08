<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class ClaimTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'can_reproduce'     =>'YES',
          'source_code'       => 'abcd',
          'datasets'          => 'provided',
          'exp_results'       => 'xyz',
           
            ]);
    }
}
