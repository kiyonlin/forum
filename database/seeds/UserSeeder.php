<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User')->create([
            'name'     => 'kiyon',
            'email'    => 'kiyonlin@163.com',
        ]);

        factory('App\User')->create([
            'name'     => 'nini',
            'email'    => 'nini@163.com',
        ]);
    }


}
