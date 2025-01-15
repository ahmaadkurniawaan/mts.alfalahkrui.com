<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Pages\DesignPage;
use App\Helpers;
use Filament\Actions\DeleteAction;
use Filament\Forms\Get as FormsGet;
use Filament\Forms\Set as FormsSet;
use Filament\Tables\Actions\DeleteAction as ActionsDeleteAction;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (FormsGet $get, FormsSet $set, ?string $state) {
                        if (! $get('is_name_changed')) {
                            $set('url', Str::slug($state));
                        }
                    }),

                Forms\Components\TextInput::make('url')
                    ->label('URL')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->live()
                    ->afterStateUpdated(function (FormsSet $set) {
                        $set('is_name_changed', true);
                    })
                    ->helperText('This will be auto-generated but you can modify it if needed'),

                Forms\Components\Toggle::make('add_to_navbar')
                    ->label('Add to navbar')
                    ->default(false),

                Forms\Components\Hidden::make('is_name_changed')
                    ->default(false),
            ])
            ->columns(1);
    }

    public static function download(Page $page)
    {
        try {
            return Helpers::downloadPage($page);
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error downloading page')
                ->danger()
                ->send();
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('url')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->hidden(fn(Page $record) => $record->id === 1),
                Tables\Actions\Action::make('editWeb')
                    ->label('Design')
                    ->url(fn(Page $record): string => DesignPage::getUrl(['page' => $record->id]))
                    ->icon('heroicon-m-paint-brush')
                    ->color('danger'),
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->color('warning')
                    ->action(fn(Page $record) => self::download($record)),
                Tables\Actions\Action::make('viewWeb')
                    ->label('Preview')
                    ->url(fn(Page $record): string => url($record->url))
                    ->openUrlInNewTab()
                    ->icon('heroicon-m-eye')
                    ->color('success'),
                ActionsDeleteAction::make()
                    ->hidden(fn(Page $record) => $record->id === 1),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->checkIfRecordIsSelectableUsing(
                fn(Model $record): bool => $record->id !== 1
            );
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function canDelete(Model $record): bool
    {
        return $record->id !== 1;
    }

    public static function canEdit(Model $record): bool
    {
        return $record->id !== 1;
    }
}
