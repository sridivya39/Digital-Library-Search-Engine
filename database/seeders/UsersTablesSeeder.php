<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        User::create([
            'first_name'        => 'Sridivya',
            'last_name'         => 'Majeti',
            'email'             => 'sridivyamajeti22@gmail.com',
            'password'          =>  Hash::make('password'),
            'remember_token'    =>  Str::random(10),
            // 'Verification_code' =>  Str::random(10),
            // // 'is_verified'       =>  
            
        ]);
    
    }
}
