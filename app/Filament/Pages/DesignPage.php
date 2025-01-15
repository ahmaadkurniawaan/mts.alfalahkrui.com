<?php

namespace App\Filament\Pages;

use App\Helpers;
use Filament\Pages\Page;

use App\Models\Page as PageModel;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Notification;

class DesignPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.design';

    protected static bool $shouldRegisterNavigation = false;

    public $page;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview')->label('Preview')->url(route('page.show', ['url' => $this->page->url === '' ? '/' : $this->page->url]))->openUrlInNewTab()->icon('heroicon-o-eye')->extraModalWindowAttributes(['target' => '_blank']),
            Action::make('download')
                ->label('Download')
                ->icon('heroicon-m-arrow-down-tray')
                ->color('warning')
                ->action(function () {
                    try {
                        return Helpers::downloadPage($this->page);
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Error downloading page')
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }

    public function mount()
    {
        $pageId = request()->query('page');

        if (!$pageId) {
            abort(404);
        }
        
        $this->page = PageModel::findOrFail($pageId);
    }

    public function getTitle(): string
    {
        if ($this->page) {
            return 'Page Design - ' . $this->page->title;
        }
        return 'Design Page';
    }
}
