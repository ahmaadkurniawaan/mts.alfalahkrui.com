<?php

namespace App\Livewire;

use App\Helpers;
use App\Models\Hyperlink;
use Livewire\Component;
use App\Models\Page;
use Mustache_Engine;

class ShowPage extends Component
{
    public $page;
    public $url;

    public function mount($url = null)
    {
        $this->url = $url ? trim($url, '/') : '';

        $this->page = Page::where('url', $this->url)
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function render()
    {
        $m = new Mustache_Engine(array('entity_flags' => ENT_QUOTES));

        $html = $m->render($this->page->html, Helpers::getDynamicPageData($this->page));

        $html = Helpers::replaceVariablesInString($html, setting('*'));

        $this->page->html = $html;

        return view('livewire.show-page')
            ->layout('layouts.guest');
    }
}
