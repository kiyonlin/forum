<?php

use Illuminate\Database\Seeder;

class RepliesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Reply', 50)->create();
    }


}
