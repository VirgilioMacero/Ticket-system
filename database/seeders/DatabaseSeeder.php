<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\AreaService::factory()->create([
            'id'=>1,
            'name' => 'Tech Support',
        ]);
        \App\Models\AreaService::factory()->create([
            'id'=>2,
            'name' => 'App Support',
        ]);
        \App\Models\AreaService::factory()->create([
            'id'=>3,
            'name' => 'Billing',
        ]);
        \App\Models\AreaService::factory()->create([
            'id'=>4,
            'name' => 'Appointment',
        ]);
        \App\Models\AreaService::factory()->create([
            'id'=>5,
            'name' => 'Marketing',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Adrian',
            'email' => 'adrian@newsmartservices.com',
            'type' => 'SUP_USER',
            'area_service_id' => 1,
            'password' => '$2y$10$mA5mr8GmVj.32LJVIOF90.dLSRYjzHTxkH2hv4eZj0VjnVw1/IMWm'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Virgilio',
            'email' => 'virgiliomacero9@gmail.com',
            'type' => 'ADMIN',
            'area_service_id' => 2,
            'password' => '$2y$10$mA5mr8GmVj.32LJVIOF90.dLSRYjzHTxkH2hv4eZj0VjnVw1/IMWm'
        ]);
    }
}
