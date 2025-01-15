<?php

namespace App;

use App\Models\Page;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Mustache_Engine;

class Helpers
{

    public static function getDynamicPageData(Page $page)
    {
        $content = collect($page->content ?? [])
            ->mapWithKeys(function ($value, $key) {
                if (is_array($value) && isset($value['eloquentModel'])) {
                    return [$key => self::getDynamicDataFromEloquent($value['eloquentModel'], $value['filter'] ?? [])];
                }
                return [$key => $value];
            });

        $settings = setting('*');

        return [
            "meta" => [
                "current_url" => url()->current()
            ],
            ...$content->toArray(),
            ...$settings
        ];
    }


    public static function getDynamicDataFromEloquent($model, $filters = [])
    {
        $query = ("App\\Models\\" . Str::studly($model))::query();

        if (!empty($filters['conditions'])) {
            foreach ($filters['conditions'] as $condition) {
                $query->where($condition['field'], $condition['operator'], $condition['value']);
            }
        }

        if (!empty($filters['sort'])) {
            $query->orderBy($filters['sort'], $filters['order'] ?? 'asc');
        }

        if (!empty($filters['limit'])) {
            $query->limit($filters['limit']);
        }

        return $query->get();
    }

    public static function downloadPage(Page $page)
    {
        try {
            $m = new Mustache_Engine(array('entity_flags' => ENT_QUOTES));

            $page->html = $m->render($page->html, Helpers::getDynamicPageData($page));

            $htmlContent = view('download', ['page' => $page])->render();

            $filename = $page->url == '' ? 'index' : $page->url . '.html';

            return response()->streamDownload(function () use ($htmlContent) {
                echo $htmlContent;
            }, $filename, [
                'Content-Type' => 'text/html',
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public static function replaceVariablesInString($string, $variables = [])
    {
        return preg_replace_callback('/\$([a-zA-Z_][a-zA-Z0-9_]*)/', function ($matches) use ($variables) {
            $variableName = $matches[1];
            
            return array_key_exists($variableName, $variables) ? $variables[$variableName] : $matches[0];
        }, $string);
    }
}
