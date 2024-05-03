<?php

namespace Sorethea\Hrms\Resources\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reference_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('reference_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('balance')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('last_balance')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('type')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('remark')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reference_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('balance')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_balance')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
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
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Sorethea\Hrms\Resources\Resources\TransactionResource\Pages\ListTransactions::route('/'),
            'create' => \Sorethea\Hrms\Resources\Resources\TransactionResource\Pages\CreateTransaction::route('/create'),
            'edit' => \Sorethea\Hrms\Resources\Resources\TransactionResource\Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return trans('hr.human_resources');
    }
}
