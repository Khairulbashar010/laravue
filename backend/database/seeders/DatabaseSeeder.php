<?php

namespace Database\Seeders;

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
        $this->call([
            RoleTableSeeder::class,
            UserTableSeeder::class,
        ]);
        for ($i=0; $i < 20 ; $i++) {
            $this->call([
                BillTableSeeder::class,
            ]);
        }
    }
}
