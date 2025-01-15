<?php

namespace Database\Seeders;

use App\Models\Block;
use Database\Seeders\Seeds\BlockSeeds;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = BlockSeeds::data();

        foreach ($data as $item) {
            Block::updateOrCreate(
                ['name' => $item['name']],
                [
                    'content' => self::getBlockContent($item['name']),
                    ...$item
                ]
            );
        }
    }

    private static function getBlockContent($name)
    {
        $path = database_path('seeders/blocks/' . $name . '.html');

        if (!file_exists($path)) {
            throw new \Exception("Block content file not found: {$path}");
        }

        return file_get_contents($path);
    }
}
