<?php

use Illuminate\Database\Seeder;
use App\TicketStatus;

class TicketStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ts = [
        	'Open','Closed','Pending','Cancelled'

        ];
        foreach ($ts as $value) {
             TicketStatus::create(['name' => $value]);
        }
    }
}
