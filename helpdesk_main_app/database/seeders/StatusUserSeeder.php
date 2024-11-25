<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusUsers;
use Carbon\Carbon;

class StatusUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            'active',
            'inactive',
            'suspended',
            'banned',
            'pending',
        ];

        foreach ($status as $stat) {
            StatusUsers::create([
                'status' => $stat,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
