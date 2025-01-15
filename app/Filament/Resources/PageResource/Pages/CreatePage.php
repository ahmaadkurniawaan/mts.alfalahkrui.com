<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Pages\DesignPage;
use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    public function getRedirectUrl(): string
    {
        return DesignPage::getUrl(['page' => $this->record->id]);
    }
}
