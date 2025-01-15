<?php

use App\Livewire\ShowPage;
use App\Livewire\PageBuilder;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Berita;

Route::get('/', ShowPage::class)->name('page.home');
Route::get('/berita', [Berita::class, 'index'])->name('page.berita');

Route::get('admin/pages/builder', App\Filament\Pages\DesignPage::class)->name('filament.pages.design');
Route::get('/{url}', ShowPage::class)->where('url', '.*')->name('page.show');
