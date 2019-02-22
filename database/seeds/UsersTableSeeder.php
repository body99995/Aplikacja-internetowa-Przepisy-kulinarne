<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = 'Rafal';
        $user->surname = 'Wodyk';
        $user->password = bcrypt('qwerty');
        $user->email = 'wody1@op.pl';
        $user->save();
        
        $user = new \App\User();
        $user->name = 'Marcin';
        $user->surname = 'Nowak';
        $user->password = bcrypt('qwerty2');
        $user->email = 'admin@admin.com';
        $user->save();
    }
}
