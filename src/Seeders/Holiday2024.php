<?php

namespace Sorethea\Hrms\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Sorethea\Hrms\Models\Holiday;

class Holiday2024 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $holidays=[
            "1/1/2024"=>"International New Year Day",
            "1/7/2024"=>"Day of Victory over the Genocidal Regime",
            "3/8/2024"=>"International Women's Rights Day",
            "4/13/2024"=>"Khmer New Year's Day",
            "4/14/2024"=>"Khmer New Year's Day",
            "4/15/2024"=>"Khmer New Year's Day",
            "4/16/2024"=>"Khmer New Year's Day",
            "5/1/2024"=>"International Labor Day",
            "5/14/2024"=>"Birthday of His Majesty Preah Bat Samdech Preah Boromneath NORODOM SIHAMONI, King of Cambodia",
            "5/22/2024"=>"Visaka Bochea Day",
            "5/26/2024"=>"Royal Ploughing Ceremony",
            "6/18/2024"=>"Birthday of Her Majesty the Queen-Mother NORODOM MONINEATH SIHANOUK of Cambodia",
            "9/24/2024"=>"Constitution Day",
            "10/1/2024"=>"Pchum Ben Day",
            "10/2/2024"=>"Pchum Ben Day",
            "10/3/2024"=>"Pchum Ben Day",
            "10/15/2024"=>"Mourning Day of the Late King-Father NORODOM SIHANOUK of Cambodia",
            "10/29/2024"=>"Coronation Day of His Majesty Preah Bat Samdech Preah Boromneath NORODOM SIHAMONI, King of Cambodia",
            "11/9/2024"=>"National Independence Day",
            "11/14/2024"=>"Water Festival",
            "11/15/2024"=>"Water Festival",
            "11/16/2024"=>"Water Festival",
        ];
        foreach ($holidays as $key => $value){
            Holiday::create(
                [
                    "name"=>$value,
                    "date"=>Carbon::make($key)
                ]
            );
        }
    }
}
