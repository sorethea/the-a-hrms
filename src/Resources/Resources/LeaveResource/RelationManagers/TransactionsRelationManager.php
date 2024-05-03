<?php

namespace Sorethea\Hrms\Resources\Resources\LeaveResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('type')
            ->columns([
                //Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('remark'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('qty'),
                Tables\Columns\TextColumn::make('balance'),
                Tables\Columns\TextColumn::make('last_balance'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
