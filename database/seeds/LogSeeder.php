<?php

use App\Category;
use App\Log;
use App\User;
use Illuminate\Database\Seeder;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = Category::all();
        $users = User::all();
        for ($i=0;$i<300;$i++) {
            $date = now()->addDay(rand(-400,400));
            factory(Log::class)->create([
                'category_id' => $cats->random(),
                'payer_id' => $users->random(),
                'created_at' => $date,
                'date' => $date->format('Y-m-d'),
            ]);
        }
    }
}
