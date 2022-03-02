<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id'=>1,
            'name'=>'User'
        ]);
        Role::create([
            'id'=>2,
            'name'=>'Customer'
        ]);
    }
}
