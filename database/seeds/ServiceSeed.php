<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allservices = [
        	'Internet','Dark Fiber','Local Loop','Machine Servicing','RTU Monitoring','Network Planning and Design'

        ];
        foreach ($allservices as $value) {
             Service::create(['name' => $value]);
        }
    }
}
