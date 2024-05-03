<?php

namespace Sorethea\Hrms\Resources\Resources\EmployeeResource\RelationManagers;

use App\Filament\Resources\EmployeeResource\RelationManagers\Model;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Sorethea\Hrms\Models\Holiday;
use Sorethea\Hrms\Resources\Resources\LeaveResource;

class LeavesRelationManager extends RelationManager
{
    protected static string $relationship = 'Leaves';

    /**
     * @param Model $ownerRecord
     * @param string $pageClass
     * @return string|null
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->options(fn()=>config("the-a-hrms.leave.type"))
                    ->default("annual_leave"),
                Forms\Components\DatePicker::make('from')
                    ->reactive()
                    ->required(),
                Forms\Components\DatePicker::make('to')
                    ->reactive()
                    ->live()
                    ->minDate(fn(Forms\Get $get)=>$get("from"))
                    ->afterStateUpdated(function($state, Forms\Get $get, callable $set){
                        $holidays = Holiday::query()->whereYear("date",Carbon::make(now())->year)->pluck("date")->toArray();
                        $from = $get("from");
                        $qty = 0;
                        $currentDate = Carbon::make($from);
                        $endDate = Carbon::make($state);
                        while ($currentDate <= $endDate){
                            if($currentDate->isWeekday() && !in_array($currentDate->format('Y-m-d'),$holidays)){
                                $qty ++;
                            }
                            $currentDate->addDay();
                        }
                        //dd($qty);
                        $set("qty",$qty);
                    })
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options(fn()=>config("the-a-hrms.leave.status"))
                    ->default("approved"),
                Forms\Components\TextInput::make('qty')
                    ->helperText("Number of leave taken in day")
                    ->numeric(),
                Forms\Components\Textarea::make('reason')
                    ->maxLength(255)
                    ->columnSpan(2)
            ]);
    }
    protected function applyDefaultSortingToTableQuery(Builder $query): Builder
    {
        return $query->orderBy("from","desc");
    }


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('from')
            ->columns([
//                Tables\Columns\TextColumn::make('id')
//                    ->url(fn($record)=>LeaveResource::getUrl('view',['record'=>$record])),
                Tables\Columns\TextColumn::make('from')
                    ->date(),
                Tables\Columns\TextColumn::make('to')->date(),
                Tables\Columns\TextColumn::make('qty'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn($state)=>config("the-a-hrms.leave.status.".$state))
                    ->color(fn(string $state): string => match ($state){
                        "pending"=>"info",
                        "approved"=>"success",
                        "rejected"=>"danger",
                        "cancelled"=>"warning",
                    }),
                Tables\Columns\IconColumn::make("paid_leave")
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])

            ->actions([
                Tables\Actions\ActionGroup::make(array_merge([
                    Tables\Actions\ViewAction::make(),
                ],LeaveResource::getLeaveActions())),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
