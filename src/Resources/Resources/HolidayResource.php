<?php

namespace Sorethea\Hrms\Resources\Resources;

use App\Filament\Resources\HolidayResource\Pages;
use App\Filament\Resources\HolidayResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Sorethea\Hrms\Models\Holiday;

class HolidayResource extends Resource
{
    protected static ?string $model = Holiday::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->columnSpan(2)
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('date')
                        ->required(),
                ])->columns(3),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->date("D, d M Y")
                    ->sortable(),
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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => \Sorethea\Hrms\Resources\Resources\HolidayResource\Pages\ListHolidays::route('/'),
            'create' => \Sorethea\Hrms\Resources\Resources\HolidayResource\Pages\CreateHoliday::route('/create'),
            'edit' => \Sorethea\Hrms\Resources\Resources\HolidayResource\Pages\EditHoliday::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return trans('hr.human_resources');
    }
}
