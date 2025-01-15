<?php

namespace App\Livewire;

use App\Helpers;
use Livewire\Component;

use App\Models\Page;
use App\Models\Block;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class PageBuilder extends Component
{
    public $html = '';
    public $styles = '';
    public $projectData = [];
    public $content = [];
    public $page;

    protected $rules = [
        'html' => 'required'
    ];

    public function mount($page = null)
    {
        $this->html = html_entity_decode($this->page->html ?? '');
        $this->styles = $this->page->styles ?? '';
        $this->projectData = $this->page->projectData ?? [];
        $this->content = $this->page->content ?? '';

        $this->initData($page);
    }

    public function initData($pageId)
    {
        $page = Page::find($pageId);

        $this->page = $page;

        $blocks = Block::where('is_active', true)
            ->get()
            ->map(function ($block) {
                if ($block->preview_image) {
                    $block->preview_image = asset('storage/' . $block->preview_image);
                }
                return $block;
            })
            ->toArray();

        $this->dispatch('load-initial-data', $page, $blocks, setting('*'));
    }

    public function save()
    {
        $this->validate();

        $this->page->fill([
            'html' => $this->html,
            'styles' => $this->styles,
            'project_data' => $this->projectData,
            'content' => $this->content,
        ])->save();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.page-builder');
    }

    public function getData($model, $filters = [])
    {
        return Helpers::getDynamicDataFromEloquent($model, $filters);
    }

    public function handleSave($data)
    {
        try {
            $this->html = $data['html'];
            $this->styles = $data['styles'];
            $this->projectData = $data['projectData'];
            $this->content = $data['content'];
            $this->save();

            Notification::make()
                ->title('Changes saved')
                ->body('Your page content has been updated.')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            Notification::make()
                ->title('Error saving changes')
                ->body('There was a problem saving your changes.')
                ->danger()
                ->send();
        }
    }
}
