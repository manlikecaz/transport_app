<?php

namespace Database\Seeders;
use \App\Models\Areas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class areasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {    
          Areas::factory(10)->create([]);
        //  Areas::factory(10)->create([
        //     'name' => 'Test User',
        //     'description' => 'we have none',
        // ]);
        }
    }
