<?php

namespace App\Observers;

use App\Models\Hyperlink;
use App\Models\Page;

class PageObserver
{
    public function saving(Page $page)
    {
        if ($page->isDirty('add_to_navbar')) {
            if ($page->add_to_navbar) {
                Hyperlink::updateOrCreate([
                    'page_id' => $page->id,
                ], [
                    'page_id' => $page->id,
                    'name' => $page->title,
                    'url' => $page->full_url,
                    'open_in_new_tab' => false,
                ]);
            } else {
                Hyperlink::where('page_id', $page->id)->delete();
            }
        }
    }
}
