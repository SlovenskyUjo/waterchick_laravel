<?php

namespace Database\Seeders;

use App\Models\Plugin;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PluginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plugin::create(['name' => 'Plugin 1', 'description' => 'Description 1']);

    }
}
