<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TicketsSeeder extends Seeder
{
    public function run()
    {
        // Create an instance of Faker to generate random data
        $faker = Faker::create();

        // Generate 25 sample tickets
        foreach (range(1, 50) as $index) {
            DB::table('tickets')->insert([
                'user_id' => 2, // user_id 2
                'status' => $faker->randomElement(['open', 'closed', 'pending']), // Random status
                'priority' => $faker->randomElement(['low', 'medium', 'high']), // Random priority
                'category' => $faker->randomElement(['software', 'hardware', 'network', 'security', 'other']), // Random category
                'created_by' => $faker->randomDigitNotNull, // Created by, use real user IDs if necessary
                'updated_by' => $faker->randomDigitNotNull, // Updated by, use real user IDs if necessary
                'deleted_by' => null, // Deleted by, for soft deletes
                'title' => $faker->sentence, // Random title
                'description' => $faker->paragraph, // Random description
                'created_at' => Carbon::now(), // Current timestamp for created_at
                'updated_at' => Carbon::now(), // Current timestamp for updated_at
                'deleted_at' => null, // Soft delete column, can be set to a date if necessary
            ]);
        }
    }
}
