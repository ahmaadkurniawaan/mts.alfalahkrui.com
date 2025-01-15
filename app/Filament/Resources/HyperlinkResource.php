<?php

namespace App\Filament\Resources;

use App\Filament\Pages\DesignPage;
use App\Filament\Resources\HyperlinkResource\Pages;
use App\Models\Hyperlink;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;

class HyperlinkResource extends Resource
{
    protected static ?string $model = Hyperlink::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $label = 'Navbar Links';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\ToggleButtons::make('type')
                    ->options([
                        'page' => 'Page',
                        'url' => 'URL',
                    ])
                    ->grouped()
                    ->reactive()
                    ->columnSpanFull()
                    ->default('page')
                    ->required(),
                Forms\Components\Select::make('page_id')
                    ->label('Page')
                    ->relationship('page', 'title')
                    ->preload()
                    ->searchable()
                    ->required(fn(Get $get) => $get('type') === 'page')
                    ->hidden(fn(Get $get) => $get('type') !== 'page')
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        if ($get('page_id')) {
                            $page = Page::find($get('page_id'));
                            $set('name', $page->title);
                            $set('url', $page->full_url);
                        }
                    })
                    ->reactive(),
                Forms\Components\TextInput::make('name')
                    ->label('Title')
                    ->required()
                    ->maxLength(255)
                    ->reactive(),
                Forms\Components\TextInput::make('url')
                    ->required()
                    ->maxLength(255)
                    ->readOnly(fn(Get $get) => $get('type') !== 'url'),
                Forms\Components\Toggle::make('open_in_new_tab')
                    ->required(),
            ])->columns(1)->inlineLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->searchable(),
                Tables\Columns\IconColumn::make('open_in_new_tab')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                DownStepAction::make(),
                UpStepAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageHyperlinks::route('/'),
        ];
    }
}
