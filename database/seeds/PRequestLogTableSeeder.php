<?php

use Illuminate\Database\Seeder;

class PRequestLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PRequestLog::class, 50000)->create();
    }
}
