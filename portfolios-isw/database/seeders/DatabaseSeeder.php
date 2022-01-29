<?php

namespace Database\Seeders;

use App\Models\User;
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
        \App\Models\Role::factory(4)->create();
        \App\Models\User::factory(4)->create();
        foreach (User::all() as $key => $user) {
            $data = ['user_id' => $user->id, 'page_url' => '/', 'status' => false];
            \App\Models\Page::create($data);
        }
    }
}
