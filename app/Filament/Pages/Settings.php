<?php

namespace App\Filament\Pages;

use Closure;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Outerweb\FilamentSettings\Filament\Pages\Settings as BaseSettings;
use Illuminate\Support\Str;

class Settings extends BaseSettings
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?int $navigationSort = 5;

    public function schema(): array|Closure
    {
        return [
            TextInput::make('app_title')
                ->label('App Title')
                ->required(),
            FileUpload::make('app_logo')
                ->label('App Logo')
                ->visibility('public')
                ->image()
                ->storeFileNamesIn('original_filename')
                ->afterStateHydrated(static function (BaseFileUpload $component, string|array|null $state) {
                    if (blank($state)) {
                        $component->state([]);

                        return;
                    }
                    $component->state([((string) Str::uuid()) => $state]);
                })
                ->getUploadedFileUsing(static function (BaseFileUpload $component, string $file, string|array|null $storedFileNames): ?array {

                    return [
                        'name' => basename($file),
                        'size' => 0,
                        'type' => null,
                        'url' => $file,
                    ];
                })
                ->required(),
        ];
    }

    public function afterSave()
    {
        $logo = setting('app_logo');
        if ($logo && !str_starts_with($logo, 'http')) {
            setting(['app_logo' => asset('storage/' . $logo)]);
        }
    }
}
