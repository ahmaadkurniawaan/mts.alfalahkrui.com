<?php

namespace Database\Seeders;

use App\Models\Page;
use Database\Seeders\Seeds\PageSeeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = PageSeeds::data();

        foreach ($data as $item) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Page::updateOrCreate(
                ['url' => $item['url']],
                [
                    'html' => self::getPageData($item['url'] === "" ? "home" : $item['url'], "html"),
                    "project_data" => json_decode(self::getPageData($item['url'] === "" ? "home" : $item['url'], "json")),
                    ...$item,
                    "content" => json_decode($item["content"])
                ]
            );
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }

    private static function getPageData($name, $type)
    {
        $path = database_path('seeders/pages/' . $name . '.' . $type);

        if (!file_exists($path)) {
            throw new \Exception("Page content file not found: {$path}");
        }

        return file_get_contents($path);
    }
}
