<?php

namespace App\Filament\Resources\HyperlinkResource\Pages;

use App\Filament\Pages\DesignPage;
use App\Filament\Resources\HyperlinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHyperlinks extends ManageRecords
{
    protected static string $resource = HyperlinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
