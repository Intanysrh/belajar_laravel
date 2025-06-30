<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Level;

class levelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $levels = [
            [
                'name' => 'Administrator'
            ],
            [
                'name' => 'Operator'
            ],
            [
                'name' => 'Leader'
            ]
        ];

        Level::insert($levels);
    }
}
