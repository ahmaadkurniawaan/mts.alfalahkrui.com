<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlockResource\Pages;
use App\Models\Block;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Get as FormsGet;
use Filament\Forms\Set as FormsSet;

class BlockResource extends Resource
{
    protected static ?string $model = Block::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('label')
                            ->label('Block Label')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (FormsGet $get, FormsSet $set, ?string $state) {
                                if (! $get('is_name_changed')) {
                                    $set('name', Str::slug($state));
                                }
                            })
                            ->helperText('The display name for this block'),

                        Forms\Components\TextInput::make('name')
                            ->label('Block ID')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->live()
                            ->afterStateUpdated(function (FormsSet $set) {
                                $set('is_name_changed', true);
                            })
                            ->helperText('This will be auto-generated but you can modify it if needed'),

                        Forms\Components\Hidden::make('is_name_changed')
                            ->default(false),

                        Forms\Components\TextInput::make('category')
                            ->required(),
                        Forms\Components\FileUpload::make('preview_image')
                            ->image()
                            ->directory('block-previews'),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                        Forms\Components\Textarea::make('content')
                            ->label('HTML Content')
                            ->required()
                            ->columnSpanFull()
                            ->rows(10)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('preview_image')
                    ->square(),
                Tables\Columns\TextColumn::make('label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'Basic' => 'Basic',
                        'Tailblocks' => 'Tailblocks',
                        'Custom' => 'Custom',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active status'),
            ])
            ->actions([
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
            'index' => Pages\ListBlocks::route('/'),
            'view' => Pages\ViewBlock::route('/{record}'),
            // 'create' => Pages\CreateBlock::route('/create'),
            // 'edit' => Pages\EditBlock::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return true;
    }
}