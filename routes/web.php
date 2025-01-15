<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\PageBuilder;

use App\Livewire\ShowPage;

Route::get('/', ShowPage::class)->name('page.home');

Route::get('admin/pages/builder', App\Filament\Pages\DesignPage::class)->name('filament.pages.design');
Route::get('/{url}', ShowPage::class)->where('url', '.*')->name('page.show');
