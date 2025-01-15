<?php

namespace Database\Seeders\Seeds;

class PageSeeds
{
    public static function data()
    {
        return [
            [
                "id" => 1,
                "title" => "home",
                "created_at" => "2024-12-27 09:21:31",
                "updated_at" => "2025-01-10 23:04:38",
                "url" => "",
                "is_active" => 1,
                "styles" => "* { box-sizing: border-box; } body {margin: 0;}#ic9o0l{background-image:unset;background-repeat:unset;background-position:unset;background-attachment:unset;background-size:unset;color:#ffffff;width:55px;}#italvv{color:#ffffff;}#i25std{color:#ffffff;}",
                "content" => "{\"logo\": \"\$app_logo\", \"limit\": 3, \"title\": \"\$app_title\", \"navbar\": {\"filter\": {\"limit\": 3}, \"eloquentModel\": \"hyperlink\"}}",
                "add_to_navbar" => 0
            ],
            [
                "id" => 2,
                "title" => "About",
                "created_at" => "2024-12-27 23:52:29",
                "updated_at" => "2025-01-10 23:06:27",
                "url" => "about",
                "is_active" => 1,
                "styles" => "* { box-sizing: border-box; } body {margin: 0;}",
                "content" => "{\"logo\": \"\$app_logo\", \"limit\": 3, \"title\": \"\$app_title\", \"navbar\": {\"filter\": {\"limit\": 3}, \"eloquentModel\": \"hyperlink\"}}",
                "add_to_navbar" => 1
            ],
            [
                "id" => 3,
                "title" => "Teams",
                "created_at" => "2025-01-10 23:07:05",
                "updated_at" => "2025-01-10 23:26:28",
                "url" => "teams",
                "is_active" => 1,
                "styles" => "* { box-sizing: border-box; } body {margin: 0;}#im5ldg{color:#ffffff;}#icq9cs{color:#ffffff;}#i1qjng{color:#ffffff;}#ifgasn{color:#ffffff;}",
                "content" => "{\"logo\": \"\$app_logo\", \"limit\": 3, \"title\": \"\$app_title\", \"navbar\": {\"filter\": {\"limit\": 3}, \"eloquentModel\": \"hyperlink\"}}",
                "add_to_navbar" => 1
            ],
            [
                "id" => 4,
                "title" => "Testimonial",
                "created_at" => "2025-01-10 23:24:39",
                "updated_at" => "2025-01-10 23:33:49",
                "url" => "testimonial",
                "is_active" => 1,
                "styles" => "* { box-sizing: border-box; } body {margin: 0;}",
                "content" => "{\"logo\": \"\$app_logo\", \"limit\": 3, \"title\": \"\$app_title\", \"navbar\": {\"filter\": {\"limit\": 3}, \"eloquentModel\": \"hyperlink\"}}",
                "add_to_navbar" => 1
            ]
        ];
    }
}
