<?php

namespace Sorethea\Hrms\Resources;

use App\Filament\Resources\OrganizationalUnitResource\Pages;
use App\Filament\Resources\OrganizationalUnitResource\RelationManagers;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Sorethea\Hrms\Models\OrganizationalUnit;

class OrganizationalUnitResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = OrganizationalUnit::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('type')
                        ->options(config("hrms.outype"))
                        ->searchable()
                        ->nullable(),
                    Forms\Components\Textarea::make('description')
                        ->columnSpanFull(),

                    Forms\Components\Select::make('parent_id')
                        ->searchable()
                        ->relationship('parent', 'name')
                        ->nullable(),
                    Forms\Components\Toggle::make('is_brand')
                        ->live()
                        ->default(false),
                ])
                    ->columnSpan(2)
                    ->columns(2),
                Forms\Components\Section::make([
                    Forms\Components\FileUpload::make("logo")
                        ->image()
                        ->nullable(),
                ])
                    ->hidden(fn(Get $get):bool =>!$get('is_brand'))
                    ->columnSpan(1)
                    ->columns(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->formatStateUsing(fn($state):string =>ucfirst($state))
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_brand')
                    ->boolean(),
                Tables\Columns\TextColumn::make('parent.name')
                    ->numeric()
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
            'index' => \Sorethea\Hrms\Resources\OrganizationalUnitResource\Pages\ListOrganizationalUnits::route('/'),
            'create' => \Sorethea\Hrms\Resources\OrganizationalUnitResource\Pages\CreateOrganizationalUnit::route('/create'),
            'edit' => \Sorethea\Hrms\Resources\OrganizationalUnitResource\Pages\EditOrganizationalUnit::route('/{record}/edit'),
        ];
    }
    public static function getNavigationGroup(): ?string
    {
        return trans('hr.human_resources');
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
        ];
    }
}
