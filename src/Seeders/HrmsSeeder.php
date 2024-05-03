<?php

namespace Sorethea\Hrms\Seeders;

use Illuminate\Database\Seeder;

class HrmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
           Holiday2024::class,
        ]);
    }
}
