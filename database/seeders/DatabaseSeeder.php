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
        \App\Models\User::factory()->make([
            'perid' => 'admin',
            'name' => 'admin',
            'admin'=> 1,

        ]);

        \App\Models\Group::factory()->make();
    }
}
