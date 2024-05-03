<?php

namespace Sorethea\Hrms\Resources\Resources\EmployeeResource\Pages;

use App\Helpers\LeaveHelper;
use App\Models\Employee;
use Filament\Actions;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;
use Sorethea\Hrms\Resources\Exports\EmployeeExporter;
use Sorethea\Hrms\Resources\Resources\EmployeeResource;

class ListEmployees extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ExportAction::make()->exporter(EmployeeExporter::class),
            Actions\Action::make("leave_balance")
                ->form([
                    Checkbox::make("all")
                        ->reactive()
                        ->helperText("All active employees (none probation period employees)")
                        ->default(false),
                    Select::make("employee_ids")
                        ->options(Employee::query()
                            ->where("active",true)
                            ->where("hired_date","<=",now()->subMonth(3))
                            ->pluck("name","id"))
                        ->searchable()
                        ->label("Employees")
                        ->multiple()
                        ->visible(fn(Get $get)=>!$get("all"))
                        ->required(),

                    TextInput::make("amount")
                        ->numeric()
                        ->default(18)
                        ->suffix("days")
                        ->required(),
                ])
                ->action(function (array $data){
                    $employees = [];
                    if($data["all"]){
                        $employees = Employee::query()
                            ->where("active",true)
                            ->where("hired_date","<=",now()->subMonth(3))->get();
                    }else{
                        $employees = Employee::query()->whereIn("id",$data["employee_ids"])->get();
                    }

                    $employees->each(function ($employee) use($data){
                        LeaveHelper::topup($employee,$data["amount"]);
                    });
                })
                ->requiresConfirmation(),

        ];
    }

    protected function getHeaderWidgets(): array
    {
        return EmployeeResource::getWidgets();
    }

     public function getTabs(): array
     {
         return [
             null =>Tab::make("Active")->query(fn($query)=>$query->where("active",true)),
             "Male"=>Tab::make()->query(fn($query)=>$query->where("active",true)->where("gender","male")),
             "Female"=>Tab::make()->query(fn($query)=>$query->where("active",true)->where("gender","female")),
             "Inactive"=>Tab::make()->query(fn($query)=>$query->where("active",false)),
             "Probation"=>Tab::make()->query(fn($query)=>$query->where("active",true)->whereBetween(DB::raw('DATE(hired_date)'),[now()->subMonth(3),now()])),
         ];
     }
}
