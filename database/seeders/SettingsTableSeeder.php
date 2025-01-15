<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        setting(['app_title' => 'Your App Title']);
        setting(['app_logo' => asset('storage/logo.png')]);
    }
}
