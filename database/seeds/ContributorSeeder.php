<?php

use App\Category;
use App\Contributor;
use App\User;
use Illuminate\Database\Seeder;

class ContributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $cats = Category::all();
        foreach ($cats as $c) {
            $contribution = rand(10, 90);
            factory(Contributor::class)->create([
                'user_id' => $users[0]->id,
                'category_id' => $c->id,
                'contribution' => $contribution
            ]);
            factory(Contributor::class)->create([
                'user_id' => $users[1]->id,
                'category_id' => $c->id,
                'contribution' => 100 - $contribution
            ]);
        }
    }
}
